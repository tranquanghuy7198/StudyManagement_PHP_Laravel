<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Quản lý học tập | Bảng điểm SV</title>
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
    <!-- Bootstrap progressbar  -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-progressbar-3.3.4.css')}}"/> 
    <!-- Theme color -->
    <link id="switcher" href="{{asset('css/theme-color/fountain-blue-theme.css')}}" rel="stylesheet">
    <!-- Table Style -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/TableStyle.css')}}"/>
    <!-- Button Style -->
    <link rel="stylesheet" href="{{asset('css/ButtonStyle.css')}}">

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
        <form action="">
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
 <!-- -------------------------------------------------------------------------------------------------- -->

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
<!-- -------------------------------------------------------------------------------------------------- -->

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

<!-- -------------------------------------------------------------------------------------------------- -->

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
            <li><a href="{!! url('home') !!}">Trang chủ</a></li>
            @endif

            @if(Auth::check())
            <li><a href="{{ url('viewPersonalInfo') }}">Thông tin cá nhân</a></li>
            @endif
            <li class="dropdown">
              <a href="service.html" class="dropdown-toggle" data-toggle="dropdown">Chương trình học <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <!-- <li><a href="blog-archive.html">Blog Archive</a></li> -->
                @if(!(Auth::check()) or (Auth::check() and $person['who'] != 3))
                <li><a href="{{ url('findAllCourse') }}">Toàn bộ học phần</a></li>
                @endif
                @if(Auth::check() and $person['who'] != 2)
                <li><a href="studyPath">Lộ trình học</a></li>
                @endif
              </ul>
            </li>
            @if(Auth::check() and $person['who'] == 1)
            <li><a href="{{ url('studentPoint') }}">Bảng điểm</a></li>
            @endif
            @if(Auth::check() and $person['who'] != 1)
            <li class="active"><a href="{{ url('findTeachingClass') }}">Bảng điểm SV</a></li>
            @endif
            @if(Auth::check() and $person['who'] != 2)
            <li><a href="{{ url('enrol') }}">Đăng ký học</a></li>
            @endif
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Tra cứu <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="classList">Danh sách lớp</a></li>
                <li><a href="{{ url('findRegister') }}">Lớp sinh viên đăng ký</a></li>
                @if(Auth::check() and $person['who'] != 2)
                <li><a href="{{ url('findStudentFee') }}">Học phí sinh viên</a></li>
                @endif
              </ul>
            </li>
            @if(Auth::check() and $person['who'] == 3)
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Khác <span class="fa fa-angle-down"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{{ url('editStudentList') }}">Danh sách sinh viên</a></li>
                <li><a href="listTeacher">Danh sách giảng viên</a></li>
                <li><a href="editAdminList">Danh sách quản trị viên</a></li>
                <li><a href="{{ url('editCourseList') }}">Danh sách học phần</a></li>
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

<!-- -------------------------------------------------------------------------------------------------- -->
  
  <!-- Start single page header -->
  <section id="single-page-header">
    <div class="overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-left">
              <h2>Bảng điểm sinh viên</h2>
              <p>Quản lý và cập nhật bảng điểm các lớp</p>
            </div>
          </div>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="single-page-header-right">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End single page header -->
  
  <!-- Start blog archive -->
  <section id="blog-archive">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="blog-archive-area">
            <div class="row">
              <div class="col-md-4 hidden-sm hidden-xs">
                <aside class="blog-side-bar">
                  <!-- Start sidebar widget -->
                  <div class="sidebar-widget">
                    <!-- Start blog search -->
                    <form action="editStudentPoint" method="post">
                      {!! csrf_field() !!}
                      <div class="search-group">
                        <button type="submit" class="blog-search-btn"><span class="fa fa-search"></span></button>
                        <input type="search" name="id" placeholder="Tìm theo MSSV" value="{!! old('id', isset($student) ? $student['id'] : null) !!}">
                      </div>
                    </form>
                  </div>
                  <!-- End blog search -->
                </aside>
              </div>
              <div class="col-md-8">
                <div class="blog-archive-left">
                  <!-- Start list of teaching classes -->
                  <div class="col-md-12">
                    <div class="title-area">
                        <h2 class="title">Bảng điểm</h2>
                        <p> </p>
                    </div>
                  </div>
                  <table style="width: 730px">
                    <thead>
                      <tr>
                        <th colspan="6">Kết quả học tập của sinh viên {{ $student['fullName'] }}</th>
                      </tr>
                      <tr>
                        <th style="width: 150px">Mã học phần</th>
                        <th style="width: 330px">Tên học phần</th>
                        <th style="width: 70px">Giữa kỳ</th>
                        <th style="width: 70px">Cuối kỳ</th>
                        <th style="width: 70px">Đánh giá</th>
                        <th style="width: 40px"></th>
                      </tr>
                    </thead>
                    <tbody>
                      @for($i=0; $i < count($enrol); $i++)
                      <tr>
                        <td>{{ $course[$i]['courseId'] }}</td>
                        <td>{{ $course[$i]['courseName'] }}</td>
                        {!! Form::open(array('route' => 'calculatePoint', 'method' => 'post')) !!}
                        {!! Form::hidden('id', $enrol[$i]['studentId']) !!}
                        {!! Form::hidden('classId', $enrol[$i]['classId']) !!}
                        <td><input style="width: 70px" class="ButtonStyle" type="text" name="midterm" value="{!! old('midterm', isset($enrol[$i]) ? $enrol[$i]['midterm'] : null) !!}"/></td>
                        <td><input style="width: 70px" class="ButtonStyle" type="text" name="endterm" value="{!! old('endterm', isset($enrol[$i]) ? $enrol[$i]['endterm'] : null) !!}"/></td>
                        <td>{{ $enrol[$i]['evaluate'] }}</td>
                        <td><button class="ButtonStyle add" type="submit">OK</button></td>
                        {!! Form::close() !!}
                      </tr>
                      @endfor
                    </tbody>
                  </table>
                  <!-- End list of teaching classes -->
                  <!-- <div class="blog-navigation-area">
                    <div class="blog-navigation-prev">
                      <a href="#">
                        <h5>All about writing story</h5>
                        <span>Previous Post</span>
                      </a>
                    </div>
                    <div class="blog-navigation-next">
                      <a href="#">
                        <h5>All about friends story</h5>
                        <span>Next Post</span>
                      </a>
                    </div>
                  </div> -->
                  <!-- Start Comment box -->
                  <!-- <div class="comments-box-area">
                    <h2>Leave a Comment</h2>
                    <p>Your email address will not be published.</p>
                    <form action="" class="comments-form">
                       <div class="form-group">                        
                        <input type="text" class="form-control" placeholder="Your Name">
                      </div>
                      <div class="form-group">                        
                        <input type="email" class="form-control" placeholder="Email">
                      </div>
                       <div class="form-group">                        
                        <textarea placeholder="Comment" rows="3" class="form-control"></textarea>
                      </div>
                      <button class="comment-btn">Submit Comment</button>
                    </form>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
  </section>
  <!-- End blog archive -->

  <!-- Start footer -->
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
  <!-- End footer -->

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
  
 
  <!-- Custom js -->
  <script type="text/javascript" src="{{asset('js/custom.js')}}"></script>
    
  </body>
</html>