<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{env('APP_NAME')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="/api/ShowImg/favicon.ico">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/ticker-style.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/nice-select.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('themeUser/assets/css/ckeditor.css')}}">

</head>

<body>

	<div id="app">
        <div id="preloader-active">
            <div class="preloader d-flex align-items-center justify-content-center">
                <div class="preloader-inner position-relative">
                    <div class="preloader-circle"></div>
                    <div class="preloader-img pere-text">
                        <img src="/api/ShowImg/logo.png">
                    </div>
                </div>
            </div>
        </div>
        <header>
            <!-- Header Start -->
            <div class="header-area">
                <div class="main-header ">
                    <div class="header-top white-bg d-none d-sm-block">
                        <div class="container">
                            <div class="col-xl-12">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="header-info-left">
                                        <ul>     
                                            <li class="title colorb"><span class="flaticon-energy"></span>{{env('slogan')}}</li>
                                        </ul>
                                    </div>
                                    <div class="header-info-right">
                                        <ul class="header-date">
                                            <li><span class="flaticon-calendar"></span>{{env('numberHeader')}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="header-bottom header-sticky">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-2 col-lg-3 col-md-3">
                                    <a href="/" target="_self"><img style="padding: 9px 0px;" src="/api/ShowImg/logo.png" alt=""></a>
                                </div>
                                <div class="col-xl-8 col-lg-9 col-md-9 header-flex">
                                    <div class="main-menu d-none d-md-block">
                                        <nav>
                                            <user-category/>
                                        </nav>
                                    </div>
                                </div>  
        
                                <div class="col-xl-2 col-lg-2 col-md-2">
                                    <div class="header-right f-right d-none d-xl-block">
                                        <div class="nav-search search-switch">
                                            <i class="fa fa-search"></i>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Mobile Menu -->
                                <div class="col-12">
                                    <div class="mobile_menu d-block d-md-none"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Header End -->
        </header>
        @yield('Content')
        <footer>
            <!-- Footer Start-->
            <div class="footer-main footer-bg">
                <div class="footer-area pt-5">
                    <div class="container">
                        <div class="row d-flex justify-content-between">
                            <div class="col-xl-3 col-lg-3 col-md-5 col-sm-8">
                                <div class="single-footer-caption mb-50">
                                    <div class="single-footer-caption mb-30">
                                        <!-- logo -->
                                        <div class="footer-logo">
                                            <a href=""><img src="/api/ShowImg/logo2_footer.png" alt=""></a>
                                        </div>
                                        <div class="footer-tittle">
                                            <div class="footer-pera">
                                                <p class="info1">{{env('target')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-7">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-tittle">
                                        <h4>Được viết bởi</h4>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p class="info2">{{env('memberOne')}}</p>
                                            <p class="info2">{{env('menberTow')}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-7">
                                <div class="single-footer-caption mb-50">
                                    <div class="footer-tittle">
                                        <h4>Thông tin chung</h4>
                                    </div>
                                    <div class="footer-tittle">
                                        <div class="footer-pera">
                                            <p class="info2">Gmail: {{env('GmailFooter')}}</p>
                                            <p class="info2">Số điện thoại: {{env('numberFooter')}}</p>
                                        </div>
                                    </div>                           
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer-bottom aera -->
                <div class="footer-bottom-area footer-bg">
                    <div class="container">
                        <div class="footer-border">
                            <div class="row d-flex align-items-center">
                                <div class="col-xl-12 ">
                                    <div class="footer-copy-right text-center">
                                        <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Được phát triển vào năm  &copy;2022 Với mục đính giao lưu và cùng nhau học tập | Trưởng nhóm <a href="{{env('LinkFBFooter')}}" target="_blank">{{env('memberOne')}}</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End-->
        </footer>

        <div class="search-model-box" id="search-model-box">
            <div class="d-flex align-items-center h-100 justify-content-center">
                <button  class="search-close-btn">+</button>
                <form class="search-model-form" action="/Search">
                    <input type="text" name="searchName" id="search-input" placeholder="Bạn muốn tìm kiếm gì?" autocomplete="off">
                </form>
            </div>
        </div>
	</div>

	<script src="{{asset('js/app.js')}}"></script> 




<!-- JS here -->

    <script src="{{asset('themeUser/assets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{asset('themeUser/assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/bootstrap.min.js')}}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{asset('themeUser/assets/js/jquery.slicknav.min.js')}}"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{asset('themeUser/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/slick.min.js')}}"></script>
    <!-- Date Picker -->
    <script src="{{asset('themeUser/assets/js/gijgo.min.js')}}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{asset('themeUser/assets/js/wow.min.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/animated.headline.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/jquery.magnific-popup.js')}}"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="{{asset('themeUser/assets/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/jquery.sticky.js')}}"></script>
    
    <!-- contact js -->
    <script src="{{asset('themeUser/assets/js/contact.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/jquery.form.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/mail-script.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/jquery.ajaxchimp.min.js')}}"></script>
    
    <!-- Jquery Plugins, main Jquery -->	
    <script src="{{asset('themeUser/assets/js/plugins.js')}}"></script>
    <script src="{{asset('themeUser/assets/js/main.js')}}"></script>

    
</body>
</html>