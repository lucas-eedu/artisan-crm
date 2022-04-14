@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 class="m-0">Dashboard</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Dashboard v1</li>
               </ol>
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <!-- Small boxes (Stat box) -->
         <div class="row">
            <!-- Flash Message -->
            <div class="col-lg-12 col-12">
               @include('flash::message')
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-box-new">
                  <div class="inner">
                     <h3>{{$numberLeadsThisMonth}}</h3>
                     <p>Total de leads neste mês</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-bag"></i>
                  </div>
                  <a href="{{route('showListNewLeads')}}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-box-negotiation">
                  <div class="inner">
                     <h3>{{$numberNegotiationLeadsThisMonth}}</h3>
                     <p>Leads em negociação neste mês</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="{{route('showListNegotiationLeads')}}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-box-gain">
                  <div class="inner">
                     <h3>{{$numberGainLeadsThisMonth}}</h3>
                     <p>Leads ganhos neste mês</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-person-add"></i>
                  </div>
                  <a href="{{route('showListGainLeads')}}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-box-lost">
                  <div class="inner">
                     <h3>{{$numberLostLeadsThisMonth}}</h3>
                     <p>Leads perdidos neste mês</p>
                  </div>
                  <div class="icon">
                     <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="{{route('showListLostLeads')}}" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
               </div>
            </div>
            <!-- ./col -->
         </div>
         <!-- Charts -->
         <div class="row">
            <div class="col-md-12">
               <!-- BAR CHART -->
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">Relatório Geral</h3>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                           <i class="fas fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <div class="chart">
                        <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                     </div>
                  </div>
                  <!-- /.card-body -->
               </div>
            </div>
         </div>
         <!-- Charts -->
         <!-- DONUT CHART -->
         <!-- PIE CHART -->
         <!-- <div class="row">
            <div class="col-md-6">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">Melhor vendedor do mês</h3>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                           <i class="fas fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
               </div>
            </div>
            <div class="col-md-6">
               <div class="card">
                  <div class="card-header">
                     <h3 class="card-title">Melhor vendedor do ano</h3>
                     <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                           <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                           <i class="fas fa-times"></i>
                        </button>
                     </div>
                  </div>
                  <div class="card-body">
                     <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
               </div>
            </div>
         </div> -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
   $(function() {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      var areaChartData = {
         labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
         datasets: [{
               label: 'Negociação',
               backgroundColor: '#FFE933',
               borderColor: 'rgba(210, 214, 222, 1)',
               pointRadius: false,
               pointColor: 'rgba(210, 214, 222, 1)',
               pointStrokeColor: '#c1c7d1',
               pointHighlightFill: '#fff',
               pointHighlightStroke: 'rgba(220,220,220,1)',
               data: [
                  '{{$numberLeadsNegotiationPerMonth[1]}}',
                  '{{$numberLeadsNegotiationPerMonth[2]}}',
                  '{{$numberLeadsNegotiationPerMonth[3]}}',
                  '{{$numberLeadsNegotiationPerMonth[4]}}',
                  '{{$numberLeadsNegotiationPerMonth[5]}}',
                  '{{$numberLeadsNegotiationPerMonth[6]}}',
                  '{{$numberLeadsNegotiationPerMonth[7]}}',
                  '{{$numberLeadsNegotiationPerMonth[8]}}',
                  '{{$numberLeadsNegotiationPerMonth[9]}}',
                  '{{$numberLeadsNegotiationPerMonth[10]}}',
                  '{{$numberLeadsNegotiationPerMonth[11]}}',
                  '{{$numberLeadsNegotiationPerMonth[12]}}',
               ]
            },
            {
               label: 'Total',
               backgroundColor: '#33B8FF',
               borderColor: 'rgba(60,141,188,0.8)',
               pointRadius: false,
               pointColor: '#3b8bba',
               pointStrokeColor: 'rgba(60,141,188,1)',
               pointHighlightFill: '#fff',
               pointHighlightStroke: 'rgba(60,141,188,1)',
               data: [
                  '{{$numberLeadsPerMonth[1]}}',
                  '{{$numberLeadsPerMonth[2]}}',
                  '{{$numberLeadsPerMonth[3]}}',
                  '{{$numberLeadsPerMonth[4]}}',
                  '{{$numberLeadsPerMonth[5]}}',
                  '{{$numberLeadsPerMonth[6]}}',
                  '{{$numberLeadsPerMonth[7]}}',
                  '{{$numberLeadsPerMonth[8]}}',
                  '{{$numberLeadsPerMonth[9]}}',
                  '{{$numberLeadsPerMonth[10]}}',
                  '{{$numberLeadsPerMonth[11]}}',
                  '{{$numberLeadsPerMonth[12]}}',
               ]
            },
            {
               label: 'Ganhos',
               backgroundColor: '#4CD11D',
               borderColor: 'rgba(210, 214, 222, 1)',
               pointRadius: false,
               pointColor: 'rgba(210, 214, 222, 1)',
               pointStrokeColor: '#c1c7d1',
               pointHighlightFill: '#fff',
               pointHighlightStroke: 'rgba(220,220,220,1)',
               data: [
                  '{{$numberLeadsGainPerMonth[1]}}',
                  '{{$numberLeadsGainPerMonth[2]}}',
                  '{{$numberLeadsGainPerMonth[3]}}',
                  '{{$numberLeadsGainPerMonth[4]}}',
                  '{{$numberLeadsGainPerMonth[5]}}',
                  '{{$numberLeadsGainPerMonth[6]}}',
                  '{{$numberLeadsGainPerMonth[7]}}',
                  '{{$numberLeadsGainPerMonth[8]}}',
                  '{{$numberLeadsGainPerMonth[9]}}',
                  '{{$numberLeadsGainPerMonth[10]}}',
                  '{{$numberLeadsGainPerMonth[11]}}',
                  '{{$numberLeadsGainPerMonth[12]}}',
               ]
            },
            {
               label: 'Perdidos',
               backgroundColor: '#FF5733',
               borderColor: 'rgba(210, 214, 222, 1)',
               pointRadius: false,
               pointColor: 'rgba(210, 214, 222, 1)',
               pointStrokeColor: '#c1c7d1',
               pointHighlightFill: '#fff',
               pointHighlightStroke: 'rgba(220,220,220,1)',
               data: [
                  '{{$numberLeadsLostPerMonth[1]}}',
                  '{{$numberLeadsLostPerMonth[2]}}',
                  '{{$numberLeadsLostPerMonth[3]}}',
                  '{{$numberLeadsLostPerMonth[4]}}',
                  '{{$numberLeadsLostPerMonth[5]}}',
                  '{{$numberLeadsLostPerMonth[6]}}',
                  '{{$numberLeadsLostPerMonth[7]}}',
                  '{{$numberLeadsLostPerMonth[8]}}',
                  '{{$numberLeadsLostPerMonth[9]}}',
                  '{{$numberLeadsLostPerMonth[10]}}',
                  '{{$numberLeadsLostPerMonth[11]}}',
                  '{{$numberLeadsLostPerMonth[12]}}',
               ]
            },
         ]
      }

      //-------------
      //- DONUT CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      // var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
      // var donutData = {
      //    labels: [
      //       'Ana',
      //       'Lucas',
      //       'Antony',
      //       'Jhon',
      //       'Larissa',
      //       'Pedro',
      //    ],
      //    datasets: [{
      //       data: [700, 500, 400, 600, 300, 100],
      //       backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
      //    }]
      // }
      // var donutOptions = {
      //    maintainAspectRatio: false,
      //    responsive: true,
      // }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      // new Chart(donutChartCanvas, {
      //    type: 'doughnut',
      //    data: donutData,
      //    options: donutOptions
      // })

      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      // var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      // var pieData = donutData;
      // var pieOptions = {
      //    maintainAspectRatio: false,
      //    responsive: true,
      // }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      // new Chart(pieChartCanvas, {
      //    type: 'pie',
      //    data: pieData,
      //    options: pieOptions
      // })

      //-------------
      //- BAR CHART -
      //-------------
      var barChartCanvas = $('#barChart').get(0).getContext('2d')
      var barChartData = $.extend(true, {}, areaChartData)
      var temp0 = areaChartData.datasets[0]
      var temp1 = areaChartData.datasets[1]
      barChartData.datasets[0] = temp1
      barChartData.datasets[1] = temp0

      var barChartOptions = {
         responsive: true,
         maintainAspectRatio: false,
         datasetFill: false
      }

      new Chart(barChartCanvas, {
         type: 'bar',
         data: barChartData,
         options: barChartOptions
      })
   })
</script>
@endsection