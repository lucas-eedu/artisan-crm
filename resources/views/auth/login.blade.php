@extends('layouts.auth')

@section('content')
<div class="container-fluid">
   <div class="row align-items-center" style="height: 100vh;">
      <div class="col-md-6" style="background: url('{{ asset('artisancrmv1/assets/images/auth/bg-auth.jpg') }}'); height: 100vh"></div>
      <div class="col-md-6 px-5">

      @include('flash::message')

      @foreach($errors->all() as $error)
         <p class="alert alert-danger">{{$error}}</p>
      @endforeach

      <div class="bg-white pb-3 pt-5 px-5 shadow-lg rounded border-top border-primary">
      <div class="mb-5">
         <h2 class="h2 text-center">Artisan<span class="fw-light">CRM</span></h2>
         <p class="text-center text-muted">Faça login para iniciar sua sessão:</p>
      </div>
         <form class="" action="{{ route('login') }}" method="post">

            @csrf

            <div>
               
               <div class="">
                  <input id="email" name="email" type="email" autocomplete="email" placeholder="Email" required class="form-control" />
               </div>
            </div>
            
            <div>
               <div class="d-flex justify-content-between mt-3">
                  

               </div>
               <div class="">
                  <input id="password" name="password" type="password" placeholder="Senha" autocomplete="current-password" required class="form-control" />
               </div>
            </div>


            <div class="icheck-primary mt-3 mb-3">
               <input name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox" class="" />
               <label for="remember" class="">Lembre-se de mim
               </label>
            </div>

            
            <button type="submit" class="btn btn-primary btn-md btn-block" style="width: -moz-available; width: -webkit-fill-available">Entrar</button>
            
         </form>
         <div class="text-center pb-4">
            <p class="mt-3 my-0">
               Ainda não tem uma conta?
               <a href="{{route('register')}}" class="text-decoration-none">Criar conta</a>
            </p>
         
            @if (Route::has('password.request'))
               <a href="{{ route('password.request') }}" class="text-decoration-none text-center">Esqueceu sua senha?</a>
            @endif
         </div>
      </div>
   </div>
   </div>
</div>

<!-- Personalizações -->
<script>
   tailwind.config = {
      theme: {
         backgroundImage: {
            'login-image': "url({{ asset('artisancrmv1/assets/images/auth/bg-auth.jpg') }})",
         }
      }
   }
</script>
@endsection