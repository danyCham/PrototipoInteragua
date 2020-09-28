<?php

namespace App\Exports;

use App\CRONOGRAMA_MANT;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;

class EXPORT_CRONO implements FromCollection, withHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = \DB::table('TBL_CRTL_ACT_EQUIPO')
                                      ->join('tbl_cronograma_mantenimiento','TBL_CRTL_ACT_EQUIPO.id_cronograma','=','tbl_cronograma_mantenimiento.id_cronograma')
                                      ->join('tbl_equipo','tbl_cronograma_mantenimiento.id_equipo','=','tbl_equipo.id_equipo')
                                      ->join('tbl_ubicacion','tbl_equipo.id_ubicacion','=','tbl_ubicacion.id_ubicacion')
                                      ->select('tbl_equipo.codigo_equipo','tbl_equipo.nombre','tbl_ubicacion.direccion','tbl_crtl_act_equipo.fecha_actividad','tbl_crtl_act_equipo.fecha_act_proxima','tbl_crtl_act_equipo.usuario_resp','tbl_cronograma_mantenimiento.detalle'); 
        
        $query = $query->get();
        return $query;

    }

    public function headings():array{
        return ['codigo_equipo','nombre','direccion','fecha_actividad','fecha_act_proxima','usuario_resp','detalle'];
    }
}
