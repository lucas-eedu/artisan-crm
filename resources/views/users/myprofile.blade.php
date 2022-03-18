@extends('layouts.app')

@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Meu Perfil</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{route('user.index')}}">Painel</a></li>
                     <li class="breadcrumb-item active">Meu Perfil</li>
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
               <h3 class="card-title">Editando Perfil</h3>
            </div>
            <!-- /.card-header -->
            <form method="post" action="{{route('myProfileUpdate')}}" enctype="multipart/form-data">
               
               @csrf
               @method("PUT")

               <div class="card-body">
                  <div class="form-group">
                     <label for="profile_picture">Foto de Perfil</label><br>
                     @if($user->profile_picture)
                        <img src="{{asset('storage/' . $user->profile_picture)}}" class="profile-user-img img-fluid img-circle" alt="Foto de Perfil" height="88" width="88">
                     @endif
                     <p class="text-muted">
                        <small>Permitido apenas extensões JPG ou PNG.</small>
                     </p>
                     <input type="file" class="@error('profile_picture') is-invalid @enderror" id="profile_picture" name="profile_picture">
                     @error('profile_picture')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="name">Nome</label>
                     <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Ex: Lucas Eduardo" id="name" name="name" value="{{old('name', $user->name)}}">
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{$message}}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="email">E-mail</label>
                     <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Ex: email@email.com" id="email" name="email" value="{{old('email', $user->email)}}">
                     @error('email')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{$message}}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="password">Senha</label>
                     <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="********" id="password" name="password" value="">
                     @error('password')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{$message}}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                  <a href="{{route('dashboard')}}" class="btn btn-danger">Cancelar</a>
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
