<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title','Home')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="/front/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/front/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/front/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Binus</span>ComServ</h1>
                </a>
            </div>
            <div class="navbar-nav ml-auto py-0">
                @if (Auth::guard('webmember') -> check())
                <a href="/orders" class="btn border">
                    <i class="fas fa-user text-primary"></i>
                    <span>{{ Auth::guard('webmember') -> user()->member_name }}</span>
                </a>
                @else
                <a href="/login_member" class="btn border">
                    <i class="fas fa-user text-primary"></i>
                    <span>Login</span>
                </a>
                @endif
            </div>
            <div>
                @if (Auth::guard('webmember') -> check())
                <a href="/logout_member" class="btn border">
                    <i class="fas fa-sign-out-alt text-primary"></i>
                    <span>Log out</span>
                </a>
                @endif
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                
                @php
                    $categories = App\Models\Category::all();
                @endphp

                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100 collapsed" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="text-light m-0">Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    @foreach ($categories as $category)
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 250px">
                        <div class="nav-item dropdown">
                            <a href="" class="nav-link" data-toggle="dropdown">
                                 <span>{{ $category->category_name }}</span>
                                <i class="fa fa-angle-down float-right mt-1"></i>
                            </a>
                            <div class="dropdown-menu position-absolute bg-secondary border-0 rounded-0 w-100 m-0">
                                @php
                                $subcategories = App\Models\Subcategory::where('id_category', $category->id)->get();
                                @endphp

                                @foreach ($subcategories as $subcategory)
                                <li>
                                    <a href="/products/{{ $subcategory->id }}">{{ $subcategory->subcategory_name }}</a>
                                </li>
                                @endforeach
                            </div>
                        </div>  
                        @endforeach   
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="/front/" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Binus</span>ComServ</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="/" class="nav-item nav-link active">Home</a>                           
                            <div class="nav-item dropdown">
                                <a href="/front/" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="/cart" class="dropdown-item">Activity Cart</a>
                                    <a href="/checkout" class="dropdown-item">Request</a>
                                </div>
                            </div>
                            <a href="/contact" class="nav-item nav-link">Contact</a>
                        </div>
                    </div>
                </nav>
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="/front/img/bl_sky.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="display-4 text-white text-uppercase font-weight-semi-bold mb-4">Binus Comserv</h3>
                                    <h3 class="text-light font-weight-medium mb-3">Guidelines for Community Services Compliance</h4>
                                    <a href="https://student.binus.ac.id/wp-content/uploads/2022/10/CDC-TFI_Mahasiswa-comserv.pdf" target="_blank" class="btn btn-light py-2 px-3">Guide</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->   
    <div class="container-fluid bg-dark text-light mt-5 pt-5">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <a href="/front/" class="text-decoration-none">
                    <h1 class="mb-4 display-5 text-light font-weight-semi-bold"><span class="text-primary font-weight-bold border border-white px-3 mr-1">BINUS</span>ComServ</h1>
                </a>
                <p>Dolore erat dolor sit lorem vero amet. Sed sit lorem magna, ipsum no sit erat lorem et magna ipsum dolore amet erat.</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>Paskal Hyper Square, Jl. Pasir Kaliki No.25-27, Ciroyom, Kec. Andir, Kota Bandung, Jawa Barat 40181</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="font-weight-bold text-light mb-4">Share</h5>
                        <div class="d-flex flex-column justify-content-start">
                            <a class="text-light mb-2" href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fstudent.binus.ac.id%2Fcommunity-service-guide%2F"><i class="fa fa-angle-right mr-2"></i>Twitter</a>
                            <a class="text-light mb-2" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fstudent.binus.ac.id%2Fcommunity-service-guide%2F"><i class="fa fa-angle-right mr-2"></i>Facebook</a>
                            <a class="text-light" href="https://wa.me/?text=Community+Service+Guide+-+https%3A%2F%2Fstudent.binus.ac.id%2Fcommunity-service-guide%2F"><i class="fa fa-angle-right mr-2"></i>Whatsapp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top border-light mx-xl-5 py-4">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-light">
                    &copy; <a class="text-light font-weight-semi-bold " href="/front/">ComServ</a>. All Rights Reserved. Designed
                    by
                    <a class="text-light font-weight-semi-bold" href="/front/https://htmlcodex.com">HTML Codex</a><br>
                    Distributed By <a href="/front/https://themewagon.com" target="_blank">ThemeWagon</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    


    <!-- JavaScript Libraries -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/front/lib/easing/easing.min.js"></script>
    <script type="text/javascript" src="/front/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script type="text/javascript" src="/front/mail/jqBootstrapValidation.min.js"></script>
    <script type="text/javascript" src="/front/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script type="text/javascript" src="/front/js/main.js"></script>
    @stack('js')
    
</body>

</html>