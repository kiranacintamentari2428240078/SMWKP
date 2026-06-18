<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function tentang()
    {
        return view('public.tentangKami');
    }

    public function privacy()
    {
        return view('public.kebijakanPrivasi');
    }

    public function help()
    {
        return view('public.pusatBantuan');
    }

    public function terms()
    {
        return view('public.syaratKetentuan');
    }

    public function contact()
    {
        return view('public.contact');
    }

    public function partnerships()
    {
        return view('public.partnerships');
    }
}
