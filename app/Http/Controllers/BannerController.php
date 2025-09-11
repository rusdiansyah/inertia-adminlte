<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class BannerController extends Controller
{
    private $title = 'Banner';
    public function index()
    {
        $data = Banner::latest()->get();
        return Inertia::render('Banner/Index',[
            'title' => $this->title,
            'data' => $data,
        ]);
    }
    public function create()
    {
        $data = [];
        return Inertia::render('Banner/Create',[
            'title' => 'Tambah '.$this->title,
            'data' => $data,
        ]);
    }
    public function edit(Banner $banner)
    {
        return Inertia::render('Banner/Create',[
            'title' => 'Tambah '.$this->title,
            'data' => $banner,
        ]);
    }
    public function store(Request $request)
    {
        if ($request->id) {
            $fields = $request->validate([
                'judul' => ['required', 'max:255', Rule::unique('banners')->ignore($request->id)],
            ]);
        } else {
            $fields = $request->validate([
                'gambar' => ['max:6000', 'image'],
                'judul' => ['required', 'max:255', 'unique:banners'],
            ]);
        }
        $fields['isPublish'] = (bool) $request->isPublish;
        if ($request->hasFile('gambar')) {
            $fields['gambar'] = $request->gambar->store('banners', 'public');
        }
        if ($request->id) {
            Banner::where('id', $request->id)
                ->update($fields);
        } else {
            Banner::create($fields);
        }
        return redirect()
            ->route('banner.index')
            ->with('message', 'Data berhasil disimpan');
    }
}
