@extends('layouts.app')
@section('content')  
@section('pagetitle')
  <h3>Formato de Requisición interna</h3> 
@stop
@section('x_search') 
	<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"> 
						
		<div class="input-group">
		<input type="text" class="form-control" placeholder="Search for...">
		<span class="input-group-btn">
				  <button class="btn btn-default" type="button">Go!</button>
			  </span>
		</div> 
	</div>  
	  
@stop 
 
@section('x_content')
 
    <div class="x_panel">
	    <div class="x_title">
			<h2>Recibo de Requisicion interna</h2>
		<!--
			<ul class="nav navbar-right panel_toolbox">
			
			  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
			  </li>
			  <li class="dropdown"> 
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="#">Settings 1</a>
				  </li>
				  <li><a href="#">Settings 2</a>
				  </li>
				</ul>
			  </li>
			  <li><a class="close-link"><i class="fa fa-close"></i></a>
			  </li>
			</ul>-->
			<div class="clearfix"></div>
	    </div>
		<div class="x_content">
		  <ul class="list-unstyled timeline">
				<li>
				  <div class="block">
					<div class="tags">
					  <a href="" class="tag">
						<span>Paso 1</span>
					  </a>
					</div>
					<div class="block_content"><br/>
						<h2 class="title">
							 <a>Detalles de la entrega </a><br/>
						</h2>
					
						<br />
							
						<div class="table-responsive">
							<table id="datatable-buttons" class="table table-striped table-bordered ">
								<thead>
								     <tr>
										<th>Código</th>
										<th>Fecha</th>																																																				
										<th>Asunto</th>	
										<th>Estado</th>
										<th>Solicitante</th>
										<th>Autorizado</th>
										<th>Fecha entrega</th>
										<th>Observaciones </th>
									</tr>
								</thead>
								<tbody>
									
									<tr>
									  <td>0023933</td>
										<td>26-06-2017</td>
										<td> compa prueba</td>
										<td>entrega</td>
										<td>pepito</td>
										<td>pepito</td>
										<td>26-07-2017</td>
										<td>Entrega parcial en espera de nueva compra</td>
										
									</tr> 
								</tbody>
							</table>
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
					<div class="block_content">
						<h2 class="title">
									  <a>Detalle de  productos</a>
								  </h2>
							<br />
							<div class="panel panel-default">
							
							<div class="table-responsive">
								<table id="datatable-buttons" class="table table-striped table-bordered ">
									<thead>
									   <tr>
												<th>No.</th>
											<th>Producto</th>
											<th>Cantidad</th>
											<th>Uidad</th>
											<th>Descripción detallada</th>
											<th>Cant.Entregada</th>
											<th>Cant.Pendiente</th>
											<th>Observaciones </th>
										</tr>
									</thead>
									<tbody>
										
										<tr>
											<td>1</td>
											<td>Aceite </td>
											<td>10 UND</td>
											<td>1 caja 2 UND</td>
											<td>dedcd </td>
											<td>6 </td>
											<td>4 </td>
											<td>esperar de nueva compra</td>
										</tr> 
									</tbody>
								</table>
							</div>
						</div>
						<br/>
							<h5>Recibí los elementos solicitados en este formato<h5>
								<div class="row ">
								<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"><br>
								<div class="form-group">
										<h5 >Observaciones	</h5>																		
										<div class="col-md-8 col-sm-8 col-xs-12"></br>	
											<textarea type="text" id="last-name"  name="last-name"rows="6" required="required" class="form-control col-md-7 col-xs-12"></textarea>
										</div><br>
									</div>
									<div class="form-group   col-md-4 col-sm-4 col-xs-12"><br>									
										<div class="form-group col-md-12 col-xs-12">
											<h5>Nombre </h5>
												<input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="¿quien recibe?">
										</div>										
									</div>	
									<div class="form-group   col-md-4 col-sm-4 col-xs-12"><br>						
										<div class="form-group col-md-12 col-xs-12">
											<h5>Cargo </h5>
												<input type="text" class="form-control" id="Schoolname" name="Schoolname[]" value="" placeholder="cargo">
										</div>
									</div>	
									<div class="form-group   col-md-4 col-sm-4 col-xs-12"><br>
								
										<h5>Fecha </h5>
										<div class="input-group registration-date-time">
											<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></span>
											<input class="form-control" name="registration_date" id="registration-date" type="date">
											<span class="input-group-btn">
											</span>
										</div>
									
									</div>	
									
								</form>
							</div>
						<br />	
					</div>
				  </div>
				</li>
			</ul>
			<div class="form-group right ">	
				<button type="submit" class="btn btn-danger">Cancelar</button>
				<button type="submit" class="btn btn-success">Guardar</button>
			</div>

        </div>
		
	</div>		
@stop
        <!-- /page content -->
		<!--
		<script type="text/javascript">
			$(document).ready(function(){
				function onFinishCallback(){
				$('#wizard').smartWizard('showMessage','Finish Clicked');
			} 
			});
			
			
		</script>
		-->
@stop
<!--6581128-->
<!--229392650-->