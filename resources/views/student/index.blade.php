@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudiantes</title>

    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />

    <!-- Favicon link -->
   <link rel="icon" href="{{ url('favicon.ico') }}" >
   
    <!-- custom css file link  -->
   <link rel="stylesheet" href="{{ asset('css/offer.css') }}">
   <link rel="stylesheet" href="{{ asset('css/style.css') }}">

   <style>
       ul {
  padding-left: 2rem;
}


ul {
  margin-top: 0;
  margin-bottom: 1rem;
}

.pagination li{
  font-size: 16px;
}


ul ul {
  margin-bottom: 0;
}

b {
  font-weight: bolder;
}

.pagination {
  display: flex;
  padding-left: 0;
  list-style: none;
  margin-top: 10px;
}

.page-link {
  position: relative;
  display: block;
  color: #0d6efd;
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #dee2e6;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
@media (prefers-reduced-motion: reduce) {
  .page-link {
    transition: none;
  }
}
.page-link:hover {
  z-index: 2;
  color: #0a58ca;
  background-color: #e9ecef;
  border-color: #dee2e6;
}
.page-link:focus {
  z-index: 3;
  color: #0a58ca;
  background-color: #e9ecef;
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.page-item:not(:first-child) .page-link {
  margin-left: -1px;
}
.page-item.active .page-link {
  z-index: 3;
  color: #fff;
  background-color: #0d6efd;
  border-color: #0d6efd;
}
.page-item.disabled .page-link {
  color: #6c757d;
  pointer-events: none;
  background-color: #fff;
  border-color: #dee2e6;
}

.page-link {
  padding: 6px 12px;
}

.page-item:first-child .page-link {
  border-top-left-radius: 4px;
  border-bottom-left-radius: 4px;
}
.page-item:last-child .page-link {
  border-top-right-radius: 4px;
  border-bottom-right-radius: 4px;
}

.justify-content-end {
  justify-content: flex-end !important;
}

  .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 16px;
    }  

.clearfix::after {
  display: block;
  clear: both;
  content: "";
}
   </style>
</head>
<body>
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

    <div class="container">
        <div class="row my-5">
          <div class="col-lg-12">
            <div class="card shadow">
              <div class="card-header bg-blue d-flex justify-content-between align-items-center">
                <h3 class="text-light"><?php if($userRole == 3){ echo "Manejar";}  ?> Estudiantes y Egresados</h3>
                <a href="@if ($userRole == 2) {{ route('offer.create') }} @endif" class="btn btn-light" style="visibility: hidden;"><i class="bi-plus-circle me-2"></i>Añadir Nueva Vacante</a>   
              </div>
              <div class="card-body" id="show_all_employees">
                <div style="overflow-x: auto;">
                    <table class="table table-striped table-sm text-center align-middle" id="data-table" >
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Cédula</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Género</th>
                            <th>Dirección</th>
                            <th>Municipio</th>
                            <th>Provincia</th>
                            <th>Nacionalidad</th>
                            <th>Teléfono Residencial</th>
                            <th>Teléfono Célular</th>
                            <th>¿Tiene licencia de conducir?</th>
                            <th>¿Tiene vehículo propio?</th>
                            <th>Año de graduación</th>
                            <th>Centro Académico</th>
                            <th>Grado</th>
                            <th>Matrícula</th>
                            <th>Carrera Técnica</th>
                            <th>Años de Experiencia</th>
                            <th>Área Laboral de Interés</th>
                            <th>CV</th>
                            <th>ID de Vacante Asignada</th>
                            @if($userRole == 3)
                                <th>Acciones</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->surname }}</td>
                                    <td>{{ $student->identification }}</td>
                                    <td>{{ $student->birthday }}</td>
                                    <td>{{ $student->sex }}</td>
                                    <td>{{ $student->direction }}</td>
                                    <td>{{ $student->municipality }}</td>
                                    <td>{{ $student->province }}</td>
                                    <td><?php if($student->nationality){
                                            echo "Extranjero";
                                        }else{
                                            echo "Dominicano";
                                        } ?></td>
                                    <td>{{ $student->homeNumber }}</td>
                                    <td>{{ $student->cellphone }}</td>
                                    <td>
                                        <?php if($student->hasDrivingLicense){
                                            echo "Sí";
                                        }else{
                                            echo "No";
                                        } ?>
                                    </td>
                                    <td>
                                        <?php if($student->hasVehicle){
                                            echo "Sí";
                                        }else{
                                            echo "No";
                                        } ?>
                                    </td>
                                    <td>{{ $student->graduationYear }}</td>
                                    <td>{{ $student->school }}</td>
                                    <td>{{ $student->grade }}</td>
                                    <td>{{ $student->enrollmentID }}</td>
                                    <td>{{ $student->career }}</td>
                                    <td>{{ $student->experience }}</td>
                                    <td>{{ $student->workArea }}</td>
                                    <td>
                                        <form action="{{ route('download', $student->cv_path) }}" method="get">
                                            <input type="hidden" name="cv_path" value="{{ $student->cv_path }}">
                                            <button type="submit" id="deleteIcon" style="background:none;" class="text-danger mx-1 deleteIcon">Descargar</button>
                                        </form>
                                    </td>
                                    <td>{{ $student->offer_id }}</td>
                                    @if($userRole == 3)
                                        <td>
                                            
                                            <form action="{{ route('student.destroy', $student->id) }}" method="post">
                                              @csrf
                                              @method('DELETE')
                                                <button type="submit" id="deleteIcon" style="background:none;" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></button>
                                            </form>
                                        
                                        </td>
                                    @endif                                        
                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{$students->links()}}

            </div>
            </div>
          </div>
        </div>
      </div>

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


@if (session()->has('success'))
    <script>
        window.onload = Swal.fire({
            title: 'Éxito!',
            text: '{{ $offers }}',
            icon: 'success',
            confirmButtonText: 'Cool'
        })
    </script>
@endif

</body>
</html>