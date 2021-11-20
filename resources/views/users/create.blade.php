@extends('layouts.app')

@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Criar Usuário</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item"><a href="{{route('user.index')}}">Usuários</a></li>
                     <li class="breadcrumb-item active">Cria Usuário</li>
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
               <h3 class="card-title">Novo Usuário</h3>
            </div>
            <!-- /.card-header -->
            <form method="post" action="{{route('user.store')}}" enctype="multipart/form-data">
               @csrf
               <div class="card-body">
                  <div class="form-group">
                     <label for="company_id">Empresa</label>
                     <select id="company_id" class="select2 form-control @error('company_id') is-invalid @enderror" name="company_id">
                        <option value="">Selecione</option>
                        @foreach($companies as $company)
                           <option value="{{$company->id}}" @if ($company->id == old('company_id')) selected="selected" @endif>{{$company->name}}</option>
                        @endforeach
                     </select>
                     @error('company_id')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="name">Nome</label>
                     <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Ex: Lucas Eduardo" id="name" name="name" value="{{old('name')}}">
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="email">E-mail</label>
                     <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Ex: email@email.com" id="email" name="email" value="{{old('email')}}">
                     @error('email')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="profile_id">Perfil de Acesso</label>
                     <select id="profile_id" class="select2 form-control @error('profile_id') is-invalid @enderror" name="profile_id">
                        <option value="">Selecione</option>
                        @foreach($profiles as $profile)
                           <option value="{{$profile->id}}" @if ($profile->id == old('profile_id')) selected="selected" @endif>{{$profile->name}}</option>
                        @endforeach
                     </select>
                     @error('profile_id')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="password">Senha</label>
                     <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" id="password" name="password" value="">
                     @error('password')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                  <a href="{{route('user.index')}}" class="btn btn-danger">Cancelar</a>
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
