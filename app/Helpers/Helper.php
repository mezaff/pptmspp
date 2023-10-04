<?php
function getTahunAjaran()
{
    $bulanAwal = bulanSPP()[0];
    $bulanSekarang = intval(date('m'));
    if ($bulanSekarang >= $bulanAwal) {
        return date('Y');
    }
    return date('Y') - 1;
}

function getClassName($className)
{
    $class_parts = explode('\\', $className);
    return end($class_parts);
}

function bulanSPP()
{
    return [
        7, 8, 9, 10, 11, 12, 1, 2, 3, 4, 5, 6
    ];
}

function getKelas()
{
    return [
        '1A' => '1A',
        '1B' => '1B',
        '2A' => '2A',
        '2B' => '2B',
        '3A' => '3A',
        '3B' => '3B',
        '4' => '4',
        '5' => '5',
        '6' => '6',
    ];
}

function ubahNamaBulan($angka)
{
    $namaBulan = [
        '' => '',
        '1' => 'Januari',
        '2' => 'Februari',
        '3' => 'Maret',
        '4' => 'April',
        '5' => 'Mei',
        '6' => 'Juni',
        '7' => 'Juli',
        '8' => 'Agustus',
        '9' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember',
    ];
    // return $namaBulan[$angka];
    //diubah menjadi
    return $namaBulan[intval($angka)];
}

function formatRupiah($nominal, $prefix = null)
{
    $prefix = $prefix ? $prefix : 'Rp. ';
    return $prefix . number_format($nominal, 0, ',', '.');
}

function terbilang($x)
{
    $angka = ["", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas"];

    if ($x < 12)
        return " " . $angka[$x];
    elseif ($x < 20)
        return terbilang($x - 10) . " belas";
    elseif ($x < 100)
        return terbilang($x / 10) . " puluh" . terbilang($x % 10);
    elseif ($x < 200)
        return "seratus" . terbilang($x - 100);
    elseif ($x < 1000)
        return terbilang($x / 100) . " ratus" . terbilang($x % 100);
    elseif ($x < 2000)
        return "seribu" . terbilang($x - 1000);
    elseif ($x < 1000000)
        return terbilang($x / 1000) . " ribu" . terbilang($x % 1000);
    elseif ($x < 1000000000)
        return terbilang($x / 1000000) . " juta" . terbilang($x % 1000000);
}
