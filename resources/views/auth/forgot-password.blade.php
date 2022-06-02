@extends('layouts.guest')

@section('content')
   <div class="login-box">

      <!-- @include('flash::message') -->

      @foreach($errors->all() as $error)
            <p class="alert alert-danger">{{$error}}</p>
      @endforeach

      @if (session('status'))
         <p class="alert alert-success">{{ session('status') }}</p>
      @endif
      
      <!-- /.login-logo -->
      <div class="shadow px-5 py-4 bg-light rounded border-top border-primary">
      <h2 class="h2 pt-3 text-center">Artisan<span class="fw-light">CRM</span></h2>
         <div class="card-body">
            <p class="login-box-msg">Informe seu e-mail abaixo</p>
            
            <form action="{{ route('password.email') }}" method="post">
               
               @csrf

               <div class="input-group mb-3">
                  
                  <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Seu e-mail" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                  @error('email')
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
            
            <p class="text-center mt-3 mb-1">Gostaria de fazer o login? <a href="{{ route('login') }}" class="text-decoration-none">Login</a></p>
            <p class="text-center mb-0">Ainda não tem conta? <a href="{{route('register')}}" class="text-center text-decoration-none">Criar conta</a></p>

         </div>
      </div>
   </div>
@endsection