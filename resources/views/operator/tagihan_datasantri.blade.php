<div class="card">
    <h5 class="card-header fw-bold">DETAIL TAGIHAN SPP SANTRI | {{ $periode }}</h5>
    <div class="card-body mt-n4">
        <table class="table">
            <tr>
                <td width="10%">NIS</td>
                <td> : {{ $santri->nis }}</td>
            </tr>
            <tr>
                <td width="50">NAMA</td>
                <td class="text-capitalize"> : {{ $santri->nama }}</td>
            </tr>
            <tr>
                <td width="50">KELAS</td>
                <td class="text-capitalize"> : {{ $santri->kelas }}</td>
            </tr>
            <tr>
                <td width="50">JENIS SPP</td>
                <td class="text-capitalize"> : {{ $santri->jenis_spp }}</td>
            </tr>
        </table>
    </div>
</div>
