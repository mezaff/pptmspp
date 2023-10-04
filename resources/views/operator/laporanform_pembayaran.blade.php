{!! Form::open([
'route' => 'laporanpembayaran.index',
'method' => 'GET',
'target' => 'blank'
]) !!}
<div class="row gx-2">
    <div class="col-md-2 col-sm-12">
        <label for="biaya_id">Jenis Tagihan</label>
        {!! Form::select('biaya_id', $biayaList,
        null,
        ['class' => 'form-control', 'placeholder' => '-Pilih Jenis Tagihan-']) !!}
        <span class="text-danger">{{ $errors->first('biaya_id')}}</span>
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="kelas">Kelas</label>
        {!! Form::select('kelas', getKelas(),
        null,
        ['class' => 'form-control', 'placeholder' => '-Pilih Kelas-']) !!}
        <span class="text-danger">{{ $errors->first('kelas')}}</span>
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="status">Status Pembayaran</label>
        {!! Form::select('status', [
        '' => '-Pilih Status-',
        'sudah-konfirmasi' => 'Sudah Dikonfirmasi',
        'belum-konfirmasi' => 'Belum Dikonfirmasi',
        ],
        request('status'),
        ['class' => 'form-control']
        ) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="bulan">Bulan</label>
        {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => '-Pilih Bulan-']) !!}
    </div>
    <div class="col-md-2 col-sm-12">
        <label for="tahun">Tahun</label>
        {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control', 'placeholder' => '-Pilih Tahun-']) !!}
    </div>
    <div class="col-md-2 col-sm-12 mt-4">
        <button class="btn btn-primary">Cari</button>
    </div>
</div>
{!! Form::close() !!}
