@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Empresas</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- swiper css link  -->
   <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <!-- Favicon link -->
  <link rel="icon" href="{{ url('favicon.ico') }}" >

   <!-- custom css file link  -->
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

</head>
<body>

<!-- header section starts  -->

<!-- header section starts  -->
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
      <a href="{{ route('stats') }}">Estadisticas</a>
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
      <span class="btn register-btn">Registráte</span>
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

<div class="container">
    <div class="title">Registro de empresas</div>
    <div class="content">
      <form action="{{ route('business.store') }}" method="POST">
          @csrf
        <div class="user-details">
          <div class="input-box">
            <span class="details">Nombre de la Empresa</span>
            <input type="text" placeholder="Ingresa el nombre de la empresa" required name="name">
          </div>
          <div class="input-box">
            <span class="details">RNC</span>
            <input type="number" placeholder="Ingresa tu RNC" oninput="validity.valid||(value='');" required name="RNC">
          </div>
          <div class="input-box">
            <span class="details">¿Desea que se conozca la identidad de la empresa?</span>
            <select class="form-control" required name="wantsAnonimity">
                <option selected>----Selecciona----</option>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">¿Tiene departamento de formación?</span>
            <select class="form-control" required name="hasFormationDepartment">
                <option selected>----Selecciona----</option>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Actividad económica de la empresa</span>
            <textarea rows="3" cols="40" required name="economicalActivity"></textarea>
          </div>
          <div class="input-box">
            <span class="details">Industria</span>
            <input type="text" placeholder="Ingresa la industria" class="form-control" required name="industry">
          </div>
          <div class="input-box">
            <span class="details">Dirección</span>
            <input type="text" placeholder="Ingresa tu dirección" required name="direction">
          </div>
          <div class="input-box">
            <span class="details">Sector</span>
            <input type="text" placeholder="Ingresa el sector" required name="sector">
          </div>
          <div class="input-box">
            <span class="details">Municipio</span>
            <input type="text" placeholder="Ingresa el municipio" name="municipality">
          </div>
          <div class="input-box">
            <span class="details">Provincia</span>
            <input type="text" placeholder="Ingresa la provincia" required name="province">
          </div>
          <div class="input-box">
            <span class="details">Tamaño de la Empresa</span>
            <select class="form-control" name="enterpriseSize">
                <option selected>----Selecciona----</option>
                <option>Micro</option>
                <option>Pequeña</option>
                <option>Mediana</option>
                <option>Grande</option>
            </select>
          </div>
          <div class="input-box">
            <span class="details">Sección</span>
            <input type="text" placeholder="Ingresa la sección" name="section">
          </div>
          <div class="input-box">
            <span class="details">País donde opera la empresa</span>
            <input type="text" placeholder="Ingresa país de operación" class="form-control" name="countryArea">
          </div>
          <div class="input-box">
            <span class="details">Teléfono principal</span>
            <input type="tel" placeholder="Ingresa tu teléfono principal" required name="mainCellphone">
          </div>
          <div class="input-box">
            <span class="details">Teléfono directo</span>
            <input type="tel" placeholder="Ingresa tu teléfono directo" required name="directPhone">
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Ingresa tu email" required name="email">
          </div>
          <div class="input-box">
            <span class="details">Contraseña</span>
            <input type="password" placeholder="Ingresa tu contraseña" required name="password">
          </div>
          <div class="input-box">
            <span class="details">Nombre del contacto</span>
            <input type="text" placeholder="Ingresa el nombre de contacto" name="contactName">
          </div>
          <div class="input-box">
            <span class="details">Correo del contacto</span>
            <input type="text" placeholder="Ingresa el correo de contacto" name="contactEmail">
          </div>
          <div class="input-box">
            <span class="details">Teléfono del contacto</span>
            <input type="number" placeholder="Ingresa el teléfono de contacto" name="contactNumber">
          </div>
        </div>
        
        <div class="button">
          <input type="submit" id="register" value="Registrar">
        </div>
      </form>
    </div>
  </div>

<!-- home section ends -->

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

   <div class="credit"> OILP <span>IPISA</span> | © 2021 </div>

</section>

<!-- footer section ends -->



<!-- swiper js link  -->
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="{{ asset('js/script.js') }}"></script>

<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

</body>
</html>