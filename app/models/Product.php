<?php

class Product extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ac_payin_products';

	protected $guarded = array('row_id');

	protected $fillable = array('product_id','merchant_id','product_name','product_description','product_price','product_shipping','product_sku','product_clicks','date_added');

	public $timestamps = false;

	public function payincart()
	{
		return $this->belongsTo('PayinCart');
	}

	public static function getAllProducts()
	{
		if (Session::has('merchant'))
		{
			$merchant  	  = Session::get('merchant');
			$product_list = Product::where('merchant_id' , $merchant['merchant_id'])->get();
		}
		else
		{
			$product_list = Product::All();
		}

		return $product_list;
	}

	public static function getProductInfo($product_name)
	{
		$res = DB::table('ac_payin_products')
			->where('product_name',$product_name)
			->first();

		if ( !empty($res) ){
			$response = array(
    			'status'	=> 200,
    			'error'		=> false,
    			'data'		=> $res
    		);
		}
		else{
			$response = array(
    	 		'status'		 => 404,
    			'error'			 => true,
    			'error_ message' => 'No Result Found.'
    		);
		}

		return $response;
	}
	
	public static function addProduct($data,$merchant_id=null)
	{
		$create_data = array(
			'product_id'		=> Utils::generateRandomString(),
			'merchant_id'		=> Auth::user()->id,
			'date_added'		=> new DateTime,
			'bitcoin_button'	=> 1
		);

		foreach ($data as $key => $value) {
			if ( !empty($value) ){
				$create_data[$key] = $value;
			}
		}

		$add_product = self::create( $create_data );

		/*$add_product = Products::create(
			array(
				'product_id'			=> Utils::generateRandomString(),
				'merchant_id' 			=> Auth::user()->ee_member_id,
				'product_name'  		=> $data['product_name'],
				'product_description'	=> $data['product_description'],
				'product_price'			=> $data['product_price'],	
				'product_shipping'		=> $data['product_shipping'],
				'product_sku'			=> $data['product_sku'],
				'product_clicks'		=> $data['product_clicks'],
				'product_embedcode'		=> $data['product_embedcode'],
				'callback_url'			=> $data['callback_url'],
				'bitcoin_button'		=> 1,
				'date_added'			=> new DateTime
				)
			);*/

		$response = array(
        				'status'	=> 200,
        				'error' 	=> false,
        				'message'	=> 'Product has been successfully added.');

        return $response;		 	 	 	 	 	 	 	 	
	}

	public static function updateProduct($data, $product_id=null)
	{

		$update = array();

		foreach ($data as $key => $value) 
		{
			if($value != null)
			{
				$update[$key] =  $value;
			}	
		}

		if(empty($update))
		{
			$response = array(
        				'status'	=> 400,
        				'error' 	=> 'bad_request',
        				'params'	=> $data,
        				'message'	=> 'All parameters are blank/null, Please check your parameters.');
		}
		else
		{
			$affectedRows = Products::where('product_id',$product_id)->update($update);

			if($affectedRows == 1)
			{
				$response = array(
        				'status'	=> 200,
        				'error' 	=> false,
        				'update'	=> $update,
        				'message'	=> 'Product has been successfully updated.');
			}
			else
			{
				$response = array(
        				'status'	=> 402,
        				'error' 	=> 'update_failed',
        				'update'	=> $update,
        				'message'	=> 'Product update failed.');
			}
		}

		return $response;
	}
}
