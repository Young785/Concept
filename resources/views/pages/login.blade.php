@section('title', 'Concept - Login Page')
@include('layouts.header')
  <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="/"><img class="logo-img" src="/assets/images/logo.png" alt="logo"></a>
                <span class="splash-description">Please enter your user information.</span>
            </div>
            @if (session()->has("notExist"))
                <div class="alert alert-danger">
                    These credentials do not match our records.
                </div>
            @endif
            @if (session()->has("not_given"))
                <div class="alert alert-danger text-center">
                    Access Denied!
                </div>
            @endif
            <div class="card-body">
                <form action="/pages/login" method="POST">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="email" name="email" type="email" placeholder="Email">
                        <p class="error">{{ $errors->first("email") }}</p>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password">
                        <p class="error">{{ $errors->first("password") }}</p>
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="/pages/register" class="footer-link">Create An Account</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="#" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->

@include('layouts.footer')
