
	<div id="page-content-wrapper">
		<div class="container-fluid">
			<div class="row form-group">
				<div class="col-lg-12">
					<h1>Jugadores</h1>
				</div>
				<div class="col-lg-12">
					<a id="btnAgregarJugador" class="btn btn-default" data-toggle="modal" data-target="#dlgAgregarJugador"><i class="fa fa-plus"></i> Agregar Jugador</a>
				</div>
				<!--<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>-->
			</div>
			<div class="row">
				<div class="col-lg-12">
					<table id="tblJugadores" class="table table-striped table-bordered table-hover">
						<thead>
							<tr>
								<th></th>
								<th>T.O.R.</th>
								<th>Nombre</th>
								<th>Apellidos</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="dlgAgregarJugador" tabindex="-1" role="dialog" aria-labelledby="dlgAgregarJugadorLabel">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Agregar Jugador</h4>
			</div>
			<div class="modal-body">
				<div class="form-horizontal">
					<div class="form-group">
						<label class="col-lg-2 control-label">T.O.R.</label>
						<div class="col-lg-2">
							<input type="text" id="txtTor" class="form-control input-sm" required>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Nombre</label>
						<div class="col-lg-10">
							<input type="text" id="txtNombre" class="form-control input-sm">
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Apellidos</label>
						<div class="col-lg-10">
							<input type="text" id="txtApellidos" class="form-control input-sm">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="btnAceptar" class="btn btn-primary">Aceptar</button>
			</div>
		</div>
	</div>
</div>

<script>

	$(document).ready(function(){

		var oJugador = {};
		var table;

		$("#menu-toggle").click(function(e) {
			e.preventDefault();
			$("#wrapper").toggleClass("toggled");
		});

		$("#btnAceptar").click(function(e) {
			guardarJugador();
		});

		$("#btnAgregarJugador").click(function(e) {
			clearInput();
		});

		var clearInput = function(){
			$(":input").val('');
		};

		var guardarJugador = function(){

			oJugador = {
				sTor: 		$("#txtTor").val(),
				sNombre: 	$("#txtNombre").val(),
				sApellidos: $("#txtApellidos").val()
			}

			$.ajax({
				url: "<?php echo base_url().'jugador/guardarJugador'; ?>",
				type: 'POST',
				dataType: 'json',
				data: oJugador
			})
			.done(function(json){
				//destroyLoading('body');
				if (json == false) {
					bootbox.alert("Jugador ya existe.");
				}else{
					bootbox.alert("Jugador registrado.", function(){
						clearInput();
					});
				}
			})
			.fail(function(jqXHR, textStatus, errorThrown) {
				//destroyLoading('body');
			});
		};

		var listarJugadores = function(){
			table = $('#tblJugadores').DataTable( {
				"processing": true,
				"serverSide": true,
				"ajax": {
					"url": "<?php echo base_url().'jugador/listarJugadores'; ?>",
					"type": "POST"
				},
				"columns": [
					{
						"className":      'details-control',
						"orderable":      false,
						"data":           null,
						"defaultContent": ''
					},
					{ "data": "jug_tor" },
					{ "data": "jug_nombre" },
					{ "data": "jug_apellidos" }
				],
				"order": [[ 1, "asc" ]],
				"iDisplayLength": 25,
				"language": {
					"sProcessing":		"Procesando...",
					"sLengthMenu":		"Mostrar _MENU_ registros",
					"sZeroRecords":		"No se encontraron resultados",
					"sEmptyTable": 		"Ningún dato disponible en esta tabla",
					"sInfo":       		"Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
					"sInfoEmpty":  		"Mostrando registros del 0 al 0 de un total de 0 registros",
					"sInfoFiltered":	"(filtrado de un total de _MAX_ registros)",
					"sInfoPostFix":		"",
					"sSearch":     		"Buscar:",
					"sUrl":        		"",
					"sInfoThousands":  	",",
					"sLoadingRecords": 	"Cargando...",
					"oPaginate": {
						"sFirst":		"Primero",
						"sLast": 		"Último",
						"sNext": 		"Siguiente",
						"sPrevious": 	"Anterior"
					},
					"oAria": {
						"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
						"sSortDescending": ": Activar para ordenar la columna de manera descendente"
					}
				}
			});
		};

		$('#tblJugadores tbody').on('click', 'td.details-control', function () {
			var tr = $(this).closest('tr');
			var row = table.row(tr);
			var sCodTor = row.data().jug_tor;
			
			bootbox.confirm("¿Desea eliminar jugador?", function(result) {
				if(result){
					$.ajax({
						url: "<?php echo base_url().'jugador/eliminarJugador'; ?>",
						type: 'POST',
						dataType: 'json',
						data: {
							"sTor": sCodTor
						}
					})
					.done(function(json){
						//destroyLoading('body');
						if (json == 1) {
							bootbox.alert("Jugador eliminado.");
						}else{
							bootbox.alert("Error al eliminar jugador.");
						}
					})
					.fail(function(jqXHR, textStatus, errorThrown) {
						//destroyLoading('body');
					});
				}
			}); 
		});

		listarJugadores();
	});

</script>