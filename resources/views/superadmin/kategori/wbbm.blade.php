@extends('layouts.default')

@section('title', 'KATEGORI UPLOAD')

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
                <h4 class="panel-title">DAFTAR KATEGORI WBBM</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<div class="alert alert-secondary fade show">
                    <a href="#" data-toggle="modal"  class="btn btn-primary btn-xs  add-kategori"> <i class="fa fa-plus"></i> Tambah</a>
				</div>
				<!-- end alert -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="data-table-responsive" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">Nama Kategori</th>
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
								<td> 
									<a href="#" data-nama="{{$item->nama}}" data-bobot="{{$item->bobot}}"  data-id="{{$item->id}}"class="btn btn-primary btn-xs edit-kategori">edit</a>
									<a href="/masterdata/wbk/{{$item->id}}/delete" class="btn btn-danger btn-xs"  onclick="return confirm('Apakah anda Yakin ingin menghapus Data Ini?');">delete</a>
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

					<!-- #modal-dialog -->
					<div class="modal fade" id="modal-dialog">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Tambah Kategori</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <form action="/masterdata/wbbm" method="POST">
                                    @csrf
								<div class="modal-body">
									<p>
                                        <div class="form-group row m-b-15">
                                            <label class="col-md-3 col-form-label">Nama Kategori</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" required  name="nama">
                                            </div>
                                        </div>
									</p>
								</div>
								<div class="modal-footer">
									<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
									<button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                                </form>
							</div>
						</div>
					</div><!-- #modal-dialog -->
					<div class="modal fade" id="modal-dialog2">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title">Edit Kategori</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                <form action="/masterdata/wbbm/update" method="POST">
                                    @csrf
								<div class="modal-body">
									<p>
                                        <div class="form-group row m-b-15">
                                            <label class="col-md-3 col-form-label">Nama Kategori</label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" required  id="nama_kategori" name="nama">
                                                <input type="hidden" class="form-control" id="id_kategori" name="id_kategori">
                                            </div>
                                        </div>
									</p>
								</div>
								<div class="modal-footer">
									<a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
									<button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                                </form>
							</div>
						</div>
					</div>
@endsection

@push('scripts')
	<script src="/assets/plugins/datatables/js/jquery.dataTables.js"></script>
	<script src="/assets/plugins/datatables/js/dataTables.bootstrap4.js"></script>
	<script src="/assets/plugins/datatables/js/responsive/dataTables.responsive.js"></script>
	<script src="/assets/plugins/datatables/js/responsive/responsive.bootstrap4.js"></script>
	<script src="/assets/js/demo/ui-modal-notification.demo.js"></script>
	<script src="/assets/js/demo/table-manage-responsive.demo.js"></script>
	<script>
		$(document).ready(function() {
			
            $(document).on('click', '.add-kategori', function() {
            $('#modal-dialog').modal('show');
            });

            $(document).on('click', '.edit-kategori', function() {
    		$('#nama_kategori').val($(this).data('nama'));
    		$('#id_kategori').val($(this).data('id'));
            $('#modal-dialog2').modal('show');
            });
			TableManageResponsive.init();
			FormPlugins.init();
			Notification.init();
		});
	</script>
@endpush