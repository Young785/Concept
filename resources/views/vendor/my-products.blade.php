@section('title', 'Concept - Your Products')
@include('layouts.vendor.header')
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
                                <h2 class="pageheader-title">Your Porducts</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/vendor" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Your Porducts</li>
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
                    @if (session()->has("prodDeleted"))
                        <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                            Product Deleted Successfully!
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    @endif
                    @if (session()->has("prodEdited"))
                        <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                            Product Edited Successfully!
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
                                                        <div class="dropdown dd-action">
                                                            <i class=" fas fa-ellipsis-v dd-i" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"></i>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <a class="dropdown-item editDropdown" data-toggle="modal" data-target="#edit{{ $product->id }}"  data-id="{{ $product->id }}"  href="#">Edit</a>
                                                                <a class="dropdown-item"  data-toggle="modal" data-target="#delete{{ $product->id }}" href="#">Delete</a>
                                                            </div>
                                                        </div>
                                                        <div class="product-btn">
                                                            <p>About: {{ $product->description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteLabel">Delete Product</h5>
                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this Product?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">No</a>
                                                            <form action="/vendor/products/{{ $product->id }}" method="POST">
                                                                @csrf
                                                                @METHOD('DELETE')
                                                                <button class="btn btn-primary" type="submit">Yes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="edit{{ $product->id }}" tabindex="-1"role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editLabel">Edit Category</h5>
                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </a>
                                                        </div>
                                                        @php
                                                            $prod = App\Product::where("id", $product->id)->first();
                                                        @endphp
                                                        <div class="modal-body">
                                                            <form action="/vendor/products/edit/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @METHOD('PATCH')
                                                                <div class="form-group">
                                                                    <label for="inputText3" class="col-form-label">Product Name</label>
                                                                    <input id="inputText3" type="text" name="name" required value="{{ $prod->name }}" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputText3" class="col-form-label">Product Description</label>
                                                                    <input id="inputText3" type="text" name="description" required value="{{ $prod->description }}" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputText3" class="col-form-label">Product Price</label>
                                                                    <input id="inputText3" type="text" name="price" required value="{{ $prod->price }}" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputText3" class="col-form-label">Product Quantity</label>
                                                                    <input id="inputText3" type="text" name="quantity" required value="{{ $prod->quantity }}" class="form-control">
                                                                </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                                                                <button class="btn btn-primary" type="submit">Edit Category</button>
                                                            </form>
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