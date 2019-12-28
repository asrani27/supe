@extends('layouts.default')

@section('title', 'Pembangunan')

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
                <h4 class="panel-title">WBK - {{strtoupper($skpd->nama)}}</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<div class="alert alert-secondary fade show">
                    <a href="/wbbm" class="btn btn-danger btn-sm">Kembali</a>
                </div>
				<!-- end alert -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<div class="table-responsive table-bordered">
					<table id="data-table-responsive" class="table table-bordered">
						<thead>
							<tr>
								<th width="1%">NO</th>
								<th class="text-nowrap">NAMA KATEGORI</th>
								<th class="text-nowrap">NILAI</th>
								<th class="text-nowrap">KETERANGAN</th>
								<th class="text-nowrap">FILE</th>
								<th class="text-nowrap">STATUS</th>
								<th class="text-nowrap">AKSI</th>
							</tr>
						</thead>
						<tbody>
                            @php
                            $no = 1; 
                            @endphp
                            @foreach ($map as $item)
							<tr class="odd gradeX">
                                <td width="1%" class="f-s-600 text-inverse">{{$no++}}</td>
                                <td>{{$item->nama}}</td>
                                <td class="text-center" >
									@if($item->filename == null)
									-
									@else
										@if($item->nilai == null)
										<a href="#" class="btn btn-xs btn-primary isi-nilai" data-id="{{$item->upload_id}}">Isi Nilai</a>
										@else
										<a href="#" class="edit-nilai" data-id="{{$item->upload_id}}" data-nilai="{{$item->nilai}}"><strong>{{$item->nilai}}</strong></a>
										@endif
									@endif
								</td>
                                <td>{{$item->keterangan}}</td>
                                <td>{{$item->filename}}</td>
                                <td>
									
									@if($item->filename == null)
									-
									@else
										@if($item->status == 0)
										<a href="#" class="btn btn-xs btn-primary edit-status" data-id="{{$item->upload_id}}" data-status="{{$item->status}}" data-keterangan="{{$item->keterangan}}">Dalam Proses</a>
										@elseif($item->status == 1)
										<a href="#" class="btn btn-xs btn-primary edit-status" data-id="{{$item->upload_id}}" data-status="{{$item->status}}" data-keterangan="{{$item->keterangan}}">Sesuai</a>
										@elseif($item->status == 2)
										<a href="#" class="btn btn-xs btn-primary edit-status" data-id="{{$item->upload_id}}" data-status="{{$item->status}}" data-keterangan="{{$item->keterangan}}">Belum Di Tidak Lanjuti</a>
										@elseif($item->status == 3)
										<a href="#" class="btn btn-xs btn-primary edit-status" data-id="{{$item->upload_id}}" data-status="{{$item->status}}" data-keterangan="{{$item->keterangan}}">Tidak Sesuai</a>
										@endif
									@endif
								</td>
                                <td>
									@if($item->filename == null)
									<a href="#" class="btn btn-xs btn-primary add-upload" data-id="{{$item->id}}">Upload</a>
									@else
									<a href="/storage/wbbm/{{$id_skpd}}/{{$item->filename}}" target="_blank" class="btn btn-xs btn-purple">Unduh</a>
									<a href="#" class="btn btn-xs btn-warning edit-upload" data-id="{{$item->upload_id}}">Edit</a>		
									<a href="/filewbbm/delete/{{$item->upload_id}}" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda Yakin ingin menghapus Data Ini?');">Delete</a> 	
									@endif
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
<div class="modal fade" id="modal-dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Upload File</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
                <form action="/wbbm/skpd/{{$id_skpd}}" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body">
					<p>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-form-label">FILE :</label>
							<div class="col-md-8">
								<input type="file" class="form-control" name="file" id="upload_file" required>
								<input type="hidden" class="form-control" id="kategori_id" name="kategori_id" readonly>
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
<div class="modal fade" id="modal-dialog-edit-file">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit File</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form action="/filewbbm/update/{{$id_skpd}}" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body">
					<p>
						<div class="form-group row m-b-15">
							<label class="col-md-3 col-form-label">File Baru</label>
							<div class="col-md-8">
								<input type="file" name="file" required>
								<input type="hidden" class="form-control" id="edit_komponen_id" name="kategori_id" readonly>
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
<div class="modal fade" id="modal-dialog-isi-nilai">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">ISI NILAI</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form action="/wbbm/nilai/{{$id_skpd}}" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body">
					<p>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-form-label">Nilai</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="nilai" name="nilai" required>
								<input type="hidden" class="form-control" id="id_nilai" name="id_nilai">
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
<div class="modal fade" id="modal-dialog-edit-nilai">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">EDIT NILAI</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form action="/wbbm/nilai/{{$id_skpd}}/update" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body">
					<p>
						<div class="form-group row m-b-15">
							<label class="col-md-2 col-form-label">Nilai</label>
							<div class="col-md-6">
								<input type="text" class="form-control" id="nilai_edit" name="nilai" required>
								<input type="hidden" class="form-control" id="id_nilai_edit" name="id_nilai">
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
<div class="modal fade" id="modal-dialog-edit-status">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">EDIT STATUS</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form action="/wbbm/ubahstatus" method="POST">
					@csrf
				<div class="modal-body">
					<p>
						<div class="form-group row m-b-15">
							<label class="col-md-3 col-form-label">Status</label>
							<div class="col-md-8">
								<select class="form-control" id="status" name="status">
								</select>
								<input type="hidden" class="form-control" id="id_file" name="id_file" readonly>
							</div>
						</div>
						<div class="form-group row m-b-15">
							<label class="col-md-3 col-form-label">Keterangan</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="keterangan" name="keterangan">
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
<script src="/assets/plugins/highlight/highlight.min.js"></script>
<script src="/assets/js/demo/render.highlight.js"></script>
<script>
	$(document).ready(function() {
			
		$(document).on('click', '.add-upload', function() {
			$('#kategori_id').val($(this).data('id'));
            document.getElementById("upload_file").value = null;
            $('#modal-dialog').modal('show');
		});
		
		$(document).on('click', '.edit-upload', function() {
			$('#edit_komponen_id').val($(this).data('id'));
            $('#modal-dialog-edit-file').modal('show');
		});
		$(document).on('click', '.isi-nilai', function() {
			$('#id_nilai').val($(this).data('id'));
            document.getElementById("nilai").value = null;
            $('#modal-dialog-isi-nilai').modal('show');
		});

		$(document).on('click', '.edit-status', function() {
			$('#id_file').val($(this).data('id'));
			$('#status').empty();
			var status = $(this).data('status');
			console.log(status);
			if(status === 0)
			{
			$('#status').append('<option value="0" selected>Dalam Proses</option>');
			$('#status').append('<option value="1">Sesuai</option>');
			$('#status').append('<option value="2">Belum Di Tindak Lanjuti</option>');
			$('#status').append('<option value="3">Tidak Sesuai</option>');
			}
			else if(status === 1)
			{
			$('#status').append('<option value="0" >Dalam Proses</option>');
			$('#status').append('<option value="1" selected>Sesuai</option>');
			$('#status').append('<option value="2">Belum Di Tindak Lanjuti</option>');
			$('#status').append('<option value="3">Tidak Sesuai</option>');
			}
			else if(status === 2)
			{
			$('#status').append('<option value="0" >Dalam Proses</option>');
			$('#status').append('<option value="1">Sesuai</option>');
			$('#status').append('<option value="2" selected>Belum Di Tindak Lanjuti</option>');
			$('#status').append('<option value="3">Tidak Sesuai</option>');
			}
			else if(status === 3)
			{
			$('#status').append('<option value="0">Dalam Proses</option>');
			$('#status').append('<option value="1">Sesuai</option>');
			$('#status').append('<option value="2">Belum Di Tindak Lanjuti</option>');
			$('#status').append('<option value="3" selected>Tidak Sesuai</option>');
			}
            $('#modal-dialog-edit-status').modal('show');
		});
		
		$(document).on('click', '.edit-nilai', function() {
			$('#id_nilai_edit').val($(this).data('id'));
			$('#nilai_edit').val($(this).data('nilai'));
            $('#modal-dialog-edit-nilai').modal('show');
		});
		Highlight.init();
	});
</script>
@endpush

