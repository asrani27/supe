@extends('layouts.default')

@section('title', 'Pencanangan')

@push('css')

@endpush

@section('content')
<div class="row">
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
				<h4 class="panel-title">DAFTAR SKPD MENUJU ZONA INTEGRITAS</h4>
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
								<th>SKPD</th>
								<th  width="150px">Aksi</th>
							</tr>
						</thead>
						<tbody>
                            <?php
                            $no =1;
                            ?>
                            @foreach ($map as $item)
							<tr>
                                <td width="5px">{{$no++}}</td>
								<td><h5 class="widget-table-title">{{$item->nama}}</h5>
									<?php
									if($item->sesuai >= $item->jml_pegawai){
										$skor_pc = 50;
									}
									if($item->jml_pegawai == 0){
										$skor_pc = 0;
									}
									else{
										$skor_pc = ($item->sesuai * 50) / $item->jml_pegawai;	
									}

									if($item->pb_sesuai == $jml_komponen){
										$skor_pb = 50;
									}
									else{
										$skor_pb = $item->pb_sesuai * 50 / $jml_komponen;
									}

									$skor_akhir = $skor_pc + $skor_pb;
									?>
									<div class="progress progress-sm rounded-corner m-b-5">
									<div class="progress-bar progress-bar-striped progress-bar-animated bg-green f-s-10 f-w-600" style="width: {{$skor_akhir}}%;">{{$skor_akhir}}%</div>
									</div>
									<div class="clearfix f-s-10">
											status: 
									<b class="text-inverse" data-id="widget-elm" data-light-class="text-inverse" data-dark-class="text-white">
										@if($item->predikat == 'zi' OR $item->predikat == 'wbk' OR $item->predikat == 'wbbm')
										Telah Mendapatkan Predikat Zona Integritas (ZI)
										@else
										Menuju Zona Integritas
										@endif
									</b>
									</div>
								</td>
								<td class="with-btn" nowrap ><br>
                                    <a href="/zi/pencanangan/skpd/{{$item->id}}" class="btn btn-sm btn-primary">Pencanangan</a>
									<a href="/zi/pembangunan/skpd/{{$item->id}}" class="btn btn-sm btn-warning">Pembangunan</a>
								</td>
							</tr>
                            @endforeach
						</tbody>
					</table>
				</div>
				<!-- end table-responsive -->
			</div>
		</div>
	</div>
</div>
@endsection

@push('scripts')
<script src="/assets/plugins/highlight/highlight.min.js"></script>
<script src="/assets/js/demo/render.highlight.js"></script>
<script>
	$(document).ready(function() {
		Highlight.init();
	});
</script>
@endpush

