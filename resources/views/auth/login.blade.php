@extends('layouts.auth')

@section('content')
<div class="min-h-screen bg-gray-100 md:flex flex-row justify-center">
   <div class="hidden md:block sm:mx-auto sm:w-full bg-login-image bg-no-repeat bg-cover"></div>
   <div class="px-5 sm:my-auto sm:mx-auto sm:w-full md:px-3">

      @include('flash::message')

      @foreach($errors->all() as $error)
         <p class="alert alert-danger">{{$error}}</p>
      @endforeach

      <div class="sm:mx-auto sm:w-full sm:max-w-md mb-5">
         <h2 class="pt-10 md:pt-0 text-center text-3xl font-extrabold text-gray-900">Artisan<span class="font-normal">CRM</span></h2>
         <p class="mt-2 text-center text-md text-gray-600 max-w">Faça login para iniciar sua sessão:</p>
      </div>

      <div class="bg-white py-8 px-5 sm:px-10 sm:mx-5 shadow rounded-lg" style="border-top: 5px solid #0284c7;">
         <form class="mb-0 space-y-5" action="{{ route('login') }}" method="post">

            @csrf

            <div>
               <label for="email" class="block font-medium text-gray-700">Email:</label>
               <div class="mt-1">
                  <input id="email" name="email" type="email" autocomplete="email" placeholder="Email" required class="w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:border-sky-500" />
               </div>
            </div>
            
            <div>
               <div class="flex justify-between items-center">
                  <label for="password" class="block font-medium text-gray-700">Senha</label>
                  @if (Route::has('password.request'))
                  <a href="{{ route('password.request') }}" class="font-medium text-sm text-sky-600 hover:text-sky-500">Esqueceu sua
                     senha?</a>
                  @endif
               </div>
               <div class="mt-1">
                  <input id="password" name="password" type="password" placeholder="********" autocomplete="current-password" required class="w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:border-sky-500" />
               </div>
            </div>


            <div class="flex items-center">
               <input name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} type="checkbox" class="" />
               <label for="remember" class="ml-2 block text-sm text-gray-900">Lembre-se de mim
               </label>
            </div>

            <div>
               <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-sky-600 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">Entrar</button>
            </div>
         </form>
         <p class="mt-5 text-center text-sm text-gray-600 max-w">
            Ainda não tem uma conta?
            <a href="{{route('register')}}" class="font-medium text-sky-600 hover:text-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500">Criar
               conta</a>
         </p>
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