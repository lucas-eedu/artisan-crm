@extends('layouts.app')

@section('content')

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Lead</h1>
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item"><a href="{{route('lead.index')}}">Leads</a></li>
                     <li class="breadcrumb-item active">Lead</li>
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
               <h3 class="card-title">Lead</h3>
            </div>
            <!-- /.card-header -->
            <form method="post" action="{{route('lead.update', ['lead' => $lead->id])}}" enctype="multipart/form-data">
               @csrf
               @method("PUT")
               <input type="hidden" value="{{$lead->company_id}}" name="company_id">
               <input type="hidden" value="{{$lead->origin_id}}" name="origin_id">
               <input type="hidden" value="{{$lead->product_id}}" name="product_id">
               <input type="hidden" value="{{$lead->email}}" name="email">
               <div class="card-body">
                  <div class="form-group">
                     <label for="status">Status:</label>
                     <select id="status" class="select2 form-control @error('status') is-invalid @enderror" name="status">
                        <option value="new" @if ("new" == old('status', $lead->status)) selected="selected" @endif>Novo</option>
                        <option value="negotiation" @if ("negotiation" == old('status', $lead->status)) selected="selected" @endif>Negociando</option>
                        <option value="gain" @if ("gain" == old('status', $lead->status)) selected="selected" @endif>Ganho</option>
                        <option value="lost" @if ("lost" == old('status', $lead->status)) selected="selected" @endif>Perdido</option>
                     </select>
                     @error('status')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="user_id">Responsável</label>
                     <select id="user_id" class="select2 form-control @error('user_id') is-invalid @enderror" name="user_id">
                        @foreach($users as $user)
                           <option value="{{$user->id}}" @if ($user->id == old('user_id', $lead->user_id)) selected="selected" @endif>{{$user->name}}</option>
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
                     <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Ex: Lucas Eduardo" id="name" name="name" value="{{$lead->name}}" disabled>
                     @error('name')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="email">E-mail</label>
                     <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Ex: email@email.com" id="email" name="email" value="{{$lead->email}}" disabled>
                     @error('email')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="phone">Telefone</label>
                     <input type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="(85) 9.9999-9999" id="phone" name="phone" value="{{$lead->phone}}" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);" disabled>
                     @error('phone')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="message">Mensagem</label>
                     <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" cols="30" rows="10" disabled>{{$lead->message}}</textarea>
                     @error('message')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="product_id">Produto</label>
                     <input type="text" class="form-control @error('product_id') is-invalid @enderror" placeholder="Ex: Lucas Eduardo" id="product_id" name="product_id" value="{{$lead->product->name}}" disabled>
                     @error('product_id')
                        <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>
                  <div class="form-group">
                     <label for="origin_id">Origem</label>
                     <input type="text" class="form-control @error('origin_id') is-invalid @enderror" placeholder="Ex: Lucas Eduardo" id="origin_id" name="origin_id" value="{{$lead->origin->name}}" disabled>
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
