<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\PieChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PembayaranStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(array $label, array $data): PieChart
    {
        return $this->chart->pieChart()
            ->setTitle('Grafik Status Pembayaran')
            ->setSubtitle(date('F Y'))
            ->setWidth(360)
            ->setHeight(360)
            ->addData($data)
            ->setDataLabels(true)
            ->setLabels($label);
    }
}
