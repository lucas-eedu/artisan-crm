@extends('layouts.auth')

@section('content')
<div class="min-h-screen bg-gray-100 md:flex flex-row justify-center">
   <div class="hidden md:block sm:mx-auto sm:w-full bg-login-image bg-no-repeat bg-cover"></div>
   <div class="px-5 sm:my-auto sm:mx-auto sm:w-full md:px-3">

      <!-- @include('flash::message') -->

      @foreach($errors->all() as $error)
            <p class="alert alert-danger rounded-lg">{{$error}}</p>
      @endforeach

      @if (session('status'))
         <p class="alert alert-success rounded-lg">{{ session('status') }}</p>
      @endif
      
      <!-- /.login-logo -->
      
      <div class="sm:mx-auto sm:w-full sm:max-w-md mb-5">
         <h2 class="pt-10 md:pt-0 text-center text-3xl font-extrabold text-gray-900">Artisan<span class="font-normal">CRM</span></h2>
         <p class="mt-2 text-center text-md text-gray-600 max-w">Informe seu e-mail abaixo:</p>
      </div>
         
      <div class="bg-white py-8 px-5 sm:px-10 sm:mx-5 shadow rounded-lg" style="border-top: 5px solid #0284c7;">
            <form action="{{ route('password.email') }}" method="post" class="mb-0 space-y-5">
               
               @csrf
                  <div>
                     <label for="email" class="block font-medium text-gray-700 mb-2">Email:</label>
                     <input type="email" class="form-control @error('email') is-invalid @enderror w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:border-sky-500"" id="email" placeholder="Seu e-mail" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                  </div>
                     @error('email')
                  <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                  </span>
                  @enderror
               
                  <div>
                     <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-sky-600 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">Redefinir Senha</button>
                  </div>
      </div>
            </form>
            
            <p class="mt-5 text-center text-sm text-gray-600 max-w">
               Gostaria de fazer o login?
               <a href="{{ route('login') }}" class="font-medium text-sky-600 hover:text-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500">Login</a>
            </p>

            <p class="mt-2 text-center text-sm text-gray-600 max-w">
               Ainda não tem uma conta?
               <a href="{{route('register')}}" class="font-medium text-sky-600 hover:text-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500">Criar
               conta</a>
            </p>

       


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