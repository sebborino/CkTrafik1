<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ck Trafik 1</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('../bootstrap/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
</head>

<body>
  <header class="bg-light shadow w-100" style="position: fixed;z-index:1000;">
        <nav class="navbar navbar-expand-lg navbar-dark font-weight-bold font-italic custom-color-bg"> 
          <div class="container">
          <a class="navbar-brand" href="{{ route('index')}}">
            <img  width="50px" src="{{ asset('../img/cktrafik.jpg')}}" alt="Card image cap">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav w-sm-75 w-100">
              <li class="nav-item px-3 mt-2">
                <a class="nav-link h6 text-center custom-color" href="{{ route('index')}}">
                  <i class="fas fa-home"></i>
                  Home
                </a>
              </li>
              <li class="nav-item px-3 mt-2">
                <a class="nav-link h6 text-center custom-color" href="{{ route('about')}}">
                  <i class="fas fa-info-circle"></i>
                  About</a>
              </li>
              <li class="nav-item px-3 mt-2">
                <a class="nav-link h6 text-center custom-color" href="#">
                  <i class="fas fa-envelope"></i>
                  Contact</a>
              </li>
              <li class="nav-item mt-2">
                <a  href="{{route('login')}}" class="nav-link h6 text-center custom-color">
                  <i class="fas fa-user"></i>
                  Login</a>
                </li>
            </ul>
            <ul class="navbar-nav w-sm-100 w-lg-25 px-5">
              
              <li class="nav-item text-center">
                <a href="https://www.facebook.com/iraqiairways" class="nav-link custom-color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                      <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>                  
               </a>
              </li>

              <li class="nav-item text-center">
                <a  href="https://wa.me/4555247733" class="nav-link custom-color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                      <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"/>
                    </svg>                
               </a>
              </li>

              <li class="nav-item text-center">
                <a  href="https://www.tiktok.com/@iraqiairwaysdk" class="nav-link custom-color">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                      <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3V0Z"/>
                    </svg>             
               </a>
              </li>
            </ul>

              
          </div>
        </div>
        </nav>

  </header>

  @yield('content')

<!-- Footer -->
<footer class="text-center text-lg-start custom-color-bg text-muted">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">

  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="custom-color">
    <div class="container text-center text-md-start mt-5 ">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <img  width="30px" src="{{ asset('../img/cktrafik.jpg')}}"> Ck Trafik 1 ApS
          </h6>
          <p>
            <ul>
                <li>Mon - Fri: 10:00-16:00</li>
                <li>Weekends: 10:00-15:00</li>
                <li>Holidays: 10:00-15:00</li>
                <li>WhatsApp +4555247733 (WhatsApp will only be used for text-messaging, and will be answered between 10:00 and 16:00)</li>
            </ul>

          </p>
          <p>
            <div>
              <a href="https://www.facebook.com/iraqiairways" class="mx-2 text-reset">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://www.tiktok.com/@iraqiairwaysdk" class="mx-2 text-reset">
                <i class="fab fa-tiktok"></i>
              </a>
              <a href="https://wa.me/4555247733" class="mx-2 text-reset">
                <i class="fab fa-whatsapp"></i>
              </a>
            </div>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Menu
          </h6>
          <p>
            <a href="{{ route('index')}}" class="text-reset">
              Home
               </a>
          </p>
          <p>
            <a href="{{ route('about')}}" class="text-reset">
              About
            </a>
          </p>
          <p>
            <a href="{{ route('index')}}" class="text-reset">
              Contact
            </a>
          </p>
          <p>
            <a href="{{ route('login')}}" class="text-reset">
              Login
            </a>
          </p>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Read More
          </h6>
          <p>
            <a href="{{route('terms')}}" class="text-reset">Terms & Conditions</a>
          </p>
          <p>
            <a href="{{route('privacy')}}" class="text-reset">Privacy</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> H.C. Ørsteds Vej 66 st. 1., <br/> 1879 Frederiksberg C</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
              info@iraqi-airways.com
          </p>
          <p><i class="fas fa-phone me-3"></i>
            +45 55 24 77 33</p>
          <p>
            CVR: 39569418</p>  
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Section: Social media -->

  <!-- Copyright -->
  <div class="text-center p-4 custom-color border-top" style="background-color: rgba(29, 29, 27, 0.75);">
    Copyright © 2022 Ck Trafik 1 ApS, All Rights Reserved
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

          
    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>