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
            <p class="login-box-msg">Faça login para iniciar sua sessão</p>
            
            <form action="{{ route('login') }}" method="post">
               
               @csrf

               <div class="input-group mb-3">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                     </div>
                  </div>
               </div>

               <div class="input-group mb-3">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" id="user-password" placeholder="Informe a senha">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                     </div>
                  </div>
               </div>
               
               <div class="row">
                  <div class="col-8">
                     <div class="icheck-primary">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">Lembre-se de mim</label>
                     </div>
                  </div>
                  <div class="col-4">
                     <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                  </div>
               </div>

            </form>

            {{-- <div class="social-auth-links text-center mt-2 mb-3">
               <a href="#" class="btn btn-block btn-primary"><i class="fab fa-facebook mr-2"></i> Entre usando o Facebook</a>
               <a href="#" class="btn btn-block btn-danger"><i class="fab fa-google-plus mr-2"></i> Entre usando o Google+&nbsp;&nbsp;&nbsp;</a>
            </div> --}}

            <!-- /.social-auth-links -->
            @if (Route::has('password.request'))
               <p class="mb-1"><a href="{{ route('password.request') }}">Esqueci minha senha</a></p>
            @endif
            <p class="mb-0"><a href="{{route('register')}}" class="text-center">Criar conta</a></p>

         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>
@endsection