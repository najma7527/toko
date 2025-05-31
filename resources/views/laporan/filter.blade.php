<div class="card">
    <div class="card-header">
        <h4>Filter Laporan</h4>
    </div>
    <div class="card-body">
        <form action="{{ $action }}" method="GET">
            <div class="row">
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="start_date">Tanggal Mulai</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" 
                               value="{{ request('start_date') ?? date('Y-m-01') }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="end_date">Tanggal Akhir</label>
                        <input type="date" class="form-control" name="end_date" id="end_date" 
                               value="{{ request('end_date') ?? date('Y-m-d') }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group" style="margin-top: 30px">
                        <button type="submit" class="btn btn-primary">Cetak</button>
                        <a href="{{ $action }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>