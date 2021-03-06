@extends('layouts.app')

@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Produtos</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                  <li class="breadcrumb-item active">Produtos</li>
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
                     <div class="col-4">
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
            <h3 class="card-title">Lista de Produtos</h3>
            <div class="card-tools">
               <a href="{{route('product.create')}}" class="btn btn-tool" title="Adicionar Novo Produtos">
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
                     <th>Status</th>
                     <th width="250">Ações</th>
                  </tr>
               </thead>
               <tbody>
                  @foreach ($products as $product)
                  <tr>
                     <td>
                        <a>{{$product->name}}</a>
                        <br />
                        <small>Criado em: {{ \Carbon\Carbon::parse($product->created_at)->format('d/m/Y') }}</small>
                     </td>
                     <td>@if ($product->status == 'active') Ativo @else Inativo @endif</td>
                     <td style="border:0px;">
                        <button type="button" class="btn btn-info btn-flat dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-align-justify"></i>
                        </button>
                        <div class="dropdown-menu" role="menu" style="">
                           <a class="dropdown-item" href="{{ route('product.edit', ['product' => $product->id]) }}">Editar</a>
                           <form method="POST" action="{{ route('product.destroy', ['product' => $product->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
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
               <li>Total: {{ $products->total() }} Produtos</li>
            </ul>
            <ul class="pagination pagination-sm m-0 float-right">
               {{$products->links()}}
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