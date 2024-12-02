@extends('layouts.app')
@section('content')
<div class="container">
    <h1>{{ __('Alamat') }}</h1>
    <form method="post" action="{{ route('alamat.store') }}">
    @csrf
        <div class="row mb-3">
            <label for="user_id" class="col-3 col-form-label">User</label>
            <div class="col-9">
                <!-- <input type="text" class="form-control" id="user_id" 
                    name="user_id" value="{{ old('user_id') }}"/> -->
                <select class="form-control" id="user_id" 
                    name="user_id">
                    @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <label for="alamat" class="col-3 col-form-label">Alamat</label>
            <div class="col-9">
                <!-- <input type="text" class="form-control" id="alamat" name="alamat" 
                    value="{{ old('alamat') }}"/> -->
                <textarea class="form-control" id="alamat" name="alamat" ></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="province_id" class="col-3 col-form-label">Provinsi</label>
                <div class="col-9">
                    <!-- <input type="text" class="form-control" id="province_id" name="province_id" 
                        value="{{ old('province_id') }}"/> -->
                        <select class="form-control" id="province_id" name="province_id" >
                            @foreach($provinces as $province)
                            <option value="{{ $province->province_id }}">{{ $province->province }}</option>
                            @endforeach
                        </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="city_id" class="col-3 col-form-label">Kota</label>
                <div class="col-9">
                    <!-- <input type="text" class="form-control" id="city_id" name="city_id" 
                        value="{{ old('city_id') }}"/> -->
                        <select class="form-control" id="city_id" name="city_id" >
                            @foreach($cities as $city)
                            <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                </div> 
            </div> 
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-large btn-primary">
                        Simpan
                    </button>
                    <a href="{{ route('alamat.index') }}" class="btn btn-large btn-secondary">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
    @endsection