<?php

namespace App\Charts;

use App\Models\Santri;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class SantriKelasChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $santriKelas = Santri::groupBy('kelas')->get();
        $data = [
            $santriKelas->where('kelas', '1A')->count(),
            $santriKelas->where('kelas', '1B')->count(),
            $santriKelas->where('kelas', '2A')->count(),
            $santriKelas->where('kelas', '2B')->count(),
            $santriKelas->where('kelas', '3A')->count(),
            $santriKelas->where('kelas', '3B')->count(),
            $santriKelas->where('kelas', '4')->count(),
            $santriKelas->where('kelas', '5')->count(),
            $santriKelas->where('kelas', '6')->count(),
        ];
        $label = [
            'Kelas 1A',
            'Kelas 1B',
            'Kelas 2A',
            'Kelas 2B',
            'Kelas 3A',
            'Kelas 3B',
            'Kelas 4',
            'Kelas 5',
            'Kelas 6',
        ];

        return $this->chart->pieChart()
            ->setTitle('Data Santri PerKelas')
            ->setSubtitle(date('Y'))
            ->addData($data)
            ->setDataLabels(true)
            ->setLabels($label);
    }
}
