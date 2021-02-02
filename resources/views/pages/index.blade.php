@include('layouts.header')
@section('title', 'Concept Admin Page')
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
                                <h2 class="pageheader-title">Concept Admin Page</h2>
                                <p class="pageheader-text">Nulla euismod urna eros, sit amet scelerisque torton lectus vel mauris facilisis faucibus at enim quis massa lobortis rutrum.</p>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item active"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    @if (session()->has("proUpdate"))
                        <div class="alert alert-success text-center col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12" id="remove">
                            Your account has been updated Successfully!
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        </div>
                    @endif
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Users</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ count(App\User::where("user_type", "user")->get()) }}</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><i class="fa fa-fw fa-arrow-up"></i></span>
                                            {{-- <span>5.86%</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Vendors</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ count(App\User::where("user_type", "vendor")->get()) }}</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><i class="fa fa-fw fa-arrow-up"></i></span>
                                            {{-- <span>5.86%</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Orders ({{ count(App\Order::all()) }})</h5>
                                        <div class="metric-value d-inline-block">
                                            Completed
                                            <h1 class="mb-1">{{ count(App\Order::where("order_status", "completed")->get()) }}</h1>
                                        </div>
                                        <div class="metric-value d-inline-block" style="margin-left:50px">
                                            Uncompleted
                                            <h1 class="mb-1">{{ count(App\Order::where("order_status", "pending")->get()) }}</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><i class="fa fa-fw fa-arrow-up"></i></span>
                                            {{-- <span>5.86%</span> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @php
                                $sum = App\Order::sum("paid_amount");
                                // $sum = sum($jun);
                            @endphp
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Revenue</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">${{ $sum }}</h1>
                                        </div>  
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span><i class="fa fa-fw fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Sales for this Month</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">${{ $sales[0] }} </h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5.86%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- new customer  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                @foreach ($number_of_users as $item)@endforeach
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">New Customer for this Month</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">{{ count($item) }}</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end new customer  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- visitor  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Visitor</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">13000</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end visitor  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Orders</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">1340</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light bg-success-light "><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">4%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total orders  -->
                            <!-- ============================================================== -->
                        </div>
                        <div class="row">
                            <!-- ============================================================== -->
                      
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Recent Orders</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">#</th>
                                                        <th class="border-0">Image</th>
                                                        <th class="border-0">Product Name</th>
                                                        <th class="border-0">Product Id</th>
                                                        <th class="border-0">Quantity</th>
                                                        <th class="border-0">Price</th>
                                                        <th class="border-0">Order Time</th>
                                                        <th class="border-0">Customer</th>
                                                        <th class="border-0">Status</th>
                                                        <th class="border-0">Action</th>
                                                    </tr>
                                                </thead>
                                                    <tbody>
                                                        @php
                                                            $i = 0;
                                                            while($i <= 0){
                                                            $i++;
                                                            }
                                                        @endphp
                                                        
                                                        @foreach ($order_products as $item)
                                                        <tr>
                                                            <td>{{ $i++ }}</td>
                                                            <td>
                                                                <div class="m-r-10"><img src="{{ asset('/images/products/') }}/{{ $order_products[$loop->index]['image_name'][0] }}" alt="user" class="rounded" width="45"></div>
                                                            </td>
                                                            <td>{{ $item->name }} </td>
                                                            <td>id000001 </td>

                                                            {{-- {{ dd($item->quantity) }} --}}
                                                            <td>{{ $item->quantity }}</td>
                                                            <td>${{ $item->paid_amount }}</td>
                                                            <td>{{ $item->created_at->diffForHumans() }}</td>

                                                            <td>{{ $item->username }} </td>
                                                            @if ($item->order_status == "pending")
                                                                <td><span class="badge-dot badge-brand mr-1"></span>InTransit </td>
                                                                @else
                                                                <td><span class="badge-dot badge-success mr-1"></span>Delivered </td>
                                                            @endif
                                                            <td colspan="9"><a href="/admin/customers-order/{{ $item->id }}" class="btn btn-outline-light float-right">View Details</a></td>
                                                            <td>
                                                                <button class="btn btn-danger">
                                                                    <i class="fa fa-trash"></i>  
                                                                </button>
                                                            </td>
                                                        @endforeach
                                                    </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end recent orders  -->
                        </div>
                        <div class="row">
                            <!-- end product category  -->
                                   <!-- product sales  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <!-- <div class="float-right">
                                                <select class="custom-select">
                                                    <option selected>Today</option>
                                                    <option value="1">Weekly</option>
                                                    <option value="2">Monthly</option>
                                                    <option value="3">Yearly</option>
                                                </select>
                                            </div> -->
                                        <h5 class="mb-0"> Product Sales</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="ct-chart-product ct-golden-section"></div>
                                    </div>
                                    <script>
                                        
                                    </script>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product sales  -->
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
                             Copyright © 2021 - {{ date("Y") }} Concept. All rights reserved. Dashboard by <a href="">Ayomikun</a>.
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
    {{-- @endforeach --}}
@include('layouts.footer')

<script>
     $(function() {
        "use strict";
        // ============================================================== 
        // Product Sales
        // ============================================================== 
        var month = <?php echo json_encode($month_count); ?>;
        var amount = <?php echo json_encode($month_amount); ?>;

        new Chartist.Bar('.ct-chart-product', {
            labels: [month[0],month[1],month[2],month[3],month[4],month[5],month[6],month[7],month[8],month[9],month[10],month[11],month[12],],
            series: [
                [amount[0],amount[1],amount[2],amount[3],amount[4],amount[5],amount[6],amount[7],amount[8],amount[9],amount[10],amount[11],amount[12]],
            ]
        }, {
            stackBars: true,
            axisY: {
                labelInterpolationFnc: function(value) {
                    return (value / 1000) + 'k';
                }
            }
        }).on('draw', function(data) {
            if (data.type === 'bar') {
                data.element.attr({
                    style: 'stroke-width: 40px'
                });
            }
        });
    });
</script>