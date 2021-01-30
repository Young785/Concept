@include('layouts.vendor.header')
@section('title', 'Concept - Blank Page')
<style>
    .product-a{
        color: blue;
    }
    .product-a:hover{
        color: red;
    }
</style>
<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        @include('layouts.vendor.navbar')
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        @include('layouts.vendor.sidebar')
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Single Order</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/admin" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">order</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    @if (count($order) == null)
                        
                    @endif
                    <div class="row">
                        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="mb-0">Order Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <form class="/vendor/customers-order/{{ $value->id }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="username">Username</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">@</span>
                                                            </div>
                                                            <input type="text" class="form-control" id="username" value="{{ $user->username }}" placeholder="Username" disabled required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="lastName">Fullname:</label>
                                                        <input type="text" class="form-control" id="lastName" placeholder="" disabled value="{{ $user->fullname }}" required="">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                                    <input type="email" class="form-control" id="email" placeholder="you@example.com"  value="{{ $user->email }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" id="address" placeholder="1234 Main St"  value="{{ $user->address }}" disabled required="">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone">Phone Number<span class="text-muted"> </span></label>
                                                    <input type="text" class="form-control" id="phone" placeholder="Phone Number"  value="{{ $user->phone }}" disabled>
                                                </div>
                                                <hr class="mb-4">
                                                <p>Product: </p>
                                                <div class="mb-3">
                                                    <label for="product">Product Name<span class="text-muted"> </span></label>
                                                    <input type="text" class="form-control" id="product" placeholder="Product Name"  value="{{ $product->name }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="product">Product Price<span class="text-muted"> </span></label>
                                                    <input type="text" class="form-control" id="product" placeholder="Product Price"  value="{{ $product->price }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="product">Product Description<span class="text-muted"> </span></label>
                                                    <input type="text" class="form-control" id="product" placeholder="Product Description"  value="{{ $product->description }}" disabled>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone">Product: <span class="text-muted"></span></label>
                                                    <a href="/main/category/{{ $product->product_slug }}/product/{{ $product->id }}" class="product-a">See product details here</a>
                                                </div>
                                                <hr class="mb-4">
                                                @if ($value->order_status == "pending")
                                                    <p>Note: you can only complete c when goods is delivered to the Customer!</p>
                                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Complete Order</button>
                                            </form>
                                                    @else
                                                    <p>You have completed the order.</p>
                                                    <button class="btn btn-primary btn-lg btn-block" disabled type="submit">Order Completed</button>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
          
@include('layouts.vendor.footer')