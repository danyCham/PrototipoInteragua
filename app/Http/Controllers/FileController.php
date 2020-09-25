<?php

namespace App\Http\Controllers;

use App\Exports\EXPORT_CRONO;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function PDFGenerate($tipo_reporte){

        $nombre_archivo = '';

        //PARAMETROS DE REPORTE
        $TBL_CATALOGO_CABECERA = \DB::table('TBL_CATALOGO_CABECERA');
        
        if($tipo_reporte == 1){
            $nombre_archivo = 'REP_MANT_PEN_2020_TEST';
            $TBL_CATALOGO_CABECERA = $TBL_CATALOGO_CABECERA -> where('NOMBRE_CATALOGO','=','TITULO_REPORTE_MEP')->get();
        }else if($tipo_reporte == 2){
            $nombre_archivo = 'REP_MANT_PLAN_PER_2020_TEST';
            $TBL_CATALOGO_CABECERA = $TBL_CATALOGO_CABECERA -> where('NOMBRE_CATALOGO','=','TITULO_REPORTE_EPMP')->get();
        }else if($tipo_reporte == 3){
            $nombre_archivo = 'REP_MANT_PEN_PER_2020_TEST';
            $TBL_CATALOGO_CABECERA = $TBL_CATALOGO_CABECERA -> where('NOMBRE_CATALOGO','=','TITULO_REPORTE_EPMV')->get();
        }

        //dd($TBL_CATALOGO_CABECERA);

        //TABLA DE INFORMACION 
        $TBL_CRTL_ACT_EQUIPO = \DB::table('TBL_CRTL_ACT_EQUIPO')->get();

        

        $pdf = \PDF::loadView('reports/reportTemplatePDF', ['TBL_CRTL_ACT_EQUIPO'=>$TBL_CRTL_ACT_EQUIPO , 
        'tipo_reporte' => $tipo_reporte,
        'TBL_REPORT_PARAMS'=>$TBL_CATALOGO_CABECERA]);

        //return $tbl_reporte;
        
        return $pdf->download($nombre_archivo . '.pdf'); 
    }

    public function CSVGenerate(){
        return \Excel::download(new EXPORT_CRONO,'REP_CSV_FORMAT_EQUIPOS_TEST.csv');
    }
}
