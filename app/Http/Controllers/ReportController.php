<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Sekolah;
use App\Siswa;
use App\Pegawai;

class ReportController extends Controller
{
    public function sekolah()
    {
        $sekolah = Sekolah::all();
        $data = $sekolah->map(function($item){
            $kepsek = $item->pegawai->where('jabatan_id', 1)->first();
            if($kepsek == null)
            {
                $item->kepsek = '';
            }
            else
            {
                $item->kepsek = $kepsek->nama;
            }
            return $item;
        });
        return view('superadmin.report.sekolah',compact('data'));
    }

    public function pdfsekolah()
    {
        $sekolah = Sekolah::all();
        $data = $sekolah->map(function($item){
            $kepsek = $item->pegawai->where('jabatan_id', 1)->first();
            if($kepsek == null)
            {
                $item->kepsek = '';
            }
            else
            {
                $item->kepsek = $kepsek->nama;
            }
            return $item;
        });
        $pdf = PDF::loadView('superadmin.report.pdfsekolah', compact('data'))->setPaper('f4','landscape');
        return $pdf->download('pdfsekolah.pdf');
    }

    public function pegawai()
    {
        $data = Sekolah::all();
        return view('superadmin.report.pegawai',compact('data'));
    }
    
    public function siswa()
    {
        return view('superadmin.report.siswa');
    }
    
    public function jmlpegawai()
    {
        return view('superadmin.report.jmlpegawai');
    }
    
    public function jmlsiswa()
    {
        return view('superadmin.report.jmlsiswa');
    }
}
