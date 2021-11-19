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
               {{-- Company --}}
               <div class="form-group mb-3">
                  <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" placeholder="Nome da Empresa" name="company_name" value="{{ old('company_name') }}">
                  @error('company_name')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="form-group mb-3">
                  <div class="row">
                     <div class="col-md-6">
                        <select id="segment" class="select2 form-control @error('segment') is-invalid @enderror" name="segment">
                           <option value="">Segmento</option>
                           <option value="Tech ou Software">Tech ou Software</option>
                           <option value="Imobiliário">Imobiliário</option>
                           <option value="Educação e Ensino">Educação e Ensino</option>
                           <option value="Agência Criativa (web, publicidade, vídeo)">Agência Criativa (web, publicidade, vídeo)</option>
                           <option value="Serviços financeiros ou de crédito">Serviços financeiros ou de crédito</option>
                           <option value="Notícias, imprensa e publicações">Notícias, imprensa e publicações</option>
                           <option value="Fábrica ou Industria">Fábrica ou Industria</option>
                           <option value="Consultoria e Coaching">Consultoria e Coaching</option>
                           <option value="Comércio (varejo, atacado)">Comércio (varejo, atacado)</option>
                           <option value="Automotivo">Automotivo</option>
                           <option value="Saúde">Saúde</option>
                           <option value="Construção">Construção</option>
                           <option value="Outro">Outro</option>
                        </select>
                        @error('segment')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror   
                     </div>
                     <div class="col-md-6">
                        <select id="state" class="select2 form-control @error('state') is-invalid @enderror" name="state">
                           <option value="">Estado</option>
                           <option value="AC">Acre</option>
                           <option value="AL">Alagoas</option>
                           <option value="AP">Amapá</option>
                           <option value="AM">Amazonas</option>
                           <option value="BA">Bahia</option>
                           <option value="CE">Ceará</option>
                           <option value="DF">Distrito Federal</option>
                           <option value="ES">Espirito Santo</option>
                           <option value="GO">Goiás</option>
                           <option value="MA">Maranhão</option>
                           <option value="MS">Mato Grosso do Sul</option>
                           <option value="MT">Mato Grosso</option>
                           <option value="MG">Minas Gerais</option>
                           <option value="PA">Pará</option>
                           <option value="PB">Paraíba</option>
                           <option value="PR">Paraná</option>
                           <option value="PE">Pernambuco</option>
                           <option value="PI">Piauí</option>
                           <option value="RJ">Rio de Janeiro</option>
                           <option value="RN">Rio Grande do Norte</option>
                           <option value="RS">Rio Grande do Sul</option>
                           <option value="RO">Rondônia</option>
                           <option value="RR">Roraima</option>
                           <option value="SC">Santa Catarina</option>
                           <option value="SP">São Paulo</option>
                           <option value="SE">Sergipe</option>
                           <option value="TO">Tocantins</option>
                        </select>
                        @error('state')
                           <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                  </div>
               </div>
               <div class="form-group mb-3">
                  <select id="number_employees" class="select2 form-control @error('number_employees') is-invalid @enderror" name="number_employees">
                     <option value="">Qual o tamanho da empresa?</option>
                     <option value="1">1 Funcionário</option>
                     <option value="2-10">2-10 Funcionários</option>
                     <option value="11-50">11-50 Funcionários</option>
                     <option value="51-100">51-100 Funcionários</option>
                     <option value="101+">101+ Funcionários</option>
                  </select>
                  @error('number_employees')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               {{-- User --}}
               <div class="form-group mb-3">
                  <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Seu nome" name="name" value="{{ old('name') }}">
                  @error('name')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="form-group mb-3">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" id="email" placeholder="E-mail" name="email" value="{{ old('email') }}">
                  @error('email')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="form-group mb-3">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password" id="user-password" placeholder="Informe a senha">
                  @error('password')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                     </span>
                  @enderror
               </div>
               <div class="form-group mb-3">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="new-password" id="password-confirm" placeholder="Repita a senha">
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