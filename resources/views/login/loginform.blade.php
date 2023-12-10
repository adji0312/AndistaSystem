<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    {{-- KUMBH SANS FONT --}}
    <link href='https://fonts.googleapis.com/css?family=Kumbh Sans' rel='stylesheet'>
    {{-- CSS STYLE --}}
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
                        <i id="hide1" class="fas fa-eye"></i>
                        <i id="hide2" class="fas fa-eye-slash"></i>
                      </span>
                      <input id="myInput" type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                      @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="mt-3 form-check d-flex justify-content-between">
                      {{-- <div>
                        <input type="checkbox" class="form-check-input" id="rememberMe" value="rememberMe" name="rememberMe">
                        <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                      </div> --}}
                      {{-- <small><strong><a href="/forget-password" class="text-dark">Lupa Password?</a></strong></small> --}}
                    </div>
                    <div class="text-center p-1">
                      <button type="submit" class="btn px-3 py-2 text-white" style="background-color: #192022;">Masuk</button>
                    </div>
                    {{-- <div class="d-flex form-floating mx-5 mt-2 justify-content-center">
                      <small class="mb-0 text-dark">Belum memiliki akun? <a href="/register" class="text-dark"><strong>Daftar</strong></a></small>
                    </div> --}}
                  </form>
                </div>
              </div>
            </form>
          </main>
        </div>
      </div>
    
      <script>
        function myFunction(){
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

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

    {{-- JS --}}
    <script src="/js/system.js" defer></script>
    <script src="/js/system.js" defer></script>
</body>
</html>