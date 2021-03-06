<?php

namespace App\Http\Controllers;

use App\Factura;
use App\Producto;
use App\Proveedor;
use App\Unidad;
use App\ProductosOrdenCompra;
use App\Configuracion;
use App\OrdenCompra;
use App\Categoria;
use App\ProductosSolicitudCompra;
use App\Almacen;
use App\RegistroAlmacen;
use Validator;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use FPDI;

class FacturaController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       	$facturas= Factura::all();
		return View('factura.index')->with(compact('facturas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = Producto::all();
		$proveedores = Proveedor::all();
		$configuracion = Configuracion::first();
		$ordencompra = OrdenCompra::all();
		$unidads = Unidad::all();
		return View('factura.create')->with(compact('productos','proveedores','configuracion','ordencompra','unidads'));
	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_data = $request->all();
		$rules = [
            'lot_prd' =>' ',
			'no_fact' =>' ',
			'cnp_fact' =>' ',
			'comp_fact' =>' ',
			'form_pag' =>' ',
			'dia_cred' =>' ',
			'tim_entr' =>' ',
			'otr_fact' =>' ',
			'subt_fact' =>' ',
			'iva_fact' =>' ',
			'tol_fact' =>' ',
			'obv_fact' =>' ',
			'ord_comp_id'=>' ',
			'fact_id'=>'',
			'prov_id'=>''
			];
         $validate = Validator::make($post_data, $rules);
         if ($validate->passes()){
			 //return $post_data;
			$factura = Factura::create($post_data);
			$numprods = (int)$post_data['cantproductos'];
			$i = 1;
			$productos_vacios = true;
			while($i <= $numprods){
				if ($post_data['ordencompra'.$i] == 0) {
					$producto_ii = array();
					$producto_ii['prod_id'] = $post_data['producto'.$i];					
					$producto_ii['unidad_emp_id'] = $post_data['unidad'.$i];	
					$producto_ii['cant_prd'] = $post_data['cantidad'.$i];
					$producto_ii['iva_unt'] = $post_data['ivaunitario'.$i];
					$producto_ii['val_unt'] = $post_data['valorunitario'.$i];
					$producto_ii['val_tol'] = $post_data['valortotal'.$i];
					
					$producto_ii['unidad_emp_fact_id'] = $post_data['unidad'.$i];	
					$producto_ii['cant_prd_fact'] = $post_data['cantidad'.$i];
					$producto_ii['iva_unt_fact'] = $post_data['ivaunitario'.$i];
					$producto_ii['val_unt_fact'] = $post_data['valorunitario'.$i];
					$producto_ii['val_tol_fact'] = $post_data['valortotal'.$i];
					
									
					
					$producto_ii['fact_id'] = $factura->id;
					
					//$producto_ii['prod_sol_comp_id'] = $post_data['ordencompra'.$i] == 0 ? null : $post_data['ordencompra'.$i];
					//$producto_ii['ord_comp_id'] = 1;
					
					if(!$this->IsNullOrEmptyString($producto_ii['prod_id']) and !$this->IsNullOrEmptyString($producto_ii['cant_prd']) and !$this->IsNullOrEmptyString($producto_ii['unidad_emp_id'])){
						$producto_i = ProductosOrdenCompra::create($producto_ii);
						$productos_vacios = false;
					}
					else{
						$producto_i = null;
					}
				}
				else{
					$productos_vacios = false;
					$producto_i = ProductosOrdenCompra::find($post_data['ordencompra'.$i]);
					$producto_i->prod_id = $post_data['producto'.$i];
					$producto_i->unidad_emp_fact_id = $post_data['unidad'.$i];	
					$producto_i->cant_prd_fact = $post_data['cantidad'.$i];
					$producto_i->iva_unt_fact = $post_data['ivaunitario'.$i];
					$producto_i->val_unt_fact = $post_data['valorunitario'.$i];
					$producto_i->val_tol_fact = $post_data['valortotal'.$i];
					//$producto_i['prod_sol_comp_id'] = $post_data['prodsolcompra'.$i] == 0 ? null : $post_data['prodsolcompra'.$i];
					$producto_i->fact_id = $factura->id;
					$producto_i->save();
					
				}
				if($producto_i != null){
					$regalm_i['cnt_prd'] = $post_data['cantidad'.$i];
					//$regalm_i['lot_prd'] = $post_data['lote'.$i];				
					$regalm_i['obs_reg'] = $post_data['obv_fact'];								
					$regalm_i['accion_id'] = 2;					
					$producto = Producto::find($producto_i->producto->id);				
					$producto->almacen['cnt_prd'] = $producto->almacen['cnt_prd'] + $regalm_i['cnt_prd'];
					$regalm_i['almacen_id'] = $producto->almacen->id;
					$regalm_i['saldo'] = $producto->almacen['cnt_prd'];
					$regalm = RegistroAlmacen::create($regalm_i);
					$producto->almacen->save();
				}
				$i = $i + 1;
				
				//return $producto_i;
			}
			if($productos_vacios === true){
				
				$factura->delete();
				$producto->almacen['cnt_prd'] = $producto->almacen['cnt_prd'] - $regalm_i['cnt_prd'];
				$producto->almacen->save();
				$regalm->delete();
				$validate->errors()->add('cantproductos', 'Debe existir al menos un producto válido asociado a esta factura.');
				return redirect()->back()->withInput()->withErrors($validate);
			}
			
			
			return redirect()->intended('/factura');
		
		}
		
		return redirect()->back()->withInput()->withErrors($validate);	
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $factura = Factura::with('productosordencompra')->find($id);
		foreach($factura->productosordencompra as $prod){
			$prod->almacen = $this->getAlmacenProducto($prod->prod_id);
		}
		$proveedores = Proveedor::all();
		$configuracion = Configuracion::first();
		$productos = Producto::all();
		return view('factura.show')->with(compact('factura','productos','configuracion','proveedores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        $facturas = Factura::find($factura);
		return view('factura.edit')->with('facturas', $facturas);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
         $post_data = $request->all();
		$rules = [
           	'no_fact' =>' ',
			'cnp_fact' =>' ',
			'comp_fact' =>' ',
			'form_pag' =>' ',
			'dia_cred' =>' ',
			'tim_entr' =>' ',
			'otr_fact' =>' ',
			'subt_fact' =>' ',
			'iva_fact' =>' ',
			'tol_fact' =>' ',
			'obv_fact' =>' ',
			'ord_comp_id'=>' '
			];
        $validate = Validator::make($post_data, $rules);
        if (!$validate->failed()) {
            $facturas = Factura::find($post_data['id']);
			$facturas->no_fact = $post_data['no_fact'];
			$facturas->cnp_fact = $post_data['cnp_fact'];
			$facturas->comp_fact = $post_data['comp_fact'];
			$facturas->form_pag = $post_data['form_pag'];
			$facturas->dia_cred = $post_data['dia_cred'];
			$facturas->tim_entr = $post_data['tim_entr'];
			$facturas->otr_fact = $post_data['otr_fact'];
			$facturas->subt_fact = $post_data['subt_fact'];
			$facturas->iva_fact = $post_data['iva_fact'];
			$facturas->tol_fact = $post_data['tol_fact'];
			$facturas->obv_fact = $post_data['obv_fact'];
			$facturas->ord_comp_id = $post_data['ord_comp_id'];
			return view('factura.show')->with('facturas', $facturas);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
	
	function IsNullOrEmptyString($question){
		return (!isset($question) || trim($question)==='');
	}
	
	public function getAlmacenProducto(int $id){
		$producto = Producto::find($id);
		if($producto){
			$almacen = $producto->almacen()->first();
			$almacen['und'] = $producto->unidad->des_und;
		}
		else{
			$almacen = null;
		}
		return $almacen;
	}
	
	
	public function cargarproveedorocp(Request $request)
    {
		$ocp = OrdenCompra::where('prov_id', '=', $request['option'])
							->has('productos')
							->whereHas('productos', function($q){
								$q->whereNull('fact_id')
								->OrWhere(function ($query) {
									$query->whereColumn('cant_prd','>','cant_prd_fact')
										->whereNotNull('fact_id');
								});
							})
							->get();
		//si el cant productos de fact es mayor o igual a cant productos de la orden 
		return response()->json($ocp);
	}
	
	public function cargarproductosocp(Request $request)
    {
		$var = $request['option'];
		if ($var == 0){

			$prod_prvs = OrdenCompra::where('prov_id', '=', $request['prov'])
							->get(['id']);
			$productosocp = ProductosOrdenCompra::with('producto')
					->with('unidad_solicitada_factura')
					->where(function ($query) use($prod_prvs) {
						$query->whereIn('ord_comp_id',$prod_prvs)
						->whereNull('fact_id');
					})
					->orWhere(function ($query) use($prod_prvs) {
						$query->whereIn('ord_comp_id',$prod_prvs)
						->whereColumn('cant_prd','>','cant_prd_fact')
						->whereNotNull('fact_id');
					})
					->get();
		}
		else{
			
			
			$productosocp = ProductosOrdenCompra::with('producto')
					->with('unidad_solicitada_factura')
					->where(function ($query) use($var) {
						$query->where('ord_comp_id',$var)
						->whereNull('fact_id');
					})
					->orWhere(function ($query) use($var) {
						$query->where('ord_comp_id',$var)
						->whereColumn('cant_prd','>','cant_prd_fact')
						->whereNotNull('fact_id');
					})->get();
		}	
		foreach($productosocp as $prod){
			$prod->unidades = $prod->producto->unidades;
		}
		//return response()->json($productosocp);
		return $productosocp;
	}
	
	
}
