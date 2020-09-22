<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function PDFGenerate(){
        //PARAMETROS DE REPORTES
        /*$tbl_reporte = \DB::table('TBL_CABECERA_REPORTE')
                         ->join('TBL_DETALLE_REPORTE','TBL_CABECERA_REPORTE.id_cabecera_reporte','=','TBL_DETALLE_REPORTE.id_cabecera_reporte')
                         ->select('TBL_CABECERA_REPORTE.titulo','TBL_DETALLE_REPORTE.detalle')
                         ->where('TBL_CABECERA_REPORTE.id_cabecera_reporte','=','1')->get();*/


        //TABLA DE INFORMACION 
        $TBL_CRTL_ACT_EQUIPO = \DB::table('TBL_CRTL_ACT_EQUIPO')->get(); 

        $pdf = \PDF::loadView('reports/reportTemplatePDF', ['TBL_CRTL_ACT_EQUIPO'=>$TBL_CRTL_ACT_EQUIPO ]);

        //return $tbl_reporte;
        
        return $pdf->download('REP_MANT_EQPER_2020.pdf'); 
    }
}
