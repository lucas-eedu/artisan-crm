@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Empresas</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Empresas</li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>

   <section class="content">
      <div class="card card-primary" id="accordion">
         <a class="text-dark d-block w-100 collapsed" data-toggle="collapse" href="#advanced-search" aria-expanded="false">
            <div class="card-header">
               <h4 class="card-title w-100">
                  Pesquisa Avançada
               </h4>
            </div>
         </a>
         <div id="advanced-search" class="collapse" data-parent="#accordion" style="">
            <div class="card-body">
               <form>
                  <div class="row">
                     <div class="col-6">
                        <div class="form-group">
                           <input type="text" name="search" class="form-control" placeholder="Digite sua busca" value="{{ $search }}">
                        </div>
                     </div>
                     <div class="col-6">
                        <div class="form-group">
                           <select id="search_segment" class="select2 form-control" name="search_segment">
                              <option value="">Segmento</option>
                              <option value="Tech ou Software" @if ("Tech ou Software"==$search_segment) selected="selected" @endif>Tech ou Software</option>
                              <option value="Imobiliário" @if ("Imobiliário"==$search_segment) selected="selected" @endif>Imobiliário</option>
                              <option value="Educação e Ensino" @if ("Educação e Ensino"==$search_segment) selected="selected" @endif>Educação e Ensino</option>
                              <option value="Agência Criativa (web, publicidade, vídeo)" @if ("Agência Criativa (web, publicidade, vídeo)"==$search_segment) selected="selected" @endif>Agência Criativa (web, publicidade, vídeo)</option>
                              <option value="Serviços financeiros ou de crédito" @if ("Serviços financeiros ou de crédito"==$search_segment) selected="selected" @endif>Serviços financeiros ou de crédito</option>
                              <option value="Notícias, imprensa e publicações" @if ("Notícias, imprensa e publicações"==$search_segment) selected="selected" @endif>Notícias, imprensa e publicações</option>
                              <option value="Fábrica ou Industria" @if ("Fábrica ou Industria"==$search_segment) selected="selected" @endif>Fábrica ou Industria</option>
                              <option value="Consultoria e Coaching" @if ("Consultoria e Coaching"==$search_segment) selected="selected" @endif>Consultoria e Coaching</option>
                              <option value="Comércio (varejo, atacado)" @if ("Comércio (varejo, atacado)"==$search_segment) selected="selected" @endif>Comércio (varejo, atacado)</option>
                              <option value="Automotivo" @if ("Automotivo"==$search_segment) selected="selected" @endif>Automotivo</option>
                              <option value="Saúde" @if ("Saúde"==$search_segment) selected="selected" @endif>Saúde</option>
                              <option value="Construção" @if ("Construção"==$search_segment) selected="selected" @endif>Construção</option>
                              <option value="Outro" @if ("Outro"==$search_segment) selected="selected" @endif>Outro</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="form-group">
                           <select id="search_state" class="select2 form-control" name="search_state">
                              <option value="">Estado</option>
                              <option value="AC" @if ("AC"==$search_state) selected="selected" @endif>Acre</option>
                              <option value="AL" @if ("AL"==$search_state) selected="selected" @endif>Alagoas</option>
                              <option value="AP" @if ("AP"==$search_state) selected="selected" @endif>Amapá</option>
                              <option value="AM" @if ("AM"==$search_state) selected="selected" @endif>Amazonas</option>
                              <option value="BA" @if ("BA"==$search_state) selected="selected" @endif>Bahia</option>
                              <option value="CE" @if ("CE"==$search_state) selected="selected" @endif>Ceará</option>
                              <option value="DF" @if ("DF"==$search_state) selected="selected" @endif>Distrito Federal</option>
                              <option value="ES" @if ("ES"==$search_state) selected="selected" @endif>Espirito Santo</option>
                              <option value="GO" @if ("GO"==$search_state) selected="selected" @endif>Goiás</option>
                              <option value="MA" @if ("MA"==$search_state) selected="selected" @endif>Maranhão</option>
                              <option value="MS" @if ("MS"==$search_state) selected="selected" @endif>Mato Grosso do Sul</option>
                              <option value="MT" @if ("MT"==$search_state) selected="selected" @endif>Mato Grosso</option>
                              <option value="MG" @if ("MG"==$search_state) selected="selected" @endif>Minas Gerais</option>
                              <option value="PA" @if ("PA"==$search_state) selected="selected" @endif>Pará</option>
                              <option value="PB" @if ("PB"==$search_state) selected="selected" @endif>Paraíba</option>
                              <option value="PR" @if ("PR"==$search_state) selected="selected" @endif>Paraná</option>
                              <option value="PE" @if ("PE"==$search_state) selected="selected" @endif>Pernambuco</option>
                              <option value="PI" @if ("PI"==$search_state) selected="selected" @endif>Piauí</option>
                              <option value="RJ" @if ("RJ"==$search_state) selected="selected" @endif>Rio de Janeiro</option>
                              <option value="RN" @if ("RN"==$search_state) selected="selected" @endif>Rio Grande do Norte</option>
                              <option value="RS" @if ("RS"==$search_state) selected="selected" @endif>Rio Grande do Sul</option>
                              <option value="RO" @if ("RO"==$search_state) selected="selected" @endif>Rondônia</option>
                              <option value="RR" @if ("RR"==$search_state) selected="selected" @endif>Roraima</option>
                              <option value="SC" @if ("SC"==$search_state) selected="selected" @endif>Santa Catarina</option>
                              <option value="SP" @if ("SP"==$search_state) selected="selected" @endif>São Paulo</option>
                              <option value="SE" @if ("SE"==$search_state) selected="selected" @endif>Sergipe</option>
                              <option value="TO" @if ("TO"==$search_state) selected="selected" @endif>Tocantins</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="form-group">
                           <select id="search_number_employees" class="select2 form-control" name="search_number_employees">
                              <option value="">Funcionários</option>
                              <option value="1" @if ("1"==$search_number_employees) selected="selected" @endif>1 Funcionário</option>
                              <option value="2-10" @if ("2-10"==$search_number_employees) selected="selected" @endif>2-10 Funcionários</option>
                              <option value="11-50" @if ("11-50"==$search_number_employees) selected="selected" @endif>11-50 Funcionários</option>
                              <option value="51-100" @if ("51-100"==$search_number_employees) selected="selected" @endif>51-100 Funcionários</option>
                              <option value="101+" @if ("101+"==$search_number_employees) selected="selected" @endif>101+ Funcionários</option>
                           </select>
                        </div>
                     </div>
                     <div class="col-4">
                        <div class="form-group">
                           <select id="search_status" class="select2 form-control" name="search_status">
                              <option value="">Status</option>
                              <option value="active" @if ("active"==$search_status) selected="selected" @endif>Ativo</option>
                              <option value="inactive" @if ("inactive"==$search_status) selected="selected" @endif>Inativo</option>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="float-right">
                     <button type="submit" class="btn btn-default">
                        <i class="fa fa-search"></i>
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>

   <!-- Main content -->
   <section class="content">

      @include('flash::message')

      @if (count($errors) > 0)
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif

      <!-- Default box -->
      <div class="card">
         <div class="card-header">
            <h3 class="card-title">Lista de Empresas</h3>
            <div class="card-tools">
               <a href="{{route('company.create')}}" class="btn btn-tool" title="Adicionar Nova Permissão">
                  <i class="fas fa-plus"></i>
                  Adicionar
               </a>
            </div>
         </div>
         <div class="card-body p-0">
            <table class="table table-striped projects">
               <thead>
                  <tr>
                     <th>Nome</th>
                     <th>Segmento</th>
                     <th>Estado</th>
                     <th>Funcionários</th>
                     <th>Status</th>
                     <th>Ações</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($companies as $company)
                  <tr>
                     <td>
                        <a>{{$company->name}}</a>
                        <br />
                        <small>{{ \Carbon\Carbon::parse($company->created_at)->format('d/m/Y') }}</small>
                     </td>
                     <td>{{$company->segment}}</td>
                     <td>{{$company->state}}</td>
                     <td>{{$company->number_employees}}</td>
                     <td>@if ($company->status == 'active') Ativo @else Inativo @endif</td>
                     <td style="border:0px;">
                        <button type="button" class="btn btn-info btn-flat dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-align-justify"></i>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                           <a class="dropdown-item" href="{{ route('company.edit', ['company' => $company->id]) }}">Editar</a>
                           <form method="POST" action="{{ route('company.destroy', ['company' => $company->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
                              @csrf
                              @method('DELETE')
                              <input type="submit" value="Excluir" class="dropdown-item">
                           </form>
                        </div>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table>
         </div>
         <!-- /.card-body -->
         <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-left">
               <li>Total: {{ $companies->total() }} Empresas</li>
            </ul>
            <ul class="pagination pagination-sm m-0 float-right">
               {{$companies->links()}}
            </ul>
         </div>
         <!-- /.card-footer -->
      </div>
      <!-- /.card -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection