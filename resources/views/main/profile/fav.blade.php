@section('title', 'Spree - Profile Page')
@include('layouts.main.header')

@include('layouts.main.navbar')
    <main>
    @include('layouts.main.sidebar')
        <div class="pCol2">
            <div class="heading">
                <h2>My Favs</h2>
            </div>
            <hr/>
            <div class="row">
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="row favRow">
                        <div class="col-sm-2">
                            <div class="favImg">
                                <img src="/main/images/row1.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <p>
                                Smith & Cult Nailed Lacquer,Lovers,Creep
                            </p>
                        </div>
                        <div class="col-sm-2">
                            <p class="price">
                                $299.99
                            </p>
                        </div>
                        <div class="col-sm-2">
                            <button class="cartBtn"><i class="fas fa-cart-plus"></i></button>
                        </div>
                        <div class="col-sm-1 delete">
                            <a href="#" class="delete">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12" style="padding: 0px;">
                    <div class="row favRow">
                        <div class="col-sm-2">
                            <div class="favImg">
                                <img src="/main/images/row3.jpg" alt="">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <p>
                                Smith & Cult Nailed Lacquer,Lovers,Creep
                            </p>
                        </div>
                        <div class="col-sm-2">
                            <p class="price">
                                $299.99
                            </p>
                        </div>
                        <div class="col-sm-2">
                            <button class="cartBtn"><i class="fas fa-cart-plus"></i></button>
                        </div>
                        <div class="col-sm-1 delete">
                            <a href="#" class="delete">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
        <div class="footer">
            <div class="row" style="margin-left: -2px;">
                <div class="col-lg-3 col-md-6 col-sm-12 ">
                    <div>
                        <h6>Get to Know Us</h6>
                        <ul>
                            <li>
                                <a href="./about.html">About Us</a>
                            </li>
                            <li>
                                <a href="./career.html">Career</a>
                            </li>
                            <li>
                                <a href="./blog.html">Blog</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div>
                        <h6>Spree Business</h6>
                        <ul>
                            <li>
                                <a href="./partner.html">Sell on Spree</a>
                            </li>
                            <li>
                                <a href="./vendor/vendor.html">Advertise With Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 ">
                    <div>
                        <h6>Customer Service</h6>
                        <ul>
                            <li>
                                <a href="./contact.html">Contact Us </a>
                            </li>
                            <li>
                                <a href="./contact.html">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3  ">
                    <h6>Social</h6>
                    <div class="d-flex">
                        <div style="width: 24px;">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
    
                        </div>
                        <div style="width: 24px;" class="ml-3">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
@include('layouts.main.footer')
</body>
</html>