<?php

namespace App\Exports;

use App\Models\Appointment;
use App\Models\Country;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CountryExport implements FromCollection, WithHeadings,WithMapping
{
    protected $is_sample=false;

    public function __construct($is_sample=false)
    {
        $this->is_sample=$is_sample;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->is_sample){
            return  collect([
                (object)[
                    'id' => 1,
                    'name' => 'Bangladesh',
                    'status' => 'Active',
                ]
            ]);
        }
        return Country::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Status',
        ];
    }
    public function map($model): array
    {
        return [
            $model->id,
            $model->name,
            $model->status,
        ];
    }
}
