@extends('layouts.app')

@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Criar Empresa</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="{{route('company.index')}}">Empresas</a></li>
                     <li class="breadcrumb-item active">Criar Empresa</li>
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
               <h3 class="card-title">Nova Empresa</h3>
            </div>
            <!-- /.card-header -->
            <form method="post" action="{{route('company.store')}}" enctype="multipart/form-data">
               @csrf
               <div class="card-body">
                  <div class="form-group">
                     <label for="name">Nome:</label>
                     <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Ex: Google" id="name" name="name" value="{{old('name')}}">
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
                  <div class="form-group">
                     <label for="state">Estado:</label>
                     <select id="state" class="select2 form-control @error('state') is-invalid @enderror" name="state">
                        <option value="">Selecione</option>
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
                  <div class="form-group">
                     <label for="number_employees">Qual o tamanho da empresa?</label>
                     <select id="number_employees" class="select2 form-control @error('number_employees') is-invalid @enderror" name="number_employees">
                        <option value="">Selecione</option>
                        <option value="1">1</option>
                        <option value="2-10">2-10</option>
                        <option value="11-50">11-50</option>
                        <option value="51-100">51-100</option>
                        <option value="101+">101+</option>
                     </select>
                     @error('number_employees')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="status">Status:</label>
                     <select id="status" class="select2 form-control @error('status') is-invalid @enderror" name="status">
                        <option value="">Selecione</option>
                        <option value="active" @if ("active" == old('status')) selected="selected" @endif>Ativo - Com acesso ao CRM</option>
                        <option value="inactive" @if ("inactive" == old('status')) selected="selected" @endif>Inativo - Sem acesso ao CRM</option>
                     </select>
                     @error('status')
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
