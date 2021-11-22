@extends('layouts.app')

@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Editar Produto</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                     <li class="breadcrumb-item"><a href="{{route('permission.index')}}">Produtos</a></li>
                     <li class="breadcrumb-item active">Editar Produto</li>
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
               <h3 class="card-title">Editar Produto</h3>
            </div>
            <!-- /.card-header -->
            <form method="post" action="{{route('product.update', ['product' => $product->id])}}" enctype="multipart/form-data">
               @csrf
               @method("PUT")
               <input type="hidden" name="company_id" value="{{auth()->user()->company_id}}">
               <div class="card-body">
                  <div class="form-group">
                     <label for="name">Nome do Produto</label>
                     <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Ex: Software Web" id="name" name="name" value="{{old('name', $product->name)}}">
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="status">Status:</label>
                     <select id="status" class="select2 form-control @error('status') is-invalid @enderror" name="status">
                        <option value="">Selecione</option>
                        <option value="active" @if ("active" == old('status', $product->status)) selected="selected" @endif>Ativo</option>
                        <option value="inactive" @if ("inactive" == old('status', $product->status)) selected="selected" @endif>Inativo</option>
                     </select>
                     @error('status')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
               </div>
               <!-- /.card-body -->
               <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                  <a href="{{route('permission.index')}}" class="btn btn-danger">Cancelar</a>
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
