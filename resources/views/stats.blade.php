@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Estadísticas</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- Favicon link -->
   <link rel="icon" href="{{ url('favicon.ico') }}" >

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">

   <link rel="stylesheet" href="{{ asset('css/stats.css') }}">

   <link rel="stylesheet" href="sweetalert2.min.css">
   
   <style>
      .map-responsive{
         overflow:hidden;
         padding-bottom:56.25%;
         position:relative;
         height:0;
      }

     .map-responsive iframe{
         left:0;
         top:0;
         height:100%;
         width:100%;
         position:absolute;
      }
   </style>
</head>
<body>
 <!-- header section starts  -->
@auth
   <?php
        $authUser = $users->find(Auth::user());
        $userRole = $authUser->role;
   ?>
@endauth

<header class="header">

   <a href="{{ route('home') }}" class="logo"><i class="fas fa-building"></i> OILP-IPISA </a>

   <nav class="navbar">
      <div id="close-navbar" class="fas fa-times"></div>
      <a href="{{ route('home') }}">Inicio</a>
      @auth
         @if ($userRole >= 2)
         <a href="{{ route('student.index') }}">Postulantes</a>
         @endif
      @endauth
      <a href="{{ route('business.index') }}">Empresas</a>
      <a href="{{ route('offer.index') }}">Vacantes</a>
      <a href="{{ route('stats') }}">Estadísticas</a>
      <a href="{{ route('contacts') }}"><div class="fas fa-phone"></div></a>
   </nav>

   <div class="icons">
      <div id="account-btn" class="fas fa-user"></div>
      <div id="menu-btn" class="fas fa-bars"></div>
   </div>

</header>

<!-- account form section starts  -->

<div class="account-form">

   <div id="close-form" class="fas fa-times"></div>

   <div class="buttons">
      <span class="btn active login-btn">Login</span>
      <span class="btn register-btn">Regístrate</span>
   </div>
   @guest
   <form class="login-form active" method="POST" action="{{ route('login') }}">
      <h3>Iniciar sesión</h3>
      @csrf
      <input type="email" placeholder="@error('email') {{ $message }} ............... @enderror Ingresa tu email" class="box" name="email">
      <input type="password" placeholder="@error('password') {{ $message }} ............ @enderror Ingresa tu password" class="box" name="password">
      <div class="flex">
         <input type="checkbox" name="remember" id="remember-me">
         <label for="remember-me">Recuérdame </label>
      </div>
      <input type="submit" value="iniciar sesión" class="btn">
   </form>
   @endguest
   @auth
      <form class="login-form active" method="POST" action="{{ route('logout') }}">
         <h3>Está logueado</h3>
         @csrf
         <input type="email" placeholder="{{ Auth::user()->email }}" class="box" name="email" disabled>
         <input type="password" placeholder="" class="box" name="password" value="..." disabled>
         
         <div class="flex">
            <input type="checkbox" name="remember" id="remember-me" disabled>
            <label for="remember-me">Recuérdame </label>
         </div>

         <input type="submit" value="Salir de la sesión" class="btn">
      </form>
   @endauth



   <form class="register-form" onsubmit="return false;">
      <h3>Registráte</h3>
      <a href="{{ route('student.create') }}" class="btn">Estudiantes y Egresados</a>
      <a href="{{ route('business.create') }}" class="btn">Empresa</a>
      @auth
         @if ($userRole == 3)
            <a href="{{ route('admin') }}" class="btn">Administrador</a>
         @endif
      @endauth
   </form>

</div>
<!-- stats section starts  -->
  
<div class="main-content">
        <div class="header-card pb-8 pt-5 pt-md-8">
          <div class="container-fluid">
            <h2 class="mb-5 heading">Estadísticas</h2>
            <div class="header-body">
              <div class="row">
                <div class="col-xl-3 col-lg-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Vacantes Disponibles</h5>
                          <span class="h2 font-weight-bold mb-0">{{ $offers->count() }}</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                            <i class="fas fa-chart-bar"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap">¡Corre y consigue la tuya!</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Postulantes Registrados*</h5>
                          <span class="h2 font-weight-bold mb-0">{{ $studentsSignedUp->count() }}</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                            <i class="fas fa-chart-pie"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap">(*) Total de postulantes</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Candidatos Disponibles*</h5>
                          <span class="h2 font-weight-bold mb-0">{{ $studentsAvailable->count() }}</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                            <i class="fas fa-users"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap">(*) Candidatos en espera de oferta</span>
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                  <div class="card card-stats mb-4 mb-xl-0">
                    <div class="card-body">
                      <div class="row">
                        <div class="col">
                          <h5 class="card-title text-uppercase text-muted mb-0">Empresas Registradas</h5>
                          <span class="h2 font-weight-bold mb-0">{{ $businessesSignedUp->count() }}</span>
                        </div>
                        <div class="col-auto">
                          <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                            <i class="fas fa-percent"></i>
                          </div>
                        </div>
                      </div>
                      <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-nowrap">¿Qué esperas para formar parte de alguna?</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Page content -->
      </div>

<section class="footer" style="margin-top: 30vh;">

   <div class="box-container">

      <div class="box">
         <h3> <i class="fas fa-building"></i> OILP-IPISA </h3>
         <p>El Instituto Politécnico Industrial de Santiago (IPISA), es una institución educativa técnico profesional con uno de los más altos niveles de expansión y crecimiento en este tipo de modelo de educación, así como también, acorde a la vanguardia de los nuevos tiempos.</p>
         <div class="share">
            <a href="https://web.facebook.com/IPISASDB" class="fab fa-facebook-f"></a>
            <a href="https://www.instagram.com/ipisasdb/?hl=es" class="fab fa-instagram"></a>
         </div>
      </div>

      <div class="box">
         <h3>Enlaces Rápidos</h3>
         <a href="{{ route('home') }}" class="link">Inicio</a>
         <a href="{{ route('stats') }}" class="link">Estadisticas</a>
         <a href="{{ route('contacts') }}" class="link">Contacto</a>
      </div>

      <div class="box">
         <h3>Contáctanos</h3>
         <a href="tel:8097245700" class="link">+1 (809) 724-5700</a>
         <a href="mailto:info@ipisa.edu.do" class="link">info@ipisa.edu.do</a>
         <a href="https://www.google.com/maps/place/Instituto+Polit%C3%A9cnico+Industri…3685!3m4!1s0x0:0x13c741931d8d644f!8m2!3d19.4270006!4d-70.6843685?hl=es-MX" class="link">Av. Hispanoamericana, Km 1 Santiago, Zona Sur, República Dominicana</a>
      </div>

     

   </div>

   <div class="credit"> OILP <span>IPISA</span> | © 2021 </div>

</section>

<!-- footer section ends -->



<!-- custom js file link  -->
<script src="{{ asset('js/script.js') }}"></script>

</body>
</html>