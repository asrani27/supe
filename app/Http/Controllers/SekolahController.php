<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use App\Sekolah;
use App\Siswa;
use App\Jabatan;
use Auth;
use Alert;

class SekolahController extends Controller
{
    public function pegawai()
    {
        $id_sekolah = Auth::user()->sekolah->id;
        $data_pegawai = Pegawai::where('sekolah_id', $id_sekolah)->get();
        return view('sekolah.pegawai.index',compact('data_pegawai'));
    }

    public function tambahpegawai()
    {
        $jabatan = Jabatan::all();
        return view('sekolah.pegawai.tambah',compact('jabatan'));
    }

    public function editpegawai($id)
    {
        $data = Pegawai::find($id);
        $jabatan = Jabatan::all();
        return view('sekolah.pegawai.edit',compact('jabatan','data'));
    }

    public function simpanpegawai(Request $req)
    {
        $id_sekolah = Auth::user()->sekolah->id;
        $s = new Pegawai;
        $s->nik = $req->nik;
        $s->nama = $req->nama;
        $s->alamat = $req->alamat;
        $s->jkel = $req->jkel;
        $s->telp = $req->telp;
        $s->jabatan_id = $req->jabatan_id;
        $s->sekolah_id = $id_sekolah;
        $s->save();
        Alert::success('Pegawai Berhasil Di Simpan', 'Pesan');
        return redirect('/pegawai');
    }
    
    public function updatepegawai(Request $req, $id)
    {
        $id_sekolah = Auth::user()->sekolah->id;
        $s          = Pegawai::find($id);
        $s->nik     = $req->nik;
        $s->nama    = $req->nama;
        $s->alamat  = $req->alamat;
        $s->jkel    = $req->jkel;
        $s->telp    = $req->telp;
        $s->jabatan_id = $req->jabatan_id;
        $s->sekolah_id = $id_sekolah;
        $s->save();
        Alert::success('Pegawai Berhasil Di Update', 'Pesan');
        return redirect('/pegawai');
    }

    public function deletepegawai($id)
    {
        $del = Pegawai::find($id)->delete();
        Alert::success('Pegawai Berhasil Di Hapus', 'Pesan');
        return back();
    }
    public function account()
    {
        $data = Auth::user()->sekolah;
        return view('sekolah.akun',compact('data'));
    }
    
    public function saveaccount(Request $req)
    {
        $id = Auth::user()->sekolah->id;
        if($req->password == null)
        {
            $u = Sekolah::find($id);
            $u->nama = $req->nama;
            $u->jml_pegawai = $req->jml_pegawai;
            $u->save();

            $d = $u->user;
            $d->email = $req->email;
            $d->save();
        }
        else
        {
            $u = Sekolah::find($id);
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

    public function siswa()
    {
        $data = Siswa::all();
        return view('sekolah.siswa.index',compact('data'));
    }
    
    public function tambahsiswa()
    {
        return view('sekolah.siswa.tambah');
    }

    public function simpansiswa(Request $req)
    {
        $id_sekolah = Auth::user()->sekolah->id;
        $s          = new Siswa;
        $s->nis     = $req->nis;
        $s->nama    = $req->nama;
        $s->alamat  = $req->alamat;
        $s->jkel    = $req->jkel;
        $s->nama_ayah    = $req->nama_ayah;
        $s->nama_ibu    = $req->nama_ibu;
        $s->status = $req->status;
        $s->sekolah_id = $id_sekolah;
        $s->save();
        Alert::success('Siswa Berhasil Di Simpan', 'Pesan');
        return redirect('/siswa');
    }

    public function editsiswa($id)
    {
        $data = Siswa::find($id);
        return view('sekolah.siswa.edit',compact('data'));
    }

    public function updatesiswa(Request $req, $id)
    {
        $s              = Siswa::find($id);
        $s->nis         = $req->nis;
        $s->nama        = $req->nama;
        $s->alamat      = $req->alamat;
        $s->jkel        = $req->jkel;
        $s->nama_ayah   = $req->nama_ayah;
        $s->nama_ibu    = $req->nama_ibu;
        $s->status      = $req->status;
        $s->save();
        Alert::success('Siswa Berhasil Di Perbaharui', 'Pesan');
        return redirect('/siswa');
    }

    public function deletesiswa($id)
    {
        $del = Siswa::find($id)->delete();
        Alert::success('Siswa Berhasil Di Hapus', 'Pesan');
        return back();
    }
}
