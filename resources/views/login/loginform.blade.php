{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Kumbh Sans' rel='stylesheet'>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
    <title>Andista Login</title>
</head>
<body>
    <div class="row justify-content-center">
        <div class="col-lg-5">
          @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
    
          @if(session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
              {{ session('loginError') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
    
          <main class="form-signin w-100 m-auto mt-5">
            <div class="text-center">
              <img class="mb-4 loginLogo" src="/images/logoLF.png" alt="" width="200">
            </div>
            <form action="/login-process" method="post" class="d-flex justify-content-center formLogin">
              @csrf
              <div class="card" style="width: 25rem; background-color: #ff9624;">
                <div class="card-body">
                  <h4 class="card-title text-center">LOGIN</h4>
                  <form>
                    <div class="mb-1">
                      <label for="username" class="form-label"><strong>Email</strong></label>
                      <input type="email" class="form-control @error('username') is-invalid @enderror" id="email" name="email" value="{{ old('username') }}"> 
                      @error('username')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror 
                    </div>
                    <div class="mb-2">
                      <label for="password" class="form-label"><strong>Password</strong></label>
                      <span class="eye d-flex float-end position-absolute end-0 mx-4 align-items-center mt-2" onclick="myFunction()">
                        <i id="hide1" class="fas fa-eye" style="display: hidden;"></i>
                        <i id="hide2" class="fas fa-eye-slash"></i>
                      </span>
                      <input id="myInput" type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                      @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="text-center p-1">
                      <button type="submit" class="btn px-3 py-2 text-white" style="background-color: #192022;">Masuk</button>
                    </div>
                  </form>
                </div>
              </div>
            </form>
          </main>
        </div>
      </div>
    
      <script>
        function myFunction(){
          console.log('alskdhjasd');
          var x = document.getElementById("myInput");
          var y = document.getElementById("hide1");
          var z = document.getElementById("hide2");
    
          if(x.type === 'password'){
            x.type = "text";
            y.style.display = "block";
            z.style.display = "none";
          }else{
            x.type = "password";
            y.style.display = "none";
            z.style.display = "block";
          }
        }
      </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    <script src="/js/system.js" defer></script>
    <script src="/js/system.js" defer></script>
</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Login Andista System</title>

      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

      {{-- KUMBH SANS FONT --}}
      <link href='https://fonts.googleapis.com/css?family=Kumbh Sans' rel='stylesheet'>

      {{-- CSS STYLE --}}
      <link rel="stylesheet" href="/css/sign-in.css">

      <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.0/dist/trix.css">
      <script type="text/javascript" src="https://unpkg.com/trix@2.0.0/dist/trix.umd.min.js"></script>
      <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js'></script>

      <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }

        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }

        .b-example-divider {
          width: 100%;
          height: 3rem;
          background-color: rgba(0, 0, 0, .1);
          border: solid rgba(0, 0, 0, .15);
          border-width: 1px 0;
          box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
          flex-shrink: 0;
          width: 1.5rem;
          height: 100vh;
        }

        .bi {
          vertical-align: -.125em;
          fill: currentColor;
        }

        .nav-scroller {
          position: relative;
          z-index: 2;
          height: 2.75rem;
          overflow-y: hidden;
        }

        .nav-scroller .nav {
          display: flex;
          flex-wrap: nowrap;
          padding-bottom: 1rem;
          margin-top: -1px;
          overflow-x: auto;
          text-align: center;
          white-space: nowrap;
          -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
          --bd-violet-bg: #712cf9;
          --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

          --bs-btn-font-weight: 600;
          --bs-btn-color: var(--bs-white);
          --bs-btn-bg: var(--bd-violet-bg);
          --bs-btn-border-color: var(--bd-violet-bg);
          --bs-btn-hover-color: var(--bs-white);
          --bs-btn-hover-bg: #6528e0;
          --bs-btn-hover-border-color: #6528e0;
          --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
          --bs-btn-active-color: var(--bs-btn-hover-color);
          --bs-btn-active-bg: #5a23c8;
          --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
          z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
          display: block !important;
        }
      </style>
      
      
  </head>
  <body class="d-flex align-items-center py-4 bg-body-tertiary">    
    

    <main class="form-signin w-100 m-auto">
      <form action="/login-process" method="post">
        @csrf
        <img class="mb-4" src="{{ asset('./img/icon/logoAndista.png') }}" alt="" width="72" height="72">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        @if(session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
          </div>
        @endif
      
        @if(session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ session('loginError') }}
          </div>
        @endif
        <div class="form-floating">
          <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" name="email">
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" name="password">
          <label for="floatingPassword">Password</label>
        </div>
        
        <button class="btn btn-primary w-100 py-2 mt-3" type="submit">Sign in</button>
      </form>
    </main>
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
