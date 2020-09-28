<?php

namespace App\Http\Controllers;

use App\Exports\EXPORT_CRONO;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FileController extends Controller
{
    public function PDFGenerate($tipo_reporte){

        $nombre_archivo = '';
        $query = \DB::table('TBL_CRTL_ACT_EQUIPO')
                                      ->join('tbl_cronograma_mantenimiento','TBL_CRTL_ACT_EQUIPO.id_cronograma','=','tbl_cronograma_mantenimiento.id_cronograma')
                                      ->join('tbl_equipo','tbl_cronograma_mantenimiento.id_equipo','=','tbl_equipo.id_equipo')
                                      ->join('tbl_ubicacion','tbl_equipo.id_ubicacion','=','tbl_ubicacion.id_ubicacion')
                                      ->select('tbl_equipo.codigo_equipo','tbl_equipo.nombre','tbl_ubicacion.direccion','tbl_crtl_act_equipo.fecha_actividad','tbl_crtl_act_equipo.fecha_act_proxima','tbl_crtl_act_equipo.usuario_resp','tbl_cronograma_mantenimiento.detalle'); 
        

        //PARAMETROS DE REPORTE
        $TBL_CATALOGO_CABECERA = \DB::table('TBL_CATALOGO_CABECERA');
        
        if($tipo_reporte == 1){
            $nombre_archivo = 'REP_MANT_PEN_2020_TEST';
            $TBL_CATALOGO_CABECERA = $TBL_CATALOGO_CABECERA -> where('NOMBRE_CATALOGO','=','TITULO_REPORTE_MEP')->get();
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')->get();
        }else if($tipo_reporte == 2){
            $nombre_archivo = 'REP_MANT_PLAN_PER_2020_TEST';
            $TBL_CATALOGO_CABECERA = $TBL_CATALOGO_CABECERA -> where('NOMBRE_CATALOGO','=','TITULO_REPORTE_EPMP')->get();
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')->get();
        }else if($tipo_reporte == 3){
            $nombre_archivo = 'REP_MANT_PEN_PER_2020_TEST';
            $TBL_CATALOGO_CABECERA = $TBL_CATALOGO_CABECERA -> where('NOMBRE_CATALOGO','=','TITULO_REPORTE_EPMV')->get();
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')->get();
        }
 
        $pdf = \PDF::loadView('reports/reportTemplatePDF', ['consulta'=>$query , 
                                                            'tipo_reporte'       => $tipo_reporte,
                                                            'TBL_REPORT_PARAMS'  =>$TBL_CATALOGO_CABECERA]);

        //return $tbl_reporte;
        
        return $pdf->download($nombre_archivo . '.pdf'); 
    }

    public function CSVGenerate(){
        return \Excel::download(new EXPORT_CRONO,'REP_CSV_FORMAT_EQUIPOS_TEST.csv');
    }

    public function ReportPageController($rep_type){
        $fecha_act = Carbon::today();
        $fecha_act_prox_pre = Carbon::today();
        $query = \DB::table('TBL_CRTL_ACT_EQUIPO')
                                      ->join('tbl_cronograma_mantenimiento','TBL_CRTL_ACT_EQUIPO.id_cronograma','=','tbl_cronograma_mantenimiento.id_cronograma')
                                      ->join('tbl_equipo','tbl_cronograma_mantenimiento.id_equipo','=','tbl_equipo.id_equipo')
                                      ->join('tbl_ubicacion','tbl_equipo.id_ubicacion','=','tbl_ubicacion.id_ubicacion')
                                      ->select('tbl_equipo.codigo_equipo','tbl_equipo.nombre','tbl_ubicacion.direccion','tbl_crtl_act_equipo.fecha_actividad','tbl_crtl_act_equipo.fecha_act_proxima','tbl_crtl_act_equipo.usuario_resp','tbl_cronograma_mantenimiento.detalle'); 
        //TABLA DE INFORMACION
        if($rep_type == 'epm'){
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')->get();
        }elseif($rep_type == 'epmp'){
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')
                           ->whereBetween('tbl_crtl_act_equipo.fecha_act_proxima',[$fecha_act,$fecha_act_prox_pre->addDays(31)])
                           ->get();
           // dd($query);
        }elseif($rep_type == 'epmv'){
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')->get();
        }
        

        return view('reports.reportTemplate',['treport'=>$rep_type,'consulta'=>$query]);
    }
}
