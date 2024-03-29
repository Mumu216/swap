@extends('frontend.layout.template')

@section('seo')
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Molla - Bootstrap eCommerce Template">
    <meta name="author" content="p-themes">
    <title>Molla - Bootstrap eCommerce Template</title>
@endsection

@section('content')

		<main class="main">
            <div class="page-header text-center" style="background-image: url('assets/images/page-header-bg.jpg')">
                <div class="container">
                    <h1 class="page-title">Checkout<span>Shop</span></h1>
                </div><!-- End .container -->
            </div><!-- End .page-header -->
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div><!-- End .container -->
            </nav><!-- End .breadcrumb-nav -->

            <div class="page-content">
                <div class="checkout">
                    <div class="container">
                        <div class="checkout-discount">
                            <form action="#">
                                @csrf
                                <input type="text" class="form-control" required id="checkout-discount-input">
                                <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
                            </form>
                        </div><!-- End .checkout-discount -->
                        <form action="{{  route('make_payment')}}"  method="POST" class="needs-validation" id="frmShippingAddress">
                            @csrf
                            <div class="row">
                                <div class="col-lg-9">
                                    <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>First Name *</label>
                                                <input type="text" name="first_name" value="@if(Auth::check()) {{ Auth::user()->name }} @endif"  class="form-control" required>
                                            </div><!-- End .col-sm-6 -->

                                            <div class="col-sm-6">
                                                <label>Last Name *</label>
                                                <input type="text" name="last_name" value="" class="form-control" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        {{-- <label>Company Name (Optional)</label>
                                        <input type="text" class="form-control"> --}}
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Email address *</label>
                                                <input type="email" name="email" value="@if(Auth::check()) {{ Auth::user()->email }}@endif" class="form-control" required>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Phone *</label>
                                                <input type="tel" class="form-control" name="phone" value="@if(Auth::check()) {{ Auth::user()->phone }}@endif" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div>


                                               <div class="form-row">
													<div class="form-group col">
														<label class="font-weight-bold text-dark text-2">Shipping Address [Flat No, House No, Road No etc] </label>
														<input type="text" value="@if(Auth::check()) {{ Auth::user()->address }}@endif" name="address" class="form-control">
													</div>
												</div>

                                                <div class="form-row">
                                                    <div class="form-group col-lg-6">
														<label class="font-weight-bold text-dark text-2">Division</label>
														 <select class="form-control" name="division_id"  id="division_id">
                                                          <option>Please Select Your Division</option>
                                                          @foreach($divisions as $division)
                                                            <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                          @endforeach
                                                        </select>
													</div>

                                                    <div class="form-group col-lg-6">
														<label class="font-weight-bold text-dark text-2">District</label>
														 <select class="form-control" name="district_id" id="district_names">
                                                           <option>Please Select Your District</option>
                                                           @foreach( $districts as $district)
                                                             <option value="{{ $district->id }}">{{ $district->district_name}}</option>
                                                           @endforeach
                                                        </select>
													</div>
                                                </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>State / Country *</label>
                                                <input type="text" class="form-control" name="country" value="@if(Auth::check()) {{ Auth::user()->country }}@endif" required>
                                            </div><!-- End .col-sm-6 -->
                                        </div><!-- End .row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Postcode / ZIP *</label>
                                                <input type="text" class="form-control" name="post_code" value="@if(Auth::check()) {{ Auth::user()->zip_code }}@endif" required>
                                            </div><!-- End .col-sm-6 -->


                                        </div><!-- End .row -->



                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                                            <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                                        </div><!-- End .custom-checkbox -->

                                        <div class="custom-control custom-checkbox">
                                            @if(Auth::check())
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}" >
                                            @endif
                                            <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                                            <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?</label>
                                        </div><!-- End .custom-checkbox -->

                                        <label>Order notes (optional)</label>
                                        <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                </div><!-- End .col-lg-9 -->
                                <aside class="col-lg-3">
                                    <div class="summary">
                                        <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                                        <table class="table table-summary">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                {{-- @foreach($carts as $cart)
                                                <tr>
                                                    <td><a href="#">{{ $cart->product->name }}</a></td>
                                                    <td>${{ $cart->unit_price }}</td>
                                                </tr>
                                                @endforeach --}}
                                                {{-- @foreach($carts as $cart)
                                                <tr>
                                                    <td><a href="#">{{ $cart->product->name }}</a></td>
                                                    <td>{{ $cart->unit_price }}</td>
                                                </tr>
                                                @endforeach --}}

                                                <tr class="summary-subtotal">
                                                    <td>Subtotal:</td>
                                                    <td>${{ App\Models\Cart::totalPrice() }}</td>
                                                </tr><!-- End .summary-subtotal -->
                                                <tr>
                                                    <td>Shipping:</td>
                                                    <td>Free shipping</td>
                                                </tr>
                                                <tr class="summary-total">
                                                    <td>Total:</td>
                                                    <td>${{ App\Models\Cart::totalPrice() }}</td>
                                                </tr><!-- End .summary-total -->
                                            </tbody>
                                        </table><!-- End .table table-summary -->

                                        <div class="accordion-summary" id="accordion-payment">
                                            <div class="card">
                                                <div class="card-header" id="heading-1">
                                                    <h2 class="card-title">
                                                        <a role="button" data-toggle="collapse" href="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                                            Direct bank transfer
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1" data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-2">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-2" aria-expanded="false" aria-controls="collapse-2">
                                                            Check payments
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-2" class="collapse" aria-labelledby="heading-2" data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-3">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-3" aria-expanded="false" aria-controls="collapse-3">
                                                            Cash on delivery
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-3" class="collapse" aria-labelledby="heading-3" data-parent="#accordion-payment">
                                                    <div class="card-body">Quisque volutpat mattis eros. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-4">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-4" aria-expanded="false" aria-controls="collapse-4">
                                                            PayPal <small class="float-right paypal-link">What is PayPal?</small>
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-4" class="collapse" aria-labelledby="heading-4" data-parent="#accordion-payment">
                                                    <div class="card-body">
                                                        Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede. Donec nec justo eget felis facilisis fermentum.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->

                                            <div class="card">
                                                <div class="card-header" id="heading-5">
                                                    <h2 class="card-title">
                                                        <a class="collapsed" role="button" data-toggle="collapse" href="#collapse-5" aria-expanded="false" aria-controls="collapse-5">
                                                            Credit Card (Stripe)
                                                            <img src="assets/images/payments-summary.png" alt="payments cards">
                                                        </a>
                                                    </h2>
                                                </div><!-- End .card-header -->
                                                <div id="collapse-5" class="collapse" aria-labelledby="heading-5" data-parent="#accordion-payment">
                                                    <div class="card-body"> Donec nec justo eget felis facilisis fermentum.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Lorem ipsum dolor sit ame.
                                                    </div><!-- End .card-body -->
                                                </div><!-- End .collapse -->
                                            </div><!-- End .card -->
                                        </div><!-- End .accordion -->

										<input type="hidden" name="amount" value="{{App\Models\Cart::totalPrice()}}">
                                          <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block">
                                            <span class="btn-text">Place Order</span>
                                            <span class="btn-hover-text">Proceed to Checkout</span>
                                        </button>
                                    </div><!-- End .summary -->
                                </aside><!-- End .col-lg-3 -->
                            </div><!-- End .row -->
                        </form>
                    </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->

@endsection

