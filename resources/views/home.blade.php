@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Inserción Laboral</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.0/css/all.min.css">

   <!-- Favicon link -->
   <link rel="icon" href="{{ url('favicon.ico') }}" >

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">

   <link rel="stylesheet" href="{{ asset('css/home.css') }}">

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

<!-- account form section ends -->

<!-- header section ends -->

<!-- home section starts  -->

<section class="home">

   <div class="swiper home-slider">
      
      <div class="swiper-wrapper">

         <section class="swiper-slide slide" style="background: url(images/IMG_0550.jpg) no-repeat;">
            <div class="content">
               <h3>La pasantía, ¡tu entrada al mundo laboral!</h3>
               <button class="btn" id="gotoregister">Regístrate</button>
               <button class="swiper-btn"></button>
            </div>
         </section>

         <section class="swiper-slide slide" style="background: url(images/IMG-0377.jpg) no-repeat;">
            <div class="content">
               <h3>Oficina de Intermediación Laboral y Pasantías</h3>
               <button class="btn" id="gotoregister1">Regístrate</button>
               <button class="swiper-btn"></button>
            </div>
         </section>

         <section class="swiper-slide slide" style="background: url(images/IMG_0828.jpg) no-repeat;">
            <div class="content">
               <h3>Conéctate con empresas por todo el país</h3>
               <button class="btn" id="gotoregister2">Regístrate</button>
               <button class="swiper-btn"></button>
            </div>
         </section>

      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="about" id="about">

   <div class="image">
       <img src="{{ url('images/ipisa_about.jpg') }}" alt="">
   </div>

   <div class="content">
       <h3>¿Por qué elegir IPISA?</h3>
       <p>El Instituto Politécnico Industrial de Santiago (IPISA), es una institución educativa técnico profesional con uno de los más altos niveles de expansión y crecimiento en este tipo de modelo de educación, así como también, acorde a la vanguardia de los nuevos tiempos.</p>
       <button class="btn" id="about_btn">Regístrate</button>
   </div>

</section>

<!-- perfil profesional -->

<section class="courses">

   <h1 class="heading">Conoce el perfil de nuestros talleres</h1>

   <div class="box-container">

      <div class="box">
         <div class="image">
            <img src="{{ url('images/info.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>Desarrollo y Administración de Aplicaciones Informáticas.</h3>
            <p>Descarga el perfil dándole un click al butón de abajo</p>

            <form action="{{ route('download-perfil') }}" method="get">
               <input type="hidden" name="perfil" value="inf">
               <input type="submit" class="btn" value="Descargar PDF"></input>
            </form>
          
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="{{ url('images/contabilidad.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3> Gestión Administrativa y tributaria.</h3>
            <p>Descarga el perfil dándole un click al butón de abajo</p>
            
            <form action="{{ route('download-perfil') }}" method="get">
               <input type="hidden" name="perfil" value="gat">
               <input type="submit" class="btn" value="Descargar PDF"></input>
            </form>
         </div>
      </div>

     

      
      <div class="box">
         <div class="image">
            <img src="{{ url('images/muebles.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>muebles y Estructuras de Madera</h3>
            <p>Descarga el perfil dándole un click al butón de abajo</p>
            
            <form action="{{ route('download-perfil') }}" method="get">
               <input type="hidden" name="perfil" value="muebles">
               <input type="submit" class="btn" value="Descargar PDF"></input>
            </form>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="{{ url('images/confeccion.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>confección y patronaje</h3>
            <p>Descarga el perfil dándole un click al butón de abajo</p>
            
            <form action="{{ route('download-perfil') }}" method="get">
               <input type="hidden" name="perfil" value="patronaje">
               <input type="submit" class="btn" value="Descargar PDF"></input>
            </form>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="{{ url('images/electronica.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>equipos electrónicos</h3>
            <p>Descarga el perfil dándole un click al butón de abajo</p>
            <form action="{{ route('download-perfil') }}" method="get">
               <input type="hidden" name="perfil" value="elca">
               <input type="submit" class="btn" value="Descargar PDF"></input>
            </form>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="{{ url('images/electricidad.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>instalaciones eléctricas</h3>
            <p>Descarga el perfil dándole un click al butón de abajo</p>
            
            <form action="{{ route('download-perfil') }}" method="get">
               <input type="hidden" name="perfil" value="eldad">
               <input type="submit" class="btn" value="Descargar PDF"></input>
            </form>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="{{ url('images/automotriz.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>electromecánica de vehículos</h3>
            <p>Descarga el perfil dándole un click al butón de abajo</p>
            
            <form action="{{ route('download-perfil') }}" method="get">
               <input type="hidden" name="perfil" value="auto">
               <input type="submit" class="btn" value="Descargar PDF"></input>
            </form>
         </div>
      </div>

      <div class="box">
         <div class="image">
            <img src="{{ url('images/mecanizado.jpg') }}" alt="">
         </div>
         <div class="content">
            <h3>mecanizado</h3>
            <p>Descarga el perfil dándole un click al butón de abajo</p>
            <form action="{{ route('download-perfil') }}" method="get">
               <input type="hidden" name="perfil" value="mecanizado">
               <input type="submit" class="btn" value="Descargar PDF"></input>
            </form>
         </div>
      </div>
     
   </div>

</section>

<section class="footer">

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

   <div class="credit"> OILP <span>IPISA</span> | © 2022 </div>

</section>

<!-- footer section ends -->


<!-- home section ends -->

<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="{{ asset('js/script.js') }}"></script>

<script src="{{ asset('js/slider.js') }}"></script>

<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

<script src="{{ asset('js/swiper.js') }}"></script>

@if (session()->has('success'))
   <script>
      window.onload = Swal.fire({
         title: 'Éxito!',
         text: '{{ session("success") }}',
         icon: 'success',
         confirmButtonText: 'Cool'
      })
   </script>
@endif

</body>
</html>