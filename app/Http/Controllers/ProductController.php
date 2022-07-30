<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Customer;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Prophecy\Call\Call;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Product::class);
        $customers = Customer::all();
        $products = Product::select('*')->orderBy('id','desc')->paginate(5);
        $category = Category::all();
        if ($request->s) {
            $products->where('name', 'LIKE', '%' . $request->s . '%');
        }
        $params = [
            'products' => $products,
            'category' => $category,
            'customers' => $customers,
        ];
        return view('backend.products.index',$params);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $params = [
            'categories' => $categories,
        ];
        return view('backend.products.create',$params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $storedPath = $image->move('images', $image->getClientOriginalName());
            $product->image           = 'storage/images/' . $image->getClientOriginalName();
        }
        try {
            $product->save();
            return redirect()->route('products.index')->with('success','Sửa'. ' ' . $request->name.' '.  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('products.index')->with('error','Sửa'. ' ' . $request->name.' '.  'không thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $params = [
            'product' => $product,
            'categories' => $categories,
        ];
        return view('backend.products.edit', $params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request,$id)
    {
        $product = Product::find($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $storedPath = $image->move('images', $image->getClientOriginalName());
            $product->image           = 'images/' . $image->getClientOriginalName();
        }
        $product->save();
        return redirect()->route('products.index')->with('success','Sửa'. ' ' . $request->name.' '.  'thành công');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success','Xóa'.' '.  'thành công');;
    }

    public function websiteProduct() {
        $products = Product::all();
        $category = Category::all();
        $params = [
            'products' => $products,
            'category' => $category,
        ];
        return view('frontend.website.product',$params);
    }




    public function cart()
    {
        return view('frontend.website.cart');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
          
        $cart = session()->get('cart', []);
  
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
          
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updateQuantity(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'cập nhật Giỏ hàng thành công ');
        }
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Xóa sản phẩm thành công');
        }
    }
    
    public function checkout()
    {
        return view('frontend.website.checkout');
    }

    public function checkouts(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->birthday = $request->birthday;
        $customer->password = $request->password;
        try {
            $customer->save();
            return redirect()->route('cart')->with('success','Giao dịch '.  'thành công');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->route('cart')->with('error','Giao dịch '.  'không thành công');
        }
    }

    public function categories($category_id)
    {
        $products = Product::where('category_id',$category_id)->get();
        $params = [
            'products' => $products,
        ];
        return view('frontend.website.categories',$params);
        
    }

    public function showProduct($id)
    {
        $showProduct = Product::find($id);
        $params = [
            'showProduct' => $showProduct
        ];
        return view('frontend.website.detail',$params);
    }
}
