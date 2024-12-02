<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use GuzzleHttp\Client;
// use App\Models\City;
// use App\Models\Province;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlamatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $alamats = \App\Models\Alamat::with('province', 'city')->paginate(10);
        $alamats = Alamat::paginate(10);
        if (Auth::user()->role == 'KONSUMEN') {
            $alamats = Alamat::where('user_id', Auth::user()->id)->paginate(10);
        }
        return view('alamat.index', ['alamats' => $alamats]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = \App\Models\User::all();
        $provinces = \App\Models\Province::all();
        $cities = \App\Models\City::all();
        return view('alamat.create', [
            'users' => $users, 
            'provinces' => $provinces, 
            'cities' => $cities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $alamat = new \App\Models\Alamat();
        $alamat->user_id = $request->user_id;
        $alamat->alamat = $request->alamat;
        $alamat->city_id = $request->city_id;
        $alamat->province_id = $request->province_id;
        $alamat->save();
        // redirect('alamat.index');
        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil ditambahkan');

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
    public function edit(string $id)
    {
        //
        $alamat = Alamat::findOrFail($id);
        $users = \App\Models\User::all();
        $provinces = \App\Models\Province::all();
        $cities = \App\Models\City::all();
        
        return view('alamat.edit', [
            'alamat' => $alamat,
            'users' => $users,
            'provinces' => $provinces,
            'cities' => $cities,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alamat' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,city_id',
            'province_id' => 'required|exists:provinces,province_id',
        ]);

        $alamat = Alamat::findOrFail($id);
        $alamat->user_id = $request->user_id;
        $alamat->alamat = $request->alamat;
        $alamat->city_id = $request->city_id;
        $alamat->province_id = $request->province_id;
        $alamat->save();

        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $alamat = Alamat::findOrFail($id);
        $alamat->delete(); 
        return redirect()->route('alamat.index')->with('success', 'Alamat berhasil dihapus'); 
    }
}

    