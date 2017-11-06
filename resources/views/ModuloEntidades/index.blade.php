@extends('layouts.plataforma')
@section('header')
  <link rel="stylesheet" href="{{ asset('jqwidgets4.4.0/jqwidgets/styles/jqx.base.css') }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('jqwidgets4.4.0/jqwidgets/styles/jqx.light.css') }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('jqwidgets4.4.0/jqwidgets/styles/jqx.darkblue.css') }}" type="text/css"/>
  <link rel="stylesheet" href="{{ asset('css/visores.css') }}" type="text/css" />

@endsection

@section('content')
<div class="row">
    <div id="contenido_datos" class="col-lg-12 col-md-12">
        <div class="row">
            <div class="col-md-12">
                <div class="pull-right">
                    <button id="btnNuevoRegistro" class="btn btn-success" data-toggle="modal" data-target="#add_new_record_modal"> <i class="fa fa-plus"></i> Nueva Institucion</button>
                </div>
            </div>
        </div>        
        <div class="white-box p-10">                     
            <div id="gridMain"></div>
        </div>
    </div>
</div>
<!-- Modal - Add New Record -->
<div class="modal fade" id="add_new_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Nueva Institucion</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="nombre">Institucion</label>
                    <input type="text" id="nombre" required="true" placeholder="Nombre de la Institucion" class="form-control"/>
                </div>
                 <div class="form-group">
                    <label for="nombre">Depende de</label>
                    <select id="dependede_id" class="form-control"><option value="0">Independiente</option></select>
                </div>
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="text" id="codigo" required="true" placeholder="Codigo" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="sigla">Sigla</label>
                    <input type="text" id="sigla" required="true" placeholder="Sigla" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" id="direccion" required="true" placeholder="Direccion" class="form-control"/>
                </div>                
                 <div class="form-group">
                    <label for="localidad">Localidad</label>
                    <input type="text" id="localidad" required="true" placeholder="Localidad o Ciudad" class="form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="insertar">Agregar</button>                
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
 
<!-- Modal - Update details -->
<div class="modal fade" id="update_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Actualizacion</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="institucion">Institucion</label>
                    <input type="text" id="updatenombre" required placeholder="Nombre de la Institucion" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="codigo">Codigo</label>
                    <input type="text" id="updatecodigo" required placeholder="Codigo" class="form-control"/>
                </div>
 
                <div class="form-group">
                    <label for="sigla">Sigla</label>
                    <input type="text" id="updatesigla" required placeholder="Sigla" class="form-control"/>
                </div>
                 <div class="form-group">
                    <label for="direccion">Direccion</label>
                    <input type="text" id="updatedireccion" required placeholder="direccion" class="form-control"/>
                </div>
                 <div class="form-group">
                    <label for="localidad">Ciudad o Localidad</label>
                    <input type="text" id="updatelocalidad" required placeholder="Ciudad o Localidad" class="form-control"/>
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="actualizar" >Actualizar</button>                
            </div>
        </div>
    </div>
</div>
<!-- // Modal -->
<!-- Modal - Ver -->
<div class="modal fade" id="show_record_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Ver</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Institucion</label> 
                    <div id="shownombre"></div>
                </div>
                <div class="form-group">
                    <label>Codigo</label>
                    <div id="showcodigo"></div>
                </div>
                <div class="form-group">
                    <label>Sigla</label>
                    <div id="showsigla"></div>
                </div>
                 <div class="form-group">
                    <label>Direccion</label>
                    <div id="showdireccion"></div>
                </div>
                <div class="form-group">
                    <label>Ciudad o Localidad</label>
                    <div id="showlocalidad"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="show_remove_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Borrar</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Institucion</label> 
                    <div id="removenombre"></div>
                </div>
 
                <div class="form-group">
                    <label>Codigo</label>
                    <div id="removecodigo"></div>
                </div>
 
                <div class="form-group">
                    <label>Sigla</label>
                    <div id="removesigla"></div>
                </div>
                 <div class="form-group">
                    <label>Direccion</label>
                    <div id="removedireccion"></div>
                </div>
                <div class="form-group">
                    <label>Ciudad o Localidad</label>
                    <div id="removelocalidad"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btnBorrar" ><i class="fa fa-trash m-l-15"> Borrar</i></button>               
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="id">
<input type="hidden" id="task">
<!-- // Modal -->
@endsection

@push('script-head')
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxcore.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxnavigationbar.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxdata.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxbuttons.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxscrollbar.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxmenu.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxcombobox.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxlistbox.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxdropdownlist.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxradiobutton.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxgrid.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxgrid.filter.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxgrid.selection.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxgrid.sort.js') }}"></script>
  <script type="text/javascript" src="{{ asset('jqwidgets4.4.0/jqwidgets/jqxgrid.pager.js') }}"></script>
<script>
 $(document).ready(function () {
    //var url = "/moduloentidades/ajax/instituciones/obtenertodas";

    //$("#jqxNavigationBar").jqxNavigationBar({ width: '100%', height: 400});
    // prepare the data
    var listaInstGlobal=null;
    $.get("/moduloentidades/ajax/instituciones/obtenertodas", function(respuesta){
        var listaInst = respuesta.listaInstituciones;        
        listaInstGlobal=listaInst;
        var source =
            {
                datatype: "json",
                datafields: [
                    {name: 'id',type:'integer'},
                    {name: 'nombre',type:'string'},
                    {name: 'sigla',type:'string'},
                    {name: 'codigo',type:'integer'},
                    {name: 'direccion',type:'string'},
                    {name: 'localidad',type:'string'}
                ],

                id: 'entidades',
                //url: url,
                localdata: listaInst,
                // sortcolumn: 'nombre',
                // sortdirection: 'asc'
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            
            function setAcciones(row, columnfield, value, defaulthtml, columnproperties) {
                return '<button id="icoVer" class="btn btn-info insti_ver" data-toggle="modal"  data-target="#show_record_modal"><i class="fa fa-eye"></i></button>'+
                '<button id="icoEditar" class="btn btn-warning insti_editar" data-toggle="modal" data-target="#update_record_modal"><i class="fa fa-pencil"></i></button>'+
                '<button id="icoBorrar" class="btn btn-danger insti_borrar" data-toggle="modal" data-target="#show_remove_modal"><i class="fa fa-trash"></i></button>';
            }    
           
            // create grid.  
            $("#gridMain").jqxGrid({
                width: '100%',
                height: 600,
                source: dataAdapter,
                sortable: true,
                filterable: true,
                altrows: true,
                pageable: true,
                columns: [
                  //{text:'ID',datafield:'id',width:20},
                  {text:'Institucion',datafield:'nombre',width:"50%"},
                  {text:'Sigla',datafield:'sigla',width:80},
                  {text:'Codigo',datafield:'codigo',width:80},
                  {text:'Direccion',datafield:'direccion',width:80},
                  {text:'Localidad',datafield:'localidad',width:80},
                  {text:'Acciones', datafield:'id', cellsrenderer: setAcciones,width:"115px"}, //columna adicional
                ]
            });
    })
    



    //$('#events').jqxPanel({ width: 300, height: 80});
    $("#gridMain").on("sort", function (event) {
        $("#events").jqxPanel('clearcontent');
        var sortinformation = event.args.sortinformation;
        var sortdirection = sortinformation.sortdirection.ascending ? "ascending" : "descending";
        if (!sortinformation.sortdirection.ascending && !sortinformation.sortdirection.descending) {
            sortdirection = "null";
        }
        var eventData = "Triggered 'sort' event <div>Column:" + sortinformation.sortcolumn + ", Direction: " + sortdirection + "</div>";
        $('#events').jqxPanel('prepend', '<div style="margin-top: 5px;">' + eventData + '</div>');
    });

    $("#gridMain").on('cellclick', function(event){
        //console.log(event.args.row.bounddata.nombre);
        //console.log(event.args.datafield);
        $("#id").val(event.args.row.bounddata.id);

        $("#updatenombre").val(event.args.row.bounddata.nombre);
        $("#updatecodigo").val(event.args.row.bounddata.codigo);
        $("#updatesigla").val(event.args.row.bounddata.sigla);
        $("#updatedireccion").val(event.args.row.bounddata.direccion);
        $("#updatelocalidad").val(event.args.row.bounddata.localidad);

        $("#shownombre").html(event.args.row.bounddata.nombre);
        $("#showcodigo").html(event.args.row.bounddata.codigo);                
        $("#showsigla").html(event.args.row.bounddata.sigla);
        $("#showdireccion").html(event.args.row.bounddata.direccion);
        $("#showlocalidad").html(event.args.row.bounddata.localidad);  

        
        $("#removenombre").html(event.args.row.bounddata.nombre);
        $("#removecodigo").html(event.args.row.bounddata.codigo);
        $("#removesigla").html(event.args.row.bounddata.sigla);
        $("#removedireccion").html(event.args.row.bounddata.direccion);
        $("#removelocalidad").html(event.args.row.bounddata.localidad); 
        //console.log(event.args.originalEvent.target.id);

        //event.args.originalEvent.target.className
        // if(event.args.originalEvent.target.id=='icoBorrar'){
        //     $("#task").val('delete');
        // }
        // if(event.args.originalEvent.target.id=='icoEditar'){
        //     $("#task").val('update');
        // }
        // if(event.args.originalEvent.target.id=='icoVer'){
        //     $("#task").val('');
        // }                                 
    });

    $("#gridMain").on('click', '.insti_ver', function(event){
        $("#task").val('');
        //console.log("boton ver :" + $("#id").val());
    })
    $("#gridMain").on('click', '.insti_editar', function(event){
        $("#task").val('update');
        //console.log("boton editar" + $("#id").val());
    })
    $("#gridMain").on('click', '.insti_borrar', function(event){
        $("#task").val('delete');
        //console.log("boton borrar" + $("#id").val());
    })

    //$("#gridMain button").click(function(){ console.log('ssssssssssss')})
            /*
            $('#clearsortingbutton').jqxButton({ height: 25});
            $('#sortbackground').jqxCheckBox({checked: true, height: 25}); */
            // clear the sorting.
            
            // $('#clearsortingbutton').click(function () {
            //     $("#gridMain").jqxGrid('removesort');
            // });
            // show/hide sort background
            
            // $('#sortbackground').on('change', function (event) {
            //     $("#gridMain").jqxGrid({ showsortcolumnbackground: event.args.checked });
            // });
            $("#btnNuevoRegistro").click(function(){
                $("#id").val('');
                $("#nombre").val('');
                $("#codigo").val('');
                $("#sigla").val('');
                $("#direccion").val('');
                $("#localidad").val('');
                $("#task").val('create');
                //llenar combo    
                //console.log(listaInstGlobal.sortcolumn[1]);            
                for(i=0;i<listaInstGlobal.length;i++){  
                    $("#dependede_id").append('<option value="'+listaInstGlobal[i].id+'">'+listaInstGlobal[i].nombre+'</option>');
                }
                
            });
            $("#insertar").click(function(){

                var institucion = {
                    'id':$("#id").val(),
                    'nombre':$("#nombre").val(),
                    'dependede_id':$("#dependede_id").val(),
                    'codigo':$("#codigo").val(),
                    'sigla':$("#sigla").val(),
                    'direccion':$("#direccion").val(),
                    'localidad':$("#localidad").val(),
                    'task':$("#task").val(),
                    '_token': $('input[name=_token]').val()
                };
                console.log(institucion);
                //institucion.sigla = $("#sigla").val();

                $.post('/moduloentidades/ajax/instituciones/crud', institucion, function(respuesta){
                    $("#add_new_record_modal").modal("hide");
                });

            });

            $("#actualizar").click(function(){
                var institucion = {
                    'nombre' : $("#updatenombre").val(),
                    'codigo':$("#updatecodigo").val(),
                    'sigla':$("#updatesigla").val(),
                    'direccion':$("#updatedireccion").val(),
                    'localidad':$("#updatelocalidad").val(),
                    'id':$("#id").val(),
                    'task':$("#task").val(),
                    '_token': $('input[name=_token]').val()                    
                };

                //institucion.sigla = $("#sigla").val();

                $.post('/moduloentidades/ajax/instituciones/crud', institucion, function(respuesta){
                    $("#update_record_modal").modal("hide");
                });
            });
            $("#btnBorrar").click(function(){
                var institucion = {
                    'nombre' :'',
                    'codigo':'',
                    'sigla':'',
                    'direccion':'',
                    'localidad':'',
                    'id':$("#id").val(),
                    'task':$("#task").val(),
                    '_token': $('input[name=_token]').val()                    
                };
                //institucion.sigla = $("#sigla").val();

                $.post('/moduloentidades/ajax/instituciones/crud', institucion, function(respuesta){
                     $("#show_remove_modal").modal("hide");
                });
            }); 
                       

});
    // READ records

    // function readRecords() {
    //     $.get("ajax/readRecords.php", {}, function (data, status) {
    //         $(".records_content").html(data);
    //     });
    // }

</script>
@endpush