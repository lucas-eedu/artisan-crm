@extends('layouts.app')

@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Criar Perfil</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Dashboard</a></li>
                     <li class="breadcrumb-item"><a href="{{route('profile.index')}}">Perfis</a></li>
                     <li class="breadcrumb-item active">Cria Perfil</li>
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
               <h3 class="card-title">Novo Perfil</h3>
            </div>
            <!-- /.card-header -->
            <form method="post" action="{{route('profile.store')}}" enctype="multipart/form-data">
               @csrf
               <div class="card-body">
                  <div class="form-group">
                     <label for="name">Nome:</label>
                     <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Ex: Administrador" id="name" name="name" value="{{old('name')}}">
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group" id="campoUsuarios">
                     <label class="label-control" for="permissions">
                        Permissões deste Perfil
                     </label>

                     <fieldset class="checkbox ml-1" style="background:#F0F0F0; padding-top:0.5em; margin-bottom:0.5em;">
                        <label>
                           <input id="checkboxPermissionToggler" type="checkbox" name="" value=""> <i>Marcar/desmarcar todos</i><br>
                        </label>
                     </fieldset>

                     @foreach($permissions as $permission)
                        <fieldset class="checkbox ml-1">
                           <label>
                                 <input class="checkboxPermission" type="checkbox" name="permissions[]" value="{{$permission->id}}" @if (old('permissions') && in_array($permission->id, old('permissions'))) checked="checked" @endif>
                                    {{$permission->name}}
                                 <br>
                           </label>
                        </fieldset>
                     @endforeach

                     @error('permissions')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                  <a href="{{route('profile.index')}}" class="btn btn-danger">Cancelar</a>
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
