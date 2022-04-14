@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Leads / Negociação</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Leads / Negociação</li>
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
         <div id="advanced-search" class="collapse" data-parent="#accordion">
            <div class="card-body">
               <form>
                  <div class="row">
                     <div class="col-12">
                        <div class="form-group">
                           <input type="text" name="search" class="form-control" placeholder="Digite sua busca" value="{{ $search }}">
                        </div>
                     </div>
                     <div class="@if(auth()->user()->profile_id != 3) col-4 @else col-6 @endif">
                        <div class="form-group">
                           <select id="search_product_id" class="select2 form-control" name="search_product_id">
                              <option value="">Produto</option>
                              @foreach($products as $product)
                              <option value="{{$product->id}}" @if ($product->id == $search_product_id) selected="selected" @endif>{{$product->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="@if(auth()->user()->profile_id != 3) col-4 @else col-6 @endif">
                        <div class="form-group">
                           <select id="search_origin_id" class="select2 form-control" name="search_origin_id">
                              <option value="">Origem</option>
                              @foreach($origins as $origin)
                              <option value="{{$origin->id}}" @if ($origin->id == $search_origin_id) selected="selected" @endif>{{$origin->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     @if(auth()->user()->profile_id != 3)
                     <div class="col-4">
                        <div class="form-group">
                           <select id="search_user_id" class="select2 form-control" name="search_user_id">
                              <option value="">Vendedor Responsável</option>
                              @foreach($users as $user)
                              <option value="{{$user->id}}" @if ($user->id == $search_user_id) selected="selected" @endif>{{$user->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     @endif
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
      <div class="card">
         <div class="card-header">
            <ul class="nav nav-pills float-left">
               <li class="nav-item"><a class="nav-link" href="{{route('lead.index')}}">Todos</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('showListNewLeads')}}">Novos</a></li>
               <li class="nav-item"><a class="nav-link active" href="{{route('showListNegotiationLeads')}}">Negociação</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('showListGainLeads')}}">Ganho</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('showListLostLeads')}}">Perdido</a></li>
            </ul>
            @can('create', \App\Models\Lead::class)
            <div class="card-tools">
               <a href="{{route('lead.create')}}" class="btn btn-tool" title="Adicionar Novo Lead">
                  <i class="fas fa-plus"></i>
                  Adicionar
               </a>
            </div>
            @endcan
         </div>
         <div class="card-body p-0">
            <div class="tab-content">
               <div class="tab-pane active">
                  <table class="table table-striped projects">
                     <thead>
                        <tr>
                           <th>Nome</th>
                           <th>E-mail</th>
                           <th>Telefone</th>
                           <th>Produto</th>
                           <th>Origem</th>
                           <th>Status</th>
                           @if(auth()->user()->profile_id != 3)
                           <th>Vendedor Responsável</th>
                           @endif
                           <th>Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($leads as $lead)
                        <tr>
                           <td>
                              <a>{{$lead->name}}</a>
                              <br />
                              <small>Cadastro: {{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }} às {{ \Carbon\Carbon::parse($lead->created_at)->format('H:i') }}</small>
                           </td>
                           <td>{{$lead->email}}</td>
                           <td>{{$lead->phone}}</td>
                           <td>{{$lead->product->name}}</td>
                           <td>{{$lead->origin->name}}</td>
                           <td>
                              @if ($lead->status === 'new')
                              <span class="badge badge-pill badge-info">Novo</span>
                              @elseif ($lead->status === 'negotiation')
                              <span class="badge badge-pill badge-warning text-white">Negociação</span>
                              @elseif ($lead->status === 'gain')
                              <span class="badge badge-pill badge-success">Ganho</span>
                              @else
                              <span class="badge badge-pill badge-danger">Perdido</span>
                              @endif
                           </td>
                           @if(auth()->user()->profile_id != 3)
                           <td>{{$lead->user->name}}</td>
                           @endif
                           <td style="border:0px;">
                              <button type="button" class="btn btn-info btn-flat dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                 <i class="fas fa-align-justify"></i>
                              </button>
                              <div class="dropdown-menu" role="menu">
                                 @can('viewAny', \App\Models\Lead::class)
                                 <a class="dropdown-item" href="{{ route('lead.show', ['lead' => $lead->id]) }}">Ver</a>
                                 @endcan
                                 @can('update', \App\Models\Lead::class)
                                 <a class="dropdown-item" href="{{ route('lead.edit', ['lead' => $lead->id]) }}">Editar</a>
                                 @endcan
                                 @can('update', \App\Models\Lead::class)
                                 <form method="POST" action="{{ route('lead.destroy', ['lead' => $lead->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Excluir" class="dropdown-item">
                                 </form>
                                 @endcan
                              </div>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                     <ul class="pagination pagination-sm m-0 float-left">
                        <li>Total: {{ $leads->total() }} Leads</li>
                     </ul>
                     <ul class="pagination pagination-sm m-0 float-right">
                        {{$leads->links()}}
                     </ul>
                  </div>
                  <!-- /.card-footer -->
               </div>
            </div>
         </div>
      </div>
      <!-- /.card -->
   </section>
   <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection