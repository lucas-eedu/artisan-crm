@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Permissões</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Permissões</li>
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
                     <div class="col-12">
                        <div class="form-group">
                           <input type="text" name="search" class="form-control" placeholder="Digite sua busca" value="{{ $search }}">
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
            <h3 class="card-title">Lista de Permissões</h3>
            <div class="card-tools">
               <a href="{{route('permission.create')}}" class="btn btn-tool" title="Adicionar Nova Permissão">
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
                     <th>Código</th>
                     <th width="250">Ações</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($permissions as $permission)
                  <tr>
                     <td>
                        <a>{{$permission->name}}</a>
                        <br />
                        <small>{{ \Carbon\Carbon::parse($permission->created_at)->format('d/m/Y') }}</small>
                     </td>
                     <td>{{$permission->code}}</td>
                     <td style="border:0px;">
                        <button type="button" class="btn btn-info btn-flat dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-align-justify"></i>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                           <a class="dropdown-item" href="{{ route('permission.edit', ['permission' => $permission->id]) }}">Editar</a>
                           <form method="POST" action="{{ route('permission.destroy', ['permission' => $permission->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
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
               <li>Total: {{ $permissions->total() }} Permissões</li>
            </ul>
            <ul class="pagination pagination-sm m-0 float-right">
               {{$permissions->links()}}
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