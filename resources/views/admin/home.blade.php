@extends('admin.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <div class="content-header">
     <div class="container-fluid">
       <div class="row mb-2">
         <div class="col-sm-6">
           <h1 class="m-0">Dashboard</h1>
         </div><!-- /.col -->
         <div class="col-sm-6">
           <ol class="breadcrumb float-sm-right">

           </ol>
         </div><!-- /.col -->
       </div><!-- /.row -->
     </div><!-- /.container-fluid -->
   </div>
   <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <!-- Small boxes (Stat box) -->
       <div class="row">
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-info">
             <div class="inner">
               <h3>{{$cmd}}</h3>

               <p>Commandes</p>
             </div>
             <div class="icon">
               <i class="ion ion-bag"></i>
             </div>
             <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-success">
             <div class="inner">
               <h3>{{$cat}}</h3>

               <p>Categorie</p>
             </div>
             <div class="icon">
                <i class="fas fa-list-ol"></i>
             </div>
             <a href="{{route('admin.catlist')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-warning">
             <div class="inner">
               <h3>{{$prod}}</h3>

               <p>Produits</p>
             </div>
             <div class="icon">
                <i class="fab fa-product-hunt"></i>
             </div>
             <a href="{{route('admin.prodlist')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-danger">
             <div class="inner">
               <h3>{{$user}}</h3>

               <p>Utilisateur</p>
             </div>
             <div class="icon">
                <i class="ion ion-person-add"></i>
             </div>
             <a href="{{route('admin.userlist')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
         <div class="col-lg-3 col-6">
           <!-- small box -->
           <div class="small-box bg-success">
             <div class="inner">
               <h3>Statistique</h3>

               <p>.</p>
             </div>
             <div class="icon">
               <i class="ion ion-stats-bars"></i>
             </div>
             <a href="{{route('admin.statistic')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
           </div>
         </div>
       </div>

       <!-- /.row -->
       <!-- Main row -->
       <div class="row">
         <!-- Left col -->
         <section class="col-lg-7 connectedSortable">
         <section class="col-lg-5 connectedSortable">

           <!-- /.card -->
         </section>
         <!-- right col -->
       </div>
       <!-- /.row (main row) -->

     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->

@endsection
