{!! Form::open([
'route' => 'laporanrekappembayaran.index',
'method' => 'GET',
'target' => 'blank'
]) !!}
<div class="row gx-2">
    <div class="col-md-2 col-sm-12">
        <label for="kelas">Kelas</label>
        {!! Form::select('kelas', getKelas(),
        null,
        ['class' => 'form-control', 'placeholder' => '-Pilih Kelas-']) !!}
        <span class="text-danger">{{ $errors->first('kelas')}}</span>
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
