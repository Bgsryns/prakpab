@extends('layouts.app')
@section('content') 
<div class="container">
    <h1>{{ __('Alamat') }}</h1>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-large btn-primary"
                href="{{ route('alamat.create') }}">Tambah Alamat</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>&nbsp;</th>
                <th>User</th>
                <th>Alamat</th>
                <th>Provinsi</th>
                <th>Kota</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($alamats as $alamat)
            <tr>
                <td class="d-flex">
                    <a href="{{ url('/alamat/'.$alamat->id.'/edit') }}" 
                        class="btn btn-primary">Edit
                    </a>
                    &nbsp;
                    <form action="{{ url('/alamat/'.$alamat->id) }}"
                        method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger"
                            onclick="return confirm('Are you sure?')"> 
                            Delete
                        </button>
                    </form>
                </td>
                <td>{{ $alamat->user->name }}</td>
                <td>{{ $alamat->alamat }}</td>
                <td>{{ $alamat->province->province }}</td>
                <td>{{ $alamat->city->city_name }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">
                    <div class="alert alert-warning"> Tidak ada data!</div>
                </td> 
            </tr> 
        @endforelse
        </tbody>
    </table>
@if($alamats)
{{ $alamats->links() }} 
@endif
</div>
@endsection