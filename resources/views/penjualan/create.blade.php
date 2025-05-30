@extends('template')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Penjualan Baru</h1>
    
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Penjualan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('penjualan.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label>Barang</label>
                    <button type="button" class="btn btn-sm btn-success mb-2" id="tambahBarang">
                        <i class="fas fa-plus"></i> Tambah Barang
                    </button>
                    
                    <div id="daftarBarang">
                        <div class="row barang-item mb-3">
                            <div class="col-md-5">
                                <select name="barang_id[]" class="form-control select-barang" required>
                                    <option value="">Pilih Barang</option>
                                    @foreach($barangs as $barang)
                                    <option value="{{ $barang->id }}" data-harga="{{ $barang->harga_jual }}" data-stok="{{ $barang->stok }}">
                                        {{ $barang->name_barang }} (Stok: {{ $barang->stok }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="jumlah[]" class="form-control jumlah" placeholder="Jumlah" min="1" required>
                                <small class="text-danger stok-info" style="display: none;">Stok tidak mencukupi</small>
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control-plaintext harga" placeholder="Harga Jual" readonly>
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
                    <button type="submit" class="btn btn-primary" id="submit-btn">
                        <i class="fas fa-save"></i> Simpan Penjualan
                    </button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
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
        if (e.target.classList.contains('jumlah') || e.target.classList.contains('select-barang')) {
            const row = e.target.closest('.barang-item');
            const selectBarang = row.querySelector('.select-barang');
            const selectedOption = selectBarang.options[selectBarang.selectedIndex];
            
            if (selectedOption.value) {
                const harga = selectedOption.getAttribute('data-harga');
                const stok = parseInt(selectedOption.getAttribute('data-stok'));
                const jumlahInput = row.querySelector('.jumlah');
                const jumlah = parseInt(jumlahInput.value) || 0;
                
                // Validasi stok
                const stokInfo = row.querySelector('.stok-info');
                if (jumlah > stok) {
                    stokInfo.style.display = 'block';
                    jumlahInput.setCustomValidity('Jumlah melebihi stok');
                } else {
                    stokInfo.style.display = 'none';
                    jumlahInput.setCustomValidity('');
                }
                
                row.querySelector('.harga').value = 'Rp ' + parseFloat(harga).toLocaleString('id-ID');
                const subTotal = jumlah * parseFloat(harga);
                row.querySelector('.sub-total').value = 'Rp ' + subTotal.toLocaleString('id-ID');
                hitungTotal();
            }
        }
    });
    
    function hitungTotal() {
        let total = 0;
        document.querySelectorAll('.barang-item').forEach(row => {
            const subTotalText = row.querySelector('.sub-total').value;
            if (subTotalText) {
                const subTotal = parseFloat(subTotalText.replace(/[^0-9]/g, ''));
                total += subTotal;
            }
        });
        document.getElementById('total-harga').value = 'Rp ' + total.toLocaleString('id-ID');
    }
    
    // Validasi sebelum submit
    document.querySelector('form').addEventListener('submit', function(e) {
        let valid = true;
        document.querySelectorAll('.barang-item').forEach(row => {
            const selectBarang = row.querySelector('.select-barang');
            const jumlah = parseInt(row.querySelector('.jumlah').value) || 0;
            const stok = parseInt(selectBarang.options[selectBarang.selectedIndex]?.getAttribute('data-stok')) || 0;
            
            if (jumlah > stok) {
                valid = false;
                row.querySelector('.stok-info').style.display = 'block';
            }
        });
        
        if (!valid) {
            e.preventDefault();
            alert('Ada barang yang jumlahnya melebihi stok!');
        }
    });
});
</script>
@endsection