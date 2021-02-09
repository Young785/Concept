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
                                <h2 class="pageheader-title">Profile Details</h2>
                                <p class="pageheader-text">Here are your details.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/admin" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Users</li>
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
                                    <h5 class="card-header">Your Category</h5>
                                    <div class="card-body">
                                        <form action="/admin/add-category" method="POST" enctype="multipart/form-data">
                                            @csrf
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Category Name</label>
                                                    <input id="inputText3" type="text" name="category_name" value="{{old("category_name") }}" class="form-control">
                                                    <p class="error">{{ $errors->first("category_name") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Category Image</label>
                                                    <input id="inputText3" type="file" name="category_image" value="{{old("category_image") }}" class="form-control">
                                                    <p class="error">{{ $errors->first("category_image") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Category Descripton</label>
                                                    <input id="inputText3" type="text" name="category_description" value="{{old("category_description") }}" class="form-control">
                                                    <p class="error">{{ $errors->first("category_description") }}</p>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button class="btn btn-primary">Add Category</button>
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