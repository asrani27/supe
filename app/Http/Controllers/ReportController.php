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

    public function pdfpegawai($id)
    {
        $sekolah = Sekolah::find($id);
        $data = $sekolah->pegawai;
        //dd($data);
        $pdf = PDF::loadView('superadmin.report.pdfpegawai', compact('data'))->setPaper('f4','landscape');
        return $pdf->download('pdfpegawai.pdf');
    }
    
    public function pdfsiswa($id)
    {
        $sekolah = Sekolah::find($id);
        $data = $sekolah->siswa;
        //dd($data);
        $pdf = PDF::loadView('superadmin.report.pdfsiswa', compact('data'))->setPaper('f4','landscape');
        return $pdf->download('pdfsiswa.pdf');
    }

    public function pegawai()
    {
        $data = Sekolah::all();
        return view('superadmin.report.pegawai',compact('data'));
    }
    
    public function siswa()
    {
        $data = Sekolah::all();
        return view('superadmin.report.siswa',compact('data'));
    }
    
    public function jmlpegawai()
    {
        $data = Sekolah::all();
        $map = $data->map(function($item, $key){
            $item->jml_pegawai = count($item->pegawai);
            return $item;
        });
        return view('superadmin.report.jmlpegawai',compact('map'));
    }
    
    public function pdfjmlp()
    {
        $data = Sekolah::all();
        $map = $data->map(function($item, $key){
            $item->jml_pegawai = count($item->pegawai);
            return $item;
        });
        $pdf = PDF::loadView('superadmin.report.pdfjmlp', compact('map'))->setPaper('f4','landscape');
        return $pdf->download('jumlahpegawai.pdf');
    }
    
    public function pdfjmls()
    {
        $data = Sekolah::all();
        $map = $data->map(function($item, $key){
            $item->jml_siswa = count($item->siswa);
            return $item;
        });
        $pdf = PDF::loadView('superadmin.report.pdfjmls', compact('map'))->setPaper('f4','landscape');
        return $pdf->download('jumlahsiswa.pdf');
    }

    public function jmlsiswa()
    {
        $data = Sekolah::all();
        $map = $data->map(function($item, $key){
            $item->jml_siswa = count($item->siswa);
            return $item;
        });
        return view('superadmin.report.jmlsiswa',compact('map'));
    }
}
