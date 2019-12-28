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
                <h4 class="panel-title">{{strtoupper($kategori)}} - {{strtoupper($skpd->nama)}}</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<div class="alert alert-secondary fade show">
                    <a href="/zi/pencanangan/skpd/{{$id_skpd}}" class="btn btn-danger btn-sm">Kembali</a>
                    <a href="/zi/pencanangan/skpd/{{$id_skpd}}/kategori/{{$id_kategori}}/upload" class="btn btn-success btn-sm">Upload</a>
				</div>
				<!-- end alert -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<div class="table-responsive table-bordered">
					<table id="data-table-responsive" class="table table-bordered">
						<thead>
							<tr>
								<th width="1%">No</th>
								<th class="text-nowrap">Judul</th>
								<th class="text-nowrap">Nama File</th>
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
								<td width=200px><strong><a href="#" class="edit-judul" data-id="{{$item->id}}" data-judul="{{$item->judul}}">{{$item->judul}}</a></strong></td>
                                <td>
									
										<?php
										$number = 1;
										?>
										<table border=0 class="table-condensed">
										@foreach ($item->fileupload as $item2)
										<tr>	
										<td width="5px">{{$number++}}</td>
										<td>{{$item2->filename}}</td>
										<td>{{$item2->keterangan}}</td>
										<td><a href="#" class="btn btn-xs btn-primary edit-status" data-id="{{$item2->id}}" data-status="{{$item2->status}}" data-keterangan="{{$item2->keterangan}}">
											@if($item2->status == 0)
											Dalam Proses
											@elseif($item2->status == 1)
											Sesuai
											@elseif($item2->status == 2)
											Belum Di Tindak Lanjuti
											@elseif($item2->status == 3)
											Tidak Sesuai
											@endif
											</a></td>
										<td>
											{{-- <a href="/fileupload/preview/{{$id_skpd}}/{{$item2->id}}" target="_blank" class="btn btn-xs btn-info">View</a>  --}}
											
											<a href="/storage/pencanangan/{{$id_skpd}}/{{$item2->filename}}" class="btn btn-xs btn-purple">Unduh</a> 
											
											<a href="#" class="btn btn-xs btn-warning edit-file" data-id="{{$item2->id}}" >Edit</a> 
											
											<a href="/fileupload/delete/{{$item2->id}}" class="btn btn-xs btn-danger" onclick="return confirm('Apakah anda Yakin ingin menghapus Data Ini?');">Delete</a> 
										</td>
										</tr>
										@endforeach
										</table>
								</td>
								<td> 
								<a href="/zi/pencanangan/skpd/{{$id_skpd}}/kategori/{{$id_kategori}}/delete/{{$item->id}}" class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda Yakin ingin menghapus Data Ini?');">Delete</a>
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
					<h4 class="modal-title">Edit Status</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form action="/zi/pencanangan/ubahstatus" method="POST">
					@csrf
				<div class="modal-body">
					<p>
						<div class="form-group row m-b-15">
							<label class="col-md-3 col-form-label">Status</label>
							<div class="col-md-8">
								<select class="form-control" id="status" name="status">
								</select>
								<input type="hidden" class="form-control" id="iddata" name="id_fileupload">
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
<div class="modal fade" id="modal-dialog-edit-file">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit File</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form action="/fileupload/update" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body">
					<p>
						<div class="form-group row m-b-15">
							<label class="col-md-3 col-form-label">File Baru</label>
							<div class="col-md-8">
								<input type="file" name="file" required>
								<input type="hidden" class="form-control" id="ideditfile" name="id_fileupload">
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
<div class="modal fade" id="modal-dialog-edit-judul">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Edit Judul</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				<form action="/fileupload/judul/update" method="POST" enctype="multipart/form-data">
					@csrf
				<div class="modal-body">
					<p>
						<div class="form-group row m-b-15">
							<label class="col-md-3 col-form-label">Judul</label>
							<div class="col-md-8">
								<input type="text" class="form-control" id="edit_judul" name="judul" required>
								<input type="hidden" class="form-control" id="ideditjudul" name="id_judul">
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
			
		$(document).on('click', '.edit-status', function() {
			$('#iddata').val($(this).data('id'));
			$('#keterangan').val($(this).data('keterangan'));
			$('#status').empty();
			var status = $(this).data('status');
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
			$('#status').append('<option value="0" >Dalam Proses</option>');
			$('#status').append('<option value="1">Sesuai</option>');
			$('#status').append('<option value="2">Belum Di Tindak Lanjuti</option>');
			$('#status').append('<option value="3" selected>Tidak Sesuai</option>');
			}
            $('#modal-dialog').modal('show');
		});
		
		$(document).on('click', '.edit-file', function() {
			$('#ideditfile').val($(this).data('id'));
            $('#modal-dialog-edit-file').modal('show');
		});
		$(document).on('click', '.edit-judul', function() {
			$('#ideditjudul').val($(this).data('id'));
			$('#edit_judul').val($(this).data('judul'));
            $('#modal-dialog-edit-judul').modal('show');
		});
		
		Highlight.init();
	});
</script>
@endpush

