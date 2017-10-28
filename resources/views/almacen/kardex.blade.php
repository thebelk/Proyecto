@extends('layouts.app')
@section('content')
@section('pagetitle')
  <h3></h3> 
@endsection
@section('x_search')
	<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search"> 
						
		<div class="input-group">
		<input type="text" class="form-control" placeholder="Buscar ...">
		<span class="input-group-btn">
				  <button class="btn btn-default glyphicon glyphicon-search" type="button"></button> 
			  </span> 
		</div>
	</div>
	
@endsection 

@section('x_content')
  <div class="x_panel">
	    <div class="x_title"> 
			<h2>Movimientos  en Almacén   </h2> &nbsp&nbsp&nbsp
			
			<div class=" col-md-2 col-sm-2 col-xs-6 right">
					<a  data-toggle="modal" data-target=".descargar" class="btn btn-primary  left" role="button"><i class="glyphicon glyphicon-cloud-download" aria-hidden="true"></i>&nbsp&nbsp Descargar </a>
			</div>
			<div class=" col-md-3 col-sm-3 col-xs-6 right">
				<div id="reportrange" class="pull-center" style="background: #fff; cursor: pointer; padding: 8px 10px; border: 1px solid #ccc">
					<i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
					<span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
				</div>
			</div>
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
			<div class="table-responsive">
				<table id="datatable-buttons" class="table table-striped table-bordered ">
				  <thead>
				   <tr>
						<th class="text-center">Código </th>
						<th class="text-center">Fecha</th>
						<th class="text-center">Detalle</th>
						<th class="text-center">Producto</th>
						<th class="text-center">Unidad</th>
						<th class="text-center">Cant. Entrada</th>
						<th class="text-center">Cant. Salida</th>
						<th class="text-center">Saldo</th>
					</tr>
				  </thead>
				  <tbody>
					
					<tr>
					  <td>0023933</td>
						<td>
							26-06-2017
						</td>
						<td>Inicio almacén </td>
						<td> Arepas antioqueñas precocidas	</td>
						<td>Unidad</td>
						<td></td>
						<td></td>
						<td>10</td>
					</tr> 
					<tr>
					  <td>0023945</td>
						<td>
							28-06-2017
						</td>
						<td>Compra  </td>
						<td> Arepas antioqueñas precocidas	</td>
						<td>Unidad</td>
						<td>5</td>
						<td></td>
						<td>15</td>
					</tr> 
					<tr>
					  <td>0023947</td>
						<td>
							28-06-2017
						</td>
						<td>Requisición  </td>
						<td> Arepas antioqueñas precocidas	</td>
						<td>Unidad</td>
						<td></td>
						<td>11</td>
						<td>4</td>
					</tr> 
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th>Saldo</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</tfoot>
				</table>
			</div>
        </div>
		
	</div>
	
<!-- create Descargar modal -->		  

	<div class="modal fade descargar">
		<div class="modal-dialog modal-sm"style="width:210px;">
			<div class="modal-content">
				<div class="modal-body">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h5 class="modal-title" id="myModalLabel2">Seleccionar formato </h5><br/>
					<div class="content">
						<ul class="list-unstyled">
						  <li><input type="radio" name="radio1" id="radio1" value="option1" checked=""><label for="radio1">PDF</label></li>
						  <li><input type="radio" name="radio1" id="radio2" value="option2"><label for="radio2">Excel</label></li>
						</ul>       
						<button type="submit" class="btn-link btn-lg  ">Descargar Ahora</button>
					</div>	
				</div>
			</div>
		</div>
	</div>
 <!-- /modals -->
@endsection
@endsection


