<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;
use Illuminate\Support\Str;
class KategoriController extends Controller
{
    private $title = 'Kategori';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::latest()->get();
        return Inertia::render('Kategori/Index',[
            'title' => 'Daftar '.$this->title,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Kategori/Create', [
            'title' => 'Tambah ' . $this->title,
            'data' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'nama' => ['required', 'max:255', Rule::unique('kategoris')->ignore($request->id)],
        ]);
        $slug = Str::of($request->nama)->slug('-');
        $fields['slug'] = $slug;
        $fields['isActive'] = $request->isActive;

        Kategori::updateOrCreate(['id' => $request->id],
        $fields);

        return redirect()
            ->route('kategori.index')
            ->with('message', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategori $kategori)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kategori $kategori)
    {
        return Inertia::render('Kategori/Create', [
            'title' => 'Edit ' . $this->title,
            'data' => $kategori,
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
        Kategori::find($id)->delete();
        return redirect()
            ->route('kategori.index')
            ->with('message', 'Data berhasil dihapus');
    }
}
