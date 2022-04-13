@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Usuários</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Usuários</li>
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
                     <div class="col-8">
                        <div class="form-group">
                           <input type="text" name="search" class="form-control" placeholder="Digite sua busca" value="{{ $search }}">
                        </div>
                     </div>
                     @if (auth()->user()->profile_id == 1)
                        <div class="col-2">
                           <div class="form-group">
                              <select id="search_company_id" class="select2 form-control" name="search_company_id">
                                 <option value="">Empresa</option>
                                 @foreach($companies as $company)
                                    <option value="{{$company->id}}" @if ($company->id == $search_company_id) selected="selected" @endif>{{$company->name}}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                     @endif
                     <div class="@if (auth()->user()->profile_id == 1) col-2 @else col-4 @endif">
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
            <h3 class="card-title">Lista de Usuários</h3>
            <div class="card-tools">
               <a href="{{route('user.create')}}" class="btn btn-tool" title="Adicionar Novo Usuário">
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
                     <th>E-mail</th>
                     <th>Perfil</th>
                     @if (auth()->user()->profile_id == 1)
                     <th>Empresa</th>
                     @endif
                     <th>Status</th>
                     <th>Ações</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($users as $user)
                  <tr>
                     <td>
                        <a>{{$user->name}}</a>
                        <br />
                        <small>Criado em: {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</small>
                     </td>
                     <td>{{$user->email}}</td>
                     <td>{{$user->profile->name}}</td>
                     @if (auth()->user()->profile_id == 1 && isset($user->company))
                     <td>{{$user->company->name}}</td>
                     @endif
                     <td>@if ($user->status == 'active') Ativo @else Inativo @endif</td>
                     <td style="border:0px;">
                        <button type="button" class="btn btn-info btn-flat dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-align-justify"></i>
                        </button>
                        <div class="dropdown-menu" role="menu">
                           <a class="dropdown-item" href="{{ route('user.edit', ['user' => $user->id]) }}">Editar</a>
                           <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
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
               <li>Total: {{ $users->total() }} Usuários</li>
            </ul>
            <ul class="pagination pagination-sm m-0 float-right">
               {{$users->links()}}
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