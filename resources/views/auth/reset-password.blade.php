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
            <p class="login-box-msg">Redefinir Senha</p>
            
            <form action="{{ route('password.update') }}" method="post">
               
               @csrf

               <!-- Password Reset Token -->
               <input type="hidden" name="token" value="{{ $request->route('token') }}">

               <div class="input-group mb-3">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Seu e-mail" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
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
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Nova senha" name="password" autocomplete="new-password">
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                     </div>
                  </div>
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               </div>

               <div class="input-group mb-3">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" id="password_confirmation" placeholder="Nova senha" name="password_confirmation" autocomplete="new-password" placeholder="Confirme sua senha" >
                  <div class="input-group-append">
                     <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
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
                     <button type="submit" class="btn btn-primary btn-block">Redefinir senha</button>
                  </div>
               </div>

            </form>
            
            <p class="mt-3 mb-1">Gostaria de fazer o login? <a href="{{ route('login') }}">Login</a></p>

         </div>
      </div>
   </div>
@endsection