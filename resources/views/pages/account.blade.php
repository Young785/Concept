@include('layouts.header')
@section('title', 'Concept - Your Profile')
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
                                    <h5 class="card-header">Your Acoount</h5>
                                    <div class="card-body">
                                        <form action="/admin/account" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @METHOD('PATCH')
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Full Name:</label>
                                                    <input id="inputText3" type="text" name="fullname" value="{{ $admin->fullname }}" class="form-control">
                                                    <p class="error">{{ $errors->first("fullname") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">UserName:</label>
                                                    <input id="inputText3" type="text" name="username" value="{{ $admin->username }}" class="form-control">
                                                    <p class="error">{{ $errors->first("username") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Email:</label>
                                                    <input id="inputText3" type="text" name="email" value="{{ $admin->email }}" class="form-control">
                                                    <p class="error">{{ $errors->first("email") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">User Image:</label><br>
                                                    <em>The user image is optional!</em>
                                                    <input id="inputText3" type="file" name="user_image" value="{{ $admin->user_image }}" class="form-control">
                                                    <p class="error">{{ $errors->first("user_image") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Address:</label>
                                                    <input id="inputText3" type="text" name="address" value="{{ $admin->address }}" class="form-control">
                                                    <p class="error">{{ $errors->first("address") }}</p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputText3" class="col-form-label">Phone Number:</label>
                                                    <input id="inputText3" type="number" name="phone" value="{{ $admin->phone }}" class="form-control">
                                                    <p class="error">{{ $errors->first("phone") }}</p>
                                                </div>
                                                <div class="form-group text-center">
                                                    <button class="btn btn-primary">Edit Account</button>
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