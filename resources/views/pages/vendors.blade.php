@include('layouts.header')
@section('title', 'Concept - Vendors')
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
                                <h2 class="pageheader-title">All Users</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="/admin" class="breadcrumb-link">Dashboard</a></li>
                                            <li class="breadcrumb-item active" aria-current="page">Vendors</li>
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
                            <!-- ============================================================== -->
                            @if (session()->has("msg"))
                                <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                                    You deleted the vendor Successfully!
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif
                            @if (session()->has("vendor"))
                                <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                                    You have Successfully made the user a Vendor!
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                </div>
                            @endif
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Vendors available Recently!</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            @if (count($vendors) == ' ')
                                                <p class="text-center"><b>No Available Vendor!</b></p>
                                                @else
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">#</th>
                                                        <th class="border-0">Image</th>
                                                        <th class="border-0">Fullname</th>
                                                        <th class="border-0">Username</th>
                                                        <th class="border-0">Email</th>
                                                        <th class="border-0">Address</th>
                                                        <th class="border-0">Phone</th>
                                                        <th class="border-0">Gender</th>
                                                        <th class="border-0">Date</th>
                                                        <th class="border-0">Action</th>
                                                    </tr>
                                                </thead>
                                                @php
                                                    $i = 0;
                                                    while($i <= 0){
                                                    $i++;
                                                    }
                                                @endphp
                                                    @foreach ($vendors as $vendor)
                                                        <tbody>
                                                            <tr>
                                                                <td>{{ $i++ }}</td>
                                                                <td>
                                                                    <div class="m-r-10"><img src="/assets/images/defavendorult.png" alt="{{ $vendor->name }}" class="rounded" width="45"></div>
                                                                </td>
                                                                <td>{{ $vendor->fullname }} </td>
                                                                <td>{{ $vendor->username }} </td>
                                                                <td>{{ $vendor->email }}</td>
                                                                <td>{{ $vendor->address }}</td>
                                                                <td>{{ $vendor->phone }}</td>
                                                                @if ($vendor->gender == "0")
                                                                    <td> Male</td>
                                                                    @else
                                                                    <td>Female</td>
                                                                @endif
                                                                <td>{{ $vendor->created_at->diffForHumans() }} </td>
                                                                <td>
                                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#unmakeVendor{{ $vendor->id }}">
                                                                        Remove Vendor
                                                                    </a>    
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{ $vendor->id }}">
                                                                        <i class="fa fa-fw fa-trash"></i>
                                                                    </a>    
                                                                </td>
                                                            </tr>                                        
                                                        </tbody>
                                                    @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    <div class="pagination">
                                        {{-- {{ $vendor->links() }} --}}
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @if (count($vendors) == 1)
                                
                            <div class="modal fade" id="exampleModal{{ $vendor->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </a>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this User?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">No</a>
                                            <form action="/admin/customers/{{ $vendor->id }}" method="POST">
                                                @csrf
                                                @METHOD('DELETE')
                                                <button class="btn btn-primary" type="submit">Yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="unmakeVendor{{ $vendor->id }}" tabindex="-1" role="dialog" aria-labelledby="makeVendorLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="makeVendorLabel">Make Vendor</h5>
                                            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </a>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this User?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#" class="btn btn-secondary" data-dismiss="modal">No</a>
                                            <form action="/admin/vendors/{{ $vendor->id }}" method="POST">
                                                @csrf
                                                <button class="btn btn-primary" type="submit">Yes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            @endif
                           
                            <!-- ============================================================== -->
                            <!-- end recent orders  -->

                            <!-- ============================================================== -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            Copyright © 2021 - {{ date("Y") }} Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Ayomikun</a>.
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  --> 
@include('layouts.footer')