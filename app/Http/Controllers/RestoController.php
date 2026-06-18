<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Booking;
use App\Models\Review;
use App\Models\Menu;

class RestoController extends Controller
{
    private function getRestaurant()
    {
        $restaurant = auth()->user()->restaurant;
        if (!$restaurant) {
            abort(403, 'Silakan daftarkan restoran Anda terlebih dahulu.');
        }
        return $restaurant;
    }

    public function dashboard()
    {
        $restaurant = $this->getRestaurant();

        $totalBookings = $restaurant->bookings()->count();
        $pendingBookings = $restaurant->bookings()->where('status', 'pending')->count();
        $totalReviews = $restaurant->reviews()->count();
        $avgRating = round($restaurant->reviews()->avg('rating') ?: 5.0, 1);

        $bookings = $restaurant->bookings()->orderBy('created_at', 'desc')->take(5)->get();
        $reviews = $restaurant->reviews()->orderBy('created_at', 'desc')->take(5)->get();

        return view('Resto.dashboardResto', compact('restaurant', 'totalBookings', 'pendingBookings', 'totalReviews', 'avgRating', 'bookings', 'reviews'));
    }

    public function restoSaya()
    {
        $restaurant = $this->getRestaurant();
        return view('Resto.restoSaya', compact('restaurant'));
    }

    public function booking()
    {
        $restaurant = $this->getRestaurant();
        $allBookingsQuery = $restaurant->bookings();
        
        $totalBookings = (clone $allBookingsQuery)->count();
        $pendingBookings = (clone $allBookingsQuery)->where('status', 'pending')->count();
        $confirmedBookings = (clone $allBookingsQuery)->where('status', 'confirmed')->count();
        
        $bookings = $allBookingsQuery->orderBy('created_at', 'desc')->paginate(10);
        
        return view('Resto.bookinganMasuk', compact('restaurant', 'bookings', 'totalBookings', 'pendingBookings', 'confirmedBookings'));
    }

    public function galeri(Request $request)
    {
        $restaurant = $this->getRestaurant();
        $query = $restaurant->menus();

        // Filter by Category
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        // Search Query
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $menus = $query->orderBy('created_at', 'desc')->paginate(8);

        // Fetch all categories for filter chips
        $categories = $restaurant->menus()->distinct()->pluck('category')->toArray();

        if ($request->ajax()) {
            return response()->json([
                'html' => view('Resto.partials.menu_cards', compact('menus'))->render(),
                'hasMore' => $menus->hasMorePages(),
                'nextPageUrl' => $menus->nextPageUrl(),
            ]);
        }

        return view('Resto.galeriFoto', compact('restaurant', 'menus', 'categories'));
    }

    public function reviews()
    {
        $restaurant = $this->getRestaurant();
        $reviews = $restaurant->reviews()->with('user')->orderBy('created_at', 'desc')->get();
        return view('Resto.ulasanResto', compact('restaurant', 'reviews'));
    }

    public function sertifikasi()
    {
        $restaurant = $this->getRestaurant();
        return view('Resto.sertifikasi', compact('restaurant'));
    }

    public function profilAdmin()
    {
        return view('Resto.profilAdmin');
    }

    public function profilUsaha()
    {
        $restaurant = $this->getRestaurant();
        return view('Resto.profilUsaha', compact('restaurant'));
    }

    public function editResto()
    {
        $restaurant = $this->getRestaurant();
        return view('Resto.editResto', compact('restaurant'));
    }

    public function statusPendaftaran()
    {
        $restaurant = auth()->user()->restaurant;
        return view('Resto.statusPendaftaran', compact('restaurant'));
    }

    // ==========================================
    // ACTION ENDPOINTS
    // ==========================================

    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:confirmed,rejected',
        ]);

        $restaurant = $this->getRestaurant();
        $booking = $restaurant->bookings()->findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        $statusMsg = $request->status === 'confirmed' ? 'disetujui' : 'dibatalkan';

        return redirect()->back()->with('success', "Reservasi oleh {$booking->guest_name} berhasil {$statusMsg}.");
    }

    public function replyReview(Request $request, $id)
    {
        $request->validate([
            'reply_comment' => 'required|string',
        ]);

        $restaurant = $this->getRestaurant();
        $review = $restaurant->reviews()->findOrFail($id);
        $review->reply_comment = $request->reply_comment;
        $review->save();

        return redirect()->back()->with('success', 'Balasan ulasan berhasil dikirim.');
    }

    public function updateProfile(Request $request)
    {
        $restaurant = $this->getRestaurant();

        $request->validate([
            'nama_restoran' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'description' => 'nullable|string',
            'maps_url' => 'nullable|url',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'kategori' => 'required|string',
            'operational_hours_weekday' => 'nullable|string',
            'operational_hours_weekend' => 'nullable|string',
            'nama_pemilik' => 'required|string|max:255',
            'nib_number' => 'nullable|string|max:100',
            'halal_certificate_number' => 'nullable|string|max:100',
            'thumbnail' => 'nullable|image|max:2048',
        ]);

        $operationalHours = [
            'Senin-Jumat' => $request->input('operational_hours_weekday', '08:00 - 21:00'),
            'Sabtu-Minggu' => $request->input('operational_hours_weekend', '07:00 - 22:00'),
        ];

        $photos = $restaurant->photos;
        if ($request->hasFile('thumbnail')) {
            if (is_array($photos) && count($photos) > 0) {
                foreach ($photos as $oldPhoto) {
                    if ($oldPhoto && !str_starts_with($oldPhoto, 'http://') && !str_starts_with($oldPhoto, 'https://')) {
                        if (\Storage::disk('public')->exists($oldPhoto)) {
                            \Storage::disk('public')->delete($oldPhoto);
                        }
                    }
                }
            }
            $path = $request->file('thumbnail')->store('restaurants', 'public');
            $photos = [$path];
        }

        $restaurant->update([
            'nama_restoran' => $request->nama_restoran,
            'whatsapp' => $request->whatsapp,
            'alamat' => $request->alamat,
            'description' => $request->description,
            'maps_url' => $request->maps_url,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'kategori' => $request->kategori,
            'operational_hours' => json_encode($operationalHours),
            'nama_pemilik' => $request->nama_pemilik,
            'nib_number' => $request->nib_number,
            'halal_certificate_number' => $request->halal_certificate_number,
            'photos' => $photos,
        ]);

        return redirect()->route('resto.restoSaya')->with('success', 'Profil restoran berhasil diperbarui.');
    }

    public function updateAccount(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('users', 'email')->ignore($user->id),
                \Illuminate\Validation\Rule::unique('restaurants', 'email')->ignore($user->restaurant ? $user->restaurant->id : null),
            ],
            'phone' => 'required|string|max:20',
            'photo' => 'nullable|image|max:2048',
            'current_password' => 'nullable|required_with:new_password|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('photo')) {
            if ($user->photo && \Storage::disk('public')->exists($user->photo)) {
                \Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $request->file('photo')->store('profile_photos', 'public');
        }

        $passwordChanged = false;
        if ($request->filled('new_password')) {
            if (!\Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini tidak cocok.']);
            }
            $user->password = \Hash::make($request->new_password);
            $passwordChanged = true;
        }

        $user->save();

        if ($user->restaurant) {
            $user->restaurant->whatsapp = $request->phone;
            $user->restaurant->email = $request->email;
            $user->restaurant->nama_pemilik = $request->name;
            $user->restaurant->save();
        }

        if ($passwordChanged) {
            auth()->login($user);
        }

        return redirect()->back()->with('success', 'Akun admin berhasil diperbarui.');
    }

    public function storeMenu(Request $request)
    {
        $restaurant = $this->getRestaurant();

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'category' => 'required|string',
            'custom_category' => 'nullable|required_if:category,custom|string|max:100',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('menus', 'public');
        }

        $category = $request->category === 'custom' ? $request->custom_category : $request->category;

        Menu::create([
            'restaurant_id' => $restaurant->id,
            'name' => $request->name,
            'price' => $request->price,
            'category' => $category,
            'description' => $request->description,
            'photo' => $photoPath,
        ]);

        return redirect()->back()->with('success', 'Item menu baru berhasil diunggah.');
    }

    public function deleteMenu($id)
    {
        $restaurant = $this->getRestaurant();
        $menu = $restaurant->menus()->findOrFail($id);
        
        if ($menu->photo && \Storage::disk('public')->exists($menu->photo)) {
            \Storage::disk('public')->delete($menu->photo);
        }
        
        $menu->delete();
        
        return redirect()->back()->with('success', "Item menu {$menu->name} berhasil dihapus.");
    }

    public function uploadCertification(Request $request)
    {
        $restaurant = $this->getRestaurant();

        $request->validate([
            'nib_file' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
            'halal_certificate_file' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
            'nib_number' => 'nullable|string|max:100',
            'halal_certificate_number' => 'nullable|string|max:100',
        ]);

        if ($request->filled('nib_number')) {
            $restaurant->nib_number = $request->nib_number;
        }

        if ($request->filled('halal_certificate_number')) {
            $restaurant->halal_certificate_number = $request->halal_certificate_number;
            if ($restaurant->halal_status === 'none' || !$restaurant->halal_status) {
                $restaurant->halal_status = 'reviewing';
            }
        }

        if ($request->hasFile('nib_file')) {
            $path = $request->file('nib_file')->store('certifications', 'public');
            $restaurant->nib_file = $path;
        }

        if ($request->hasFile('halal_certificate_file')) {
            $path = $request->file('halal_certificate_file')->store('certifications', 'public');
            $restaurant->halal_certificate_file = $path;
            $restaurant->halal_status = 'reviewing';
        }

        $restaurant->save();

        return redirect()->back()->with('success', 'Berkas sertifikasi dan legalitas berhasil diperbarui.');
    }
}