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
                @if (session()->has("completed"))
                    <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                        Congratulation! You successfully Completed the Order.
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    </div>
                @endif
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">All Orders</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
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
                            @if (count($order) != null)
                                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <!-- ============================================================== -->
                                    <!-- social source  -->
                                    <!-- ============================================================== -->
                                    <div class="card">
                                        <h5 class="card-header"> Uncompleted Orders</h5>
                                        <div class="card-body p-0">
                                            <ul class="social-sales list-group list-group-flush">
                                                @foreach ($order as $item)
                                                    <li class="list-group-item social-sales-content">
                                                        <span class="social-sales-icon-circle facebook-bgcolor mr-2">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <span class="social-sales-name">{{ $user->username }}</span>
                                                        <span class="social-sales-count text-dark">
                                                            <a href="/vendor/customers-order/{{ $item->id }}">
                                                                <button class="btn btn-primary">See Order Details</button>
                                                            </a>
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <!-- ============================================================== -->
                                    <!-- end social source  -->
                                    <!-- ============================================================== -->
                                </div>
                                @else
                                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <!-- ============================================================== -->
                                    <!-- social source  -->
                                    <!-- ============================================================== -->
                                    <div class="card">
                                        <h5 class="card-header"> Uncompleted Orders</h5>
                                        
                                        <p class="text-center">No Available Uncompleted Orders</p>
                                        <div class="card-footer text-center"></div>
                                    </div>
                                    <!-- ============================================================== -->
                                    <!-- end social source  -->
                                    <!-- ============================================================== -->
                                </div>
                            @endif

                                <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1"></div>
                                @if (count($completed) != null)
                                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <!-- ============================================================== -->
                                    <!-- sales traffice source  -->
                                    <!-- ============================================================== -->
                                    <div class="card">
                                        <h5 class="card-header"> Completed Orders</h5>
                                        <div class="card-body p-0">
                                            <ul class="traffic-sales list-group list-group-flush">
                                                @foreach ($completed as $item)
                                                    <li class="list-group-item social-sales-content">
                                                        <span class="social-sales-icon-circle facebook-bgcolor mr-2" style="background: #1d9a3a;">
                                                            <i class="fa fa-user"></i>
                                                        </span>
                                                        <span class="social-sales-name">Ayomikun</span>
                                                        <span class="social-sales-count text-dark">
                                                            <a href="/vendor/customers-order/{{ $item->id }}">
                                                                <button class="btn btn-success">Order Completed</button>
                                                            </a>
                                                        </span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-xl-5 col-lg-6 col-md-6 col-sm-12 col-12">
                                    <!-- ============================================================== -->
                                    <!-- sales traffice source  -->
                                    <!-- ============================================================== -->
                                    <div class="card">
                                        <h5 class="card-header"> Completed Orders</h5>
                                        <p class="text-center">No Available Completed Orders</p>
                                        <div class="card-footer text-center"></div>
                                    </div></div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
@include('layouts.vendor.footer')