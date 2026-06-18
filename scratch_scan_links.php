<?php
$viewsPath = __DIR__ . '/resources/views';
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewsPath));
$results = [];

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $filePath = $file->getPathname();
        $relativePath = str_replace(__DIR__ . '/', '', $filePath);
        $lines = file($filePath);
        
        foreach ($lines as $lineNum => $line) {
            // Find all href matches in this line
            // Match href="something" or href='something'
            if (preg_match_all('/href=(["\'])(.*?)\1/', $line, $matches)) {
                foreach ($matches[2] as $href) {
                    if (preg_match('/\.css|fonts\.googleapis|cdnjs\.cloudflare|cdn\.jsdelivr|bootstrap|unpkg|font-awesome|font-icons/', $href)) {
                        continue;
                    }
                    $results[$relativePath][] = [
                        'line' => $lineNum + 1,
                        'href' => $href,
                        'content' => trim($line)
                    ];
                }
            }
        }
    }
}

foreach ($results as $file => $items) {
    echo "========================================\n";
    echo "FILE: $file\n";
    echo "========================================\n";
    foreach ($items as $item) {
        printf("Line %3d | Href: %-60s | Line content: %s\n", $item['line'], $item['href'], $item['content']);
    }
    echo "\n";
}
