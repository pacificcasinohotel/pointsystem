<?php

class Invoice extends Eloquent {
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = '';

    public static function getinvoiceinfo($invoice_id,$merchant_id)
    {

        $res = PayinCart::with(
                'buyer',
                'payinproductcart',
                'payinproductcart.product'
            )
            ->select(
                'buyer_id',
                'invoice_id',
                'merchant_id',
                'cart_status'
            )
            ->where('invoice_id',$invoice_id)
            ->where('merchant_id',$merchant_id)
            ->first();

        if($res)
        {
            $res = $res->toArray();

            $res['total']           = 0;
            $res['total_shipping']  = 0;

            foreach ($res['payinproductcart'] as $key => $val) {
                $qty        = $val['quantity'];
                $date       = $val['date_added'];
                $price      = $val['product']['product_price'];
                $subtotal   = ( $qty * $price );

                $res['payinproductcart'][$key]['subtotal'] = $subtotal;
                $res['total']           += $subtotal;
                $res['total_shipping']  += $val['product']['product_shipping'];
            }
            $res['date_added'] = $date;

            return $res;
        }
        return false;
    }

    public static function getInvoiceList($merchant_id)
    {
        // $invoice = DB::table('ac_payin_cart')->where('merchant_id', $merchant_id)->get();
        // $invoice = PayinCart::with('buyer')->where('merchant_id', $merchant_id)->get()->toArray();

        $invoice = PayinCart::with('buyer','payinproductcart')
            ->where('merchant_id', $merchant_id)
            ->get();

        if($invoice->count() > 0)
        {
            return $invoice;
        }
        return false;
    }

    /*public static function getInvoiceInfo($invoice_id,$merchant_id)
    {

        $buyer = DB::table('ac_payin_cart as pc')
            // ->leftJoin('ac_payin_product_cart as ppc','ppc.invoice_id','=','pc.invoice_id')
            // ->leftJoin('ac_payin_products as pp','pp.product_id','=','ppc.product_id')
            ->leftJoin('ac_buyer_info as bi','bi.buyer_id','=','pc.buyer_id')
            ->where('pc.invoice_id',$invoice_id)
            ->where('pc.merchant_id',$merchant_id)
            ->first(array(
                'pc.invoice_id',
                'pc.merchant_id',
                'bi.buyer_id',
                'bi.first_name',
                'bi.last_name',
                'bi.email',
                'bi.address_1',
                'bi.address_2',
                'bi.address_number',
                'bi.address_city',
                'bi.address_state',
                'bi.address_zip',
                'bi.address_country',
                'bi.address_phone'
            ));

        $products = DB::table('ac_payin_product_cart as ppc')
            ->leftJoin('ac_payin_products as pp','pp.product_id','=','ppc.product_id')
            ->where('ppc.invoice_id',$invoice_id);
        
        $product_total = $products->sum('product_price');
        $product_details = $products->get(array(
                'pp.product_id',
                'quantity',
                'ppc.date_added',
                'product_name',
                'product_description',
                'product_price',
                'product_shipping'
            ));

        if ( !empty($product_details) ){

            $invoice_date = $product_details[count($product_details)-1]->date_added;
            $invoice_date = date("Y/m/d",strtotime($invoice_date));

            $res['buyer']       = $buyer;
            $res['total']       = number_format($product_total,2);
            $res['date']        = $invoice_date;
            $res['products']    = $product_details;

            if ( count($res) > 0 ){
                return $res;
            }
            return false;
        }
        return false;
    }*/

}