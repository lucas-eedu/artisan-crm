@extends('layouts.app')

@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Criar Lead</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item"><a href="{{route('lead.index')}}">Leads</a></li>
                     <li class="breadcrumb-item active">Criar Lead</li>
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
               <h3 class="card-title">Novo Lead</h3>
            </div>
            <!-- /.card-header -->
            <form method="post" action="{{route('lead.store')}}" enctype="multipart/form-data">
               @csrf
               <input type="hidden" value="{{auth()->user()->company_id}}" name="company_id">
               <div class="card-body">
                  <div class="form-group">
                     <label for="user_id">Responsável</label>
                     <select id="user_id" class="select2 form-control @error('user_id') is-invalid @enderror" name="user_id">
                        <option value="">Sem Responsável</option>
                        @foreach($users as $user)
                           <option value="{{$user->id}}" @if ($user->id == old('user_id')) selected="selected" @endif>{{$user->name}}</option>
                        @endforeach
                     </select>
                     @error('user_id')
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
                     <label for="phone">Telefone</label>
                     <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="(85) 9.9999-9999" id="phone" name="phone" value="{{old('phone')}}" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">
                     @error('phone')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="message">Mensagem</label>
                     <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" cols="30" rows="10">{{old('message')}}</textarea>
                     @error('message')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="product_id">Produto</label>
                     <select id="product_id" class="select2 form-control @error('product_id') is-invalid @enderror" name="product_id">
                        <option value="">Selecione</option>
                        @foreach($products as $product)
                           <option value="{{$product->id}}" @if ($product->id == old('product_id')) selected="selected" @endif>{{$product->name}}</option>
                        @endforeach
                     </select>
                     @error('product_id')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="origin_id">Origem</label>
                     <select id="origin_id" class="select2 form-control @error('origin_id') is-invalid @enderror" name="origin_id">
                        <option value="">Selecione</option>
                        @foreach($origins as $origin)
                           <option value="{{$origin->id}}" @if ($origin->id == old('origin_id')) selected="selected" @endif>{{$origin->name}}</option>
                        @endforeach
                     </select>
                     @error('origin_id')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                  <a href="{{route('lead.index')}}" class="btn btn-danger">Cancelar</a>
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
