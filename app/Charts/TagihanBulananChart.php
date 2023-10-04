<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\DonutChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\PieChart;

class TagihanBulananChart
{
    protected $chart;
    // protected array $data = [];
    // protected array $labels = [];

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(array $data): PieChart
    {
        return $this->chart->pieChart()
            ->setTitle('Grafik Tagihan Bulanan')
            ->setSubtitle(date('F Y'))
            ->setDataLabels(true)
            ->setWidth(200)
            ->setHeight(200)
            ->setSparkline(true)
            ->addData($data);
    }
}
