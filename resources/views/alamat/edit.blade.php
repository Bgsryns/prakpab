@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Alamat</h1>
    <form method="post" action="{{ route('alamat.update', $alamat->id) }}">
        @csrf
        @method('PUT')

        <!-- Dropdown Pilih User -->
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select class="form-control" id="user_id" name="user_id">
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id', $alamat->user_id) == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input Alamat -->
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat">{{ old('alamat', $alamat->alamat) }}</textarea>
            @error('alamat')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown Provinsi -->
        <div class="mb-3">
            <label for="province_id" class="form-label">Provinsi</label>
            <select class="form-control" id="province_id" name="province_id">
                @foreach($provinces as $province)
                    <option value="{{ $province->province_id }}" {{ old('province_id', $alamat->province_id) == $province->province_id ? 'selected' : '' }}>
                        {{ $province->province }}
                    </option>
                @endforeach
            </select>
            @error('province_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Dropdown Kota -->
        <div class="mb-3">
            <label for="city_id" class="form-label">Kota</label>
            <select class="form-control" id="city_id" name="city_id">
                @foreach($cities as $city)
                    <option value="{{ $city->city_id }}" {{ old('city_id', $alamat->city_id) == $city->city_id ? 'selected' : '' }}>
                        {{ $city->city_name }}
                    </option>
                @endforeach
            </select>
            @error('city_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Simpan dan Batal -->
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('alamat.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
