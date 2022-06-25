@extends('backend.layout.template');

@section('body-content')

<div class="br-pagetitle">
    <i class="icon ion-ios-home-outline"></i>
    <div>
      <h4>Manage District</h4>
      <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
    </div>
  </div>


  <div class="br-pagebody">
    <div class="br-section-wrapper">
        <h6 class="br-section-label">Basic Table</h6>
          <div class="bd bd-gray-300 rounded ">
            <div class="row">
               <div class="col-lg-12">

                <table class="table table-bordered table-striped mg-b-0">
                    <thead class="thead-colored thead-dark">
                      <tr>
                        <th scope="col">#Sl</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Regular Price</th>
                        <th scope="col">Offer Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>

                    </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                         @foreach($products as $product)
                      <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>
                            @php $p = 1; @endphp
                           @foreach($product->images as $image)
                            @if($p > 0 )
                            <img src="{{ asset('backend/img/products/'   .  $image->image) }}" width="50">
                            @endif
                            @php $p--; @endphp
                           @endforeach
                        </td>
                        <td>{{ $product->title}}</td>
                        <td>{{ $product->category->title}}</td>
                        <td>{{ $product->brand->name}}</td>
                        <td>{{ $product->regular_price}}</td>
                        <td>
                            @if(!empty( $product->offer_price ))
                               {{ $product->offer_price}}
                            @else
                             -N/A-
                            @endif
                        </td>
                        <td>{{ $product->quantity }} Pcs</td>
                        <td>
                            @if($product->is_featured == 0)
                               <span class="badge badge-primary">Inactive</span>
                            @elseif($product->is_featured == 1)
                            <span class="badge badge-info">Active</span>
                            @endif
                        </td>
                        <td>
                            @if($product->status == 1)
                              <span class="badge badge-success">Active</span>
                            @elseif($product->status == 0)
                              <span class="badge badge-info">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-button">
                                <ul>
                                    <li><a href="{{ route('product.edit' , $product->id) }}"><i class="fa fa-edit"></i></a></li>
                                    <li><a href="" data-toggle="modal" data-target="#delete{{ $product->id }}"><i class="fa fa-trash"></i></a></li>
                                 </ul>
                                 <!-- Modal start -->

                                 <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Do you confirm to delete this Product?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body text-center" >
                                        <div class="modal-buttons">
                                          <ul>
                                            <li>
                                              <form action="{{ route('product.destroy' , $product->id) }}" method="POST">
                                                @csrf
                                                <input type="submit" name="delete" class="btn btn-success" value="Confirm">
                                              </form>
                                            </li>
                                            <li><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></li>
                                          </ul>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                 <!-- Modal End -->


                            </div>
                        </td>
                    </tr>
                       @php $i++ ; @endphp
                       @endforeach
                   </tbody>
                  </table>
                  @if($products->count() == 0)
                    <div class="alert alert-info">
                      No Product Added Yet. Please Add Product For Product Delivery Management.
                 </div>
                 @endif
                </div>
            </div>
        </div>
    </div>
</div>




  @endsection
