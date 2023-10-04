@extends('layouts.app_sneat', ['title' => 'Form Tagihan'])
@section('js')
<script>
    $(document).ready(function() {
        $("#checkAll").change(function() {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    });

</script>
@endsection
@section('content')
<div class="bs-stepper wizard-numbered mt-2">
    @include('operator.tagihanlain_stepheader')
    <div class="bs-stepper-content">
        <!-- Account Details -->
        <div id="account-details" class="content active dstepper-block">
            <div class="content-header mb-3">
                <h6 class="mb-0">Cari Data Santri</h6>
                <small>Kategori Tujuan Tagihan.</small>
            </div>
            {!! Form::open([
            'url' => request()->fullUrl(),
            'method' => 'GET',
            ]) !!}
            {!! Form::hidden('step', 2, []) !!}
            {!! Form::hidden('tagihan_untuk', request('tagihan_untuk'), []) !!}
            <div class="g-3">
                <div class="form-group mb-2">
                    <label for="nama">Nama</label>
                    {!! Form::text('nama', request('nama'), ['class' => 'form-control', 'placeholder' => 'Cari berdasarkan nama', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('nama')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="kelas">Kelas</label>
                    {!! Form::select('kelas', getKelas(),
                    request('kelas'),
                    ['class' => 'form-control', 'placeholder' => 'Cari berdasarkan kelas']) !!}
                    <span class="text-danger">{{ $errors->first('kelas')}}</span>
                </div>
            </div>
            <input type="submit" name="cari" value="Cari Data" class="btn btn-primary">
            <hr>
            {!! Form::close() !!}
            @if (Session::has('data_santri'))
            <h5>Santri Yang Dipilih: {{ Session::get('data_santri')->count()}}</h5>
            <ul>
                @foreach (Session::get('data_santri') as $item)
                <li>
                    <a href="{{ route('tagihanlainstep2.delete', [
                        'id' => $item->id,
                        'action' => 'delete',
                    ]) }}">x</a>
                    <span class="badge bg-secondary">
                        ({{ $item->nis }}) {{ $item->nama }}
                    </span>
                </li>
                @endforeach
            </ul>
            <a href="{{ route('tagihanlainstep2.delete', ['action' => 'deleteall']) }}" class="text-danger">
                Hapus Semua
            </a>
            @endif
            <hr>
            @if (request()->filled('cari'))
            <h5>PILIH DATA SANTRI</h5>
            {!! Form::open([
            'route' => 'tagihanlainstep2.store',
            'method' => 'POST',
            ]) !!}
            <div class="table-responsive">
                <table class="{{ config('app.table_style') }}">
                    <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th width="2%" class="text-center text-white">
                                <input type="checkbox" id="checkAll">
                            </th>
                            <th width="40%" class="text-center text-white">Nama</th>
                            <th width="25%" class="text-center text-white">Kelas</th>
                            <th class="text-center text-white">Jenis SPP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($santri as $item)
                        <tr>
                            <td class="text-center">
                                {!! Form::checkbox('santri_id[]', $item->id, $item->checked, []) !!}
                            </td>
                            <td class="text-capitalize">{{ $item->nama }}</td>
                            <td class="text-center">{{ $item->kelas }}</td>
                            <td class="text-center">{{ $item->jenis_spp }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4">Data tidak ditemukan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <input type="submit" value="Pilih" class="btn btn-primary mb-3">
            </div>
            {!! Form::close() !!}
            @endif
            <div class="alert alert-primary" role="alert">
                Silahkan pilih santri yang akan ditagih, klik Pilih, jika sudah selesai klik Lanjut.
            </div>
            <div class="col-12 d-flex justify-content-between">
                <a href="{{ route('tagihanlainstep.create', ['step' => 1]) }}" class="btn btn-secondary btn-prev">
                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                    <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                </a>
                <a href="{{ route('tagihanlainstep.create', ['step' => 3]) }}" class="btn btn-primary btn-next">
                    <span class="align-middle d-sm-inline-block d-none me-sm-1">Lanjut</span>
                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
