<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>LAPORAN JUMLAH PEGAWAI</title>
<style type="text/css">
    .auto-style1 {
        border-width: 0px;
    }
    .auto-style2 {
        border-style: solid;
        border-width: 1px;
        padding:5px;
    }
    </style>
    
</head>

<body>

<p>LAPORAN JUMLAH PEGAWAI</p>
<table style="width: 100%" border=1 cellspacing=0 cellpadding=0>
	<tr>
		<td class="auto-style2">No</td>
		<td class="auto-style2">Nama Sekolah</td>
		<td class="auto-style2">Jumlah Pegawai</td>
	</tr>
    @php
    $no = 1; 
    @endphp
    @foreach ($map as $item)
    <tr class="odd gradeX">
        <td width="1%" class="f-s-600 text-inverse">{{$no++}}</td>
        <td class="auto-style2" >{{$item->nama}}</td>
        <td class="auto-style2" >{{$item->jml_sekolah}}</td>
    </tr>
    @endforeach
</table>

</body>

</html>
