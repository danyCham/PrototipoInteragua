<?php

namespace App\Exports;

use App\CRONOGRAMA_MANT;
use Maatwebsite\Excel\Concerns\FromCollection;

class EXPORT_CRONO implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CRONOGRAMA_MANT::all();
    }
}
