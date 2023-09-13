<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MySQL Data to Excel Export - Laravel</title>
		<!-- favicon-->
		<link rel="shortcut icon" href="{{asset('public/images/favicon.ico')}}" type="image/x-icon">
		<link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/x-icon">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('public/assets/css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('public/assets/css/excel-export.css')}}" />
    </head>
    <body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="header">
						<div class="logo"><img src="{{asset('public/images/logo.png')}}" /></div>
						<h2>MySQL Data to Excel Export - Laravel</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<div class="panel-area">
						<div class="panel-header">
							<div class="header-title">Tables Export</div>
						</div>
						<div class="panel-content">
							<ul class="nav nav-list">
								<li><a href="{{url('/')}}">Basic</a></li>
								<li class="active"><a href="{{url('row-grouping')}}">Row Grouping</a></li>
								<li><a href="{{url('header-rows-columns-merge')}}">Header (Rows and Columns Merge)</a></li>
								<li><a href="{{url('autofilter-range-of-cells')}}">Autofilter Range of Cells</a></li>
								<li><a href="{{url('formula-calculations')}}">Formula Calculations</a></li>
								<li><a href="{{url('protected-and-unprotected-on-cells')}}">Protected and Unprotected on Cells</a></li>
							</ul>
						</div>
						<div class="panel-header">
							<div class="header-title">Images Export</div>
						</div>
						<div class="panel-content">
							<ul class="nav nav-list">
								<li><a href="{{url('image-with-description')}}">Image With Description</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					<div class="panel-area">
						<div class="panel-header">
							<div class="inner-panel">
								<h5 class="rules-title">Row Grouping</h5>
								<a href="{{url('row-grouping-excel')}}" class="btn btn-primary pull-right">
									<span class="glyphicon glyphicon-export" aria-hidden="true"></span> Excel Export
								</a>
							</div>
						</div>
						<div class="panel-content">
							<div class="table-responsive">
								<table class="table table-bordered table-hover" cellspacing="0" width="100%">
									<thead> 
										<tr>
											<th class="text-center" style="width:5%;">#</th>
											<th style="width:35%;">Item Name</th> 
											<th style="width:20%;">Item Code</th> 
											<th class="text-right" style="width:20%;">Price</th> 
											<th class="text-right" style="width:20%;">Quantity</th> 
										</tr> 
									</thead> 
									<tbody>
										@php
											$tempDate = '';
										@endphp
										@foreach($data as $key => $row)
											@if($tempDate!= $row->Date)
											<tr> 
												<td style="background-color:#f3faf6;" colspan="7">{{$row->Date}}</td> 
											</tr>
											@php
												$tempDate = $row->Date;
											@endphp
											@endif
											<tr> 
												<td class="text-center">{{$key+1}}</td> 
												<td>{{$row->ItemName}}</td> 
												<td>{{$row->ItemCode}}</td> 
												<td class="text-right">{{number_format($row->Price, 2)}}</td> 
												<td class="text-right">{{number_format($row->Quantity)}}</td>
											</tr>
										@endforeach
									</tbody> 
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="{{asset('public/assets/js/jquery-3.2.1.min.js')}}"></script>
		<script src="{{asset('public/assets/js/bootstrap.min.js')}}"></script>		
    </body>
</html>
