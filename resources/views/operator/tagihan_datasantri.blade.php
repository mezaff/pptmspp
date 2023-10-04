<div class="card">
    <h5 class="card-header fw-bold">DETAIL TAGIHAN SPP SANTRI | Bulan {{ $periode }}</h5>
    <div class="card-body mt-n4">
        <table class="table">
            <tr class="fw-bold">
                <td width="12%">NIS</td>
                <td> : {{ $santri->nis }}</td>
            </tr>
            <tr class="fw-bold">
                <td width="12%">NAMA</td>
                <td class="text-capitalize"> : {{ $santri->nama }}</td>
            </tr>
            <tr class="fw-bold">
                <td width="12%">KELAS</td>
                <td class="text-capitalize"> : {{ $santri->kelas }}</td>
            </tr>
            <tr class="fw-bold">
                <td width="12%">NAMA WALI</td>
                <td class="text-capitalize"> : {{ $santri->wali->name }}</td>
            </tr>
        </table>
    </div>
</div>
