@extends('backend.layout.template');

@section('body-content')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Update Product Details</h4>
      <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
    </div>
  </div>

  <div class="br-pagebody">
    <div class="br-section-wrapper">
        <h6 class="br-section-label">Update Product Table</h6>
         <div class="row">

                 <div class="col-lg-6">
                    <form action="{{ route('product.update' , $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Product Title</label>
                             <input type="text" name="title" class="form-control" required="required" autocomplete="off" placeholder="Enter Product Title" value="{{ $product->title }}">
                         </div>

                         <div class="form-group">
                           <label>Brand</label>
                            <select class="form-control" name="brand_id">
                              <option>Please Selecet the Brand</option>
                                 @foreach($brands as $brand)
                                 <option value="{{ $brand->id }}"
                                  @if($brand->id == $product->brand_id)
                                  selected
                                  @endif
                                 >{{ $brand->name }}</option>
                                 @endforeach
                              </select>
                         </div>


                         <div class="form-group">
                            <label>Category</label>
                              <select class="form-control" name="category_id">
                                <option>Please Selecet the Category</option>
                                 @foreach($categories as $pcat)
                                 <option value="{{ $pcat->id }}"
                                  @if($pcat->id == $product->category_id)
                                   selected
                                  @endif
                                 >{{ $pcat->title }}</option>
                                 @foreach(App\Models\Category::orderBy('title' , 'asc')->where('is_parent' , $pcat->id)->get() as $ccat)
                                  <option value="{{ $ccat->id }}"
                                    @if($ccat->id == $product->category_id)
                                    selected
                                   @endif
                                   >--{{ $ccat->title }}</option>
                                   @endforeach
                                 @endforeach
                              </select>
                         </div>

                              <div class="form-group">
                                <label>Product Quantity [Ex:5]</label>
                                 <input type="text" name="quantity" class="form-control" required="required" autocomplete="off" placeholder="Enter Product Regular Price" value="{{ $product->quantity }}">
                             </div>

                             <div class="form-group">
                                <label>Product Regular Price</label>
                                 <input type="text" name="regular_price" class="form-control" required="required" autocomplete="off" placeholder="Enter Product Regular Price"  value="{{ $product->regular_price }}">
                             </div>

                             <div class="form-group">
                                <label>Product Offer Price</label>
                                 <input type="text" name="offer_price" class="form-control"  autocomplete="off" placeholder="Enter Product Offer Price"  value="{{ $product->offer_price }}">
                             </div>
                            </div>

                             <div class="col-lg-6">
                               <div class="form-group">
                                 <label>Featured Product</label>
                                   <select class="form-control" name="is_featured">
                                    <option value="0">Please Select the Status</option>
                                    <option value="1" @if($product->is_featured == 1) selected @endif>Featured</option>
                                    <option value="0" @if($product->is_featured == 0) selected @endif>Regular Product</option>
                                  </select>
                                    </div>

                               <div class="form-group">
                                 <label>Status</label>
                                  <select class="form-control" name="status">
                                    <option value="1">Please Select the Status</option>
                                    <option value="1" @if($product->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($product->status == 0 ) selected @endif>Inactive</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" rows="4" name="description">{{ $product->description }}</textarea>
                                </div>

                                <div class="form-group">
                                  <label>Product Search Tags [Seperated with comma (,)]</label>
                                  <input type="text" name="tags" class="form-control" value="{{ $product->tags }}">
                                </div>

                                @foreach($product->images as $image)
                                  <img src="{{ asset('backend/img/products/'   . $image->image) }}" width="50">
                                @endforeach

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                         <label>Main Thumbnail Image (*)</label>
                                          <input type="file" name="p_image[]" class="form-control-file">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Extra Image 1</label>
                                             <input type="file" name="p_image[]" class="form-control-file">
                                           </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label>Extra Image 2</label>
                                                 <input type="file" name="p_image[]" class="form-control-file">
                                               </div>
                                            </div>
                                        </div>
                              </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="submit" name="updateproduct" value="Save Changes" class="btn btn-teal btn-block mg-b-10">
                                  </div>
                            </div>
                     </form>
                </div>
             </div>
            </div>
        </div>
@endsection




