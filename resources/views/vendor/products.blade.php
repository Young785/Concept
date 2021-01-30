@include('layouts.vendor.header')
@section('title', 'Concept - Blank Page')
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
                                <h2 class="pageheader-title">All Porducts</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/vendor" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Porducts</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    @if (session()->has("msg"))
                        <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                            Product Created Successfully!
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    @endif
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    @if(count($products) == null)
                                    <h1 class="text-center"><b>No Products Available</b> </h1>
                                        @else
                                        @foreach ($products as $product)
                                            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12">
                                                <div class="product-thumbnail">
                                                    <div class="product-img-head">
                                                        <div class="product-img">
                                                            <img src="{{ asset('/images/products/') }}/{{ $pics[$loop->index]['image_name'][0] }}" class="col-xs-12 col-md-12 col-lg-12 cat-img category-img img-fluid" alt="">  
                                                        </div>
                                                        <div class="ribbons bg-success"></div>
                                                        <div class="ribbons-text">New</div>
                                                        <div class=""><a href="#" class="product-wishlist-btn"><i class="fas fa-heart"></i></a></div>
                                                    </div>
                                                    <div class="product-content">
                                                        <div class="product-content-head">
                                                            <h3 class="product-title">{{ $product->name }}</h3>
                                                            <div class="product-rating d-inline-block">
                                                                <i class="fa fa-fw fa-star"></i>
                                                                <i class="fa fa-fw fa-star"></i>
                                                                <i class="fa fa-fw fa-star"></i>
                                                                <i class="fa fa-fw fa-star"></i>
                                                                <i class="fa fa-fw fa-star"></i>
                                                            </div>
                                                            <div class="product-price">${{ $product->price }}</div>
                                                        </div>
                                                        <div class="product-btn">
                                                            <p>About: {{ $product->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
          
@include('layouts.vendor.footer')