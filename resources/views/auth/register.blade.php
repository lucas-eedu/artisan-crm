@extends('layouts.guest')

@section('content')

   <div class="login-box w-50">

      @include('flash::message')

      @foreach($errors->all() as $error)
            <p class="alert alert-danger">{{$error}}</p>
      @endforeach
      
      <!-- /.login-logo -->
      <div class="shadow-lg p-5 bg-white rounded border-top border-primary">
         <div class="card-header text-center">
         <h2 class="h2 text-center">Artisan<span class="fw-light">CRM</span></h2>
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
                           <option value="Tech ou Software" @if ("Tech ou Software" == old('segment')) selected="selected" @endif>Tech ou Software</option>
                           <option value="Imobiliário" @if ("Imobiliário" == old('segment')) selected="selected" @endif>Imobiliário</option>
                           <option value="Educação e Ensino" @if ("Educação e Ensino" == old('segment')) selected="selected" @endif>Educação e Ensino</option>
                           <option value="Agência Criativa (web, publicidade, vídeo)" @if ("Agência Criativa (web, publicidade, vídeo)" == old('segment')) selected="selected" @endif>Agência Criativa (web, publicidade, vídeo)</option>
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
                     <div class="col-md-6">
                        <select id="state" class="select2 form-control @error('state') is-invalid @enderror" name="state">
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
               </div>
               <div class="form-group mb-3">
                  <select id="number_employees" class="select2 form-control @error('number_employees') is-invalid @enderror" name="number_employees">
                     <option value="">Qual o tamanho da empresa?</option>
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
                        <label for="agree">Concordo com os <a href="#" target="_blank" class="text-decoration-none">Termos de Uso</a></label>
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
            <div class="">
            <!-- /.social-auth-links -->
            @if (Route::has('password.request'))
               <p class="mb-1 mt-3"><a href="{{ route('password.request') }}" class="text-decoration-none">Esqueci minha senha</a></p>
            @endif
            <p class="mb-0">Já possui uma conta? <a href="{{route('login')}}" class="text-center text-decoration-none">Login</a></p>
            </div>
         </div>
         <!-- /.card-body -->
      </div>
      <!-- /.card -->
   </div>

   <style>
      .login-page {
         
      }
   </style>
@endsection

@section('scripts')
   <!-- jQuery -->
   <script src="{{ asset('artisancrmv1/assets/plugins/jquery/jquery.min.js') }}"></script>
   <!-- Select2 -->
   <script src="{{ asset('artisancrmv1/assets/plugins/select2/js/select2.full.min.js') }}"></script>
   <!-- Initialize select2.js -->
   <script>
      $(function() {
         //Initialize Select2 Elements
         $('.select2').select2()
      })
   </script>
@endsection