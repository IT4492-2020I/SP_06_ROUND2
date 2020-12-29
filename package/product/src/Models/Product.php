<?php

namespace Dung\Product\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Dung\Order\Models\OrderDetail;

class Product extends Model
{
    protected $table = 'products';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'image',
        'price',
        'category_id',
        'status',
        'created_at',
    ];
    const SLIDE = [
        'url1'=>"banner1.jpg",
        'url2'=>"banner2.jpg",
        'url3'=>"banner3.jpg",
        'url4'=>"banner4.jpg"
    ];

    public function new_product($sl){
        $result=DB::table('products')->orderByRaw('created_at DESC')->paginate($sl);
        return $result;
    }
    function product_related($id,$id_category){
        $result=DB::table('products')->leftJoin("categorys","products.category_id","=","categorys.id")->where([["products.id","<>",$id],["products.category_id","=","$id_category"],])->orderByRaw('products.created_at DESC')->select("products.id","image","products.name","products.price")->offset(0)->limit(3)->get();
        return $result;
    }
    public function category_product($id_category){
        $result=DB::table('products')->where("category_id","=","$id_category")->orderByRaw('products.created_at DESC')->paginate(9);
        return $result;
    }
    public function best_category_product($category_id){
      $result=DB::table('products')->join('order_details',"order_details.product_id","=","products.id")->where("products.category_id","=","$category_id")->orderByRaw('order_details.quantity DESC')->paginate(3);
      return $result;
    }
    public function search_products($text){
        $result=DB::table("categorys")->join("products","products.category_id","=","categorys.id")->where("categorys.name","like","%$text%")->orwhere("products.name","like","%$text%")->paginate(8);
        return $result;
    }
    public function counter(){
        $count = DB::table('orders')->orderByRaw('id DESC')->offset(1)->limit(2)->get();
        return $count;
    }

    /**
     * relation to category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /**
     * relationship to feedback
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    /**
     * relationship to orderdetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }


    public function listData($input)
    {

        $builder = $this->orderBy('created_at', 'desc');
        if (isset($input['name'])) {
            $builder->where('name', 'LIKE', '%' . $input['name'] . '%');
        }

        if (isset($input['status'])) {
            $builder->where('status', '=', $input['status']);
        }
        if (isset($input['category_id'])) {
            $builder->where('category_id', '=', $input['category_id']);
        }
        if (isset($input['from'])) {
            $builder->where('created_at', '>=', $input['from']);
        }
        if (isset($input['to']) ) {
            $builder->where('created_at', '<', $input['to']);
        }
        return $builder->paginate();
    }
    /**
     * store product data
     *
     * @param $request
     * @return mixed
     */
    public function storeData($request)
    {
        $input = $request->all();

        $filePart = 'upload/product';
        if ($request->hasFile('image')) {
            $file = $request->image;
            $file->move($filePart, $file->getClientOriginalName());
            $input['image'] = '/' . $filePart . '/' . $file->getClientOriginalName();
        }
        $input['created_at'] = Carbon::now();
        return $this->create($input);
    }

    public function updateData($request)
    {
        $input = $request->all();
        $filePart = 'upload/product';
        $price = $this->find($input['id'])->price;

        //update new and deleted old
        if ($request->hasFile('image')) {
            if(File::exists(public_path($this->find($input['id'])->image))){
                unlink(public_path($this->find($input['id'])->image));
            }
            $file = $request->image;
            $file->move($filePart, $file->getClientOriginalName());
            $input['image'] = '/' . $filePart . '/' . $file->getClientOriginalName();
        }
        $input['size'] = ($input['size'] / 10);
        $input['created_at'] = Carbon::now();
        $this->find($input['id'])->update($input);
    }
}
