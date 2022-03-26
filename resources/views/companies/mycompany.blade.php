@extends('layouts.app')

@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Minha Empresa</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                     <li class="breadcrumb-item active">Minha Empresa</li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">

         @include('flash::message')

         @if (count($errors) > 0)
            <div class="alert alert-danger">
               Verifique os erros abaixo
            </div>
         @endif

         <!-- Default box -->
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Dados da Empresa</h3>
            </div>
            <!-- /.card-header -->
            <form method="post" action="{{route('myCompanyUpdate')}}" enctype="multipart/form-data">
               @csrf
               @method("PUT")
               <div class="card-body">
                  <div class="form-group">
                     <label for="name">Nome:</label>
                     <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Ex: Google" id="name" name="name" value="{{old('name', $company->name)}}">
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="segment">Segmento:</label>
                     <select id="segment" class="select2 form-control @error('segment') is-invalid @enderror" name="segment">
                        <option value="">Selecione</option>
                        <option value="Tech ou Software" @if ("Tech ou Software" == old('segment', $company->segment)) selected="selected" @endif>Tech ou Software</option>
                        <option value="Imobiliário" @if ("Imobiliário" == old('segment', $company->segment)) selected="selected" @endif>Imobiliário</option>
                        <option value="Educação e Ensino" @if ("Educação e Ensino" == old('segment', $company->segment)) selected="selected" @endif>Educação e Ensino</option>
                        <option value="Agência Criativa (web, publicidade, vídeo)" @if ("Agência Criativa (web, publicidade, vídeo)" == old('segment', $company->segment)) selected="selected" @endif>Agência Criativa (web, publicidade, vídeo)</option>
                        <option value="Serviços financeiros ou de crédito" @if ("Serviços financeiros ou de crédito" == old('segment', $company->segment)) selected="selected" @endif>Serviços financeiros ou de crédito</option>
                        <option value="Notícias, imprensa e publicações" @if ("Notícias, imprensa e publicações" == old('segment', $company->segment)) selected="selected" @endif>Notícias, imprensa e publicações</option>
                        <option value="Fábrica ou Industria" @if ("Fábrica ou Industria" == old('segment', $company->segment)) selected="selected" @endif>Fábrica ou Industria</option>
                        <option value="Consultoria e Coaching" @if ("Consultoria e Coaching" == old('segment', $company->segment)) selected="selected" @endif>Consultoria e Coaching</option>
                        <option value="Comércio (varejo, atacado)" @if ("Comércio (varejo, atacado)" == old('segment', $company->segment)) selected="selected" @endif>Comércio (varejo, atacado)</option>
                        <option value="Automotivo" @if ("Automotivo" == old('segment', $company->segment)) selected="selected" @endif>Automotivo</option>
                        <option value="Saúde" @if ("Saúde" == old('segment', $company->segment)) selected="selected" @endif>Saúde</option>
                        <option value="Construção" @if ("Construção" == old('segment', $company->segment)) selected="selected" @endif>Construção</option>
                        <option value="Outro" @if ("Outro" == old('segment', $company->segment)) selected="selected" @endif>Outro</option>
                     </select>
                     @error('segment')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="state">Estado:</label>
                     <select id="state" class="select2 form-control @error('state') is-invalid @enderror" name="state">
                        <option value="">Selecione</option>
                        <option value="AC" @if ("AC" == old('state', $company->state)) selected="selected" @endif>Acre</option>
                        <option value="AL" @if ("AL" == old('state', $company->state)) selected="selected" @endif>Alagoas</option>
                        <option value="AP" @if ("AP" == old('state', $company->state)) selected="selected" @endif>Amapá</option>
                        <option value="AM" @if ("AM" == old('state', $company->state)) selected="selected" @endif>Amazonas</option>
                        <option value="BA" @if ("BA" == old('state', $company->state)) selected="selected" @endif>Bahia</option>
                        <option value="CE" @if ("CE" == old('state', $company->state)) selected="selected" @endif>Ceará</option>
                        <option value="DF" @if ("DF" == old('state', $company->state)) selected="selected" @endif>Distrito Federal</option>
                        <option value="ES" @if ("ES" == old('state', $company->state)) selected="selected" @endif>Espirito Santo</option>
                        <option value="GO" @if ("GO" == old('state', $company->state)) selected="selected" @endif>Goiás</option>
                        <option value="MA" @if ("MA" == old('state', $company->state)) selected="selected" @endif>Maranhão</option>
                        <option value="MS" @if ("MS" == old('state', $company->state)) selected="selected" @endif>Mato Grosso do Sul</option>
                        <option value="MT" @if ("MT" == old('state', $company->state)) selected="selected" @endif>Mato Grosso</option>
                        <option value="MG" @if ("MG" == old('state', $company->state)) selected="selected" @endif>Minas Gerais</option>
                        <option value="PA" @if ("PA" == old('state', $company->state)) selected="selected" @endif>Pará</option>
                        <option value="PB" @if ("PB" == old('state', $company->state)) selected="selected" @endif>Paraíba</option>
                        <option value="PR" @if ("PR" == old('state', $company->state)) selected="selected" @endif>Paraná</option>
                        <option value="PE" @if ("PE" == old('state', $company->state)) selected="selected" @endif>Pernambuco</option>
                        <option value="PI" @if ("PI" == old('state', $company->state)) selected="selected" @endif>Piauí</option>
                        <option value="RJ" @if ("RJ" == old('state', $company->state)) selected="selected" @endif>Rio de Janeiro</option>
                        <option value="RN" @if ("RN" == old('state', $company->state)) selected="selected" @endif>Rio Grande do Norte</option>
                        <option value="RS" @if ("RS" == old('state', $company->state)) selected="selected" @endif>Rio Grande do Sul</option>
                        <option value="RO" @if ("RO" == old('state', $company->state)) selected="selected" @endif>Rondônia</option>
                        <option value="RR" @if ("RR" == old('state', $company->state)) selected="selected" @endif>Roraima</option>
                        <option value="SC" @if ("SC" == old('state', $company->state)) selected="selected" @endif>Santa Catarina</option>
                        <option value="SP" @if ("SP" == old('state', $company->state)) selected="selected" @endif>São Paulo</option>
                        <option value="SE" @if ("SE" == old('state', $company->state)) selected="selected" @endif>Sergipe</option>
                        <option value="TO" @if ("TO" == old('state', $company->state)) selected="selected" @endif>Tocantins</option>
                     </select>
                     @error('state')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="number_employees">Qual o tamanho da empresa?</label>
                     <select id="number_employees" class="select2 form-control @error('number_employees') is-invalid @enderror" name="number_employees">
                        <option value="">Selecione</option>
                        <option value="1" @if ("1" == old('number_employees', $company->number_employees)) selected="selected" @endif>1</option>
                        <option value="2-10" @if ("2-10" == old('number_employees', $company->number_employees)) selected="selected" @endif>2-10</option>
                        <option value="11-50" @if ("11-50" == old('number_employees', $company->number_employees)) selected="selected" @endif>11-50</option>
                        <option value="51-100" @if ("51-100" == old('number_employees', $company->number_employees)) selected="selected" @endif>51-100</option>
                        <option value="101+" @if ("101+" == old('number_employees', $company->number_employees)) selected="selected" @endif>101+</option>
                     </select>
                     @error('number_employees')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                  <a href="{{route('company.index')}}" class="btn btn-danger">Cancelar</a>
               </div>
            </form>
            <!-- /.form -->
         </div>
         <!-- /.card -->
      </section>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->

@endsection
