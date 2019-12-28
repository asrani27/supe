@extends('layouts.default')

@section('title', 'DAFTAR SEKOLAH')

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
                <h4 class="panel-title">DAFTAR PEGAWAI</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<div class="alert alert-secondary fade show">
                    <a href="/pegawai/tambah" class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> Tambah</a>
				</div>
				<!-- end alert -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="data-table-responsive" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">NIK</th>
								<th class="text-nowrap">Nama</th>
								<th class="text-nowrap">Jkel</th>
								<th class="text-nowrap">Jabatan</th>
								<th class="text-nowrap">Telp</th>
								<th class="text-nowrap">Aksi</th>
							</tr>
						</thead>
						<tbody>
                            @php
                            $no = 1; 
                            @endphp
                            @foreach ($data_pegawai as $item)
							<tr class="odd gradeX">
                                <td width="1%" class="f-s-600 text-inverse">{{$no++}}</td>
								<td>{{$item->nik}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->jkel}}</td>
                                <td>{{$item->jabatan->nama}}</td>
                                <td>{{$item->telp}}</td>
								<td> 
									<a href="/pegawai/{{$item->id}}/edit" class="btn btn-primary btn-xs">edit</a>
									<a href="/pegawai/{{$item->id}}/delete" class="btn btn-danger btn-xs">delete</a>
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