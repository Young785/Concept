@include('layouts.header')
@section('title', 'Concept - Blank Page')
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
                                <h2 class="pageheader-title">All Categories</h2>
                                <p class="pageheader-text">Available Categories</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/admin" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Categories</li>
                                        </ol>
                                    </nav>
                                </div>
                                <p>---> Note there should only be a unique Category!</p>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  --> 
                    @if (session()->has("msg"))
                        <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                            You have Successfully added a new Category!!
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    @endif
                    @if (session()->has("catDeleted"))
                    <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                        Category Deleted Successfully!
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    @endif
                    @if (session()->has("catEdited"))
                    <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                        Category Edited Successfully!
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                    @endif
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="row">
                                    @if(count($categories) == null)
                                    <h1 class="text-center"><b>No Category Available</b> </h1>
                                        @else
                                            @foreach ($categories as $category)
                                            <div class="col-xl-3 col-lg-6 col-md-12 col-sm-12 col-12">
                                                <div class="product-thumbnail">
                                                    <div class="product-img-head">
                                                        <div class="product-img">
                                                            <img src="{{ asset("images/category") }}/{{ $category->category_image }}" alt="{{ $category->category_name }}" class="category-img img-fluid"></div>
                                                        <div class="ribbons bg-success"></div>
                                                        <div class="ribbons-text">New</div>
                                                        <div class=""><a href="#" class="product-wishlist-btn"><i class="fas fa-heart"></i></a></div>
                                                    </div>
                                                    <div class="product-content">
                                                        <div class="product-content-head">
                                                            <h3 class="product-title">{{ $category->category_name }}</h3>
                                                            <div class="dropdown dd-action">
                                                                <i class=" fas fa-ellipsis-v dd-i" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true">
                                                                </i>
                                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                  <a class="dropdown-item editDropdown" data-toggle="modal" data-target="#edit{{ $category->id }}"  data-id="{{ $category->id }}"  href="#">Edit</a>
                                                                  <a class="dropdown-item"  data-toggle="modal" data-target="#delete{{ $category->id }}" href="#">Delete</a>
                                                                </div>
                                                            </div>
                                                            {{-- <script>
                                                                function editCat(){
                                                                    window.history.replaceState (null, null, "?id={{ $category->id }}")
                                                                }
                                                            </script> --}}
                                                            <div class="product-rating d-inline-block">
                                                                <i class="fa fa-fw fa-star"></i>
                                                                <i class="fa fa-fw fa-star"></i>
                                                                <i class="fa fa-fw fa-star"></i>
                                                                <i class="fa fa-fw fa-star"></i>
                                                                <i class="fa fa-fw fa-star"></i>
                                                            </div>
                                                        </div>
                                                        <div class="product-btn">
                                                            <p>About: {{ $category->category_description }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="delete{{ $category->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteLabel">Delete Category</h5>
                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this Category?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">No</a>
                                                            <form action="/admin/categories/{{ $category->id }}" method="POST">
                                                                @csrf
                                                                @METHOD('DELETE')
                                                                <button class="btn btn-primary" type="submit">Yes</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="edit{{ $category->id }}" tabindex="-1"role="dialog" aria-labelledby="editLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editLabel">Edit Category</h5>
                                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </a>
                                                        </div>
                                                        @php
                                                            $cat = App\Category::where("id", $category->id)->first();
                                                        @endphp
                                                        <div class="modal-body">
                                                            <form action="/admin/categories/edit/{{ $category->id }}" method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @METHOD('PATCH')
                                                                <div class="form-group">
                                                                    <label for="inputText3" class="col-form-label">Category Name</label>
                                                                    <input id="inputText3" type="text" name="category_name" required value="{{ $cat->category_name }}" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputText3" class="col-form-label">Category Image</label>
                                                                    <p>This field is Optional!</p>
                                                                    <input id="inputText3" type="file" name="category_image" value="{{ $cat->category_image }}" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="inputText3" class="col-form-label">Category Description</label>
                                                                    <input id="inputText3" type="text" name="category_description" required value="{{ $cat->category_description }}" class="form-control">
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
          
@include('layouts.footer')