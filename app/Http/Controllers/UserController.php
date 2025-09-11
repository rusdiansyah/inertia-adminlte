<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UserController extends Controller
{
    private $title = 'User';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::latest()->get();
        return Inertia::render('User/Index',[
            'title' => 'Daftar '.$this->title,
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $listRole = ['Admin','User'];
        return Inertia::render('User/Create',[
            'title' => 'Tambah '.$this->title,
            'listRole' => $listRole,
            'data' => [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if($request->id)
        {
            $fields = $request->validate([
                // 'avatar' => ['nullable','max:3000', 'image'],
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'lowercase', 'max:255', Rule::unique('users')->ignore($request->id)],
                'role' => 'required',
            ]);
        }else{
            $fields = $request->validate([
                'avatar' => ['max:3000', 'image'],
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email','lowercase', 'max:255', 'unique:users'],
                'password' => ['required', 'min:3', 'confirmed'],
                'role' => 'required',
            ]);
        }
        $fields['isActive'] =(bool) $request->isActive;
        if ($request->hasFile('avatar')) {
            // $fields['avatar'] = Storage::disk('public')->put('avatars', $request->avatar);
            $fields['avatar'] = $request->avatar->store('avatars', 'public');
        }
        if($request->id)
        {
            User::where('id',$request->id)
            ->update($fields);
        }else{
            User::create($fields);
        }
        return redirect()
            ->route('user.index')
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
    public function edit(User $user)
    {
        // dd($user);
        $listRole = ['Admin', 'User'];
        return Inertia::render('User/Create', [
            'title' => 'Edit '.$this->title,
            'listRole' => $listRole,
            'data' => $user,
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
        // dd($id);
        User::find($id)->delete();
        return redirect()
            ->route('user.index')
            ->with('message', 'Data berhasil dihapus');
    }
}
