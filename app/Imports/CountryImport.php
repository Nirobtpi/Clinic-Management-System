<?php

namespace App\Imports;

use App\Models\Country;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CountryImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       try{
            $country=new Country();
            $country->name=$row[1];
            $country->status=strtolower($row[2]);
            $country->save();
        }catch(\Exception $e){
          Log::error("Error in country import file: ".$e->getMessage());
        }
    }
}
