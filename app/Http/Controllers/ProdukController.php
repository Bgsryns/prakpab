<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        $produks = Produk::paginate(10);
        return view('produk.index', ['produks' => $produks]);
    }

    // Menampilkan form untuk membuat produk baru
    public function create()
    {
        return view('produk.create');
    }

    // Menyimpan produk baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|max:255',
            'image_url' => 'nullable|image',
            'rasa' => 'nullable|string',
            'ukuran' => 'nullable|integer',
            'berat' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        $data = $request->all();
        $data['image_url'] = $this->handleImageUpload($request);

        Produk::create($data);
        return redirect('/produk')->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan form untuk mengedit produk
    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        return view('produk.edit', ['produk' => $produk]);
    }

    // Memperbarui produk yang ada
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_produk' => 'required|max:255',
            'image_url' => 'nullable|image',
            'rasa' => 'nullable|string',
            'ukuran' => 'nullable|integer',
            'berat' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        $produk = Produk::findOrFail($id);
        $data = $request->all();
        $data['image_url'] = $this->handleImageUpdate($request, $produk);

        $produk->update($data);
        return redirect('/produk')->with('success', 'Produk berhasil diperbarui');
    }

    // Menghapus produk dari database
    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);
        $this->deleteImage($produk);
        $produk->delete();
        return redirect('/produk')->with('success', 'Produk berhasil dihapus');
    }

    // Menghapus gambar dari produk
    public function destroy_image($id)
    {
        $produk = Produk::findOrFail($id);
        $this->deleteImage($produk);
        $produk->image_url = null;
        $produk->save();
        return back()->with('success', 'Gambar berhasil dihapus');
    }

    // Menangani upload gambar
    private function handleImageUpload(Request $request)
    {
        if ($request->hasFile('image_url')) {
            return $request->file('image_url')->store('assets/produk', 'public');
        }
        return null; // Jika tidak ada gambar yang diupload
    }

    // Menangani update gambar
    private function handleImageUpdate(Request $request, Produk $produk)
    {
        if ($request->hasFile('image_url')) {
            // Hapus gambar lama
            $this->deleteImage($produk);
            // Simpan gambar baru
            return $request->file('image_url')->store('assets/produk', 'public');
        }
        return $produk->image_url; // Kembalikan image_url yang lama jika tidak ada yang baru
    }

    // Menghapus gambar dari storage
    private function deleteImage(Produk $produk)
    {
        if ($produk->image_url && Storage::disk('public')->exists($produk->image_url)) {
            Storage::disk('public')->delete($produk->image_url);
        }
    }
}
