@extends('layouts.guest')

@section('content')
    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-button>
                            {{ __('Resend Verification Email') }}
                        </x-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </x-auth-card>
    </x-guest-layout>

   <div class="login-box">
   
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
         <div class="card-header text-center">
            <a href="#" class="h1"><b>Artisan</b>CRM</a>
         </div>
         <div class="card-body">
            <p class="login-box-msg">Precisamos que você verifique seu endereço de e-mail clicando no link que acabamos de enviar para você.</p>
            <p class="login-box-msg">Se você não recebeu o e-mail, teremos o prazer de lhe enviar outro.</p>

            @if (session('status') == 'verification-link-sent')
               <p class="login-box-msg">Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o registro.</p>
            @endif
            
            <form method="POST" action="{{ route('verification.send') }}">
               
               @csrf

               <div class="row">
                  <div class="col-12">
                     <button type="submit" class="btn btn-primary btn-block">Reenviar email de verificação</button>
                  </div>
               </div>
            </form>

            <p class="mt-3 mb-1">Gostaria de cancelar a verificação? <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Clique aqui</a></p>

            <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
               @csrf
            </form>

         </div>
      </div>
