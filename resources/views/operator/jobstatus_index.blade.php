@extends('layouts.app_sneat', ['title' => 'Buat Tagihan'])
@section('js')
<script>
    $(document).ready(function() {
        var bar = document.querySelector(".progress-bar");
        var intervalId = window.setInterval(function() {
            @if(request('job_status_id') != '')
            $.getJSON("{{ route('jobstatus.show', request('job_status_id')) }}"
                , function(data, textStatus, jqXHR) {
                    var progressPercent = data['progress_percentage'];
                    var progressNow = data['progress_now'];
                    var progressMax = data['progress_max'];
                    var isEnded = data['is_ended'];
                    var id = data['id'];
                    bar.style.width = progressPercent + "%";
                    bar.innerText = progressPercent + "%";
                    $("#progress-now" + id).text(progressNow);
                    $("#progress-max" + id).text(progressMax);
                    if (isEnded) {
                        window.location.href = "{{ route('jobstatus.index') }}";
                    }
                }
            );
            @endif
        }, 2000);

    });

</script>

@endsection
@section('content')
<style>
    .progress-bar {
        font-size: 12px;
    }

</style>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('tagihan.create') }}" class="btn btn-primary mb-2">Tagihan SPP</a>
                        <a href="{{ route('tagihanlainstep.create', ['step' => 1]) }}" class="btn btn-warning mb-2">Tagihan Biaya Lain</a>
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                        <div class="input-group mb-3">
                            <input name="q" type="text" class="form-control" placeholder="Cari Data" aria-label="cari data" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2" value="{{ request('q') }}">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                @if (request('job_status_id') != '')
                <div class="progress mb-3" style="height:20px;">
                    <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="2%" class="text-center text-white">No</th>
                                <th class="text-center text-white">Modul</th>
                                <th class="text-center text-white">Progress</th>
                                <th class="text-center text-white">Status</th>
                                <td>Tanggal Buat</td>
                                <td>Deskripsi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($jobStatus as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>
                                    @if ($item->status == 'finished')
                                    {{ getClassName($item->type) }}
                                    @else
                                    <a href="{{ route('jobstatus.index', ['job_status_id' => $item->id]) }}">
                                        {{ getClassName($item->type) }}
                                    </a>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span id="progress-now{{ $item->id }}">{{ $item->progress_now }}</span>
                                    /
                                    <span id="progress-max{{ $item->id }}">{{ $item->progress_max }}</span>
                                </td>
                                <td class="text-capitalize">
                                    <span class="badge bg-{{ $item->status == 'finished' ? 'success' : 'info' }}">
                                        {{ $item->status }}
                                    </span>
                                </td>
                                <td>{{ $item->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>{{ json_encode($item->output) }}</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Data tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {!! $jobStatus->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
