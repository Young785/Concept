@include('layouts.header')
@section('title', 'Concept - Add Products')
<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        @include('layouts.navbar')
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        @include('layouts.sidebar')
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
                                <h2 class="pageheader-title">Make Products</h2>
                                <p class="pageheader-text">Here are your details.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/admin" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Add Products</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Add Product</h5>
                                    <div class="card-body">
                                        <form action="/admin/add-products" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Product Name</label>
                                                    <input id="inputText3" type="text" name="name" value="{{old("name") }}" class="form-control">
                                                    <p class="error">{{ $errors->first("name") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Product Description</label>
                                                    <input id="inputText3" type="text" name="description" value="{{old("description") }}" class="form-control">
                                                    <p class="error">{{ $errors->first("description") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Products Price</label>
                                                    <input id="inputText3" type="number" name="price" value="{{old("price") }}" class="form-control">
                                                    <p class="error">{{ $errors->first("price") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Available Quantity</label>
                                                    <input id="inputText3" type="number" name="quantity" value="{{old("quantity") }}" class="form-control">
                                                    <p class="error">{{ $errors->first("quantity") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Category Title</label> 
                                                    <select name="category_id" class="form-control">
                                                        <option readonly="readonly" disabled>Select a Category</option>
                                                        @foreach ($getcat as $item)
                                                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                                        @endforeach
                                                     </select>
                                                    <p class="error">{{ $errors->first("category_id") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Images</label>
                                                    <br> Note: <em>A product Must have a miinimum of three Images</em><br>
                                                    <input id="inputText3" type="file" name="image_name[]" value="{{old("image_name") }}" class="form-control" multiple>
                                                    <p class="error">{{ $errors->first("image_name") }}</p>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button class="btn btn-primary">Add Product</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <!-- ============================================================== -->
          
@include('layouts.footer')