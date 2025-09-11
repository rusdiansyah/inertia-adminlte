<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class BeritaController extends Controller
{
    private $title = 'Berita';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listKategori = Kategori::latest()->get();
        $data = Berita::latest()
        ->with(['kategori','user'])
        ->when($request->search,function($q)use($request){
            $q->where('judul','like','%'.$request->search.'%');
        })
        ->when($request->filterKategori,function($q)use($request){
            $q->where('kategori_id',$request->filterKategori);
        })
        ->get();
        return Inertia::render('Berita/Index',[
            'title' => $this->title,
            'data' => $data,
            'listKategori' => $listKategori,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listKategori = Kategori::where('isActive', 1)
            ->latest()
            ->get();
        return Inertia::render('Berita/Create', [
            'title' =>'Tambah '.$this->title,
            'listKategori' => $listKategori,
            'data' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if($request->id){
            $fields = $request->validate([
                'kategori_id' => 'required',
                'judul' => ['required', 'max:255'],
                'isi' => ['required',],
                // 'gambar' => ['nullable','max:8000', 'image'],
            ]);

        }else{
            $fields = $request->validate([
                'kategori_id' => 'required',
                'judul' => ['required', 'max:255'],
                'isi' => ['required',],
                'gambar' => ['max:8000', 'image'],
            ]);
        }
        $slug = Str::of($request->judul)->slug('-');
        $fields['slug'] = $slug;
        $fields['diklik'] = 0;
        $fields['isPublish'] = (bool) $request->isPublish;
        if ($request->hasFile('gambar')) {
            $fields['gambar'] = $request->gambar->store('gambars', 'public');
        }
        $fields['user_id'] = Auth::user()->id;
        // Berita::create($fields);
        Berita::updateOrCreate(
            ['id' => $request->id],
            $fields
        );
        return redirect()
            ->route('berita.index')
            ->with('message', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $listKategori = Kategori::where('isActive',1)
        ->latest()
        ->get();
        return Inertia::render('Berita/Create', [
            'title' =>'Edit '.$this->title,
            'listKategori' => $listKategori,
            'data' => Berita::find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Berita::find($id)->delete();
    }

    public function publishUpdate($id)
    {
        // dd($id);
        $berita = Berita::where('id',$id)->first();
        $berita->isPublish= !$berita->isPublish;
        $berita->save();

    }
}
