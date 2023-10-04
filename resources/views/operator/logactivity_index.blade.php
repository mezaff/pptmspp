@extends('layouts.app_sneat', ['title' => 'Aktivitas User'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                {{-- <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['route' => 'logactivity.index', 'method' => 'GET']) !!}
                        <div class="input-group mb-2">
                            {!! Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => '-Pencarian Data Santri-']) !!}
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2" value="{{ request('q') }}">
                <i class="bx bx-search"></i>
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div> --}}
    <div class="table-responsive">
        <table class="{{ config('app.table_style') }}">
            <thead class="{{ config('app.thead_style') }}">
                <tr>
                    <th width="2%" class="text-center text-white">No</th>
                    <th class="text-white">User</th>
                    <th class="text-white">Event</th>
                    <th class="text-white">Before</th>
                    <th class="text-white">After</th>
                    <th class="text-white">Description</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($models as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-capitalize">{{ $item->causer->name }}</td>
                    <td>{{ $item->event }}</td>
                    <td>
                        @if (@is_array($item->changes['old']))
                        @foreach ($item->changes['old'] as $key => $itemChange)
                        {{ $key }} : {{ $itemChange }} <br>
                        @endforeach
                        @endif
                    </td>
                    <td>
                        @if (@is_array($item->changes['attributes']))
                        @foreach ($item->changes['attributes'] as $key => $itemChange)
                        {{ $key }} : {{ $itemChange }} <br>
                        @endforeach
                        @endif
                    </td>
                    <td>{{ $item->description }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">Data tidak ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-3">
            {!! $models->links() !!}
        </div>
    </div>
</div>
</div>
</div>
</div>
@endsection
