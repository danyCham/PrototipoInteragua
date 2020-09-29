<?php

namespace App\Http\Controllers;

use App\Exports\EXPORT_CRONO;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FileController extends Controller
{
    private $fecha_desde;
    private $fecha_hasta;

    public function __construct(){
        $this->middleware('auth');
    }

    public function PDFGenerate($tipo_reporte,$string_info){ 
        $fecha_act = Carbon::today();
        $fecha_act_prox_pre = Carbon::today();
        $nombre_archivo = '';

        if($tipo_reporte != 'epm'){
            //descomposicion de parametros
            $array_values = explode(';',$string_info);
            $fecha_desde = explode('-',$array_values[0]);
            $fecha_hasta = explode('-',$array_values[1]);
            $optSel = $array_values[2];

            //fechas de filtro para reportes epmp y epmv
            $new_fecha_desde = Carbon::create($fecha_desde[2],$fecha_desde[1],$fecha_desde[0]);
            $new_fecha_hasta = Carbon::create($fecha_hasta[2],$fecha_hasta[1],$fecha_hasta[0]);
        }

        $query = \DB::table('TBL_CRTL_ACT_EQUIPO')
                                      ->join('tbl_cronograma_mantenimiento','TBL_CRTL_ACT_EQUIPO.id_cronograma','=','tbl_cronograma_mantenimiento.id_cronograma')
                                      ->join('tbl_equipo','tbl_cronograma_mantenimiento.id_equipo','=','tbl_equipo.id_equipo')
                                      ->join('tbl_ubicacion','tbl_equipo.id_ubicacion','=','tbl_ubicacion.id_ubicacion')
                                      ->select('tbl_equipo.codigo_equipo','tbl_equipo.nombre','tbl_ubicacion.direccion','tbl_crtl_act_equipo.fecha_actividad','tbl_crtl_act_equipo.fecha_act_proxima','tbl_crtl_act_equipo.usuario_resp','tbl_cronograma_mantenimiento.detalle'); 
        

        //PARAMETROS DE REPORTE
        $TBL_CATALOGO_CABECERA = \DB::table('TBL_CATALOGO_CABECERA');
        
        if($tipo_reporte == 'epm'){
            $nombre_archivo = 'REP_EPM_TEST';
            $TBL_CATALOGO_CABECERA = $TBL_CATALOGO_CABECERA -> where('NOMBRE_CATALOGO','=','TITULO_REPORTE_MEP')->get();
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')->get();
        }else if($tipo_reporte == 'epmp'){
            $nombre_archivo = 'REP_EPMP_TEST';
            $TBL_CATALOGO_CABECERA = $TBL_CATALOGO_CABECERA -> where('NOMBRE_CATALOGO','=','TITULO_REPORTE_EPMP')->get();
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')
                           ->whereBetween('tbl_crtl_act_equipo.fecha_act_proxima',[$new_fecha_desde,$new_fecha_hasta])
                           ->get();
        }else if($tipo_reporte == 'epmv'){
            $nombre_archivo = 'REP_EPMV_TEST';
            $TBL_CATALOGO_CABECERA = $TBL_CATALOGO_CABECERA -> where('NOMBRE_CATALOGO','=','TITULO_REPORTE_EPMV')->get();
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')->get();
        }
 
        $pdf = \PDF::loadView('reports/reportTemplatePDF', ['consulta'=>$query , 
                                                            'tipo_reporte'       => $tipo_reporte,
                                                            'TBL_REPORT_PARAMS'  =>$TBL_CATALOGO_CABECERA]);

        //return $tbl_reporte;
        
        return $pdf->download($nombre_archivo . '.pdf'); 
    }

    public function CSVGenerate($tipo_reporte){
        $queryExport = new EXPORT_CRONO();
        $queryExport->setTipoReporte($tipo_reporte);
        $filename = '';
        $fecha_act = Carbon::today();
        $fecha_act_prox_pre = Carbon::today();

        if($tipo_reporte == 'epm'){
            $filename = 'REP_EPM_TEST_CSV';
        }else if($tipo_reporte == 'epmp'){
            $filename = 'REP_EPMP_TEST_CSV';
        }else if($tipo_reporte == 'epmv'){
            $filename = 'REP_EPMV_TEST_CSV';
        }

        return \Excel::download($queryExport,$filename.'.csv');
    }

    public function funcionDePrueba(Request $request){
        $fecha_desde = $request->fecha_desde;
        $fecha_hasta = $request->fecha_hasta;
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
                           ->get();
                           
        }elseif($rep_type == 'epmv'){
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')->get();
        }
        

        return view('reports.reportTemplate',['treport'=>$rep_type,'consulta'=>$query,'filtro_aplicado'=>0,
        'dd'=>'','md'=>'','ad'=>'',
        'dh'=>'','mh'=>'','ah'=>'',
        'op'=>'']);
    }

    public function ReportPageFilteredController(Request $request, $rep_type){

        $opcion_seleccionada = $request->select;
        
        $fecha_desde_sp = explode('-',$request->fecha_desde);
        $fecha_hasta_sp = explode('-',$request->fecha_hasta);

        $fecha_desde = Carbon::create($fecha_desde_sp[0],$fecha_desde_sp[1],$fecha_desde_sp[2]);
        $fecha_hasta = Carbon::create($fecha_hasta_sp[0],$fecha_hasta_sp[1],$fecha_hasta_sp[2]);

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
                           ->whereBetween('tbl_crtl_act_equipo.fecha_act_proxima',[$fecha_desde,$fecha_hasta])
                           ->get();
           // dd($query);
        }elseif($rep_type == 'epmv'){
            $query = $query->where('tbl_crtl_act_equipo.estado_act','PENDIENTE')->get();
        }
        

        return view('reports.reportTemplate',['treport'=>$rep_type,
                                              'consulta'=>$query,
                                              'filtro_aplicado'=>1,
                                              'ad'=>$fecha_desde_sp[0],'md'=>$fecha_desde_sp[1],'dd'=>$fecha_desde_sp[2],
                                              'ah'=>$fecha_hasta_sp[0],'mh'=>$fecha_hasta_sp[1],'dh'=>$fecha_hasta_sp[2],
                                              'op'=>$opcion_seleccionada]);
    }
}
