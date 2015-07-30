<?php
namespace PomeMartDomainModel\Entities;

use Eloquent;
use PomeMartOrders;
use PomeMartProducts;

class OrderRemark extends Eloquent
{
    protected $table = 'order_remarks';
    protected $fillable = array(
        'id',
        'store_id',
        'order_remark_word',
        'order_ids',
    );

    public $timestamps = false;

    public static $rules = array(
        'order_remark_word' => 'required',
    );

    public static function boot()
    {
        parent::boot();
        OrderRemark::deleted(function($order_remark){
            //TODO
        });

    }

    public function store()
    {
        return $this->belongsTo('PomeMartDomainModel\Entities\Store','store_id','id');
    }

    public static function getAllRemarkByStoreId($store_id)
    {
        return OrderRemark::where('store_id','=',$store_id)->get();
    }

    public static function getRemarkById($rid)
    {
        return OrderRemark::find($rid);
    }

//    public function getProductIds()
//    {
//        $order_ids = explode('|',$this->order_ids);
//        $productids = [];
//        if(!empty($order_ids))
//        {
//            foreach($order_ids as $id){
//                $order = PomeMartOrders::fetch($id);
//                if(!is_null($order) && !is_null($order->orderItems)){
//                    foreach($order->orderItems as $item){
//                        $pid = $item->product_id;
//                        if(array_key_exists($pid,$productids)){
//                            $productids[$pid]++;
//                        }else{
//                            $productids[$pid] = 1;
//                        }
//                    }
//                }
//            }
//        }
//
//        return $productids;
//    }
//
//    public function getmostproductAttribute()
//    {
//        $product_ids = $this->getProductIds();
//        if(!empty($product_ids) && count($product_ids)>0)
//        {
//            arsort($product_ids);
//            $pid = key($product_ids);
//            $product = PomeMartProducts::getProduct($pid);
//            return !empty($product)?$product->product_name:"no product";
//        }
//        return "no product";
//    }
//
//    public function getrensiketestAttribute()
//    {
//        return "rensike have a test";
//    }

}
