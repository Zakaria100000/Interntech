<?php
    include('session.php');
?>

<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Internships</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/slicknav.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>

<body>

    <?php include('templates/header.php'); ?>

    <main>

        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center"
                data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Internships</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <!-- Left content -->
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="small-section-tittle2 mb-45">
                                    <div class="ion"> <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="12px">
                                            <path fill-rule="evenodd" fill="rgb(27, 207, 107)"
                                                d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z" />
                                        </svg>
                                    </div>
                                    <h4>Filter Jobs</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Job Category Listing start -->
                        <div class="job-category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                                <div class="small-section-tittle2">
                                    <h4>Job Category</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="select">
                                        <option value="">All Category</option>
                                        <option value="">Web Development & Design</option>
                                        <option value="">Category 2</option>
                                        <option value="">Category 3</option>
                                        <option value="">Category 4</option>
                                    </select>
                                </div>
                                <!--  Select job items End-->
                                <!-- select-Categories start -->
                                <div class="select-Categories pt-80 pb-50">
                                    <div class="small-section-tittle2">
                                        <h4>Job Type</h4>
                                    </div>
                                    <label class="container">Full Time
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Part Time
                                        <input type="checkbox" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Remote
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <!-- select-Categories End -->
                            </div>
                            <!-- single two -->
                            <div class="single-listing">
                                <div class="small-section-tittle2">
                                    <h4>Job Location</h4>
                                </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="select">
                                        <option value="">Anywhere</option>
                                        <option value="">Adrar</option>
                                        <option value="">Category 2</option>
                                        <option value="">Category 3</option>
                                        <option value="">Category 4</option>
                                    </select>
                                </div>
                                <!--  Select job items End-->
                                <!-- select-Categories start -->
                                
                                <!-- select-Categories End -->
                            </div>
                            <div class="single-listing" style="margin-top: 90px;">
                                <!-- Range Slider Start -->
                                <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow">
                                    <div class="small-section-tittle2">
                                        <h4>Filter Jobs</h4>
                                    </div>
                                    <div class="widgets_inner">
                                        <div class="range_item">
                                            <!-- <div id="slider-range"></div> -->
                                            <input type="text" class="js-range-slider" value="" />
                                            <div class="d-flex align-items-center">
                                                <div class="price_text">
                                                    <p>Price :</p>
                                                </div>
                                                <div class="price_value d-flex justify-content-center">
                                                    <input type="text" class="js-input-from" id="amount" readonly />
                                                    <span>to</span>
                                                    <input type="text" class="js-input-to" id="amount" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                                <!-- Range Slider End -->
                            </div>
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!-- Right content -->
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                <!-- Count of Job list Start -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="count-job mb-35">
                                            <span>15 Jobs found</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Count of Job list End -->
                                <!-- single-job-content -->
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="job_details.html"><img src="assets/img/icon/yassir.png" alt=""></a>
                                        </div>
                                        <div class="job-tittle">
                                            <a href="job_details.html">
                                                <h4>Frontend Developer</h4>
                                            </a>
                                            <ul>
                                                <li>Yassir</li>
                                                <li><i class="fas fa-map-marker-alt"></i>Alger, Algeria</li>
                                                <li>20 000 DZ</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link f-right">
                                        <a href="job_details.html">Full Time</a>
                                        <span>7 hours ago</span>
                                    </div>
                                </div>
                                <!-- single-job-content -->
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="job_details.html"><img src="assets/img/icon/heetch.png" alt=""></a>
                                        </div>
                                        <div class="job-tittle">
                                            <a href="job_details.html">
                                                <h4>Mobile App Developer</h4>
                                            </a>
                                            <ul>
                                                <li>Heetch</li>
                                                <li><i class="fas fa-map-marker-alt"></i>Oran, Algeria</li>
                                                <li>18 000 DZ</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link f-right">
                                        <a href="job_details.html">Full Time</a>
                                        <span>15 hours ago</span>
                                    </div>
                                </div>
                                <!-- single-job-content -->
                                <div class="single-job-items mb-30">
                                    <div class="job-items">
                                        <div class="company-img">
                                            <a href="job_details.html"><img src="assets/img/icon/hive-digit.png"
                                                    alt=""></a>
                                        </div>
                                        <div class="job-tittle">
                                            <a href="job_details.html">
                                                <h4>Full Stack Developer</h4>
                                            </a>
                                            <ul>
                                                <li>Hive Digit</li>
                                                <li><i class="fas fa-map-marker-alt"></i>Algiers, Algeria</li>
                                                <li>15 000 DZ</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="items-link f-right">
                                        <a href="job_details.html">Full Time</a>
                                        <span>2 days ago</span>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Featured_job_end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Job List Area End -->
        <!--Pagination Start  -->
        <div class="pagination-area pb-115 text-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="single-wrap d-flex justify-content-center">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-start">
                                    <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                    <li class="page-item"><a class="page-link" href="#">02</a></li>
                                    <li class="page-item"><a class="page-link" href="#">03</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><span
                                                class="ti-angle-right"></span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Pagination End  -->

    </main>

    <?php include('templates/footer.php') ?>

    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Range -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <script src="./assets/js/price_rangs.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="./assets/js/jquery.scrollUp.min.js"></script>
    <script src="./assets/js/jquery.nice-select.min.js"></script>
    <script src="./assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>

</html>