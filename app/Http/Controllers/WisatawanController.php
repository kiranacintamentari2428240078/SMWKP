<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Menu;
use Carbon\Carbon;

class WisatawanController extends Controller
{
    public function homepage()
    {
        $restaurants = Restaurant::withAvg('reviews', 'rating')
            ->where('status', 'approved')
            ->take(3)
            ->get();

        return view('Wisatawan.homepageWisatawanlogged-in', compact('restaurants'));
    }

    public function guestHomepage()
    {
        $restaurants = Restaurant::withAvg('reviews', 'rating')
            ->where('status', 'approved')
            ->take(3)
            ->get();

        return view('Wisatawan.homepageWisatawan', compact('restaurants'));
    }

    public function katalog(Request $request)
    {
        $query = Restaurant::withAvg('reviews', 'rating')->where('status', 'approved');

        // Apply Search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('nama_restoran', 'LIKE', '%' . $search . '%')
                  ->orWhere('kategori', 'LIKE', '%' . $search . '%')
                  ->orWhere('alamat', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('menus', function ($m) use ($search) {
                      $m->where('name', 'LIKE', '%' . $search . '%');
                  });
            });
        }

        // Apply Categories Filter
        if ($request->has('categories') && is_array($request->categories)) {
            $query->whereIn('kategori', $request->categories);
        }

        // Apply Rating Filter
        if ($request->filled('rating')) {
            $query->having('reviews_avg_rating', '>=', $request->input('rating'));
        }

        // Apply Price Filter
        if ($request->filled('price_max')) {
            $priceMax = $request->input('price_max');
            $query->whereHas('menus', function ($m) use ($priceMax) {
                $m->where('price', '<=', $priceMax);
            });
        }

        // Sort order
        $sort = $request->input('sort', 'popular');
        if ($sort === 'rating') {
            $query->orderBy('reviews_avg_rating', 'desc');
        } elseif ($sort === 'price_low') {
            $query->leftJoin('menus', 'restaurants.id', '=', 'menus.restaurant_id')
                  ->select('restaurants.*')
                  ->selectRaw('MIN(menus.price) as min_price')
                  ->groupBy('restaurants.id')
                  ->orderBy('min_price', 'asc');
        } else {
            $query->withCount('reviews')->orderBy('reviews_count', 'desc');
        }

        $restaurants = $query->paginate(6)->appends($request->query());

        return view('Wisatawan.katalog', compact('restaurants'));
    }

    public function kategori($slug)
    {
        $viewMap = [
            'pempek' => 'Wisatawan.pempek',
            'pempek-kapal-selam' => 'Wisatawan.pempek',
            'mie-celor' => 'Wisatawan.mieCelor',
            'miecelor' => 'Wisatawan.mieCelor',
            'tekwan' => 'Wisatawan.tekwan',
            'model' => 'Wisatawan.model',
            'laksan' => 'Wisatawan.laksan',
        ];

        $view = $viewMap[strtolower($slug)] ?? null;

        if (!$view) {
            abort(404);
        }

        $categoryName = str_replace('-', ' ', $slug);
        $restaurants = Restaurant::withAvg('reviews', 'rating')
            ->where('status', 'approved')
            ->where('kategori', 'LIKE', '%' . $categoryName . '%')
            ->get();

        return view($view, compact('restaurants', 'slug'));
    }

    public function detailRestoran($id = null)
    {
        if (!$id) {
            $resto = Restaurant::where('status', 'approved')->first() ?? Restaurant::first();
        } else {
            $resto = Restaurant::find($id);
        }

        if (!$resto) {
            abort(404, 'Restoran tidak ditemukan');
        }

        $reviews = $resto->reviews()->where('status', 'visible')->orderBy('created_at', 'desc')->get();
        $menus = $resto->menus;
        $avgRating = $resto->reviews()->avg('rating') ?: 5;
        $reviewsCount = $resto->reviews()->count();

        return view('Wisatawan.detailRestoran', compact('resto', 'reviews', 'menus', 'avgRating', 'reviewsCount'));
    }

    public function ulasanSaya()
    {
        $reviews = Review::where('user_id', auth()->id())->with('restaurant')->orderBy('created_at', 'desc')->get();
        return view('Wisatawan.daftarUlasan', compact('reviews'));
    }

    public function formulirReservasi(Request $request)
    {
        $restoId = $request->input('restaurant_id');
        $resto = Restaurant::find($restoId) ?? Restaurant::first();

        return view('Wisatawan.reservasiMeja', compact('resto'));
    }

    public function storeReservasi(Request $request)
    {
        $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'guest_name' => 'required|string|max:255',
            'guest_whatsapp' => 'required|string|max:20',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
            'number_of_guests' => 'required|integer|min:1|max:50',
        ]);

        $bookingTime = Carbon::parse($request->booking_date . ' ' . $request->booking_time);

        $booking = Booking::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $request->restaurant_id,
            'guest_name' => $request->guest_name,
            'guest_whatsapp' => $request->guest_whatsapp,
            'booking_time' => $bookingTime,
            'number_of_guests' => $request->number_of_guests,
            'status' => 'pending',
        ]);

        return redirect()->route('wisatawan.konfirmasi-reservasi', ['id' => $booking->id])
            ->with('success', 'Reservasi meja berhasil diajukan.');
    }

    public function konfirmasiReservasi($id)
    {
        $booking = Booking::with('restaurant')->findOrFail($id);
        return view('Wisatawan.reservasiBerhasil', compact('booking'));
    }

    public function peta()
    {
        $restaurants = Restaurant::where('status', 'approved')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        return view('Wisatawan.petaKuliner', compact('restaurants'));
    }

    public function tentang()
    {
        return view('Wisatawan.tentang');
    }

    public function profil()
    {
        return view('Wisatawan.profil');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
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

        if ($passwordChanged) {
            auth()->login($user);
        }

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui.');
    }
}
