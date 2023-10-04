<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        {{ @$title != '' ? "$title |" : '' }} {{ config('app.name', 'Laravel') }}
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('hightech') }}/img/logo.ico" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Saira:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('hightech') }}/lib/animate/animate.min.css" rel="stylesheet">
    <link href="{{ asset('hightech') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('hightech') }}/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('hightech') }}/css/style.css" rel="stylesheet">
</head>

<body>

    <!-- Topbar Start -->
    <div class="container-fluid bg-secondary py-2 d-none d-md-flex sticky-top">
        <div class="container">
            <div class="d-flex justify-content-between topbar">
                <div class="top-info">
                    <a href="/" class="top-link">
                        <h1 class="text-white fw-bold d-block mb-0">PPTM<span class="text-warning">Payment</span> </h1>
                    </a>
                </div>
                <div id="note" class="text-white d-none d-xl-flex align-items-center"><small><span class="fw-bold">PonPes Tarbiyatul Mutathowi'in | Ngujur Rejosari Kebonsari Madiun</span></small></div>
                <div class="top-link">
                    <a href="https://www.instagram.com/pondokngujur/" class="bg-warning nav-fill btn btn-sm-square rounded-circle" target="blank"><i class="fab fa-instagram text-white"></i></a>
                    <a href="https://www.facebook.com/tarbiyatul.mutathowiin.92" class="bg-warning nav-fill btn btn-sm-square rounded-circle" target="blank"><i class="fab fa-facebook-f text-white"></i></a>
                    <a href="https://www.youtube.com/@pondokngujur" class="bg-warning nav-fill btn btn-sm-square rounded-circle" target="blank"><i class="fab fa-youtube text-white"></i></a>
                    <a href="https://wa.me/6289523969760" class="bg-warning nav-fill btn btn-sm-square rounded-circle me-0" target="blank"><i class="fa fa-phone text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->

    <!-- Carousel Start -->
    <div class="container-fluid px-0">
        <div id="carouselId" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselId" data-bs-slide-to="0" class="active" aria-current="true" aria-label="First slide"></li>
                <li data-bs-target="#carouselId" data-bs-slide-to="1" aria-label="Second slide"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="{{ asset('hightech') }}/img/carousel-4.jpg" class="img-fluid" alt="First slide">
                    <div class="carousel-caption">
                        <div class="container carousel-content">
                            <img src="{{ asset('hightech') }}/img/logo.ico" width="100px" alt="Logo" class="mb-3 animated fadeInDown">
                            <h1 class="text-warning h1 animated fadeInUp" style="text-shadow:0px 0px 10px rgb(47, 45, 45);">Selamat Datang</h1>
                            <h1 class="text-white display-1 mb-2 animated fadeInRight" style="text-shadow:0px 0px 10px grey;">Sistem Aplikasi Pembayaran SPP Online</h1>
                            <p class="mb-4 text-white fs-5 animated fadeInDown" style="text-shadow:0px 0px 10px black;">Pondok Pesantren Tarbiyatul Mutathowi'in <br>Ngujur Rejosari Kebonsari Madiun</p>
                            <a href="{{ route('login') }}" class="me-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInLeft text-white">Masuk</button></a>
                            <a href="{{ route('register') }}" class="ms-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInRight">Daftar</button></a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('hightech') }}/img/carousel-3.jpg" class="img-fluid" alt="Second slide">
                    <div class="carousel-caption">
                        <div class="container carousel-content">
                            <img src="{{ asset('hightech') }}/img/logo.ico" width="100px" alt="Logo" class="mb-3 animated fadeInDown">
                            <h1 class="text-warning h1 animated fadeInUp" style="text-shadow:0px 0px 10px rgb(71, 71, 71);">Selamat Datang</h1>
                            <h1 class="text-white display-1 mb-2 animated fadeInLeft" style="text-shadow:0px 0px 10px grey;">Sistem Aplikasi Pembayaran SPP Online</h1>
                            <p class="mb-4 text-white fs-5 animated fadeInDown" style="text-shadow:0px 0px 10px black;">Pondok Pesantren Tarbiyatul Mutathowi'in <br>Ngujur Rejosari Kebonsari Madiun</p>
                            <a href="{{ route('login') }}" class="me-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn2 animated fadeInLeft text-white">Masuk</button></a>
                            <a href="{{ route('register') }}" class="ms-2"><button type="button" class="px-4 py-sm-3 px-sm-5 btn btn-primary rounded-pill carousel-content-btn1 animated fadeInRight">Daftar</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Footer Start -->
    <div class="container-fluid footer bg-secondary wow fadeIn" data-wow-delay=".3s">
        <div class="container pt-2 pb-2">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <span class="text-white"><a href="#" class="text-warning fw-bold"><i class="fas fa-copyright text-warning me-2"></i>{{ config('app.name', 'Laravel') }}</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                    <span class="text-white">Created By <a href="https://instagram.com/_mezaff" class="text-warning fw-bold" target="blank">Mezaff</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('hightech') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('hightech') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('hightech') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('hightech') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('hightech') }}/js/main.js"></script>
</body>

</html>
