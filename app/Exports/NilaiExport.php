<?php

namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\Repositories\Feed;
use App\DataMaster;
use App\Periode;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NilaiExport implements FromView, WithHeadings, ShouldAutoSize
{
    private $id_kelas;

    public function __construct($id_kelas)
    {
        $this->id_kelas = $id_kelas;
    }

    public function view(): View
    {
        $periode = new Periode;
        $id_periode = $periode->semesterAktif()->id_semester;
        $data = Feed::start('GetDetailNilaiPerkuliahanKelas')->filter("id_semester = '$id_periode' AND id_kelas_kuliah = '$this->id_kelas'")->get()['data'];
        $detail = collect($data)->sortBy('nama_mahasiswa');
        return view('exports.nilai', compact('detail'));
    }

    public function headings(): array
    {
        return [
            '#',
            'NIM',
            'Nama Mahasiswa'
        ];
    }
}