@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="p-2">
            <hr>
            <h2 class="text-center">Revenu Mensuel de l'anneeé <span id="annee">2021</span></h2>
            <hr>
        </div>
            <div class="card">
            <div class="card-header">
                <select name="" id="years">
                    @foreach ($years as $year)


                    <option value="{{$year->year}}">{{$year->year}}</option>
                    @endforeach
                </select>
            </div>
            <!-- /.card-header -->
            <div id="idchart" class="card-body">
                <canvas id="myChart" width="400px" height="100px"></canvas>
            </div>
        </div>
        <div class="p-2">
            <hr>
            <h2 class="text-center">Nombre de commande Mensuel de l'anneeé <span id="annee1">2021</span></h2>
            <hr>
        </div>
            <div class="card">
            <div class="card-header">
                <select name="" id="years1">
                    @foreach ($years as $year)


                    <option value="{{$year->year}}">{{$year->year}}</option>
                    @endforeach
                </select>
            </div>
            <!-- /.card-header -->
            <div  class="card-body">
                <canvas id="monChart" width="400px" height="100px"></canvas>
            </div>
        </div>
        <div class="p-2">
            <hr>
            <h2 class="text-center">5 produits plus commandées</h2>
            <hr>
        </div>
        <div class="card">
            <div class="card-header">
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="myTable1" class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>Nombre commande</th>
                            <th>titre</th>
                            <th>image</th>
                            <th>quantité stock</th>

                        </tr>
                    </thead>
                    <tbody>


                            @foreach ($prods as $item)
                            <tr>
                                <td>{{$item->nmbr}}</td>
                            <td>{{$item->title}}</td>
                            <td><img height="50px" src="{{ asset('images/'.$item->image) }}">
                            <td>{{$item->in_stock}}</td>


                        </tr>
                        @endforeach
                        </tfoot>
                </table>

            </div>
        </div>
    </section>

</div>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
<script>
 var ctx = document.getElementById('myChart').getContext('2d');
 var ctx1 = document.getElementById('monChart').getContext('2d');
 var mydata1 = <?php echo json_encode( $sum,JSON_NUMERIC_CHECK) ?>;
 var mydata2 = <?php echo json_encode( $cmd,JSON_NUMERIC_CHECK) ?>;
 var myChart;
 var monChart;
 draw1();
 function draw1(){
     myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juillet', 'juin', 'Aout', 'Septembre', 'Ocobre', 'Nouvembre', 'Decembre'],
            datasets: [{
                label: 'Revenue mensuel',
                data:mydata1 ,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 120, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    }); }
    draw2();
 function draw2(){
     monChart = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juillet', 'juin', 'Aout', 'Septembre', 'Ocobre', 'Nouvembre', 'Decembre'],
            datasets: [{
                label: 'Nombre commande mensuel',
                data:mydata2 ,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 120, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
               
                }
            }
        }
    }); }




$('#years').on('change', function() {
        $.ajax({
        url: 'statisticB/'+$('#years').val(),
        success: function(data) {
     mydata1=data
     console.log(data)
     $('#annee').html($('#years').val())
       window.myChart.destroy();
       draw1();

        }
    });


})
$('#years1').on('change', function() {
        $.ajax({
        url: 'statisticC/'+$('#years1').val(),
        success: function(data) {
     mydata2=data
     console.log(data)
     $('#annee1').html($('#years1').val())
       window.monChart.destroy();
       draw2();

        }
    });


})
</script>
@endsection
