<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use File;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('id' , 'desc')->get();
        return view('backend.pages.product.manage' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::orderby('name' , 'asc')->get();
        $categories = Category::orderby('title' , 'asc')->where('is_parent', 0)->get();
        return view('backend.pages.product.create' , compact('brands' , 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->title                 = $request->title;
        $product->slug                  = Str::slug($request->title);
        $product->description           = $request->description;
        $product->brand_id              = $request->brand_id;
        $product->category_id           = $request->category_id;
        $product->quantity              = $request->quantity;
        $product->regular_price         = $request->regular_price;
        $product->offer_price           = $request->offer_price;
        $product->is_featured           = $request->is_featured;
        $product->status                = $request->status;
        $product->tags                  = $request->tags;
        $product->save();

        if(count($request->p_image) > 0)
        {
           foreach($request->p_image as $image)
           {
                $img = rand(1,9999999) . '.' . $image->getClientOriginalExtension();
                $location = public_path('backend/img/products/'   .$img);
                Image:: make($image)->save($location);

                $p_image = new ProductImage();
                $p_image->product_id = $product->id;
                $p_image->image = $img;
                $p_image->save();
           }
        }

        return redirect()->route('product.manage');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if(!is_null($product))
        {
            $brands = Brand::orderby('name' , 'asc')->get();
            $categories = Category::orderby('title' , 'asc')->where('is_parent', 0)->get();
            return view('backend.pages.product.edit', compact('product' ,'brands' , 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title                 = $request->title;
        $product->slug                  = Str::slug($request->title);
        $product->description           = $request->description;
        $product->brand_id              = $request->brand_id;
        $product->category_id           = $request->category_id;
        $product->quantity              = $request->quantity;
        $product->regular_price         = $request->regular_price;
        $product->offer_price           = $request->offer_price;
        $product->is_featured           = $request->is_featured;
        $product->status                = $request->status;
        $product->tags                  = $request->tags;
        $product->save();


      if(count($request->p_image) > 0)
        {

          foreach ($product->images  as $pimage){

             // existing image
             if(File::exists('backend/img/products/'  . $pimage->image)){
                File::delete('backend/img/products/'  . $pimage->image);
            }


            }
           foreach($request->p_image as $image)
           {
                $img = rand(1,9999999) . '.' . $image->getClientOriginalExtension();
                $location = public_path('backend/img/products/'   .$img);
                Image:: make($image)->save($location);

                $p_image = new ProductImage();
                $p_image->product_id = $product->id;
                $p_image->image = $img;
                $p_image->save();
           }
        }

        return redirect()->route('product.manage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
