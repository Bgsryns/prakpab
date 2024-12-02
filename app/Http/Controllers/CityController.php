<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cities = City::paginate(10);
        return view('City.index', ['cities' => $cities]);
    }

    public function sync (Request $request)
    {
        $client = new Client();
        $response = $client->request('GET', 'https://api.rajaongkir.com/starter/city', [
            'headers' => [
                'key' => env('RAJAONGKIR_API_KEY'),
            ]
        ]);

        $body = $response->getBody();
        $data = json_decode($body);
        foreach ($data->rajaongkir->results as $value) {
            \App\Models\City::updateOrCreate([
                'city_id' => $value->city_id,
            ],[
                'city_id' => $value->city_id,
                'province_id' => $value->province_id,
                'type' => $value->type,
                'city_name' => $value->city_name,
                'postal_code' => $value->postal_code
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
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        //
    }
}
