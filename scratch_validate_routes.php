<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Route;

// Get all registered route names
$registeredRoutes = [];
foreach (Route::getRoutes() as $route) {
    if ($route->getName()) {
        $registeredRoutes[] = $route->getName();
    }
}

$viewsPath = __DIR__ . '/resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsPath));
$report = [];

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $filePath = $file->getPathname();
        $relativePath = str_replace(__DIR__ . DIRECTORY_SEPARATOR, '', $filePath);
        $content = file_get_contents($filePath);
        $lines = file($filePath);
        
        foreach ($lines as $lineNum => $line) {
            // Find all href="..." or href='...'
            if (preg_match_all('/href=(["\'])(.*?)\1/', $line, $matches)) {
                foreach ($matches[2] as $href) {
                    // Ignore stylesheets, fonts, external assets, icons, etc.
                    if (preg_match('/\.css|fonts\.googleapis|cdnjs\.cloudflare|cdn\.jsdelivr|bootstrap|unpkg|font-awesome|font-icons/', $href)) {
                        continue;
                    }
                    
                    $status = 'VALID';
                    $reason = '';
                    
                    // Case 1: Empty or hash href
                    if (trim($href) === '' || trim($href) === '#') {
                        $status = 'BROKEN';
                        $reason = 'Empty or hash (#) href';
                    }
                    // Case 2: route() helper
                    elseif (preg_match('/route\(\s*[\'"]([^\'"]+)[\'"]/', $href, $routeMatch)) {
                        $routeName = $routeMatch[1];
                        if (!in_array($routeName, $registeredRoutes)) {
                            $status = 'BROKEN';
                            $reason = "Route name '{$routeName}' is not registered";
                        }
                    }
                    // Case 3: url() helper
                    elseif (preg_match('/url\(\s*[\'"]([^\'"]+)[\'"]/', $href, $urlMatch)) {
                        // Just a warning or check if valid relative path
                        // url('/') or similar
                    }
                    // Case 4: relative path or external URL
                    else {
                        // Check if it's a relative path starting with /
                        if (str_starts_with($href, '/')) {
                            // Find if any route matches this URI
                            $found = false;
                            foreach (Route::getRoutes() as $r) {
                                if ($r->uri() === ltrim($href, '/')) {
                                    $found = true;
                                    break;
                                }
                            }
                            if ($href === '/') {
                                $found = true; // Root redirects
                            }
                            if (!$found) {
                                $status = 'BROKEN';
                                $reason = "Path '{$href}' does not match any registered route URI";
                            }
                        } elseif (str_starts_with($href, 'http://') || str_starts_with($href, 'https://') || str_starts_with($href, 'mailto:')) {
                            // External URL, valid format
                        } else {
                            $status = 'BROKEN';
                            $reason = "Invalid link format: '{$href}'";
                        }
                    }
                    
                    if ($status === 'BROKEN') {
                        $report[$relativePath][] = [
                            'line' => $lineNum + 1,
                            'href' => $href,
                            'reason' => $reason,
                            'content' => trim($line)
                        ];
                    }
                }
            }
        }
    }
}

// Print report
echo json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
file_put_contents('link_audit_report.json', json_encode($report, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
