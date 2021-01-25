@include('layouts.header')
@section('title', 'Concept - Registeration Page')
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form class="splash-container" action="/pages/register" method="POST">
        @csrf
        <div class="card">
            <div class="card-header">
                <h3 class="mb-1">Registrations Form</h3>
                <p>Please enter your user information.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="username" value="{{ old("username") }}" placeholder="Username">
                        <p class="error">{{ $errors->first("username") }}</p>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="fullname" value="{{ old("fullname") }}" placeholder="Full Name">
                        <p class="error">{{ $errors->first("fullname") }}</p>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" name="email" value="{{ old("email") }}" placeholder="E-mail">
                        <p class="error">{{ $errors->first("email") }}</p>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="pass1" type="password" name="password" placeholder="Password">
                    <p class="error">{{ $errors->first("password") }}</p>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="confPass" type="password" placeholder="Confirm">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="phone" value="{{ old("phone") }}" placeholder="Phone">
                        <p class="error">{{ $errors->first("phone") }}</p>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="address" value="{{ old("address") }}" placeholder="Address">
                        <p class="error">{{ $errors->first("address") }}</p>
                </div>
                <div class="form-group">
                    <select name="gender" id="gender" class="form-control">
                        <option aria-readonly="true">Select a Gender</option>
                        <option value="0">Male</option>
                        <option value="1">Female</option>
                    </select>
                    <p class="error">{{ $errors->first("gender") }}</p>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" required type="checkbox"><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
                    </label>
                </div>
                {{-- <div class="form-group row pt-0">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                        <button class="btn btn-block btn-social btn-facebook " type="button">Facebook</button>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <button class="btn  btn-block btn-social btn-twitter" type="button">Twitter</button>
                    </div>
                </div> --}}
            </div>
            <div class="form-group pt-2">
                <button class="btn btn-block btn-primary" type="submit">Register My Account</button>
            </div>
            <div class="card-footer bg-white">
                <p>Already a member? <a href="/pages/register" class="text-secondary">Login Here.</a></p>
            </div>
        </div>
    </form>
    @include('layouts.footer')
