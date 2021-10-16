@extends('layouts.guest')

@section('content')
   <div class="login-box">

      @include('flash::message')

      @foreach($errors->all() as $error)
            <p class="alert alert-danger">{{$error}}</p>
      @endforeach
      
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
         <div class="card-header text-center">
            <a href="#" class="h1"><b>Artisan</b>CRM</a>
         </div>
         <div class="card-body">
            <p class="login-box-msg">Registre-se para iniciar sua sessão</p>
            
            <form method="post" class="form-horizontal" action="{{ route('register') }}" onsubmit="if(document.getElementById('agree').checked) { return true; } else { alert('Favor confirmar que leu e concorda com os Termos de Uso do serviço'); return false; }">
               
               @csrf


               <div class="input-group mb-3">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Seu nome" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                     </div>
                  </div>
                  @error('name')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>

               <div class="input-group mb-3">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                     </div>
                  </div>
                  @error('email')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>

               <div class="input-group mb-3">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" id="user-password" placeholder="Informe a senha">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
                  @error('password')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>

               <div class="input-group mb-3">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" id="password-confirm" placeholder="Repita a senha" >
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
                  @error('password_confirmation')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               
               <div class="row">
                  <div class="col-12">
                     <div class="icheck-primary">
                        <input type="checkbox" name="agree" id="agree" {{ old('agree') ? 'checked' : '' }}>
                        <label for="agree">Concordo com os <a href="#" target="_blank">Termos de Uso</a></label>
                     </div>
                  </div>
                  <div class="col-12">
                     <button type="submit" class="btn btn-primary btn-block mt-3">Registre-se</button>
                  </div>
               </div>

            </form>

            {{-- <div class="social-auth-links text-center mt-2 mb-3">
               <a href="#" class="btn btn-block btn-primary"><i class="fab fa-facebook mr-2"></i> Registre-se usando o Facebook</a>
               <a href="#" class="btn btn-block btn-danger"><i class="fab fa-google-plus mr-2"></i> Registre-se usando o Google+&nbsp;&nbsp;&nbsp;</a>
            </div> --}}

            <!-- /.social-auth-links -->
            @if (Route::has('password.request'))
               <p class="mb-1 mt-3"><a href="{{ route('password.request') }}">Esqueci minha senha</a></p>
            @endif
            <p class="mb-0">Já possui uma conta? <a href="{{route('login')}}" class="text-center">Login</a></p>

         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
@endsection