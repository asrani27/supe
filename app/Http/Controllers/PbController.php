<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\User;
use App\Skpd;
use App\Komponen;
use App\UploadKomponen;

class PbController extends Controller
{
    public function ziPembangunan($id_skpd)
    {
        $skpd = Skpd::find($id_skpd);
        $data = Komponen::all();
        $map = $data->map(function($item)use($id_skpd){
            $uk = $item->uploadkomponen->where('skpd_id', $id_skpd)->first();
            if($uk == null)
            {
                $item->filename = null;    
                $item->nilai = null;    
                $item->keterangan = null;    
            }
            else
            {
                $item->filename = $uk->filename;
                $item->nilai = $uk->nilai;
                $item->keterangan = $uk->keterangan;
                $item->upload_id = $uk->id;
                $item->status = $uk->status;
            }
            
            return $item;
        });
        
        return view('superadmin.zi.pembangunan',compact('skpd','map','id_skpd'));
    }

    public function PembangunanUploadSimpan(Request $req, $id_skpd)
    {
        if($req->hasfile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,999).$filename;
            $req->file->storeAs('/public/pembangunan/'.$id_skpd.'/',$filename);
        }

        $u = new UploadKomponen;
        $u->skpd_id     = $id_skpd;
        $u->komponen_id = $req->komponen_id;
        $u->filename    = $filename;
        $u->save();
        
        Alert::success('Berhasil Di Simpan', 'Pesan');
        return back();
    }

    public function deleteUploadKomponen($id)
    {
        $d = UploadKomponen::find($id)->delete();
        Alert::success('Berhasil Di Hapus', 'Pesan');
        return back();
    }

    public function updateFile(Request $req, $id_skpd)
    {
        if($req->hasfile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,999).$filename;
            $req->file->storeAs('/public/pembangunan/'.$id_skpd.'/',$filename);
        }

        $u = UploadKomponen::find($req->komponen_id);
        $u->filename    = $filename;
        $u->save();
        
        Alert::success('Berhasil Di Update ', 'Pesan');
        return back();
    }

    public function isiNilai(Request $req)
    {
        $fu = UploadKomponen::find($req->id_nilai);
        $fu->nilai = $req->nilai;
        $fu->save();
        Alert::success('Nilai Berhasil Di Simpan','Pesan');
        return back();
    }

    public function updateNilai(Request $req)
    {
        $fu = UploadKomponen::find($req->id_nilai);
        $fu->nilai = $req->nilai;
        $fu->save();
        Alert::success('Nilai Berhasil Di Update','Pesan');
        return back();
    }

    public function ubahstatus (Request $req)
    {
        $fu = UploadKomponen::find($req->id_uploadkomponen);
        $fu->status = $req->status;
        $fu->keterangan = $req->keterangan;
        $fu->save();
        Alert::success('Status Berhasil Di Perbaharui','Pesan');
        return back();
    }
}
