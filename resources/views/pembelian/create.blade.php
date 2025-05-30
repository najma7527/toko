@extends('template')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Pembelian Baru</h1>
    
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Pembelian</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('pembelian.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="permasok_id">Pemasok</label>
                    <select name="permasok_id" id="permasok_id" class="form-control" required>
                        <option value="">Pilih Pemasok</option>
                        @foreach($pemasoks as $pemasok)
                        <option value="{{ $pemasok->id }}">{{ $pemasok->name_pemasok }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Barang</label>
                    <button type="button" class="btn btn-sm btn-success mb-2" id="tambahBarang">
                        <i class="fas fa-plus"></i> Tambah Barang
                    </button>
                    
                    <div id="daftarBarang">
                        <div class="row barang-item mb-3">
                            <div class="col-md-4">
                                <select name="barang_id[]" class="form-control select-barang" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_beli }}">
                                        {{ $barang->name_barang }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="jumlah[]" class="form-control jumlah" placeholder="Jumlah" min="1" required>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="harga_beli[]" class="form-control harga" placeholder="Harga Beli" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control-plaintext sub-total" placeholder="Sub Total" readonly>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-sm hapus-barang" disabled>
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Total Harga</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control-plaintext font-weight-bold" id="total-harga" value="Rp 0" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Pembelian
                    </button>
                    <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tambah barang
    document.getElementById('tambahBarang').addEventListener('click', function() {
        const newItem = document.querySelector('.barang-item').cloneNode(true);
        newItem.querySelectorAll('input').forEach(input => input.value = '');
        newItem.querySelector('.hapus-barang').disabled = false;
        document.getElementById('daftarBarang').appendChild(newItem);
    });
    
    // Hapus barang
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('hapus-barang')) {
            if (document.querySelectorAll('.barang-item').length > 1) {
                e.target.closest('.barang-item').remove();
                hitungTotal();
            }
        }
    });
    
    // Hitung otomatis
    document.addEventListener('input', function(e) {
        if (e.target.classList.contains('jumlah') || e.target.classList.contains('harga')) {
            const row = e.target.closest('.barang-item');
            const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
            const harga = parseFloat(row.querySelector('.harga').value) || 0;
            const subTotal = jumlah * harga;
            row.querySelector('.sub-total').value = 'Rp ' + subTotal.toLocaleString('id-ID');
            hitungTotal();
        }
        
        if (e.target.classList.contains('select-barang')) {
            const selectedOption = e.target.options[e.target.selectedIndex];
            const harga = selectedOption.getAttribute('data-harga');
            if (harga) {
                const row = e.target.closest('.barang-item');
                row.querySelector('.harga').value = harga;
                const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
                const subTotal = jumlah * parseFloat(harga);
                row.querySelector('.sub-total').value = 'Rp ' + subTotal.toLocaleString('id-ID');
                hitungTotal();
            }
        }
    });
    
    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.barang-item').forEach(row => {
            const jumlah = parseFloat(row.querySelector('.jumlah').value) || 0;
            const harga = parseFloat(row.querySelector('.harga').value) || 0;
            total += jumlah * harga;
        });
        document.getElementById('total-harga').value = 'Rp ' + total.toLocaleString('id-ID');
    }
});
</script>
@endsection