@extends('layouts.default')

@section('title', 'SEKOLAH')

@push('css')

@endpush

@section('content')
	<!-- begin breadcrumb -->
	{{-- <ol class="breadcrumb pull-right">
		<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
		<li class="breadcrumb-item active">Dashboard</li>
	</ol> --}}
	<!-- end breadcrumb -->
	<!-- begin page-header -->
	<!-- end page-header -->
	<div class="row">
        <div class="col-md-12">
        <div class="note note-primary">
        <div class="note-icon"><i class="fab fa-safari"></i></div>
        <div class="note-content">
            <h4><b>Selamat Datang!, {{$data->name}} </b></h4> 
            <p>
                Silahkan Gunakan Menu Di Samping
            </p>
        </div>
       
        </div>
        </div>
	</div>
	<!-- end row -->
	<!-- begin row -->
	<!-- end row -->

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
