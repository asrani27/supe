@extends('layouts.default')

@section('title', 'SKPD')

@push('css')
<link href="/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.css" rel="stylesheet" />
<link href="/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
<link href="/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />

@endpush

@section('content')
	<!-- begin breadcrumb -->
	{{-- <ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
		<li class="breadcrumb-item active">Dashboard</li>
	</ol> --}}
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<h1 class="page-header">User : {{$data->name}} </h1>
	<!-- end page-header -->
	
	<!-- begin row -->
	<div class="row">
		<!-- begin col-3 -->
		<div class="col-lg-6 col-md-6">
			<div class="widget widget-stats bg-red">
				<div class="stats-icon"><i class="fa fa-desktop"></i></div>
				<div class="stats-info">
					<h4>TOTAL SEKOLAH</h4>
					<p>{{$sekolah}}</p>	
				</div>
				<div class="stats-link">
					<a href="/masterdata/sekolah">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		{{-- <div class="col-lg-3 col-md-6">
			<div class="widget widget-stats bg-orange">
				<div class="stats-icon"><i class="fa fa-link"></i></div>
				<div class="stats-info">
					<h4>TOTAL UPLOAD</h4>
					<p>257 MB</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div> --}}
		<!-- end col-3 -->
		<!-- begin col-3 -->
		<div class="col-lg-6 col-md-6">
			<div class="widget widget-stats bg-grey-darker">
				<div class="stats-icon"><i class="fa fa-users"></i></div>
				<div class="stats-info">
					<h4>TOTAL USER</h4>
					<p>{{$user}}</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div>
		<!-- end col-3 -->
		<!-- begin col-3 -->
		{{-- <div class="col-lg-3 col-md-6">
			<div class="widget widget-stats bg-black-lighter">
				<div class="stats-icon"><i class="fa fa-clock"></i></div>
				<div class="stats-info">
					<h4>JAM </h4>
					<p>00:12:23</p>	
				</div>
				<div class="stats-link">
					<a href="javascript:;">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
				</div>
			</div>
		</div> --}}
  <!-- end widget-table -->
	</div>
	<!-- end row -->
	<!-- begin row -->
	<!-- end row -->

	
{{-- <div class="row">
	<div class="col-lg-12">
		<!-- begin panel -->
		<div class="panel panel-inverse" data-sortable-id="table-basic-7">
			<!-- begin panel-heading -->
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">PROGRESS SKPD MENUJU WBBM</h4>
			</div>
			<!-- end panel-heading -->
			<!-- begin panel-body -->
			<div class="panel-body">
				<!-- begin table-responsive -->
				<div class="table-responsive table-bordered">
					<table class="table table-striped m-b-0 ">
						<thead>
							<tr>
								<th>No</th>
								<th>Logo</th>
								<th>SKPD</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td class="with-img">
									<img src="/assets/logobjm.png" class="img-rounded height-50" />
								</td>
								<td><h5 class="widget-table-title">Dinas Komunikasi, Informatika Dan Statistik</h5>
									<div class="progress progress-sm rounded-corner m-b-5">
										<div class="progress-bar progress-bar-striped progress-bar-animated bg-orange f-s-10 f-w-600" style="width: 30%;">30%</div>
									</div>
									<div class="clearfix f-s-10">
											status: 
									<b class="text-inverse" data-id="widget-elm" data-light-class="text-inverse" data-dark-class="text-white">Verifikasi</b>
									</div>
								</td>
								<td class="with-btn" nowrap>
									<a href="#" class="btn btn-sm btn-primary rounded-corner">Detail</a>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td class="with-img">
									<img src="/assets/logobjm.png" class="img-rounded height-50" />
								</td>
								<td><h5 class="widget-table-title">Dinas Pariwisata</h5>
									<div class="progress progress-sm rounded-corner m-b-5">
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-success f-s-10 f-w-600" style="width: 100%;">100%</div>
									</div>
									<div class="clearfix f-s-10">
											status: 
									<b class="text-inverse" data-id="widget-elm" data-light-class="text-inverse" data-dark-class="text-white">Selesai</b>
									</div>
								</td>
								<td class="with-btn" nowrap>
									<a href="#" class="btn btn-sm btn-primary rounded-corner">Detail</a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td class="with-img">
									<img src="/assets/logobjm.png" class="img-rounded height-50" />
								</td>
								<td><h5 class="widget-table-title">Dinas Kepegawaian</h5>
									<div class="progress progress-sm rounded-corner m-b-5">
											<div class="progress-bar progress-bar-striped progress-bar-animated bg-indigo f-s-10 f-w-600" style="width: 74%">74%</div>
									</div>
									<div class="clearfix f-s-10">
											status: 
									<b class="text-inverse" data-id="widget-elm" data-light-class="text-inverse" data-dark-class="text-white">dalam proses</b>
									</div>
								</td>
								<td class="with-btn" nowrap>
									<a href="#" class="btn btn-sm btn-primary rounded-corner">Detail</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- end table-responsive -->
			</div>
		</div>
	</div>
</div> --}}
@endsection

@push('scripts')
<script src="/assets/plugins/highlight/highlight.min.js"></script>
<script src="/assets/js/demo/render.highlight.js"></script>
<script src="/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="/assets/js/demo/dashboard-v1.js"></script>
<script>
	$(document).ready(function() {
		Highlight.init();
		Dashboard.init();
	});
</script>
@endpush
