@extends('adminlte::page')

@section('title', 'Home')
 

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card" style="width: 90%; ">
            @if($treport == 'epm')
                <div class="card-header text-center text-bold bg-dark">
                    EQUIPOS PENDIENTE DE MANTENIMIENTO
                </div>
            @elseif($treport == 'epmp')
                <div class="card-header text-center text-bold  bg-dark">
                    EQUIPOS PLANIFICADOS PARA EL MANTENIMIENTO POR PERIODOS
                </div>
            @elseif($treport == 'epmv')
                <div class="card-header text-center text-bold  bg-dark">
                    EQUIPOS CON PERIODO DE MANTENIMIENTO VENCIDO
                </div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <form action="{{route('rutaPrueba',$treport)}}" class="form-group" style="width:50%" method="POST" id="form-filter">
                        @csrf
                        @if($treport != 'epm')
                            <div class="row m-2">
                                <div class="col">
                                    <label for="select_periodo">Periodo:</label>
                                    <select name="select" id="select_periodo" class="form-control">
                                        <option value="0">Seleccionar...</option>
                                        <option value="1">Proximos 7 días</option>
                                        <option value="2">Proxima semana</option>
                                        <option value="3">Este mes</option>
                                        <option value="4">Personalizado</option>
                                    </select>
                                </div> 
                            </div>
                            <div class="row m-2">
                                <div class="col">
                                    <label for="fecha_desde">Fecha Desde</label>
                                    <input readonly class="form-control" type="date" name="fecha_desde" id="fecha_desde">
                                </div>
                                <div class="col">
                                    <label for="fecha_hasta">Fecha Hasta</label>
                                    <input readonly class="form-control" type="date" name="fecha_hasta" id="fecha_hasta">
                                </div>
                            </div>
                            <div class="row m-2">
                                <div class="col">
                                    <input type="submit" value="Aplicar Filtro" class="btn btn-primary btn-block">
                                </div>
                                <div class="col">
                                    <input type="reset" value="Limpiar Valores" class="btn btn-outline-secondary btn-block">
                                </div>
                            </div>
                        @endif
                    </form>
                    @if($treport=='epm' or ($treport!='epm' and $filtro_aplicado == 1))
                    <div>
                        <a class="btn pdf" data-toggle="tooltip" data-placement="bottom" title="Generar Reporte en PDF" href="{{ route('pdfGenerate',$treport) }}">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-pdf" class="svg-inline--fa fa-file-pdf fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M181.9 256.1c-5-16-4.9-46.9-2-46.9 8.4 0 7.6 36.9 2 46.9zm-1.7 47.2c-7.7 20.2-17.3 43.3-28.4 62.7 18.3-7 39-17.2 62.9-21.9-12.7-9.6-24.9-23.4-34.5-40.8zM86.1 428.1c0 .8 13.2-5.4 34.9-40.2-6.7 6.3-29.1 24.5-34.9 40.2zM248 160h136v328c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V24C0 10.7 10.7 0 24 0h200v136c0 13.2 10.8 24 24 24zm-8 171.8c-20-12.2-33.3-29-42.7-53.8 4.5-18.5 11.6-46.6 6.2-64.2-4.7-29.4-42.4-26.5-47.8-6.8-5 18.3-.4 44.1 8.1 77-11.6 27.6-28.7 64.6-40.8 85.8-.1 0-.1.1-.2.1-27.1 13.9-73.6 44.5-54.5 68 5.6 6.9 16 10 21.5 10 17.9 0 35.7-18 61.1-61.8 25.8-8.5 54.1-19.1 79-23.2 21.7 11.8 47.1 19.5 64 19.5 29.2 0 31.2-32 19.7-43.4-13.9-13.6-54.3-9.7-73.6-7.2zM377 105L279 7c-4.5-4.5-10.6-7-17-7h-6v128h128v-6.1c0-6.3-2.5-12.4-7-16.9zm-74.1 255.3c4.1-2.7-2.5-11.9-42.8-9 37.1 15.8 42.8 9 42.8 9z"></path></svg>
                        </a>
                        <a class="btn csv" data-toggle="tooltip" data-placement="bottom" title="Generar archivo CSV"  href="{{ route('csvGenerate',$treport) }}">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="file-csv" class="svg-inline--fa fa-file-csv fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M224 136V0H24C10.7 0 0 10.7 0 24v464c0 13.3 10.7 24 24 24h336c13.3 0 24-10.7 24-24V160H248c-13.2 0-24-10.8-24-24zm-96 144c0 4.42-3.58 8-8 8h-8c-8.84 0-16 7.16-16 16v32c0 8.84 7.16 16 16 16h8c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8h-8c-26.51 0-48-21.49-48-48v-32c0-26.51 21.49-48 48-48h8c4.42 0 8 3.58 8 8v16zm44.27 104H160c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h12.27c5.95 0 10.41-3.5 10.41-6.62 0-1.3-.75-2.66-2.12-3.84l-21.89-18.77c-8.47-7.22-13.33-17.48-13.33-28.14 0-21.3 19.02-38.62 42.41-38.62H200c4.42 0 8 3.58 8 8v16c0 4.42-3.58 8-8 8h-12.27c-5.95 0-10.41 3.5-10.41 6.62 0 1.3.75 2.66 2.12 3.84l21.89 18.77c8.47 7.22 13.33 17.48 13.33 28.14.01 21.29-19 38.62-42.39 38.62zM256 264v20.8c0 20.27 5.7 40.17 16 56.88 10.3-16.7 16-36.61 16-56.88V264c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v20.8c0 35.48-12.88 68.89-36.28 94.09-3.02 3.25-7.27 5.11-11.72 5.11s-8.7-1.86-11.72-5.11c-23.4-25.2-36.28-58.61-36.28-94.09V264c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8zm121-159L279.1 7c-4.5-4.5-10.6-7-17-7H256v128h128v-6.1c0-6.3-2.5-12.4-7-16.9z"></path></svg>
                        </a>
                    </div>
                    @endif
                </div>
                @if($treport=='epm' or ($treport!='epm' and $filtro_aplicado == 1))
                    <div class="table-responsive mt-2">
                        <table id="reportUno">
                            <thead class="text-center">
                                <tr>
                                    <th>Codigo Equipo</th>
                                    <th>Nombre Equipo</th>
                                    <th>Ubicación</th>
                                    <th>Fecha Actividad</th>
                                    <th>Fecha Proxima</th>
                                    <th>Usuario Resp.</th>
                                    <th>Detalle Act.</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($consulta as $data)
                                    <tr>
                                        <td>{{$data -> codigo_equipo}}</td>
                                        <td>{{$data -> nombre}}</td>
                                        <td>{{$data -> direccion}}</td>
                                        <td>{{$data -> fecha_actividad}}</td>
                                        <td>{{$data -> fecha_act_proxima}}</td>
                                        <td>{{$data -> usuario_resp}}</td>
                                        <td>{{$data -> detalle}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop
 
@section('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.jqueryui.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
    
        
.pdf svg, .csv svg{
    width: 30px;
    color: #aaa;
    transition: 400ms;
}

.pdf svg:hover{
    transform: scale(1.2);
    color: red;
}

.csv svg:hover{
    transform: scale(1.2);
    color: green;
} 
    </style>
@stop

@section('js')
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.jqueryui.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    $(document).ready(function(){
        $('#reportUno').DataTable({
            dom: 'Bfrtip',
            responsive:true,
            language:{
                "decimal":        "",
                "emptyTable":     "Sin datos para mostrar",
                "info":           "Mostrando _START_ - _END_ de _TOTAL_ registros",
                "infoEmpty":      "Mostrando 0 - 0 de 0 registros",
                "infoFiltered":   "(filtrado de _MAX_ datos en total)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "loadingRecords": "Cargando...",
                "processing":     "Procesando...",
                "search":         "Buscar:",
                "zeroRecords":    "Sin resultados para la consulta",
                "paginate": {
                    "first":      "Primero",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Previo"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
        });
    });
</script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
<script>
    
    if({{$filtro_aplicado}}==1){
        document.getElementById('fecha_desde').value = '{{$ad}}'+'-'+'{{$md}}'+'-'+'{{$dd}}';
        document.getElementById('fecha_hasta').value = '{{$ah}}'+'-'+'{{$mh}}'+'-'+'{{$dh}}';
        document.getElementById('select_periodo').value = '{{$op}}';
        if('{{$op}}' == 4){
            document.getElementById('fecha_desde').readOnly  = false; 
            document.getElementById('fecha_hasta').readOnly  = false; 
        }
    }

    var selectorPer = document.getElementById('select_periodo');

    document.getElementById('form-filter').addEventListener('submit',function(e){
        //debugger;
        var opSel = document.getElementById('select_periodo').value;
        var fDesde = document.getElementById('fecha_desde').value;
        var fHasta = document.getElementById('fecha_hasta').value;
        var alertControl = document.getElementById('alert-message');

        if(opSel==0){
            toastr.error('Debe seleccionar el periodo de filtrado','Datos Requeridos',{timeOut: 3000,progressBar:true,preventDuplicates:true});
            e.preventDefault();
        }else{

            if(!fDesde){
                toastr.error('Debe elegir Fecha Desde','Datos Requeridos',{timeOut: 3000,progressBar:true,preventDuplicates:true});
                e.preventDefault();
            }else{

                if(!fHasta){
                    toastr.error('Debe elegir Fecha Hasta','Datos Requeridos',{timeOut: 3000,progressBar:true,preventDuplicates:true});
                    e.preventDefault();
                }
            }
        }
    });

    selectorPer.addEventListener('change',function(){
        //debugger;
        var fechaDesdeField = document.getElementById('fecha_desde');
        var fechaHastaField = document.getElementById('fecha_hasta');
        var fechaObjeto = new Date(); 

        opcionSeleccionada = this.value;
       // debugger;
        if(opcionSeleccionada == '4'){
            fechaHastaField.value='';
            fechaDesdeField.value='';
            fechaHastaField.readOnly  = false; 
            fechaDesdeField.readOnly  = false;
        }else{
            fechaHastaField.readOnly  = true;
            fechaHastaField.innerHTML='dd/mm/aaaa';
            fechaDesdeField.innerHTML='dd/mm/aaaa';
            fechaDesdeField.readOnly  = true;
        }
        if(opcionSeleccionada == '1'){ 
            var fechaHasta = new Date(fechaObjeto.getTime()+ 1000*60*60*24*7);

            fechaDesdeField.value = formatDate(fechaObjeto.getFullYear(),fechaObjeto.getMonth(),fechaObjeto.getDate());
            fechaHastaField.value = formatDate(fechaHasta.getFullYear(),fechaHasta.getMonth(),fechaHasta.getDate()); 

        }else if(opcionSeleccionada == '3'){

            var fechaDesde = new Date(fechaObjeto.getFullYear(),fechaObjeto.getMonth(),1);
            var fechaHasta = new Date(fechaObjeto.getFullYear(),fechaObjeto.getMonth()+1,0);

            fechaDesdeField.value = formatDate(fechaDesde.getFullYear(),fechaDesde.getMonth(),fechaDesde.getDate());
            fechaHastaField.value = formatDate(fechaHasta.getFullYear(),fechaHasta.getMonth(),fechaHasta.getDate());


        }else if(opcionSeleccionada == '2'){
            //debugger;
            fechaPrimerDiaSigSemana = obtenerPrimerDiaSemana(fechaObjeto);
            fechaDesdeField.value = formatDate(fechaPrimerDiaSigSemana.getFullYear(),fechaPrimerDiaSigSemana.getMonth(),fechaPrimerDiaSigSemana.getDate());
            
            ultimoDiaSemana = new Date(sumaDia(fechaPrimerDiaSigSemana,6));
            fechaHastaField.value = formatDate(ultimoDiaSemana.getFullYear(),ultimoDiaSemana.getMonth(),ultimoDiaSemana.getDate());

        }
    });
    function obtenerPrimerDiaSemana(fecha){
        diaSemana = fecha.getDay(); 
        
        diasFaltantes = 7-diaSemana; 

        siguienteFecha = sumaDia(fecha, diasFaltantes+1);

        return new Date(siguienteFecha);

    }

    function sumaDia(fecha,num){
        return fecha.getTime() + num*24*60*60*1000; 
    }

    function formatDate(anio, mes, dia){
        mes = mes +1;
        if(mes<10){
            var newmes = '0'+mes;
        }else{
            var newmes = mes;
        }
        if(dia<10){
            var newdia = '0'+dia;
        }else{
            var newdia = dia;
        }
        return anio+'-'+newmes+'-'+newdia;
    }
</script>
@stop 