<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Alert;
use App\Skpd;
use App\FileWbk;
use App\FileWbbm;
use App\Kategori;
use App\Upload;
use App\FileUpload;
use App\Komponen;
use App\UploadKomponen;

class SkpdController extends Controller
{
    public function pencanangan()
    { 
        $id_skpd     = Auth::user()->skpd->id;
        $skpd        = Skpd::find($id_skpd);
        $kategori    = Kategori::where('jenis','zi')->get();
        $mapKategori = $kategori->map(function($item)use($id_skpd){
            $upload = Upload::where('skpd_id', $id_skpd)->where('kategori_id', $item->id)->get();
            $item->sesuai  = $upload->map(function($item){
                return count($item->fileupload->where('status',1));
            })->sum();
            $item->jml_upload = $upload->map(function($item){
                return count($item->fileupload);
            })->sum();
            return $item;
        });
        return view('skpd.pencanangan.index',compact('mapKategori','skpd','id_skpd'));
    }
    
    public function detailPencanangan($id_kategori)
    {
        $id_skpd  = Auth::user()->skpd->id;
        $skpd     = Skpd::find($id_skpd);
        $data     = Upload::where('skpd_id', $id_skpd)->where('kategori_id', $id_kategori)->get()->sortByDesc('id');
        $kategori = Kategori::find($id_kategori)->nama;
        $map = $data->map(function($item){
            $item->ada = $item->fileupload->where('status', 1)->count();
            return $item;
        });
        return view('skpd.pencanangan.detail',compact('map','id_skpd','skpd','id_kategori','kategori'));
    }

    public function updateFile(Request $req)
    {
        $s       = FileUpload::find($req->id_fileupload);
        $id_skpd = Auth::user()->skpd->id;
        
        if($req->hasfile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,999).$filename;
            $req->file->storeAs('/public/pencanangan/'.$id_skpd.'/',$filename);
        }
        $f = FileUpload::find($req->id_fileupload);
        $f->filename = $filename;
        $f->status = 0;
        $f->save();
        Alert::success('Berhasil Di Perbaharui', 'Pesan');
        return back();
    }
    
    public function uploadPC($id_kategori)
    {
        $id_skpd = Auth::user()->skpd->id;
        $jml_pegawai = Skpd::find($id_skpd)->jml_pegawai;
        return view('skpd.pencanangan.upload',compact('id_skpd','id_kategori','jml_pegawai'));
    }

    public function uploadPCsimpan(Request $req, $id_kategori)
    {
        
        $id_skpd        = Auth::user()->skpd->id;
        $u              = new Upload;
        $u->judul       = $req->judul;
        $u->skpd_id     = $id_skpd;
        $u->kategori_id = $id_kategori;
        $u->save();

        if($req->hasfile('file'))
        {
           foreach($req->file('file') as $file)
           {
            $filename = $file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,9999).$filename;
                        
            $file->storeAs('/public/pencanangan/'.$id_skpd,$filename);

            $fu = new FileUpload;
            $fu->filename = $filename;
            $fu->upload_id = $u->id;
            $fu->save();
           }
        }
        Alert::success('Upload Berhasil', 'Pesan');
        return redirect('/pencanangan/kategori/'.$id_kategori);   
    }

    public function deletePC($id_kategori, $id_upload)
    {
        $del = Upload::find($id_upload)->delete();
        Alert::success('Data Berhasil Di Hapus','Pesan');
        return back();
    }
   
    public function updateJudul(Request $req)
    {
        $u = Upload::find($req->id_judul);
        $u->judul = $req->judul;
        $u->save();
        Alert::success('Judul Berhasil Di Perbaharui', 'Pesan');
        return back();
    }

    public function deleteFileUpload($id)
    {
        $del = FileUpload::find($id)->delete();
        Alert::success('Data File Berhasil Di Hapus','Pesan');
        return back();
    }

    public function pembangunan()
    {
        $id_skpd = Auth::user()->skpd->id;
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
        
        return view('skpd.pembangunan.index',compact('skpd','map','id_skpd'));
    }

    public function uploadPB(Request $req)
    {
        $id_skpd = Auth::user()->skpd->id;
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

    public function deletePB($id)
    {
        $d = UploadKomponen::find($id)->delete();
        Alert::success('Berhasil Di Hapus', 'Pesan');
        return back();
    }
    
    public function updateFilePB(Request $req)
    {
        $id_skpd = Auth::user()->skpd->id;
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

    public function wbk()
    {        
        $id_skpd = Auth::user()->skpd->id;
        $skpd = Skpd::find($id_skpd);
        if($skpd->predikat == 'tidak ada'){
        Alert::error('Anda Belum Menyelesaikan Zona Integritas', 'Pesan');
        return back();
        }
        else{
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
            return view('skpd.wbk',compact('map','skpd','id_skpd'));
        }
    }
    
    public function uploadWBK(Request $req)
    {
        $id_skpd = Auth::user()->skpd->id;
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
    
    public function deleteWBK($id)
    {
        $del = FileWbk::find($id)->delete();
        Alert::success('Berhasil Di Hapus', 'Pesan');
        return back();
    }

    public function updateWBK(Request $req)
    {
        $id_skpd = Auth::user()->skpd->id;
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
    
    public function wbbm()
    {        
        $id_skpd = Auth::user()->skpd->id;
        $skpd = Skpd::find($id_skpd);
        
        if($skpd->predikat == 'tidak ada' OR $skpd->predikat == 'zi'){
        Alert::error('Anda Belum Menyelesaikan Wilayah Bebas Korupsi (WBK)', 'Pesan');
        return back();
        }
        else{
        $data = Kategori::where('jenis','wbbm')->get();
        $map = $data->map(function($item)use($id_skpd){
            $uk = $item->filewbbm->where('skpd_id', $id_skpd)->first();
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
        return view('skpd.wbbm',compact('map','skpd','id_skpd'));
        }
    }
    
    public function uploadWBBM(Request $req)
    {
        $id_skpd = Auth::user()->skpd->id;
        if($req->hasfile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,999).$filename;
            $req->file->storeAs('/public/wbbm/'.$id_skpd.'/',$filename);
        }

        $u = new FileWbbm;
        $u->skpd_id     = $id_skpd;
        $u->kategori_id = $req->kategori_id;
        $u->filename    = $filename;
        $u->save();
        
        Alert::success('Berhasil Di Simpan', 'Pesan');
        return back();
    }
    
    public function deleteWBBM($id)
    {
        $del = FileWbbm::find($id)->delete();
        Alert::success('Berhasil Di Hapus', 'Pesan');
        return back();
    }

    public function updateWBBM(Request $req)
    {
        $id_skpd = Auth::user()->skpd->id;
        if($req->hasfile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,999).$filename;
            $req->file->storeAs('/public/wbbm/'.$id_skpd.'/',$filename);
        }

        $u = FileWbbm::find($req->kategori_id);
        $u->filename    = $filename;
        $u->save();
        
        Alert::success('Berhasil Di Update ', 'Pesan');
        return back();
    }

    public function account()
    {
        $data = Auth::user()->skpd;
        return view('skpd.akun',compact('data'));
    }
    
    public function saveaccount(Request $req)
    {
        $id = Auth::user()->skpd->id;
        if($req->password == null)
        {
            $u = Skpd::find($id);
            $u->nama = $req->nama;
            $u->jml_pegawai = $req->jml_pegawai;
            $u->save();

            $d = $u->user;
            $d->email = $req->email;
            $d->save();
        }
        else
        {
            $u = Skpd::find($id);
            $u->nama = $req->nama;
            $u->jml_pegawai = $req->jml_pegawai;
            $u->save();

            $d = $u->user;
            $d->email = $req->email;
            $d->password = bcrypt($req->password);
            $d->save();
        }
        Alert::success('Skpd Berhasil Di update', 'Pesan');
        return back();
    }

    public function jumlahPegawai(Request $req)
    {
        $id_skpd = Auth::user()->skpd->id;
        $s = Skpd::find($id_skpd);
        $s->jml_pegawai = $req->jml_pegawai;
        $s->save();
        Alert::success('Jumlah Pegawai Berhasil Di Perbaharui', 'Pesan');
        return back();
    }
}
