<div class="mb-3">
    <label>Nama Barang</label>
    <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang', optional($barang)->nama_barang) }}">
</div>

<div class="mb-3">
    <label>Harga Beli</label>
    <input type="text" name="harga_beli" class="form-control" value="{{ old('harga_beli', optional($barang)->harga_beli) }}">
</div>

<div class="mb-3">
    <label>Harga Jual</label>
    <input type="text" name="harga_jual" class="form-control" value="{{ old('harga_jual', optional($barang)->harga_jual) }}">
</div>

<div class="mb-3">
    <label>Stok</label>
    <input type="text" name="stok" class="form-control" value="{{ old('stok', optional($barang)->stok) }}">
</div>

<div class="mb-3">
    <label>Pemasok</label>
    <select name="pemasok_id" class="form-control">
        @foreach($pemasok as $p)
            <option value="{{ $p->id }}" {{ optional($barang)->pemasok_id == $p->id ? 'selected' : '' }}>{{ $p->nama_pemasok }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Gambar (PNG)</label>
    <input type="file" name="gambar" class="form-control">
    @if(optional($barang)->gambar)
        <img src="{{ asset('storage/' . $barang->gambar) }}" >
    @endif
</div>

<div class="mb-3">
    <label>Keterangan</label>
    <input type="text" name="keterangan" class="form-control" value="{{ old('keterangan', optional($barang)->keterangan) }}">
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
