<?php

namespace App\Imports;

use App\Models\Santri;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class SantriImport implements ToModel, WithStartRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (!array_filter($row)) {
            return null;
        }
        return new Santri([
            'nis' => $row[1],
            'nama' => $row[2],
            'kelas' => $row[3],
            'jenis_spp' => $row[4],
            'biaya_id' => $row[5],
        ]);
    }
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            '1' => 'required|unique:santris,nis',
            '2' => 'required',
            '3' => 'required',
            '4' => 'required',
            '5' => 'required|exists:biayas,id',
        ];
    }
}
