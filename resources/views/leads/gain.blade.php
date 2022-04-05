@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Leads / Ganhos</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Leads / Ganhos</li>
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
      <div class="card">
         <div class="card-header">
            <ul class="nav nav-pills float-left">
               <li class="nav-item"><a class="nav-link" href="{{route('lead.index')}}">Todos</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('showListNewLeads')}}">Novos</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('showListNegotiationLeads')}}">Negociação</a></li>
               <li class="nav-item"><a class="nav-link active" href="{{route('showListGainLeads')}}">Ganhos</a></li>
               <li class="nav-item"><a class="nav-link" href="{{route('showListLostLeads')}}">Perdidos</a></li>
            </ul>
            @can('create', \App\Models\Company::class)
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
                           <th>Status</th>
                           <th>Vendedor Responsável</th>
                           <th>Ações</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($leads as $lead)
                        <tr>
                           <td>
                              <a>{{$lead->name}}</a>
                              <br/>
                              <small>Cadastro: {{ \Carbon\Carbon::parse($lead->created_at)->format('d/m/Y') }}</small>
                           </td>
                           <td>{{$lead->email}}</td>
                           <td>{{$lead->phone}}</td>
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
                           @if (isset($lead->user))
                              <td>{{$lead->user->name}}</td>
                           @else
                              <td>Sem Responsável</td>
                           @endif
                           <td style="border:0px;">
                              <button type="button" class="btn btn-info btn-flat dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-align-justify"></i>
                              </button>
                              <div class="dropdown-menu" role="menu">
                                 <a class="dropdown-item" href="{{ route('lead.edit', ['lead' => $lead->id]) }}">Editar</a>
                                 <form method="POST" action="{{ route('lead.destroy', ['lead' => $lead->id]) }}" onsubmit="return confirm('Tem certeza que deseja excluir este item?');">
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