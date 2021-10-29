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
                  {{-- <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button> --}}
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
                        <th>ID</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th width="250">Ações</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($users as $user)
                        <tr>
                           <td>{{$user->id}}</td>
                           <td>
                              <a>{{$user->name}}</a>
                              <br/>
                              <small>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</small>
                           </td>
                           <td>{{$user->email}}</td>
                           <td style="border:0px;">
                              <button type="button" class="btn btn-info btn-flat dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                 <i class="fas fa-align-justify"></i>
                              </button>
                              <div class="dropdown-menu" role="menu" style="">
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
               <ul class="pagination pagination-sm m-0 float-right">
                  {{$users->links()}}
               </ul>
             </div>
         </div>
         <!-- /.card -->
      </section>
      <!-- /.content -->
   </div>
   <!-- /.content-wrapper -->

@endsection