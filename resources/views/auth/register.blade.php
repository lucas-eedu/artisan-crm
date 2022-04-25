@extends('layouts.auth')

@section('content')
    <div class="min-h-screen bg-gray-100 md:flex flex-row justify-center py-10">
        <div class="px-5 sm:my-auto sm:mx-auto sm:w-2/3 lg:w-2/4 md:px-3">
          <div class="sm:mx-auto sm:w-full sm:max-w-md mb-5">
              <h2 class="pt-10 md:pt-0 text-center text-3xl font-extrabold text-gray-900">Artisan<span class="font-normal">CRM</span></h2>
              <p class="mt-2 text-center text-md text-gray-600 max-w">Registre-se para iniciar sua sessão</p>
          </div>

            @include('flash::message')

            @foreach($errors->all() as $error)
               <p class="alert alert-danger">{{$error}}</p>
            @endforeach
            
          <div class="bg-white py-8 px-5 shadow rounded-lg">
            <form class="mb-0 space-y-5" method="post" action="{{ route('register') }}" onsubmit="if(document.getElementById('agree').checked) { return true; } else { alert('Favor confirmar que leu e concorda com os Termos de Uso do serviço'); return false; }">
            @csrf
            {{-- Company --}}  
            <div>
                <label for="company_name" class="block font-medium text-gray-700">Nome da Empresa</label>
                <div class="mt-1">
                  <input type="text" id="company_name" placeholder="Nome da Empresa" name="company_name" value="{{ old('company_name') }}" required class="@error('company_name') is-invalid @enderror w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:border-sky-500" />
                  @error('company_name')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror 
               </div>
            </div>
      
              <div class="flex w-full">
                <div class="w-full mr-3">
                    <label for="password" class="mb-1 block font-medium text-gray-700">Segmento</label>
                    <select id="segment" name="segment" class="@error('segment') is-invalid @enderror w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-sky-600 focus:ring-1 focus:ring-sky-600">
                        <option value="">Selecionar</option>
                        <option value="Tech ou Software" @if ("Tech ou Software" == old('segment')) selected="selected" @endif>Tech ou Software</option>
                        <option value="Imobiliário" @if ("Imobiliário" == old('segment')) selected="selected" @endif>Imobiliário</option>
                        <option value="Educação e Ensino" @if ("Educação e Ensino" == old('segment')) selected="selected" @endif>Educação / Ensino</option>
                        <option value="Agência Criativa (web, publicidade, vídeo)" @if ("Agência Criativa (web, publicidade, vídeo)" == old('segment')) selected="selected" @endif>Agência Criativa (Web, Publicidade, Vídeo)</option>
                        <option value="Serviços financeiros ou de crédito" @if ("Serviços financeiros ou de crédito" == old('segment')) selected="selected" @endif>Serviços financeiros ou de crédito</option>
                        <option value="Notícias, imprensa e publicações" @if ("Notícias, imprensa e publicações" == old('segment')) selected="selected" @endif>Notícias, imprensa e publicações</option>
                        <option value="Fábrica ou Industria" @if ("Fábrica ou Industria" == old('segment')) selected="selected" @endif>Fábrica ou Industria</option>
                        <option value="Consultoria e Coaching" @if ("Consultoria e Coaching" == old('segment')) selected="selected" @endif>Consultoria e Coaching</option>
                        <option value="Comércio (varejo, atacado)" @if ("Comércio (varejo, atacado)" == old('segment')) selected="selected" @endif>Comércio (varejo, atacado)</option>
                        <option value="Automotivo" @if ("Automotivo" == old('segment')) selected="selected" @endif>Automotivo</option>
                        <option value="Saúde" @if ("Saúde" == old('segment')) selected="selected" @endif>Saúde</option>
                        <option value="Construção" @if ("Construção" == old('segment')) selected="selected" @endif>Construção</option>
                        <option value="Outro" @if ("Outro" == old('segment')) selected="selected" @endif>Outro</option>
                    </select>
                    @error('segment')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror    
                </div>
                <div class="w-full ml-3">
                    <label for="state" class="mb-1 block font-medium text-gray-700">Estado</label>
                    <select name="state" id="state" class="@error('state') is-invalid @enderror w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-sky-600 focus:ring-1 focus:ring-sky-600">
                    <option value="">Estado</option>
                           <option value="AC" @if ("AC" == old('state')) selected="selected" @endif>Acre</option>
                           <option value="AL" @if ("AL" == old('state')) selected="selected" @endif>Alagoas</option>
                           <option value="AP" @if ("AP" == old('state')) selected="selected" @endif>Amapá</option>
                           <option value="AM" @if ("AM" == old('state')) selected="selected" @endif>Amazonas</option>
                           <option value="BA" @if ("BA" == old('state')) selected="selected" @endif>Bahia</option>
                           <option value="CE" @if ("CE" == old('state')) selected="selected" @endif>Ceará</option>
                           <option value="DF" @if ("DF" == old('state')) selected="selected" @endif>Distrito Federal</option>
                           <option value="ES" @if ("ES" == old('state')) selected="selected" @endif>Espirito Santo</option>
                           <option value="GO" @if ("GO" == old('state')) selected="selected" @endif>Goiás</option>
                           <option value="MA" @if ("MA" == old('state')) selected="selected" @endif>Maranhão</option>
                           <option value="MS" @if ("MS" == old('state')) selected="selected" @endif>Mato Grosso do Sul</option>
                           <option value="MT" @if ("MT" == old('state')) selected="selected" @endif>Mato Grosso</option>
                           <option value="MG" @if ("MG" == old('state')) selected="selected" @endif>Minas Gerais</option>
                           <option value="PA" @if ("PA" == old('state')) selected="selected" @endif>Pará</option>
                           <option value="PB" @if ("PB" == old('state')) selected="selected" @endif>Paraíba</option>
                           <option value="PR" @if ("PR" == old('state')) selected="selected" @endif>Paraná</option>
                           <option value="PE" @if ("PE" == old('state')) selected="selected" @endif>Pernambuco</option>
                           <option value="PI" @if ("PI" == old('state')) selected="selected" @endif>Piauí</option>
                           <option value="RJ" @if ("RJ" == old('state')) selected="selected" @endif>Rio de Janeiro</option>
                           <option value="RN" @if ("RN" == old('state')) selected="selected" @endif>Rio Grande do Norte</option>
                           <option value="RS" @if ("RS" == old('state')) selected="selected" @endif>Rio Grande do Sul</option>
                           <option value="RO" @if ("RO" == old('state')) selected="selected" @endif>Rondônia</option>
                           <option value="RR" @if ("RR" == old('state')) selected="selected" @endif>Roraima</option>
                           <option value="SC" @if ("SC" == old('state')) selected="selected" @endif>Santa Catarina</option>
                           <option value="SP" @if ("SP" == old('state')) selected="selected" @endif>São Paulo</option>
                           <option value="SE" @if ("SE" == old('state')) selected="selected" @endif>Sergipe</option>
                           <option value="TO" @if ("TO" == old('state')) selected="selected" @endif>Tocantins</option>
                     </select>
                     @error('state')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                     @enderror
                </div>
              </div>

              <div class="flex w-full">
                <div class="w-full">
                     <label for="number_employees" class="mb-1 block font-medium text-gray-700 ">Tamanho da Empresa</label>
                     <select name="number_employees" id="number_employees" class="@error('number_employees') is-invalid @enderror w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:border-sky-600 focus:ring-1 focus:ring-sky-600">
                        <option value="">Selecionar</option>
                        <option value="1" @if ("1" == old('number_employees')) selected="selected" @endif>1 Funcionário</option>
                        <option value="2-10" @if ("2-10" == old('number_employees')) selected="selected" @endif>2-10 Funcionários</option>
                        <option value="11-50" @if ("11-50" == old('number_employees')) selected="selected" @endif>11-50 Funcionários</option>
                        <option value="51-100" @if ("51-100" == old('number_employees')) selected="selected" @endif>51-100 Funcionários</option>
                        <option value="101+" @if ("101+" == old('number_employees')) selected="selected" @endif>101+ Funcionários</option>
                     </select>   
                     @error('number_employees')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror 
                </div>
              </div>

              {{-- User --}}
              <div>
                <label for="name" class="block font-medium text-gray-700">Seu nome</label>
                <div class="mt-1">
                  <input id="name" placeholder="Seu nome" name="name" value="{{ old('name') }}" type="text" required class="@error('name') is-invalid @enderror w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:border-sky-500" />
                  @error('name')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror 
               </div>
              </div>

              <div>
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <div class="mt-1">
                  <input type="email" placeholder="Email" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}" required class="@error('email') is-invalid @enderror w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:border-sky-500" />
                  @error('email')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror 
               </div>
              </div>

              <div>
                <label for="password" class="block font-medium text-gray-700">Senha</label>
                <div class="mt-1">
                  <input type="password"  name="password" autocomplete="current-password" id="user-password" placeholder="Informe a senha" required class="@error('password') is-invalid @enderror w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:border-sky-500" />
                  @error('password')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror 
               </div>
              </div>

              
              <div>
                <label for="password_confirmation" class="block font-medium text-gray-700">Repita sua senha</label>
                <div class="mt-1">
                  <input name="password_confirmation"  autocomplete="new-password" id="password-confirm" placeholder="Repita a senha" type="password" required class="@error('password') is-invalid @enderror w-full border border-gray-300 px-3 py-2 rounded-lg shadow-sm focus:outline-none focus:ring-1 focus:border-sky-500" />
                  @error('password_confirmation')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror 
               </div>
              </div>
      
      
              <div class="flex items-center">
                <input class="cursor-pointer"  type="checkbox" name="agree" id="agree" {{ old('agree') ? 'checked' : '' }}/>
                <label for="agree" class="ml-2 block text-md font-medium text-gray-900"
                  >Concordo com os 
                  <a class="font-medium text-sky-600 hover:text-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500 cursor-pointer">Termos de uso</a>
                </label>
              </div>
      
              <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-sky-600 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">Criar conta</button>
              </div>
            </form>
            @if (Route::has('password.request'))
            <p class="mt-5 text-center text-sm text-gray-600 max-w">
                Esqueceu sua senha?
                <a href="{{ route('password.request') }}" class="font-medium text-sky-600 hover:text-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500">Recuperar senha</a>
            </p>
            @endif
            <p class="mt-1 text-center text-sm text-gray-600 max-w">
                Já possui uma conta?
                <a href="{{route('login')}}" class="font-medium text-sky-600 hover:text-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500">Login</a>
              </p>
          </div>
        </div>
      </div>
@endsection