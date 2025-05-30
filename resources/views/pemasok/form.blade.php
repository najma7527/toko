<div class="mb-3">
    <label>Nama Pemasok</label>
    <input type="text" name="nama_pemasok" class="form-control" value="{{ old('nama_pemasok', $pemasok->nama_pemasok ?? '') }}">
</div>

<div class="mb-3">
    <label>No Telp</label>
    <input type="text" name="no_telp" class="form-control" value="{{ old('no_telp', $pemasok->no_telp ?? '') }}">
</div>

<div class="mb-3">
    <label>Alamat</label>
    <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $pemasok->alamat ?? '') }}">
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
