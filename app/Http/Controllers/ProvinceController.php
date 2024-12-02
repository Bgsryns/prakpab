<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $provinces = Province::paginate(10);
        return view('Province.index', ['provinces' => $provinces]);
    }

    // public function sync_cities(Request $request)
    // {
    //     $client = new Client();
    //     $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
    //         'headers' => [
    //             'key' => env('RAJAONGKIR_API_KEY'),
    //         ]
    //     ]);

    //     $body = $response->getBody();
    //     $data = json_decode($body);
    //     foreach ($data->rajaongkir->results as $value) {       
    //             \App\Models\City::create([
    //                 'city_id' => $value->city_id,
    //                 'province_id' => $value->province_id,
    //                 'type' => $value->type,
    //                 'city_name' => $value->city_name,
    //                 'postal_code' => $value->postal_code
    //             ]);
    //         }

    //         echo 'berhasil';
    // }

    public function sync(Request $request)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/province', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY'),
            ]
        ]);
       $body = $response->getBody();
       $data = json_decode($body);

       foreach ($data->rajaongkir->results as $value) {
           \App\Models\Province::updateOrCreate([
                'province_id' => $value->province_id,
           ],[    
               'province_id' => $value->province_id,
               'province' => $value->province,
           ]);
       }    
       return redirect()->back();
    }   



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province)
    {
        //
    }
}
