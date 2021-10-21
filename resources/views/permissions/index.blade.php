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
                  {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button> --}}
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
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Código</th>
                        <th width="250">Ações</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($permissions as $permission)
                        <tr>
                           <td>{{$permission->id}}</td>
                           <td>
                              <a>{{$permission->name}}</a>
                              <br/>
                              <small>{{ \Carbon\Carbon::parse($permission->created_at)->format('d/m/Y') }}</small>
                           </td>
                           <td>{{$permission->code}}</td>
                           <td class="project-actions btn-group">
                              <a class="btn btn-info btn-sm" href="{{ route('permission.edit', ['permission' => $permission->id]) }}"><i class="fas fa-pencil-alt"></i> Editar</a>
                              <form method="POST" action="{{ route('permission.destroy', ['permission' => $permission->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Deletar</button>
                              </form>
                           </td>
                        </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </section>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->

@endsection