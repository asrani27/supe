<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sekolah;
use App\Role;
use App\Jabatan;
use App\Komponen;
use App\FrontPage;
use App\User;
use Alert;

class MasterDataController extends Controller
{
    public function sekolah()
    {
        $data = Sekolah::all();
        return view('superadmin.sekolah.index',compact('data'));
    }

    public function style()
    {
        $data = FrontPage::first();
        return view('superadmin.style',compact('data'));
    }
    
    public function logo($req)
    {
        $logoname = $req->logo->getClientOriginalName();
        $logoname = date('d-m-Y-').rand(1,9999).$logoname;
        $req->logo->storeAs('/public',$logoname);
        return $logoname;
    }

    public function wallpaper($req)
    {
        $wallpapername = $req->wallpaper->getClientOriginalName();
        $wallpapername = date('d-m-Y-').rand(1,9999).$wallpapername;
        $req->wallpaper->storeAs('/public',$wallpapername);
        return $wallpapername;
    }

    public function updateStyle(Request $req)
    {
        
        if($req->logo == null)
        {
            if($req->wallpaper == null)
            {
                $s = frontpage::first();
                $s->title = $req->title;
                $s->description = $req->description;
                $s->save();
            }
            else
            {
                $this->wallpaper($req);
                $s = frontpage::first();
                $s->title = $req->title;
                $s->description = $req->description;
                $s->wallpaper = $this->wallpaper($req);
                $s->save();
            }
        }
        else
        { 
            if($req->wallpaper == null)
            {
                $this->logo($req); 
                $s = frontpage::first();
                $s->title = $req->title;
                $s->description = $req->description;
                $s->logo = $this->logo($req);
                $s->save();
            }
            else
            {
                $this->logo($req); 
                $this->wallpaper($req); 
                $s = frontpage::first();
                $s->title = $req->title;
                $s->description = $req->description;
                $s->logo = $this->logo($req);
                $s->wallpaper = $this->wallpaper($req);
                $s->save();
            }
        }
        Alert::success('Style berhasil Di Update', 'Pesan');
        return back();
    }

    public function tambahSekolah()
    {
        return view('superadmin.sekolah.tambah');
    }

    public function simpanSekolah(Request $req)
    {
        $roleSkpd     = Role::where('name','sekolah')->first();
        $cek_username = User::where('username', $req->username)->first();
        if($cek_username == null)
        {
            $user           = new User;
            $user->name     = $req->nama;
            $user->username = $req->username;
            $user->email       = $req->email;
            $user->password    = bcrypt($req->password);
            $user->save();
            $user->roles()->attach($roleSkpd);

            $skpd           = new Sekolah;
            $skpd->nama     = $req->nama;
            $skpd->users_id = $user->id;
            $skpd->save(); 
            Alert::success('Sekolah Berhasil Disimpan', 'Pesan');
        }
        else
        {
            Alert::error('Username Sudah Ada', 'Pesan');
        }
        return redirect('/masterdata/sekolah');
    }

    public function updateSekolah(Request $req, $id)
    {
        if($req->password == null)
        {
            $u = Sekolah::find($id);
            $u->nama = $req->nama;
            $u->save();

            $d = $u->user;
            $d->email = $req->email;
            $d->save();
        }
        else
        {
            $u = Sekolah::find($id);
            $u->nama = $req->nama;
            $u->save();

            $d = $u->user;
            $d->email = $req->email;
            $d->password = bcrypt($req->password);
            $d->save();
        }
        Alert::success('Sekolah Berhasil Di update', 'Pesan');
        return redirect('/masterdata/sekolah');
    }

    public function editSekolah($id)
    {
        $data = Sekolah::find($id);
        return view('superadmin.sekolah.edit',compact('data'));
    }

    public function deleteSekolah($id)
    {
        try {
            $del = Skpd::find($id)->delete();
            Alert::success('Sekolah Berhasil Di Hapus', 'Pesan');
        } catch (\Exception $e) {
            Alert::error('Sekolah Tidak Bisa Di Hapus, Karena Telah Memiliki Riwayat Data', 'Pesan');
        }
        return back();
    }

    public function jabatan()
    {
        $data = Jabatan::all();
        return view('superadmin.jabatan.index',compact('data'));
    }

    public function deletejabatan($id)
    {
        $del = Jabatan::find($id)->delete();
        Alert::success('Jabatan Berhasil Dihapus', 'Pesan');
        return back();
    }
    public function simpanjabatan(Request $req)
    {
        $k = new Jabatan;
        $k->nama = $req->nama;
        $k->save();
        Alert::success('Jabatan Berhasil Disimpan', 'Pesan');
        return back();
    }

    public function updatejabatan(Request $req)
    {
        $k = Jabatan::find($req->id_jabatan);
        $k->nama = $req->nama;
        $k->save();
        Alert::success('Jabatan Berhasil Di Perbaharui', 'Pesan');
        return back();
    }

    public function wbk()
    {
        $data = Kategori::where('jenis','wbk')->get();
        return view('superadmin.kategori.wbk',compact('data'));
    }

    public function deletewbk($id)
    {
        $del = Kategori::find($id)->delete();
        Alert::success('Kategori Berhasil Dihapus', 'Pesan');
        return back();
    }

    public function simpanwbk(Request $req)
    {
        $k = new Kategori;
        $k->nama = $req->nama;
        $k->jenis = 'wbk';
        $k->save();
        Alert::success('Kategori Berhasil Disimpan', 'Pesan');
        return back();
    }

    public function updatewbk(Request $req)
    {
        $k = Kategori::find($req->id_kategori);
        $k->nama = $req->nama;
        $k->save();
        Alert::success('Kategori Berhasil Di Perbaharui', 'Pesan');
        return back();
    }

    public function wbbm()
    {
        $data = Kategori::where('jenis','wbbm')->get();
        return view('superadmin.kategori.wbbm',compact('data'));
    }

    public function deletewbbm($id)
    {
        $del = Kategori::find($id)->delete();
        Alert::success('Kategori Berhasil Dihapus', 'Pesan');
        return back();
    }

    public function simpanwbbm(Request $req)
    {
        $k = new Kategori;
        $k->nama = $req->nama;
        $k->jenis = 'wbbm';
        $k->save();
        Alert::success('Kategori Berhasil Disimpan', 'Pesan');
        return back();
    }

    public function updatewbbm(Request $req)
    {
        $k = Kategori::find($req->id_kategori);
        $k->nama = $req->nama;
        $k->save();
        Alert::success('Kategori Berhasil Di Perbaharui', 'Pesan');
        return back();
    }

    public function simpanPegawai(Request $req, $id_skpd)
    {
        $s = Skpd::find($id_skpd);
        $s->jml_pegawai = $req->jml_pegawai;
        $s->save();
        Alert::success('Jumlah Pegawai Berhasil Di Perbaharui', 'Pesan');
        return back();
    }

    public function komponen()
    {
        $data = Komponen::all();
        return view('superadmin.komponen.index',compact('data'));
    }

    public function deletekomponen($id)
    {
        $del = Komponen::find($id)->delete();
        Alert::success('Komponen Berhasil Dihapus', 'Pesan');
        return back();
    }

    public function simpankomponen(Request $req)
    {
        $k = new Komponen;
        $k->nama = $req->nama;
        $k->bobot = $req->bobot;
        $k->save();
        Alert::success('Komponen Berhasil Disimpan', 'Pesan');
        return back();
    }

    public function updatekomponen(Request $req)
    {
        $k = Komponen::find($req->id_komponen);
        $k->nama = $req->nama;
        $k->bobot = $req->bobot;
        $k->save();
        Alert::success('Komponen Berhasil Di Perbaharui', 'Pesan');
        return back();
    }

    public function user()
    {
        $user = User::all();
        $map = $user->map(function($item){
            $item->skpd = $item->skpd;
            $item->role = $item->roles->first()->name;
            return $item;
        })->where('skpd', null);
        
        return view('superadmin.user.index',compact('map'));
    }
}
