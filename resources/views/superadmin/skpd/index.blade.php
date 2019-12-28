@extends('layouts.default')

@section('title', 'DAFTAR SKPD')

@push('css')
	<link href="/assets/plugins/datatables/css/dataTables.bootstrap4.css" rel="stylesheet" />
	<link href="/assets/plugins/datatables/css/responsive/responsive.bootstrap4.css" rel="stylesheet" />
@endpush

@section('content')
	<!-- begin row -->
	<div class="row">
		<!-- begin col-10 -->
		<div class="col-lg-12">
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
                <h4 class="panel-title">DAFTAR SKPD PEMERINTAH KOTA BANJARMASIN</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<div class="alert alert-secondary fade show">
                    <a href="/masterdata/skpd/tambah" class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> Tambah SKPD</a>
				</div>
				<!-- end alert -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="data-table-responsive" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">Nama SKPD</th>
								<th class="text-nowrap">Username</th>
								<th class="text-nowrap">Jml Pegawai</th>
								<th class="text-nowrap">Predikat</th>
								<th class="text-nowrap">Aksi</th>
							</tr>
						</thead>
						<tbody>
                            @php
                            $no = 1; 
                            @endphp
                            @foreach ($data as $item)
							<tr class="odd gradeX">
                                <td width="1%" class="f-s-600 text-inverse">{{$no++}}</td>
								<td>{{$item->nama}}</td>
                                <td>{{$item->user->username}}</td>
                                <td>{{$item->jml_pegawai}}</td>
                                <td>{{$item->predikat}}</td>
								<td> 
									<a href="/masterdata/skpd/{{$item->id}}/edit" class="btn btn-primary btn-xs">edit</a>
									<a href="/masterdata/skpd/{{$item->id}}/delete" class="btn btn-danger btn-xs">delete</a>
                                </td>
							</tr>
                            @endforeach
                        </tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>
			<!-- end panel -->
		</div>
		<!-- end col-10 -->
	</div>
	<!-- end row -->
@endsection

@push('scripts')
	<script src="/assets/plugins/datatables/js/jquery.dataTables.js"></script>
	<script src="/assets/plugins/datatables/js/dataTables.bootstrap4.js"></script>
	<script src="/assets/plugins/datatables/js/responsive/dataTables.responsive.js"></script>
	<script src="/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script>
	<script>
		$(document).ready(function() {

			TableManageResponsive.init();
		});
	</script>
@endpush