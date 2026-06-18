<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Wisatawan.registrasiAkunWisatawan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'wisatawan'
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil, silakan login');
    }

    public function mitraStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp' => 'required|string|max:20',
            'nama_restoran' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|unique:restaurants,email',
            'kategori' => 'required|string',
            'password' => 'required|min:8|confirmed',
            'alamat' => 'required|string',
            'photos' => 'nullable|array',
            'photos.*' => 'image|max:2048'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mitra'
        ]);

        $uploadedPhotos = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('restaurants', 'public');
                $uploadedPhotos[] = $path;
            }
        }

        Restaurant::create([
            'user_id' => $user->id,
            'nama_pemilik' => $request->name,
            'nama_restoran' => $request->nama_restoran,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'kategori' => $request->kategori,
            'alamat' => $request->alamat,
            'photos' => $uploadedPhotos,
            'status' => 'submitted',
        ]);

        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil dikirim! Tim kurasi kami akan menghubungi Anda dalam 2x24 jam.');
    }
}