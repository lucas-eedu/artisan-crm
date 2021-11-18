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
                              <br/>
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