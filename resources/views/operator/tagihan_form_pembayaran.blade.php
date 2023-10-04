<h5 class="card-header fw-bold">FORM PEMBAYARAN</h5>
<div class="card-body mt-n3">
    {!! Form::model($model, ['route' => 'pembayaran.store', 'method' => 'POST']) !!}
    {!! Form::hidden('tagihan_id', $tagihan->id, []) !!}
    <div class="form-group mb-2">
        <label for="tanggal_bayar">Tanggal Pembayaran</label>
        {!! Form::date('tanggal_bayar', $model->tangga_bayar ?? \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
    </div>
    <div class="form-group mb-2">
        <label for="jumlah_dibayar">Jumlah Yang Dibayar</label>
        {!! Form::text('jumlah_dibayar', $tagihan->total_tagihan, ['class' => 'form-control rupiah']) !!}
        <span class="text-danger">{{ $errors->first('jumlah_dibayar') }}</span>
    </div>
    {!! Form::submit('SIMPAN', ['class' => 'btn btn-primary mt-1 mb-n2']) !!}
    {!! Form::close() !!}
</div>
