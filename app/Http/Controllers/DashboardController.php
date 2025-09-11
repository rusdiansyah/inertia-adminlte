<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Berita;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $jmlUser = User::where('isActive',1)->count();
        $jmlKategori = Kategori::where('isActive',1)->count();
        $berita = Berita::orderBy('diklik','desc')
        ->limit(10)
        ->with(['kategori','user'])
        ->get();
        $jmlBanner = Banner::count();
        return Inertia::render('Dashboard',[
            'title' => 'Dashboard',
            'berita' => $berita,
            'jmlUser' => $jmlUser,
            'jmlKategori' => $jmlKategori,
            'jmlBerita' => $berita->count(),
            'jmlBanner' => $jmlBanner,
        ]);
    }
}
