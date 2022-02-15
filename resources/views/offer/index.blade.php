@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacantes</title>

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

.d-flex label{
        margin-right: 10px;
        font-size:16px;
        padding-top: 2.5px;
}
.form-control {
    display: block;
    width: 100%;
    padding: 6px 12px;
    font-size: 16px;
    font-weight: 400;
    line-height: 1.5;
    color: #212529;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: 4px;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
  color: #212529;
  background-color: #fff;
  border-color: #86b7fe;
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.form-control::placeholder {
  color: #6c757d;
  opacity: 1;
  font-size: 16px;
}

.form-control-sm {
  min-height: calc(1.5em + (0.5rem + 2px));
  padding: 4px 8px;
  font-size: 16px;
  border-radius: 3.2px;
  width: 200px;
  height: 2px;
}

.d-flex {
  display: flex !important;
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
                <h3 class="text-light">@auth <?php if($userRole == 3){ echo "Manejar";}  ?> @endauth Vacantes</h3>
                <a href="@auth @if ($userRole == 2) {{ route('offer.create') }} @endif @endauth" class="btn btn-light" ><i class="bi-plus-circle me-2"></i>Añadir Nueva Vacante</a>   
              </div>
              <div class="card-body" id="show_all_employees">
              <div class="d-flex justify-content-end">
                <label>Buscar:</label>
                <form action="{{ route('web.search') }}" method="get">
                <input type="search" list="empresas" class="form-control form-control-sm" placeholder="" name="query">
               <datalist id="empresas">
               @foreach ($offers as $offer)
                <option value="{{ $offer->status }}">
                @endforeach
                </form>
              </datalist>
            </div>
                <div style="overflow-x: auto;">
                    <table class="table table-striped table-sm text-center align-middle" id="data-table" >
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de la Empresa</th>
                            <th>Nombre del Puesto</th>
                            <th>Perfil del puesto</th>
                            <th>Sueldo</th>
                            <th>Ubicación</th>
                            <th>Tipo de contrato</th>
                            <th>Horario</th>
                            @auth
                              @if ($userRole == 3)
                              <th>E-mail Curriculum</th>
                              <th>Persona de Contacto</th>
                              <th>Teléfono</th>
                              @endif
                            @endauth
                            <th>Estado</th>
                            @auth
                              @if($userRole == 3)
                                  <th>Acciones</th>
                              @endif
                            @endauth

                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td>{{ $offer->id }}</td>
                                    <td><?php 
                                        $business = $businesses->find($offer->business_id); 

                                        if(!empty($business->id)){
                                            echo $business->name;
                                        }
                                        
                                    ?></td>
                                    <td>{{ $offer->name }}</td>
                                    <td>{{ $offer->description }}</td>
                                    <td>{{ $offer->salary }}</td>
                                    <td>{{ $offer->location }}</td>
                                    <td><?php 
                                        if($offer->contractType == 0){
                                            echo "Temporal";
                                        } else{
                                            echo "Indefinido";
                                        }
                                    ?></td>
                                    <td>{{ $offer->schedule }}</td>
                                    @auth
                                      @if ($userRole == 3)
                                      <td>{{ $offer->contactMail }}</td>
                                      <td>{{ $offer->contactName }}</td>
                                      <td>{{ $offer->contactNumber }}</td>
                                      @endif
                                    @endauth

                                    <td><?php if($offer->status == 0){
                                        echo "<p style='color: #FF922B;'><i class='fas fa-exclamation-triangle'></i><b>Pendiente</b></p>";
                                    }else{
                                        echo "<p style='color: red;'><i class='fas fa-window-close'></i><b>ASIGNADA</b></p>";
                                    } ?></td>
                                  @auth
                                    @if($userRole == 3)
                                        <td>
                                            <a href="{{ route('offer.edit', $offer->id) }}" id="" class="text-success mx-1 editIcon"><i class="bi-pencil-square h4"></i></a>
                                            
                                            <form action="{{ route('offer.destroy', $offer->id) }}" method="post">
                                                @csrf    
                                                @method('DELETE')
                                                <button type="submit" id="deleteIcon" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></button>
                                            </form>
                                        
                                        </td>
                                    @endif                                        
                                  @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                {{$offers->links()}}
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