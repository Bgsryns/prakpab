<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Produk;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->role == 'KONSUMEN'){
            $alamat = Alamat::where('user_id', Auth::user()->id)->first();
            $last_produk = Produk::orderBy('id', 'desc')->first();
            return view('home.konsumenindex', [
                'alamat' => $alamat,
                'last_produk' => $last_produk
            ]);
        }
        return view('home');
    }
}
