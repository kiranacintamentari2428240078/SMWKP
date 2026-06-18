<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Review;

class DinasController extends Controller
{
    public function dashboard()
    {
        $totalPengajuan = Restaurant::count();
        $menunggu = Restaurant::where('status', 'submitted')->count();
        $approvedCount = Restaurant::where('status', 'approved')->count();
        $rejectedCount = Restaurant::where('status', 'rejected')->count();
        $restaurants = Restaurant::where('status', 'submitted')->orderBy('created_at', 'desc')->take(3)->get();
        $avgRating = round(\App\Models\Review::avg('rating') ?: 4.8, 1);
        $reviewsCount = \App\Models\Review::count();

        return view('Dinas.dashboardDinas', compact('totalPengajuan', 'menunggu', 'approvedCount', 'rejectedCount', 'restaurants', 'avgRating', 'reviewsCount'));
    }

    public function verifikasi()
    {
        // Fetch pending submitted restaurants
        $restaurants = Restaurant::where('status', 'submitted')->orderBy('created_at', 'desc')->get();
        
        $totalPengajuan = Restaurant::count();
        $menunggu = Restaurant::where('status', 'submitted')->count();
        $approvedCount = Restaurant::where('status', 'approved')->count();
        $tingkatPenyelesaian = $totalPengajuan > 0 ? round(($approvedCount / $totalPengajuan) * 100) : 0;

        return view('Dinas.verifikasiRestoran', compact('restaurants', 'totalPengajuan', 'menunggu', 'tingkatPenyelesaian'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'nullable|string'
        ]);

        $resto = Restaurant::findOrFail($id);
        $resto->status = $request->status;
        if ($request->filled('rejection_reason')) {
            $resto->rejection_reason = $request->rejection_reason;
        }
        $resto->save();

        $message = $request->status === 'approved' 
            ? "Restoran {$resto->nama_restoran} berhasil disetujui." 
            : "Restoran {$resto->nama_restoran} berhasil ditolak.";

        return redirect()->route('dinas.verifikasi')->with('success', $message);
    }

    public function ulasan(Request $request)
    {
        $totalReviews = Review::count();
        $reportedReviews = Review::where('status', 'reported')->count();
        $averageRating = Review::avg('rating') ?? 0.0;

        $query = Review::with(['user', 'restaurant']);

        // Search Filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('comment', 'like', '%' . $search . '%')
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('name', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('restaurant', function($rq) use ($search) {
                      $rq->where('nama_restoran', 'like', '%' . $search . '%');
                  });
            });
        }

        // Rating Filter
        if ($request->filled('rating') && $request->rating !== 'all') {
            $query->where('rating', $request->rating);
        }

        // Status Filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Period Filter
        if ($request->filled('periode') && $request->periode !== 'all') {
            switch ($request->periode) {
                case 'today':
                    $query->whereDate('created_at', today());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                    break;
                case 'year':
                    $query->whereYear('created_at', now()->year);
                    break;
            }
        }

        $reviews = $query->orderBy('created_at', 'desc')->paginate(10);

        if ($request->ajax()) {
            return response()->json([
                'html' => view('Dinas.partials.review_rows', compact('reviews'))->render(),
                'hasMore' => $reviews->hasMorePages(),
                'nextPageUrl' => $reviews->nextPageUrl(),
            ]);
        }

        return view('Dinas.manajemenUlasan', compact(
            'reviews', 
            'totalReviews', 
            'reportedReviews', 
            'averageRating'
        ));
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return response()->json([
            'success' => true,
            'message' => 'Ulasan berhasil dihapus.'
        ]);
    }

    public function sertifikasi()
    {
        $restaurants = Restaurant::whereNotNull('halal_certificate_file')
            ->orWhere('halal_status', '!=', 'none')
            ->orderBy('updated_at', 'desc')
            ->get();

        $totalPengajuan = Restaurant::whereNotNull('halal_certificate_file')->count();
        $menunggu = Restaurant::where('halal_status', 'reviewing')->count();
        $aktif = Restaurant::where('halal_status', 'verified')->count();
        $kadaluarsa = Restaurant::where('halal_status', 'expired')->count();

        return view('Dinas.sertifHalalCadang', compact('restaurants', 'totalPengajuan', 'menunggu', 'aktif', 'kadaluarsa'));
    }

    public function updateSertifikasiStatus(Request $request, $id)
    {
        $request->validate([
            'halal_status' => 'required|in:verified,expired,none,reviewing',
        ]);

        $resto = Restaurant::findOrFail($id);
        $resto->halal_status = $request->halal_status;
        $resto->save();

        return redirect()->route('dinas.sertifikasi')->with('success', "Status sertifikasi halal {$resto->nama_restoran} berhasil diperbarui.");
    }

    public function sertifikatHalal()
    {
        return view('Dinas.sertifikatHalal');
    }

    public function profil()
    {
        return view('Dinas.profil');
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

        return redirect()->back()->with('success', 'Profil admin Dinas berhasil diperbarui.');
    }
}
