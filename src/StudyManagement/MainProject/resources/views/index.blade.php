<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Quản lý học tập | Trang chủ</title>
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/icon" href="{{asset('images/favicon1.ico')}}"/>
    <!-- Font Awesome -->
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">    
    <!-- Slick slider -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/slick.css')}}"/> 
    <!-- Fancybox slider -->
    <link rel="stylesheet" href="{{asset('css/jquery.fancybox.css')}}" type="text/css" media="screen" /> 
    <!-- Animate css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/animate.css')}}"/> 
    <!-- Progress bar  -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-progressbar-3.3.4.css')}}"/> 
    <!-- Theme color -->
    <link id="switcher" href="{{asset('css/theme-color/fountain-blue-theme.css')}}" rel="stylesheet">

    <!-- Main Style -->
    <link href="{{asset('style.css')}}" rel="stylesheet">

    <!-- Fonts -->

    <!-- Open Sans for body font -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!-- Lato for Title -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>    
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
  <!-- BEGAIN PRELOADER -->
  <div id="preloader">
    <div id="status">&nbsp;</div>
  </div>
  <!-- END PRELOADER -->

  <!-- SCROLL TOP BUTTON -->
  <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->

  <!-- Start header -->
  <header id="header">
    <!-- header top search -->
    <div class="header-top">
      <div class="container">
        <form action="/#">
          <div id="search">
          <input type="text" placeholder="Nhập vào nội dung cần tìm kiếm" name="s" id="m_search" style="display: inline-block;">
          <button type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
        </form>
      </div>
    </div>
    <!-- header bottom -->
    <div class="header-bottom">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="header-contact">
              <ul>
                <li>
                  <div class="phone">
                    <i class="fa fa-phone"></i>
                    @if(Auth::check())
                      {{$person['phone']}}
                    @else
                      (+844) 3869 2008
                    @endif
                  </div>
                </li>
                <li>
                  <div class="mail">
                    <i class="fa fa-envelope"></i>
                    @if(Auth::check())
                      {{$person['mail']}}
                    @else
                      DTDH@mail.hust.edu.vn
                    @endif
                  </div>
                </li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-6">
            <div class="header-login">
              @if (Auth::check())
                <a class="login modal-form" data-target="{!! url('viewPersonalInfo') !!}" data-toggle="modal" href="viewPersonalInfo">
                  <i class="fa fa-user"></i>
                  {{ $person['fullName'] }}
                </a>
                <a class="login modal-form" data-target="#logout-form" data-toggle="modal" href="#">
                  Đăng xuất
                  <i class="fa fa-sign-out"></i>
                </a>
              @else
                <a class="login modal-form" data-target="#login-form" data-toggle="modal" href="#">
                  Đăng nhập
                  <i class="fa fa-sign-in"></i>
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- End header -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start login modal window -->
  <div aria-hidden="false" role="dialog" tabindex="-1" id="login-form" class="modal leread-modal fade in">
    <div class="modal-dialog">
      <!-- Start login section -->
      <div id="login-content" class="modal-content">
        <div class="modal-header">
          <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><i class="fa fa-unlock-alt"></i>Đăng nhập</h4>
        </div>
        <div class="modal-body">
          <form action="{!! route('loginDemo') !!}" method="post">
            {!! csrf_field() !!}
            <div class="form-group">
              <input type="text" name="username" placeholder="Tên đăng nhập" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" placeholder="Mật khẩu" class="form-control">
            </div>
            <div class="loginbox">
              <button class="btn signin-btn" type="submit">Đăng nhập</button>
            </div>                    
          </form>
        </div>
        <div class="modal-footer footer-box">
          <a href="#">Quên mật khẩu?</a>          
        </div>
      </div>
    </div>
  </div>
  <!-- End login modal window -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start logout form -->
  <div aria-hidden="false" role="dialog" tabindex="-1" id="logout-form" class="modal leread-modal fade in">
    <div class="modal-dialog">
      <!-- Start login section -->
      <div id="login-content" class="modal-content">
        <div class="modal-header">
          <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
          <h4 class="modal-title"><i class="fa fa-unlock-alt"></i>Đăng xuất</h4>
        </div>
        <div class="modal-body">
          <form action="{!! route('logoutDemo') !!}" method="post">
            {!! csrf_field() !!}
            <div class="loginbox">
              <label><span>Bạn chắc chắn muốn đăng xuất?</span></label>
              <button class="btn signin-btn" type="submit">Đăng xuất</button>
            </div>                    
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End logout form -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- BEGIN MENU -->
  <section id="menu-area">      
    <nav class="navbar navbar-default" role="navigation">  
      <div class="container">
        <div class="navbar-header">
          <!-- FOR MOBILE VIEW COLLAPSED BUTTON -->
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- LOGO -->              
          <!-- TEXT BASED LOGO -->
          <a class="navbar-brand" href="{!! url('home') !!}">Quản lý học tập</a>              
          <!-- IMG BASED LOGO  -->
           <!-- <a class="navbar-brand" href="index.html"><img src="{{asset('images/logo.png')}}" alt="logo"></a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul id="top-menu" class="nav navbar-nav navbar-right main-nav">
            @if(!(Auth::check()) or (Auth::check() and $person['who'] != 3))
            <li class="active"><a href="{!! url('home') !!}">Trang chủ</a></li>
            @endif

            @if(Auth::check())
            <li><a href="{{ url('viewPersonalInfo') }}">Thông tin cá nhân</a></li>
            @endif
            <li class="dropdown">
              <a href="service.html" class="dropdown-toggle" data-toggle="dropdown">Chương trình học <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <!-- <li><a href="blog-archive.html">Blog Archive</a></li> -->
                @if(!(Auth::check()) or (Auth::check() and $person['who'] != 3))
                <li><a href="findAllCourse">Toàn bộ học phần</a></li>
                @endif
                @if(Auth::check() and $person['who'] != 2)
                <li><a href="studyPath">Lộ trình học</a></li>
                @endif
              </ul>
            </li>
            @if(Auth::check() and $person['who'] == 1)
            <li><a href="studentPoint">Bảng điểm</a></li>
            @endif
            @if(Auth::check() and $person['who'] != 1)
            <li><a href="findTeachingClass">Bảng điểm SV</a></li>
            @endif
            @if(Auth::check() and $person['who'] != 2)
            <li><a href="enrol">Đăng ký học</a></li>
            @endif
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tra cứu <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="classList">Danh sách lớp</a></li>
                <li><a href="findRegister">Lớp sinh viên đăng ký</a></li>
                @if(Auth::check() and $person['who'] != 2)
                <li><a href="findStudentFee">Học phí sinh viên</a></li>
                @endif
              </ul>
            </li>
            @if(Auth::check() and $person['who'] == 3)
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Khác <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="editStudentList">Danh sách sinh viên</a></li>
                <li><a href="listTeacher">Danh sách giảng viên</a></li>
                <li><a href="editAdminList">Danh sách quản trị viên</a></li>
                <li><a href="editCourseList">Danh sách học phần</a></li>
                <li><a href="editClassList">Danh sách lớp</a></li>
                <li><a href="pointProcess">Xử lý điểm</a></li>
                <li><a href="certificate">Cấp bằng</a></li>
              </ul>
            </li>
            @endif
            <!-- <li><a href="contact.html">Contact</a></li> -->
          </ul>                     
        </div><!--/.nav-collapse -->
        <a href="#" id="search-icon">
          <i class="fa fa-search">            
          </i>
        </a>
      </div>     
    </nav>
  </section>
  <!-- END MENU --> 
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start slider -->
  <section id="slider">
    <div class="main-slider">
      <div class="single-slide">
        <img src="{{asset('images/slider1.jpg')}}" alt="img">
        <!-- <img src="{{asset('images/slider-1.jpg')}}" alt="img"> -->
        <div class="slide-content">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="slide-article">
                  <h1 class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">Trường Đại học Bách Khoa Hà Nội</h1>
                  <p class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.75s">Trường Đại học kỹ thuật hàng đầu, cũng là một trong những<br>trung tâm nghiên cứu khoa học và chuyển giao công nghệ<br>lớn nhất của Việt Nam</p>
                  <a class="read-more-btn wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s" href="#">Xem thêm</a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="slider-img wow fadeInUp">
                  <!-- <img src="{{asset('images/person1.png')}}" alt="business man"> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="single-slide">
        <img src="{{asset('images/slider3.jpg')}}" alt="img">
        <div class="slide-content">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="slide-article">
                  <h1 class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">Quản lý<br> học tập sinh viên</h1>
                  <p class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.75s">Quản lý mọi thông tin liên quan trong quá trình sinh viên học tập tại trường Đại học Bách Khoa Hà Nội</p>
                  <a class="read-more-btn wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s" href="#">Xem thêm</a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="slider-img wow fadeInUp">
                  <!-- <img src="{{asset('images/person2.png')}}" alt="business man"> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>          
    </div>
  </section>
  <!-- End slider -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start Feature -->
  <!-- <section id="feature">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Features</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="feature-content">
            <div class="row">
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-leaf feature-icon"></i>
                  <h4 class="feat-title">Creative Design</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-mobile feature-icon"></i>
                  <h4 class="feat-title">Responsive Layouts</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-thumbs-o-up feature-icon"></i>
                  <h4 class="feat-title">Great Features</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-gears feature-icon"></i>
                  <h4 class="feat-title">Multiple Options</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-code feature-icon"></i>
                  <h4 class="feat-title">Quality Code</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                </div>
              </div>
              <div class="col-md-4 col-sm-6">
                <div class="single-feature wow zoomIn">
                  <i class="fa fa-smile-o feature-icon"></i>
                  <h4 class="feat-title">Awesome Support</h4>
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- End Feature -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start about  -->
  <!-- <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">About us</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="about-content">
            <div class="row">
              <div class="col-md-6">
                <div class="our-skill">
                  <h3>Our Skills</h3>                  
                  <div class="our-skill-content">
                  <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                    <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="100">
                        <span class="progress-title">Html5</span>
                      </div>
                  </div>
                  <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="85">
                        <span class="progress-title">Css3</span>
                      </div>
                  </div>
                  <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="70">
                        <span class="progress-title">JQuery</span>
                      </div>
                  </div>
                  <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="60">
                        <span class="progress-title">wordPress</span>
                      </div>
                  </div>
                  <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="40">
                        <span class="progress-title">Php</span>
                      </div>
                  </div>
                   <div class="progress">
                      <div class="progress-bar six-sec-ease-in-out" role="progressbar" data-transitiongoal="25">
                        <span class="progress-title">Java</span>
                      </div>
                  </div>
                  </div>                  
                </div>
              </div>
              <div class="col-md-6">
                <div class="why-choose-us">
                  <h3>Why Choose Us?</h3>
                  <div class="panel-group why-choose-group" id="accordion">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                            Awesome Design Layout <span class="fa fa-minus-square"></span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                        <img class="why-choose-img" src="{{asset('images/testi1.jpg')}}" alt="img">
                         <p> Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default ">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            Quality Coding <span class="fa fa-plus-square"></span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                         <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                        </div>
                      </div>
                    </div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="panel-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                            Great Support <span class="fa fa-plus-square"></span>
                          </a>
                        </h4>
                      </div>
                      <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                          <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- end about -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start counter -->
  <!-- <section id="counter">
    <div class="counter-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="counter-area">
              <div class="row"> -->
                <!-- Start single counter -->
                <!-- <div class="col-md-3 col-sm-6">
                  <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-suitcase"></i>
                    </div>
                    <div class="counter-no counter">
                      1275
                    </div>
                    <div class="counter-label">
                      Projects
                    </div>
                  </div>
                </div> -->
                <!-- End single counter -->
                <!-- Start single counter -->
                <!-- <div class="col-md-3 col-sm-6">
                  <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="counter-no counter">
                      5275
                    </div>
                    <div class="counter-label">
                      Hours Work
                    </div>
                  </div>
                </div> -->
                <!-- End single counter -->
                <!-- Start single counter -->
                <!-- <div class="col-md-3 col-sm-6">
                 <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-trophy"></i>
                    </div>
                    <div class="counter-no counter">
                      350
                    </div>
                    <div class="counter-label">
                      Awards
                    </div>
                  </div>
                </div> -->
                <!-- End single counter -->
                <!-- Start single counter -->
                <!-- <div class="col-md-3 col-sm-6">
                  <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <div class="counter-no counter">
                      875
                    </div>
                    <div class="counter-label">
                      Clients
                    </div>
                  </div>
                </div> -->
                <!-- End single counter -->
              <!-- </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- End counter -->

<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start Service -->
  <section id="service">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Thông báo từ nhà trường</h2>
            <span class="line"></span>
          </div>
        </div>
        <div class="col-md-12">
          <div class="service-content">
            <div class="row">
              <!-- Start single service -->
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-calendar service-icon"></i>
                  <h4 class="service-title">Lịch thi</h4>
                  <p>Thông báo lịch thi giữa kỳ<br>Thông báo lịch thi cuối kỳ<br>Thời gian nhận phúc tra bài thi từng môn</p>
                </div>
              </div>
              <!-- End single service -->
              <!-- Start single service -->
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-check-square-o service-icon"></i>
                  <h4 class="service-title">Đăng ký học tập</h4>
                  <p>Lịch đăng ký cho từng khóa<br>Danh sách lớp mở đăng ký<br>Thông tin xử lý đăng ký</p>
                </div>
              </div>
              <!-- End single service -->
              <!-- Start single service -->
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-file-text-o service-icon"></i>
                  <h4 class="service-title">Đồ án tốt nghiệp</h4>
                  <p>Lịch nộp và xét nhận đồ án tốt nghiệp<br>Kết quả xét nhận đồ án tốt nghiệp<br>Danh sách hủy đồ án không đạt yêu cầu</p>
                </div>
              </div>
              <!-- End single service -->
              <!-- Start single service -->
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-trophy service-icon"></i>
                  <h4 class="service-title">Học bổng</h4>
                  <p>Học bổng khuyến khích tài năng<br>Học bổng hỗ trợ học tập<br>Học bổng tài trợ từ các tập đoàn</p>
                </div>
              </div>
              <!-- End single service -->
              <!-- Start single service -->
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-book service-icon"></i>
                  <h4 class="service-title">Xử lý học tập</h4>
                  <p>Kết quả xử lý học tập chính thức<br>Danh sách cảnh cáo học tập<br>Xử lý buộc thôi học</p>
                </div>
              </div>
              <!-- End single service -->
              <!-- Start single service -->
              <div class="col-md-4 col-sm-6">
                <div class="single-service wow zoomIn">
                  <i class="fa fa-graduation-cap service-icon"></i>
                  <h4 class="service-title">Xét tốt nghiệp</h4>
                  <p>Mở đăng ký tốt nghiệp đợt A<br>Mở đăng ký tốt nghiệp đợt B<br>Kết quả xét tốt nghiệp</p>
                </div>
              </div>
              <!-- End single service -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Service -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start Pricing table -->
  <!-- <section id="pricing-table">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Our Pricing Tables</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="pricing-table-content">
            <div class="row">
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-table-price wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                  <div class="price-header">
                    <span class="price-title">Basic</span>
                    <div class="price">
                      <sup class="price-up">$</sup>
                      25
                      <span class="price-down">/mo</span>
                    </div>
                  </div>
                  <div class="price-article">
                    <ul>
                      <li>2GB Space</li>
                      <li>10GB Bandwidth</li>
                      <li>Free Domain</li>
                      <li>Free Email</li>
                      <li>Unlimited Support</li>
                    </ul>
                  </div>
                  <div class="price-footer">
                    <a class="purchase-btn" href="#">Purchase</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-table-price wow fadeInUp" data-wow-duration="0.75s" data-wow-delay="0.75s">
                  <div class="price-header">
                    <span class="price-title">Advanced</span>
                    <div class="price">
                      <sup class="price-up">$</sup>
                      50
                      <span class="price-down">/mo</span>
                    </div>
                  </div>
                  <div class="price-article">
                    <ul>
                      <li>2GB Space</li>
                      <li>10GB Bandwidth</li>
                      <li>Free Domain</li>
                      <li>Free Email</li>
                      <li>Unlimited Support</li>
                    </ul>
                  </div>
                  <div class="price-footer">
                    <a class="purchase-btn" href="#">Purchase</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-table-price featured-price wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
                  <div class="price-header">
                    <span class="price-title">Professional</span>
                    <div class="price">
                      <sup class="price-up">$</sup>
                      100
                      <span class="price-down">/mo</span>
                    </div>
                  </div>
                  <div class="price-article">
                    <ul>
                      <li>2GB Space</li>
                      <li>10GB Bandwidth</li>
                      <li>Free Domain</li>
                      <li>Free Email</li>
                      <li>Unlimited Support</li>
                    </ul>
                  </div>
                  <div class="price-footer">
                    <a class="purchase-btn" href="#">Purchase</a>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-table-price wow fadeInUp" data-wow-duration="1.15s" data-wow-delay="1.15s">
                  <div class="price-header">
                    <span class="price-title">Exclusive</span>
                    <div class="price">
                      <sup class="price-up">$</sup>
                      125
                      <span class="price-down">/mo</span>
                    </div>
                  </div>
                  <div class="price-article">
                    <ul>
                      <li>2GB Space</li>
                      <li>10GB Bandwidth</li>
                      <li>Free Domain</li>
                      <li>Free Email</li>
                      <li>Unlimited Support</li>
                    </ul>
                  </div>
                  <div class="price-footer">
                    <a class="purchase-btn" href="#">Purchase</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- End Pricing table -->  
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start Pricing table -->
  <!-- <section id="our-team">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Our Team</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="our-team-content">
            <div class="row"> -->
              <!-- Start single team member -->
              <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-team-member">
                 <div class="team-member-img">
                   <img src="{{asset('images/team-member-2.png')}}" alt="team member img">
                 </div>
                 <div class="team-member-name">
                   <p>John Doe</p>
                   <span>CEO</span>
                 </div>
                 <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                 <div class="team-member-link">
                   <a href="#"><i class="fa fa-facebook"></i></a>
                   <a href="#"><i class="fa fa-twitter"></i></a>
                   <a href="#"><i class="fa fa-linkedin"></i></a>
                 </div>
                </div>
              </div> -->
              <!-- Start single team member -->
              <!-- Start single team member -->
              <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-team-member">
                 <div class="team-member-img">
                   <img src="{{asset('images/team-member-1.png')}}" alt="team member img">
                 </div>
                 <div class="team-member-name">
                   <p>Bernice Neumann</p>
                   <span>Designer</span>
                 </div>
                 <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                 <div class="team-member-link">
                   <a href="#"><i class="fa fa-facebook"></i></a>
                   <a href="#"><i class="fa fa-twitter"></i></a>
                   <a href="#"><i class="fa fa-linkedin"></i></a>
                 </div>
                </div>
              </div> -->
              <!-- Start single team member -->
              <!-- Start single team member -->
              <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-team-member">
                 <div class="team-member-img">
                   <img src="{{asset('images/team-member-3.png')}}" alt="team member img">
                 </div>
                 <div class="team-member-name">
                   <p>Dvid Cameron</p>
                   <span>Developer</span>
                 </div>
                 <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                 <div class="team-member-link">
                   <a href="#"><i class="fa fa-facebook"></i></a>
                   <a href="#"><i class="fa fa-twitter"></i></a>
                   <a href="#"><i class="fa fa-linkedin"></i></a>
                 </div>
                </div>
              </div> -->
              <!-- Start single team member -->
              <!-- Start single team member -->
              <!-- <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="single-team-member">
                 <div class="team-member-img">
                   <img src="{{asset('images/team-member-1.png')}}" alt="team member img">
                 </div>
                 <div class="team-member-name">
                   <p>Bernice Neumann</p>
                   <span>Designer</span>
                 </div>
                 <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.</p>
                 <div class="team-member-link">
                   <a href="#"><i class="fa fa-facebook"></i></a>
                   <a href="#"><i class="fa fa-twitter"></i></a>
                   <a href="#"><i class="fa fa-linkedin"></i></a>
                 </div>
                </div>
              </div> -->
              <!-- Start single team member -->
            <!-- </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- End Pricing table -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start Testimonial section -->
  <!-- <section id="testimonial">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <div class="title-area">
                <h2 class="title">Whats Client Say</h2>
                <span class="line"></span>           
              </div>
            </div>
            <div class="col-md-12"> -->
              <!-- Start testimonial slider -->
              <!-- <div class="testimonial-slider"> -->
                <!-- Start single slider -->
                <!-- <div class="single-slider">
                  <div class="testimonial-img">
                    <img src="{{asset('images/testi1.jpg')}}" alt="testimonial image">
                  </div>
                  <div class="testimonial-content">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                    <h6>Bernice Neumann, <span>Designer</span></h6>
                  </div>
                </div> -->
                <!-- Start single slider -->
                <!-- <div class="single-slider">
                  <div class="testimonial-img">
                    <img src="{{asset('images/testi3.jpg')}}" alt="testimonial image">
                  </div>
                  <div class="testimonial-content">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                    <h6>John Dow, <span>CEO</span></h6>
                  </div>
                </div> -->
                <!-- Start single slider -->
                <!-- <div class="single-slider">
                  <div class="testimonial-img">
                    <img src="{{asset('images/testi2.jpg')}}" alt="testimonial image">
                  </div>
                  <div class="testimonial-content">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                    <h6>Michel, <span>Developer</span></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6"></div>        
      </div>
    </div>
  </section> -->
  <!-- End Testimonial section -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start Clients brand -->
  <!-- <section id="clients-brand">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="clients-brand-area">
            <ul class="clients-brand-slide">
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{asset('images/amazon.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{asset('images/discovery.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{asset('images/envato.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{asset('images/tuenti.png')}}" alt="img">
                </div>
              </li>
               <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{asset('images/amazon.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{asset('images/discovery.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{asset('images/envato.png')}}" alt="img">
                </div>
              </li>
              <li class="col-md-3">
                <div class="single-brand">
                  <img src="{{asset('images/tuenti.png')}}" alt="img">
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- End Clients brand -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start latest news -->
  <!-- <section id="latest-news">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Latest News</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="latest-news-content">
            <div class="row"> -->
              <!-- start single latest news -->
              <!-- <div class="col-md-4">
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <a href="blog-single-with-right-sidebar.html"><img src="{{asset('images/blog-img-1.jpg')}}" alt="image"></a>
                  </div>
                  <div class="blog-news-title">
                    <h2><a href="blog-single-with-right-sidebar.html">All about writing story</a></h2>
                    <p>By <a class="blog-author" href="#">John Powell</a> <span class="blog-date">|18 October 2015</span></p>
                  </div>
                  <div class="blog-news-details">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                    <a class="blog-more-btn" href="blog-single-with-right-sidebar.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </article>
              </div> -->
              <!-- start single latest news -->
              <!-- <div class="col-md-4">
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <a href="blog-single-with-right-sidebar.html"><img src="{{asset('images/blog-img-2.jpg')}}" alt="image"></a>
                  </div>
                  <div class="blog-news-title">
                    <h2><a href="blog-single-with-right-sidebar.html">Best Mobile Device</a></h2>
                    <p>By <a class="blog-author" href="#">John Powell</a> <span class="blog-date">|18 October 2015</span></p>
                  </div>
                  <div class="blog-news-details">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                    <a class="blog-more-btn" href="blog-single-with-right-sidebar.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </article>
              </div> -->
              <!-- start single latest news -->
              <!-- <div class="col-md-4">
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <a href="blog-single-with-right-sidebar.html"><img src="{{asset('images/blog-img-3.jpg')}}" alt="image"></a>
                  </div>
                  <div class="blog-news-title">
                    <h2><a href="blog-single-with-right-sidebar.html">Personal Note Details</a></h2>
                    <p>By <a class="blog-author" href="#">John Powell</a> <span class="blog-date">|18 October 2015</span></p>
                  </div>
                  <div class="blog-news-details">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                    <a class="blog-more-btn" href="blog-single-with-right-sidebar.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section> -->
  <!-- End latest news -->
<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- Start Footer -->
  <section id="subscribe">
    <div class="subscribe-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6">
            <h2 style="text-transform: uppercase" class="wow fadeInUp">Trường đại học<br>Bách Khoa Hà Nội</h2>
          </div>
          <div class="col-md-6 col-sm-6">
            <div class="footer-left wow fadeInUp">
              <h4><i class="fa fa-map-marker"></i>&emsp; Số 1 đường Đại Cồ Việt, Hà Nội, Việt Nam</h4>
              <h4><i class="fa fa-phone"></i>&emsp; (+844) 3869 2008, (+844) 3868 2305</h4>
              <h4><i class="fa fa-envelope"></i>&emsp; DTDH@mail.hust.edu.vn</h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Footer -->

<!-- ------------------------------------------------------------------------------------------------------------------------>
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>    
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <!-- Bootstrap -->
  <script src="{{asset('js/bootstrap.js')}}"></script>
  <!-- Slick Slider -->
  <script type="text/javascript" src="{{asset('js/slick.js')}}"></script>
  <!-- mixit slider -->
  <script type="text/javascript" src="{{asset('js/jquery.mixitup.js')}}"></script>
  <!-- Add fancyBox -->        
  <script type="text/javascript" src="{{asset('js/jquery.fancybox.pack.js')}}"></script>
 <!-- counter -->
  <script src="{{asset('js/waypoints.js')}}"></script>
  <script src="{{asset('js/jquery.counterup.js')}}"></script>
  <!-- Wow animation -->
  <script type="text/javascript" src="{{asset('js/wow.js')}}"></script> 
  <!-- progress bar   -->
  <script type="text/javascript" src="{{asset('js/bootstrap-progressbar.js')}}"></script>  
  <!-- ------------------------------------------------------------------------------------------------------------------------>
 
  <!-- Custom js -->
  <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
  
  </body>
</html>