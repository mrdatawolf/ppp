<?php

namespace App\Http\Controllers;

use App\Exports\POSExport;
use App\Imports\JansportImport;
use Illuminate\Http\Request;

class ExcelController extends Controller
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExportView()
    {
        return view('excel.index');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function exportExcel($type)
    {
        //return \Excel::download(new POSExport, 'export.'.$type);
        return \Excel::store(new POSExport, 'export.'.$type);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function importExcel(Request $request)
    {
        \Excel::import(new JansportImport,$request->import_file);

        \Session::put('success', 'Jansport file is imported successfully.');

        return back();
    }
}
