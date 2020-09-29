<?php

namespace App\Exports;

use App\CRONOGRAMA_MANT;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
use Carbon\Carbon;

class EXPORT_CRONO implements FromCollection, withHeadings
{
    private $tipoRep;
    private $string_info;

    public function setTipoReporte($tipo,$trama_fecha){
        $this->tipoRep = $tipo;
        $this->string_info = $trama_fecha;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if($this->tipoRep != 'epm'){
            //descomposicion de parametros
            $array_values = explode(';',$this->string_info);
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
        
        if($this->tipoRep == 'epm'){
            $query = $query->where('TBL_CRTL_ACT_EQUIPO.estado_act','PENDIENTE')->get();
        }else if($this->tipoRep == 'epmp'){
            $query = $query->where('TBL_CRTL_ACT_EQUIPO.estado_act','PENDIENTE')
                            ->whereBetween('tbl_crtl_act_equipo.fecha_act_proxima',[$new_fecha_desde,$new_fecha_hasta])
                            ->get();
        }else if($this->tipoRep == 'epmv'){
            $query = $query->where('TBL_CRTL_ACT_EQUIPO.estado_act','PENDIENTE')
                            ->whereBetween('tbl_crtl_act_equipo.fecha_act_proxima',[$new_fecha_desde,$new_fecha_hasta])
                            ->get();
        }

        return $query;

    }

    public function headings():array{
        return ['codigo_equipo','nombre','direccion','fecha_actividad','fecha_act_proxima','usuario_resp','detalle'];
    }
}
