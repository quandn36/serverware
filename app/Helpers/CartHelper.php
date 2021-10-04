<?php
namespace App\Helpers;
/**
 * 
 */
use Illuminate\Support\Facades\DB;
class CartHelper 
{
	public $item = [];
	public $total_quantity = 0;
	public $total_price = 0;

	function __construct()
	{   $this->items          = session('cart') ? session('cart') : [];
		$this->total_price    = $this->get_total_price();
		$this->total_quantity = $this->get_total_quantity();
	}
	public function add($product, $quantity, $price_config, $myConfig)
	{   
		$item = [
			'id'           => $product->id,
			'name'         => $product->name,
			'slug'         => $product->slug,
			'cover_image'  => $product->cover_image,
			'accessories'  => $myConfig,
			'price_config' => $price_config,
			'quantity'     => $quantity,
		];	
		$this->items[] = $item;
		/*if (isset($this->items[$product->id])) {	
			$this->items[$product->id]['quantity'] += $quantity;
		}
		else{
			
			$this->items[$product->id] = $item;
		}
		if($this->items[$product->id]['quantity'] <= $this->sl_TonKho($product))
		{
			session(['cart' => $this->items]);
			session(['mes_giohang' => 'Giỏ hàng hiện có:'.$this->items[$product->id]['quantity']]);
		}
		else
		{  
			session(['mes_giohang' => "SL tồn kho không đủ đáp ứng!"]);
		$tongtien = 0;
		$tongsl = 0;
		$gia = 0;
		$sl = 0;
		$mang = array();
		foreach ($this->items as $value) {
			$gia = $value['price'];
			$sl= $value['quantity'];
			$tongsl += $value['quantity'];
			$tongtien = $sl*$gia;
			array_push($mang, $tongtien);
		}
		$tongtien_canlay = array_sum($mang);
		$mess=[
		"thongbao" => session('mes_giohang'),
		"tongtien"=> $tongtien_canlay,
		"tongsl" => $tongsl,
		];
		}*/
		session(['cart' => $this->items]);
		return true;
	}
	
	public function sl_TonKho($product)
	{
		$sl_sp = "";
		foreach (json_decode($product->attributes) as $k1 => $v1) {
			if($k1=="quantity")
			{
				$sl_sp = $v1;
			}
		}
    	return $sl_sp;
	}

	public function remove($id){
		if (isset($this->items[$id])) {
			unset($this->items[$id]);
		}
		session(['cart' => $this->items]);
	}

	public function update($id,$quantity){
		if (isset($this->items[$id])) {
			$this->items[$id]['quantity'] = $quantity;
		}
		session(['cart' => $this->items]);
	}

	public function update_re_configure($id  ,$price_config, $myConfig){
		if (isset($this->items[$id])) {
			$this->items[$id]['accessories']  = $myConfig;
			$this->items[$id]['price_config'] = $price_config;
		}
		session(['cart' => $this->items]);
		return true;
	}

	public function clear($id,$quantity = 1){
		session(['cart' => '']);
	}

	private function get_total_price(){
		$t = 0;
		foreach ($this->items as  $item) {
			$t += $item['price_config']*$item['quantity'];
		}
	 	return $t;
	}
	private function get_total_quantity(){
		$t = 0;
		foreach ($this->items as  $item) {
			$t += $item['quantity'];
		}
	 	return $t;
	}
}
