<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Skpd;
use App\Upload;
use App\FileUpload;
use App\Komponen;
use Alert;
use Storage;

class PnController extends Controller
{
    public function index()
    {
        $data = Kategori::all();
        return view('skpd.pencanangan.index',compact('data'));
    }

    public function ziPencanangan($id_skpd)
    {
        $skpd = Skpd::find($id_skpd);
        $kategori = Kategori::where('jenis','zi')->get();
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
        //dd($mapKategori);
        return view('superadmin.zi.kategori',compact('data','id_skpd','skpd','mapKategori'));
    }
    
    public function detailUpload($id_skpd, $id_kategori)
    {   
        $skpd = Skpd::find($id_skpd);
        $data = Upload::where('skpd_id', $id_skpd)->where('kategori_id', $id_kategori)->get()->sortByDesc('id');
        $kategori = Kategori::find($id_kategori)->nama;
        return view('superadmin.zi.pencanangan',compact('data','id_skpd','skpd','id_kategori','kategori'));
    }

    public function zi()
    {
        $data = Skpd::all();
        $map = $data->map(function($item){
            $upload_id = $item->upload->where('kategori_id',1)->first();
            if($upload_id == null)
            {
                $item->sesuai = 0;
            }
            else
            {
                $item->sesuai = count($upload_id->fileupload->where('status',1));
            }
            $item->pb_sesuai = count($item->uploadkomponen->where('status',1));
            return $item;
        });
        $jml_komponen = count(Komponen::all());
        //dd($map, $jml_komponen);
        return view('superadmin.zi.index',compact('map','jml_komponen'));
    }  

    public function PencananganUpload($id_skpd, $id_kategori)
    {
        $jml_pegawai = Skpd::find($id_skpd)->jml_pegawai;
        return view('superadmin.zi.upload',compact('id_skpd','id_kategori','jml_pegawai'));
    }

    public function PencananganUploadSimpan(Request $req, $id_skpd, $id_kategori)
    {
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
        return redirect('/zi/pencanangan/skpd/'.$id_skpd.'/kategori/'.$id_kategori);
    }

    public function deleteUpload($id_skpd, $id_kategori, $id_upload)
    {
        $del = Upload::find($id_upload)->delete();
        Alert::success('Data Berhasil Di Hapus','Pesan');
        return back();
    }

    public function ubahstatus(Request $req)
    {
        $fu = FileUpload::find($req->id_fileupload);
        $fu->status = $req->status;
        $fu->keterangan = $req->keterangan;
        $fu->save();
        Alert::success('Status Berhasil Di Perbaharui','Pesan');
        return back();
    } 

    public function deleteFileUpload($id)
    {
        $del = FileUpload::find($id)->delete();
        Alert::success('Data File Berhasil Di Hapus','Pesan');
        return back();
    }

    public function previewFile($id_skpd, $id)
    {
        $pathToFile = 'storage/pencanangan/'.$id_skpd.'/'.FileUpload::find($id)->filename;
        return response()->file($pathToFile);
    }

    public function updateFile(Request $req)
    {

        $s = FileUpload::find($req->id_fileupload);
        $id_skpd = $s->upload->skpd_id;
        
        if($req->hasfile('file'))
        {
            $filename = $req->file->getClientOriginalName();
            $filename = date('d-m-Y-').rand(1,999).$filename;
            $req->file->storeAs('/public/pencanangan/'.$id_skpd.'/',$filename);
        }
        $f = FileUpload::find($req->id_fileupload);
        $f->filename = $filename;
        $f->save();
        Alert::success('Berhasil Di Perbaharui', 'Pesan');
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
    
}
