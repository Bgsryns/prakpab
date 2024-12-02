@extends('layouts.app')
@section('content') 
<div class="container">
    <h1>{{ __('City') }}</h1>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-large btn-primary" href="{{ route('city.sync') }}">Syn City</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>id</th>
                <th>City</th>
                <th>CreatedAt</th>
                <th>updateAt</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cities as $city)
                <tr>
                    <!-- <td class="d-flex">
                        <a href="{{ url('/city/' . $city->id . '/edit') }}" class="btn btn-primary">Edit
                        </a>
                        &nbsp;
                        <form action="{{ url('/city/' . $city->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td> -->
                    <td>{{ $city->id }}</td>
                    <td>{{ $city->city_id }}</td>
                    <td>{{ $city->city_name }}</td>
                    <td>{{ $city->created_at }}</td>
                    <td>{{ $city->updated_at }}</td>
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
    @if($cities)
        {{ $cities->links() }}
    @endif
</div>
@endsection