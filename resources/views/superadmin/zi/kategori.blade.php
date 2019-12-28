@extends('layouts.default')

@section('title', 'Pencanangan')

@push('css')

@endpush

@section('content')
<div class="row">
		<!-- begin col-10 -->
		<div class="col-lg-12">
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
                <h4 class="panel-title">DAFTAR KATEGORI - {{strtoupper($skpd->nama)}}</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<div class="alert alert-secondary fade show">
                    <a href="/zi" class="btn btn-danger btn-sm">Kembali</a>
                    {{-- <a href="/zi/pencanangan/skpd/{{$id_skpd}}/upload" class="btn btn-success btn-sm">Upload</a> --}}
				</div>
				<!-- end alert -->
				<!-- begin panel-body -->
				<div class="panel-body">
						<div class="table-responsive table-bordered">
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th width="80%" class="text-nowrap">Kategori</th>
								<th class="text-nowrap">Total Upload</th>
								<th class="text-nowrap">Aksi</th>
							</tr>
						</thead>
						<tbody>
                            @php
                            $no = 1; 
                            @endphp
                            @foreach ($mapKategori as $item)
							<tr class="odd gradeX">
                                <td width="1%" class="f-s-600 text-inverse">{{$no++}}</td>
								<td><h5>{{$item->nama}}</h5>
								@if($item->id == 1)
								 Jumlah Pegawai : {{strtoupper($skpd->jml_pegawai)}} orang <br />
								 <?php
								 $sesuai = $item->sesuai;
								 $jml_pegawai = $skpd->jml_pegawai;
								 if($sesuai >= $jml_pegawai)
								 {
									$skor = 100;
								 }
								 if($jml_pegawai == 0)
								 {
									$skor = 0;
								 } 
								 else {
									$skor = $sesuai * 100 / $jml_pegawai;	 
								 }
								 ?>
								<div class="progress progress-sm rounded-corner m-b-5">
								<div class="progress-bar progress-bar-striped progress-bar-animated bg-orange f-s-10 f-w-600" style="width: {{$skor}}%;">{{$skor}}%</div>
								</div>
								@else
								@endif
								</td>
								<td class="text-center "><h5>{{$item->jml_upload}}</h5></td>
								<td> 
								<a href="/zi/pencanangan/skpd/{{$id_skpd}}/kategori/{{$item->id}}" class="btn btn-primary btn-xs">Detail</a>
                                </td>
							</tr>
                            @endforeach
                        </tbody>
					</table>
						</div>
				</div>
				<!-- end panel-body -->
			</div>
			<!-- end panel -->
		</div>
		<!-- end col-10 -->
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

