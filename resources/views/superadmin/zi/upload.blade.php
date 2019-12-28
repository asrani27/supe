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
                <h4 class="panel-title">FORM UPLOAD</h4>
				</div>
				<!-- end panel-heading -->
				<!-- begin alert -->
				<div class="alert alert-secondary fade show">
					
				<form action="/simpanPegawai/{{$id_skpd}}" method="POST">
					@csrf
				<div class="form-group row">
					@if($jml_pegawai == 0 && $id_kategori ==  1)
					<div class="col-md-1">
						<a href="/zi/pencanangan/skpd/{{$id_skpd}}/kategori/{{$id_kategori}}" class="btn btn-danger">Kembali</a>
					</div>
					<div class="col-md-2">
						<input type="text" class="form-control" name="jml_pegawai" required onkeypress="return hanyaAngka(event)"/ placeholder="Masukkan Jumlah Pegawai">
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-success">Simpan</button>
					</div>
					@else
					<div class="col-md-1">
						<a href="/zi/pencanangan/skpd/{{$id_skpd}}/kategori/{{$id_kategori}}" class="btn btn-danger btn-sm">Kembali</a>
					</div>
					@endif
				</div>
				</form>
				</div>
				<!-- end alert -->
				<!-- begin panel-body -->
				@if($jml_pegawai == 0 && $id_kategori ==  1)
				@else

				<div class="panel-body">
					
				<form method="POST" action="/zi/pencanangan/skpd/{{$id_skpd}}/kategori/{{$id_kategori}}/upload" enctype="multipart/form-data">
                    @csrf
				<div class="form-group row m-b-15">
					<label class="col-form-label col-md-2">Keterangan</label>
					<div class="col-md-10">
						<textarea class="form-control" rows="3" name="judul" required></textarea>
					</div>
				</div>
				<div class="form-group row m-b-15">
						<label class="col-form-label col-md-2">File Upload</label>
						<div class="col-md-3">
							<div id="files">
							{{-- <input type="file" name="file[]"> --}}
							</div><br>
							<a href="javascript:_add_more();" class="btn btn-primary" title="Add more">+ Tambah File</a>
							
							<button type="submit" class="btn btn-success" >Simpan</button>
							<br>
							
						</div>
				</div>
				</form>
				</div>
				@endif
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
		function hanyaAngka(evt) {
		  var charCode = (evt.which) ? evt.which : event.keyCode
		   if (charCode > 31 && (charCode < 48 || charCode > 57))
 
		    return false;
		  return true;
		}
	</script>
<script>

	function _add_more() {
	//files.appendChild(document.createElement("br"));
	var del = document.createElement("a");
    del.appendChild(document.createTextNode("Delete"));
    del.href="#"; 

	document.getElementById("files").appendChild(del);

	var extra = document.createElement('input');
	extra.type="file";
	extra.name="file[]";
	document.getElementById("files").appendChild(extra);

	del.addEventListener('click', function(event){

		del.parentElement.removeChild(del);
		extra.parentElement.removeChild(extra);
		event.preventDefault();
	});
	}
	$(document).ready(function() {
		Highlight.init();
	});
</script>

@endpush

