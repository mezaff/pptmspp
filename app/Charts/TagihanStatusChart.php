<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\PieChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TagihanStatusChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(array $label, array $data): PieChart
    {
        return $this->chart->pieChart()
            ->setTitle('Grafik Status Tagihan')
            ->setSubtitle(date('F Y'))
            ->setWidth(300)
            ->setHeight(300)
            ->addData($data)
            ->setDataLabels(true)
            ->setLabels($label);
    }
}
