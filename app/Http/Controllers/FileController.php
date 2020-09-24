<?php

namespace App\Http\Controllers;

use App\Exports\EXPORT_CRONO;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function PDFGenerate(){

        //TABLA DE INFORMACION 
        $TBL_CRTL_ACT_EQUIPO = \DB::table('TBL_CRTL_ACT_EQUIPO')->get(); 

        $pdf = \PDF::loadView('reports/reportTemplatePDF', ['TBL_CRTL_ACT_EQUIPO'=>$TBL_CRTL_ACT_EQUIPO ]);

        //return $tbl_reporte;
        
        return $pdf->download('REP_MANT_EQPER_2020.pdf'); 
    }

    public function CSVGenerate(){
        return \Excel::download(new EXPORT_CRONO,'REP_CSV_FORMAT_EQUIPOS_TEST.csv');
    }
}
