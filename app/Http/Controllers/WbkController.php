<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\Kategori;
use App\Skpd;
use App\FileWbk;

class WbkController extends Controller
{
    public function index()
    {
        $data = Skpd::all();
        $map = $data->map(function($item){
            $item->sesuai = count($item->filewbk->where('status',1));
            return $item;
        });
        $jml_komponen = count(Kategori::where('jenis','wbk')->get());
        //dd($map, $jml_komponen);
        return view('superadmin.wbk.index',compact('map','jml_komponen'));
    }

    public function detail($id_skpd)
    {
        $skpd = Skpd::find($id_skpd);
        $data = Kategori::where('jenis','wbk')->get();
        $map = $data->map(function($item)use($id_skpd){
            $uk = $item->filewbk->where('skpd_id', $id_skpd)->first();
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
        return view('superadmin.wbk.detail',compact('map','skpd','id_skpd'));
    }

    public function upload(Request $req, $id_skpd)
    {
        if($req->hasfile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,999).$filename;
            $req->file->storeAs('/public/wbk/'.$id_skpd.'/',$filename);
        }

        $u = new FileWbk;
        $u->skpd_id     = $id_skpd;
        $u->kategori_id = $req->kategori_id;
        $u->filename    = $filename;
        $u->save();
        
        Alert::success('Berhasil Di Simpan', 'Pesan');
        return back();
    }

    public function deleteFile($id)
    {
        $del = FileWbk::find($id)->delete();
        Alert::success('Berhasil Di Hapus', 'Pesan');
        return back();
    }

    public function updateFile(Request $req, $id_skpd)
    {
        if($req->hasfile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,999).$filename;
            $req->file->storeAs('/public/wbk/'.$id_skpd.'/',$filename);
        }

        $u = FileWbk::find($req->kategori_id);
        $u->filename    = $filename;
        $u->save();
        
        Alert::success('Berhasil Di Update ', 'Pesan');
        return back();
    }
    
    public function ubahstatus (Request $req)
    {
        $fu = FileWbk::find($req->id_file);
        $fu->status = $req->status;
        $fu->keterangan = $req->keterangan;
        $fu->save();
        Alert::success('Status Berhasil Di Perbaharui','Pesan');
        return back();
    }

    public function isiNilai(Request $req)
    {
        $fu = FileWbk::find($req->id_nilai);
        $fu->nilai = $req->nilai;
        $fu->save();
        Alert::success('Nilai Berhasil Di Simpan','Pesan');
        return back();
    }

    public function updateNilai(Request $req)
    {
        $fu = FileWbk::find($req->id_nilai);
        $fu->nilai = $req->nilai;
        $fu->save();
        Alert::success('Nilai Berhasil Di Update','Pesan');
        return back();
    }

}
