<?php
namespace Dung\Product\Http\Controller;
use App\Http\Controllers\Controller;
use Dung\Product\Models\Product;
use Illuminate\Http\Request;
use Dung\Product\Http\Requests\ProductStoreRequest;
use Dung\Product\Models\Category;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {
    protected $product;
    protected $view;

    /**
     * CustomerController constructor.
     *
     * @param \App\Models\Product $product
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function __construct(Product $product)
    {

        $this->product = $product;
        $this->view = config("product.view");
    }

    public function list()
    {
        $New_Product = $this->product->new_product(8);
        if(!$this->view) return ["product"=>$New_Product, "view"=>$this->view];
        return view("product::User.homepage", compact("New_Product"));
    }

    public function product_detail(Request $request,$id){
        $product=Product::find($id);
        $new_product=$this->product->new_product(4);
        $product_related=$this->product->product_related($product->id,$product->category_id);
        if(!$this->view) return $new_product;
        return view("product::User.product_detail",compact("product","new_product","product_related"));
    }

    public function products_by_category(Request $request,$id){
        $category=Category::get_name();
        if(!$id) $id=$category[0]->id;
        $product_category=$this->product->category_product($id);
        if(!$this->view) return ["category"=>$category, "product_category" => $product_category];
        return view("product::User.product_type",compact("category","product_category"));
    }

    public function search_product(Request $request){
        $txt=$request->s;
        $products=$this->product->search_products($txt);
        if(!$this->view) return ["products" => $products];
        return view("product::User.search",compact("products"));
    }

    public function rediect(Request $request)
    {
        $request->session()->put('id_cart', null);
        return redirect()->route('home');
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::allows('admin')) {
            $products = $this->product->listData($request->all());
            $categorys = Category::pluck('name', 'id');
            if(!$this->view) return ['products'=>$products, 'categorys'=>$categorys];
            return view('product::Admin.Product.index', compact(['products', 'categorys']));
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('admin')) {
            $categorys = Category::pluck('name', 'id');
            if(!$this->view) return ["categorys"=>$categorys];
            return view('product::Admin.Product.create', compact(['categorys']));
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        if (Gate::allows('admin')) {
            $this->product->storeData($request);
            return redirect($request->url_back ?? route('product::products.index'));
        } else {
            return null;
            return redirect(route('home'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('admin')) {
            $product = $this->product->find($id);
            if(!$this->view) return ['product'=>$product];
            return view('product::Admin.Product.show', compact('product'));
        } else {
          //  return redirect(route('home'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::allows('admin')) {
            $product = $this->product->find($id);
            $categorys = Category::pluck('name', 'id');
            if(!$this->view) return (['product'=>$product, 'categorys'=>$categorys]);
            return view('product::Admin.Product.edit', compact(['product', 'categorys']));
        } else {
            return redirect(route('home'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductStoreRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request, $id)
    {
        if (Gate::allows('admin')) {
            $this->product->updateData($request);
            if(!$this->view) return null;
            return redirect($request->url_back ?? route('product::products.index'));
        } else {
            if(!$this->view) return null;
            return redirect(route('home'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        if (Gate::allows('admin')) {
            $product = $this->product->find($id);
            if(File::exists(public_path($product->image))){
                unlink(public_path($product->image));
            }
            $product->delete();
            if(!$this->view) return null;
            return redirect(route('product::products.index'));
        } else {
            if(!$this->view) return null;
            return redirect(route('home'));
        }
    }
}
?>
