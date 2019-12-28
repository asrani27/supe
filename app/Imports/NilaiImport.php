<?php
namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NilaiImport implements ToCollection
{
    
    public $data;

    public function collection(Collection $rows)
    { 
        $mapping = $rows->map(function($item, $key){
            return $item;
        })->toArray();
        $data = collect($mapping);
        $this->data = $data;
    }
}