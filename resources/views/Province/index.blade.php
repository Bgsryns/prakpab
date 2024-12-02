@extends('layouts.app')
@section('content') 
<div class="container">
    <h1>{{ __('Province') }}</h1>
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-large btn-primary" href="{{ route('province.sync') }}">Syn Province</a>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>id</th>
                <th>Province</th>
                <th>CreatedAt</th>
                <th>updateAt</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($provinces as $province)
                <tr>
                    <!-- <td class="d-flex">
                        <a href="{{ url('/province/' . $province->id . '/edit') }}" class="btn btn-primary">Edit
                        </a>
                        &nbsp;
                        <form action="{{ url('/province/' . $province->id) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td> -->
                    <td>{{ $province->id }}</td>
                    <td>{{ $province->province_id }}</td>
                    <td>{{ $province->province }}</td>
                    <td>{{ $province->created_at }}</td>
                    <td>{{ $province->updated_at }}</td>
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
    @if($provinces)
        {{ $provinces->links() }}
    @endif
</div>
@endsection