@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>{{ __('Produk') }}</h1>
        <form method="post" action="{{ url('/produk/' . $produk->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="row mb-3">
                <label for="nama_produk" class="col-3 col-form-label">Nama</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="nama_produk" name="nama_produk"
                        value="{{ old('nama_produk', $produk->nama_produk) }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="rasa" class="col-3 col-form-label">Rasa</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="rasa" name="rasa"
                        value="{{ old('rasa', $produk->rasa) }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="ukuran" class="col-3 col-form-label">Ukuran (ml)</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="ukuran" name="ukuran"
                        value="{{ old('ukuran', $produk->ukuran) }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="berat" class="col-3 col-form-label">Berat (gr)</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="berat" name="berat"
                        value="{{ old('berat', $produk->berat) }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="harga" class="col-3 col-form-label">Harga</label>
                <div class="col-9">
                    <input type="text" class="form-control" id="harga" name="harga"
                        value="{{ old('harga', $produk->harga) }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label for="image_url" class="col-3 col-form-label">Gambar</label>
                <div class="col-9">
                    <input type="file" class="form-control" id="image_url" name="image_url"
                        value="{{ old('image_url') }}" />
                </div>
            </div>
            @if ($produk->image_url)
                <div class="row mb-3">
                    <div class="col-5 offset-md-3">
                        <img style="width:100%" src="{{ url('/storage', $produk->image_url) }}" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-5 offset-md-3 gap-2 d-grid">
                        <button type="button" class="btn btn-danger btn-block" onclick="hapus_gambar()">HAPUS
                            GAMBAR</button>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-large btn-primary">
                        Simpan
                    </button>
                    <a href="{{ url('/produk') }}" class="btn btn-large btn-secondary">
                        Batal
                    </a>
                </div>
            </div>
        </form>
        <form action="{{ url('/produk/destroy_image/' . $produk->id) }}" method="post" id="destroy_image">
            @csrf
        </form>
    </div>
    <script>
        function hapus_gambar() {
            if (confirm('Yakin hapus gambar?')) {
                var form = document.getElementById('destroy_image');
                form.submit();
            }
        }
    </script>
@endsection