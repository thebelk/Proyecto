@extends('layouts.app')
@section('content')  

@section('x_content')

    <div class="x_panel">
	    <div class="x_title">
			<h2>Requisición Interna</h2>
			<a  href="{{ url('/requisicion/'.$requisicion->id) }}"class="btn btn-danger  right" role="button">Ver </a>
			<a  href="{{ url('/entregarRQS') }}" class="btn btn-default  right" role="button"><i class="fa fa-reply" aria-hidden="true"></i>&nbsp&nbsp&nbspVolver al listado </a>
			<div class="clearfix"></div>
	    </div>
		<div class="x_content">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/requisicion/'.$requisicion->id) }}">
				{{ csrf_field() }}
				<input name="_method" type="hidden" value="PUT" />
				<input type="hidden" class="form-control" id="cantproductos" name="cantproductos" value="{{count($requisicion->productos)}}"/>
				<input type="hidden" class="form-control" id="cantproductosinicial" name="cantproductosinicial" value="{{count($requisicion->productos)}}"/>
				<input type="hidden" class="form-control" id="productos_eliminar" name="productos_eliminar" value=""/>
				<input id="id" name="id" type="hidden" value="{{ $requisicion->id }}" />
				<input id="area_id" name="area_id" type="hidden" value="{{ $requisicion->area_id }}" />
				<input id="cargo_id" name="cargo_id" type="hidden" value="{{ $requisicion->cargo_id }}" />
				<input id="acc_rqs" name="acc_rqs" type="hidden" value="{{ $requisicion->registrohistoricorequisicion->first()->acc_rqs_id }}" />
				<ul class="list-unstyled timeline">
					<li>
						<div class="table-responsive">
							<table id="datatable-buttons" class="table table-striped table-bordered ">
								<thead>
								<tr>
										<th>Código</th>
										<th>Fecha RQS</th>	
										<th>Estado</th>
										<th>Solicitante</th>
										<th>Cargo</th>
										<th>Dependencia</th>
									</tr>
								</thead>
								<tbody>
									@foreach($requisicion->registrohistoricorequisicion as $reg)
										@if($loop->first)	
											<tr>
												<td>{{$requisicion->id}}</td>
												<td>{{$reg->created_at->format('d-m-Y')}}</td>
												<td>{{$requisicion->estadorequisicion->desc_est_req}}</td>
												<td>{{$reg->user->nom_usr}} {{$reg->user->ape_usr}}</td>
												<td>{{$requisicion->cargo->des_crg  }}</td>
												<td>{{$requisicion->area->tipoarea->des_tip_are}} / {{$requisicion->area->des_are}}</td>
											</tr> 
									
										@endif
									@endforeach
								</tbody>
							</table><br/>
						</div>
					</li>
						<li>
						<div class="block">
							<div class="tags">
							<a href="" class="tag">
								<span>Paso 1</span>
							</a>
							</div>
							<div class="block_content">
								<h2 class="title">
									<a>Editar la RQS</a>
								</h2>
								<div class="panel-body message">
									<div class="form-group">
										<label for="asn_rqs" class="col-sm-2 control-label">Asunto:</label>
										<div class="col-sm-8">
											<input type="text"  class="form-control select2-offscreen" value="{{$requisicion->asn_rqs}}" required id="asn_rqs" name="asn_rqs"  />
											@if ($errors->has('asu_est_req'))
												<span class="help-block">
													<strong>{{ $errors->first('asu_est_req') }}</strong>
												</span>
											@endif
										</div>
									</div>
									<div class="form-group">
										<label for="jst_rqs" class="col-sm-2 control-label">Justificación:</label>
										<div class="col-sm-8">
											<input type="text" class="form-control select2-offscreen" value="{{$requisicion->jst_rqs}}" required   id="jst_rqs" name="jst_rqs" />
											@if ($errors->has('jst_rqs'))
												<span class="help-block">
													<strong>{{ $errors->first('jst_rqs') }}</strong>
												</span>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
					</li>
					<li>
						<div class="block">
							<div class="tags">
							<a href="" class="tag">
								<span>Paso 2</span>
							</a>
							</div>
							<br>
							
							<div class="block_content">
								<h2 class="title">
									<a>Editar lista de productos</a>
								</h2>
								<br/>
								<div class="panel panel-default">
									<div class="panel-heading text-center">
										<span><strong><span class="glyphicon glyphicon-th-list"> </span> Productos</strong></span>
									</div>
									<div class="table-responsive">
									<table class="table table-bordered table-hover" id="education_fields">
										<thead>
											<tr >
												<th class="text-center">Producto</th>
												<th class="text-center">Nuevo Producto</th>													
												<th class="text-center">Unidad</th>	
												<th class="text-center">Cantidad</th>
												<th class="text-center"><a></a></th>
								
											</tr>
										</thead>
											@if(!$requisicion->productos->isEmpty())
												@foreach($requisicion->productos as $req_prod)
													@if($loop->first)
														<tbody class="form-group tr">
													@else
														<tbody id="removeproducto{{$loop->index + 1}}" class="form-group tr removeproducto{{$loop->index + 1}}">
													@endif
													
													<tr>
														<td class="nopadding" >
															<input type="hidden" id="rqsproductoid{{$loop->index + 1}}" name="rqsproductoid{{$loop->index + 1}}" value="{{$req_prod->id}}" required />
															<select id="producto{{$loop->index + 1}}" class="form-control" name="producto{{$loop->index + 1}}" onchange="cambio_productos({{$loop->index + 1}});" required>
																<option value="">Seleccionar</option>
																@if(!$productos->isEmpty())
																	@foreach($productos as $producto)
																		<option value="{{ $producto->id}}" @if($req_prod->prod_id == $producto->id) selected @endif>{{ $producto->des_prd}} </option>
																	@endforeach
																@endif
																<option value="0" @if(!$req_prod->producto) selected @endif >Otro (Nuevo Producto)</option>
															</select>
															@if ($errors->has('producto' . ($loop->index + 1) ))
																<span class="help-block">
																	<strong>{{ $errors->first('producto1') }}</strong>
																</span>
															@endif
														</td>
														<td class="nopadding" >
															<div class="form-group">
																<div class="form-group">
																	<input type="text" class="form-control" id="detalle{{$loop->index + 1}}" name="detalle{{$loop->index + 1}}" @if($req_prod->producto) readonly style="background:rgba(247, 247, 247, 0.57);" @else value="{{ $req_prod->nom_prd }}" @endif placeholder="Detalle"/>
																</div>
																@if ($errors->has('detalle' . ($loop->index + 1)))
																	<span class="help-block">
																		<strong>{{ $errors->first('detalle' . ($loop->index + 1)) }}</strong>
																	</span>
																@endif
															</div>
														</td>
														<td class="nopadding" >
															<select class="form-control" id="unidad{{$loop->index + 1}}" name="unidad{{$loop->index + 1}}" required>
																<option value="" selected>Seleccionar</option>
																@if($req_prod->producto)
																	@foreach($req_prod->producto->unidades as $unidad)
																		<option value="{{ $unidad->id}}" @if($unidad->id == $req_prod->unidad_solicitada->id) selected @endif>{{ $unidad->des_und}} </option>
																	@endforeach
																@else
																	@foreach($unidades as $unidad)
																		<option value="{{ $unidad->id}}" @if($unidad->id == $req_prod->unidad_solicitada->id) selected @endif>{{ $unidad->des_und}} </option>
																	@endforeach
																@endif
															</select>
															@if ($errors->has('unidad' . ($loop->index + 1)))
																<span class="help-block">
																	<strong>{{ $errors->first('unidad' . ($loop->index + 1)) }}</strong>
																</span>
															@endif
														</td>
														<td class="nopadding" >
															<div class="form-group">
															<input type="text" class="form-control disabled" id="cantidad{{$loop->index + 1}}" name="cantidad{{$loop->index + 1}}"  value="{{$req_prod->cant_sol_prd}}"/>
														</div>
															@if ($errors->has('cantidad' . ($loop->index + 1)))
																<span class="help-block">
																	<strong>{{ $errors->first('cantidad' . ($loop->index + 1)) }}</strong>
																</span>
															@endif
														</td>
														<td class="nopadding" >
															@if($loop->first)
																<div class="input-group-btn">
																	<button class="btn btn-sm btn-primary glyphicon glyphicon-plus btn-xs" type="button"  onclick="education_fields({{$productos}});"> <span  aria-hidden="true"></span></button>
																</div>
															@else
																<div class="input-group-btn">
																	<button id="boton_remover{{$loop->index + 1}}" class="btn btn-sm btn-danger glyphicon glyphicon-minus btn-xs" type="button"  onclick="remove_education_fields({{$loop->index + 1}});"> <span  aria-hidden="true"></span></button>
																</div>
															@endif
														</td>
														
													</tr>
													<tbody>
												@endforeach
											@else
											<tbody>
											@endif
								
									</table>
									</div>
									
								</div>
								@if ($errors->has('cantproductos'))
									<span class="help-block">
										<strong>{{ $errors->first('cantproductos') }}</strong>
									</span>
								@endif
								<small>Pulse + para agregar otro producto /  Pulse - para eliminar un producto.</small>
								<br />
							</div>
						</div>
					</li>
					<li>
						<div class="block">
							<div class="tags">
							<a href="" class="tag">
								<span>Paso 3</span>
							</a>
							</div>
							<div class="block_content">
								<h2 class="title">
									<a>Editar Proveedores sugeridos</a>
								</h2>
								<br/>
								<div class="panel panel-default">
								<div class="panel-heading text-center">
									<span><strong><span class="glyphicon glyphicon-th-list"> </span> Proveedores</strong></span>
								</div>
								<div class="table-responsive">
									<table class="table table-bordered table-hover" id="education_fields2">
									<thead>
										<tr >
											<th>Proveedor </th>
											<th> Nuevo  Proveedor </th>
											<th>Teléfono </th>	
										</tr>
									</thead>
									@if(!$requisicion->proveedoresrequisicion->isEmpty())
										@foreach($requisicion->proveedoresrequisicion as $req_prov)
											<tbody>
												@if($loop->last) 
 													<input type="hidden" class="form-control" id="cantproveedores" name="cantproveedores" value="{{$loop->index + 1}}"/> 
 													<script> 
 														var proveedor = {{$loop->index + 1}}; 
													</script> 
 													<input type="hidden" class="form-control" id="cantproveedoresinicial" name="cantproveedoresinicial" value="{{$loop->index + 1}}"/> 
												@endif 

												<tr>
													<td> 
														{{ $loop->index + 1 }} 
													</td> 

													<td>	
														<select id="proveedor{{ $loop->index + 1 }}" class="form-control" name="proveedor{{ $loop->index + 1 }}" onchange="cambio_proveedores({{ $loop->index + 1 }});">
															<option value="">Seleccionar</option>
															<option value="0" selected>Otro</option>
															@if(!$proveedores->isEmpty())
																@foreach($proveedores as $proveedor)
																	<option value="{{$proveedor->id}}" @if($req_prov->raz_soc == $proveedor->raz_soc) selected @endif >{{ $proveedor->raz_soc}} </option>
																@endforeach
															@endif
															
														</select>
														@if ($errors->has('proveedor' . ($loop->index + 1)))
															<span class="help-block">
																<strong>{{ $errors->first('proveedor' . ($loop->index + 1) ) }}</strong>
															</span>
														@endif
													</td>
													<td class="nopadding" >
														<div class="form-group">
															<input type="text" class="form-control" id="nombre{{ $loop->index + 1 }}" name="nombre{{ $loop->index + 1 }}" value="{{$req_prov->raz_soc}}">
															@if ($errors->has('nombre' . ($loop->index + 1)))
																<span class="help-block">
																	<strong>{{ $errors->first('nombre' . ($loop->index + 1)) }}</strong>
																</span>
															@endif
														</div>
													</td>
													<td class="nopadding" >
														<div class="form-group">
															<input type="text" class="form-control" id="telefono1" name="telefono1" value="{{$req_prov->tel_fij}}">
															@if ($errors->has('telefono' . ($loop->index + 1)))
																<span class="help-block">
																	<strong>{{ $errors->first('telefono' . ($loop->index + 1)) }}</strong>
																</span>
															@endif
														</div>
													</td>
													<td class="nopadding" >
														@if($loop->first)
															<div class="input-group-btn">
																<button class="btn btn-sm btn-primary glyphicon glyphicon-plus btn-xs" type="button"  onclick="mas_proveedor({{$proveedores}});"> <span  aria-hidden="true"></span> </button>
															</div>
														@endif
													</td>
													
												</tr>
											</tbody>
										@endforeach
									@else
										<tbody>
											<tr>
												<td>
												1
												</td>
												<td> 
 													<select id="proveedor1" class="form-control" name="proveedor1" onchange="cambio_proveedores(1);"> 
 														<option value="" selected>Seleccionar</option> 
 														@if(!$proveedores->isEmpty()) 
 															@foreach($proveedores as $proveedor) 
 																<option value="{{ $proveedor->id}}">{{ $proveedor->raz_soc}} </option> 
 															@endforeach 
 														@endif 
 														<option value="0">Otro</option> 
 													</select> 
 													@if ($errors->has('proveedor1')) 
 														<span class="help-block"> 
 															<strong>{{ $errors->first('proveedor1') }}</strong> 
 														</span> 
 													@endif 
 												</td> 

												<td class="nopadding" >
													<div class="form-group">
														<input type="text" class="form-control" id="nombre1" name="nombre1" value="">
														@if ($errors->has('nombre1'))
															<span class="help-block">
																<strong>{{ $errors->first('nombre1') }}</strong>
															</span>
														@endif
													</div>
												</td>
												<td class="nopadding" >
													<div class="form-group">
														<input type="text" class="form-control" id="telefono1" name="telefono1" value="">
														@if ($errors->has('telefono1'))
															<span class="help-block">
																<strong>{{ $errors->first('telefono1') }}</strong>
															</span>
														@endif
													</div>
												</td>
												
												<td class="nopadding" >
													<div class="input-group-btn">
														<button class="btn btn-sm btn-primary glyphicon glyphicon-plus btn-xs" type="button"  onclick="mas_proveedor({{$proveedores}});"> <span  aria-hidden="true"></span> </button>
													</div>
												</td>
											</tr>
										</tbody>
									@endif
								</table>
								</div>
							</div>
							<br/>
							</div>
						</div>
					</li>
				</ul>
				<div class="form-group right ">						
					<button type="reset"class="btn btn-danger">Borrar</button>
					<button type="submit" class="btn btn-default">Guardar</button>
				</div>
			</form>
        </div>
		
	</div>		
@stop

@stop
@section('postscripts')
	<script>
		var producto = {{count($requisicion->productos)}};
		function education_fields(productos) {
			producto++;
			var objTo = document.getElementById('education_fields')
			var divtest = document.createElement("tbody");
			divtest.setAttribute("class", "form-group tr removeproducto"+producto);
			var rdiv = 'removeproducto'+producto;
			var text = '<tr>'+
				//Productos
				'<td class="nopadding" >'+
				'<input type="hidden" id="rqsproductoid'+(producto)+'" name="rqsproductoid'+(producto)+'" value="0" required />'+
				'<select class="form-control" id="producto'+(producto)+'" name="producto'+(producto)+'" onchange="cambio_productos('+(producto)+');" required>'+
				'<option value="" selected>Seleccionar</option>';
				$.each(productos, function(index, element) {
						text = text + '<option value="'+ element.id +'">' + element.des_prd + '</option>';
					});
				text = text +
				'<option value="0">Otro (Nuevo Producto)</option>'+
				'</select></td>'+
				//Detalle
				'<td class="nopadding" >'+
					'<div class="form-group"><input type="text" class="form-control" id="detalle'+(producto)+'" name="detalle'+(producto)+'" placeholder="Detalle" readonly /></div>'+
				'</td>'+
				//Unidades
				'<td class="nopadding" >'+
					'<select class="form-control" id="unidad'+(producto)+'" name="unidad'+(producto)+'" required><option value="">Seleccionar</option></select>'+
				'</td>'+
				//Cantidad
				'<td class="nopadding" >'+
					'<div class="form-group"><input type="text" class="form-control" id="cantidad'+(producto)+'" name="cantidad'+(producto)+'" value="" placeholder="Cantidad" required /></div>'+
				'</td>'+	
				//Botones
				 '<td class="nopadding" >'+
					'<div class="input-group-btn"><button class="btn btn-sm btn-danger glyphicon glyphicon-minus btn-xs" type="button" onclick="remove_education_fields('+ producto +');">'+
						'<span aria-hidden="true"></span>'+
					'</button></div>'+
				'</td></tr>';
			divtest.innerHTML = text;
			objTo.appendChild(divtest)
			$("#cantproductos").val(producto);  
		}
		
		function mas_proveedor(proveedores) { 
 			proveedor++; 
 			var objTo = document.getElementById('education_fields2') 
 			var divtest = document.createElement("tbody"); 
 			divtest.setAttribute("class", "form-group tr removeproveedor"+proveedor); 
 			var rdiv = 'removeproveedor'+proveedor; 
 			var text = '<tr><td>' + (proveedor) +'</td>'+ 
 				//Productos 
 				'<td class="nopadding" >'+ 
 				'<select class="form-control" id="proveedor'+(proveedor)+'" name="proveedor'+(proveedor)+'" onchange="cambio_proveedores('+(proveedor)+');">'+ 
				'<option value="" selected>Seleccionar</option>'; 
 				$.each(proveedores, function(index, element) { 
 						text = text + '<option value="'+ element.id +'">' + element.raz_soc + '</option>'; 
 					}); 
 				text = text + 
 				'<option value="0">Otro</option>' + 
 				'</select></td>'+ 
 				//Nombre 
 				'<td class="nopadding" >'+ 
 					'<div class="form-group"><input type="text" class="form-control" id="nombre'+(proveedor)+'" name="nombre'+(proveedor)+'" value=""></div>'+ 
 				'</td>'+ 
 				//Teléfono 
 				'<td class="nopadding" >'+ 
 					'<div class="form-group"><input type="text" class="form-control" id="telefono'+(proveedor)+'" name="telefono'+(proveedor)+'" value=""></div>'+ 
 				'</td>'+ 
 				//Botones 
 				 '<td class="nopadding" >'+ 
 					'<div class="input-group-btn"><button class="btn btn-sm btn-danger glyphicon glyphicon-minus btn-xs" type="button" onclick="remove_proveedor('+ proveedor +');">'+ 
 						'<span aria-hidden="true"></span>'+ 
 					'</button></div>'+ 
 				'</td></tr>'; 
 			divtest.innerHTML = text; 
 			objTo.appendChild(divtest); 
 			$("#cantproveedores").val(proveedor);   
 		} 

		function remove_education_fields(rid) {
			var val = document.getElementById('rqsproductoid'+rid);
			if(val)
				document.getElementById('productos_eliminar').value += val.value + ",";
			//alert(document.getElementById('productos_eliminar').value);
			$('.removeproducto'+rid).remove();
			var i = rid;
			while(i < producto){
				$('#rqsproductoid'+(i+1)).attr('name','rqsproductoid'+i);
				$('#producto'+(i+1)).attr('name','producto'+i);
				$('#detalle'+(i+1)).attr('name','detalle'+i);
				$('#unidad'+(i+1)).attr('name','unidad'+i);
				$('#cantidad'+(i+1)).attr('name','cantidad'+i);
				$('#removeproducto'+(i+1)).attr('class','form-group tr removeproducto'+i);
				
				$('#producto'+(i+1)).attr('onchange','cambio_productos('+i+');');
				$('#boton_remover'+(i+1)).attr('onclick','remove_education_fields('+i+');');
				
				$('#rqsproductoid'+(i+1)).attr('id','rqsproductoid'+i);
				$('#producto'+(i+1)).attr('id','producto'+i);
				$('#detalle'+(i+1)).attr('id','detalle'+i);
				$('#unidad'+(i+1)).attr('id','unidad'+i);
				$('#cantidad'+(i+1)).attr('id','cantidad'+i);
				$('#boton_remover'+(i+1)).attr('id','boton_remover'+i);
				$('#removeproducto'+(i+1)).attr('id','removeproducto'+i);
				
				i++;
			}
			
			producto--;
			$("#cantproductos").val(producto);  
		}
		
		function remove_proveedor(rid) {
			$('.removeproveedor'+rid).remove()
			proveedor--;
			$("#cantproveedores").val(proveedor);  
		}
	   
	   function cambio_productos(rid) {
		   var opt = $('#producto'+rid).val();
		   $.get("{{ url('requisicion/cargarunidadesproducto')}}", 
				{
					option: opt,
					
				}, 
				function(data) {
					var model = $('#unidad'+rid);
					if (opt == 0){
						$('#detalle'+rid).attr('readonly', false);
					}
					else{
						$('#detalle'+rid).attr('readonly', true);
						$('#detalle'+rid).attr('value', '');
					}
					model.empty();
					model.append("<option value='' selected>Seleccionar</option>");
						$.each(data, function(index, element) {
							model.append("<option value='"+ element.id +"'>" + element.des_und + "</option>");
					});
			});
	   }
	   
	   function cambio_proveedores(rid) {
		   $.get("{{ url('requisicion/cargarproveedor')}}", 
				{
					option: $('#proveedor'+rid).val(),
				}, 
				function(data) {
					
					if(!jQuery.isEmptyObject(data)) {
						$('#nombre'+rid).val(data.raz_soc);
						$('#nombre'+rid).attr('readonly', true);
						$('#telefono'+rid).val(data.tel_fij);
						$('#telefono'+rid).attr('readonly', true);
					}
					else{
						$('#nombre'+rid).val(data.raz_soc);
						$('#nombre'+rid).attr('readonly', false);
						$('#telefono'+rid).val(data.tel_fij);
						$('#telefono'+rid).attr('readonly', false);
					}
			});
	   }

	</script>
	
@stop