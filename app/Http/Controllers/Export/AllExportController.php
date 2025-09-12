<?php

namespace App\Http\Controllers\Export;

use Illuminate\Http\Request;
use App\Exports\CountryExport;
use App\Http\Controllers\Controller;
use App\Imports\CountryImport;
use Maatwebsite\Excel\Facades\Excel;

class AllExportController extends Controller
{
    public function import_export_country()
    {
        // return "ok";
        return view('admin.export_import.country');
    }

    public function import_export_country_download()
    {
        return Excel::download(new CountryExport(false), 'all_country.xlsx');
    }

    public function sample_data(){
        return Excel::download(new CountryExport(true), 'sample_data.xlsx');
    }

    public function import_export_country_store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        try{
            Excel::import(new CountryImport, $request->file('file'));
            $notification = array(
                'message' => 'Data imported successfully.',
                'alert-type' => 'success'
            );
            return back()->with($notification);
        }catch(\Exception $e){
            $notification = array(
                'message' => 'Something went wrong.',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
    }
}
