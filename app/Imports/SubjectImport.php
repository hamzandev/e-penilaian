<?php

namespace App\Imports;

use App\Models\Subject;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SubjectImport implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $tableFields = iterator_to_array($collection[0]);
        $mustHaveField = ['name', 'description'];
        if (array_diff($tableFields, $mustHaveField)) {
            session()->flash('error', 'File yang kamu upload memiliki format data yang salah!');
            echo '<script>window.location.href = "'.env('APP_URL').'/master-data/teacher";</script>';
            return false;
        }
        $data = $this->collectionToArray($tableFields, $collection, true);
        foreach ($data as $row) {
            $checkDuplicate = Subject::select('id')->whereName($row['name'])->first();
            if ($checkDuplicate) {
                session()->flash('error', 'File kamu mengandung data Mapel yang telah ada di Database!');
                echo '<script>window.location.href = "'.env('APP_URL').'/master-data/teacher";</script>';
                return false;
            }
        }
        Subject::insert($data);
        session()->flash('message', count($data) . ' data Mapel berhasil di import!');
        return true;
    }

    function collectionToArray($tableFields, $collection, $hasDate = false)
    {
        $data = [];
        for ($i = 1; $i < count($collection); $i++) {
            // echo $collection[$i];
            $row = [];
            for ($j = 0; $j < count($tableFields); $j++) {
                if ($hasDate == true) {
                    if ($j == 3) {
                        $field = $this->intToDate($collection[$i][$j]);
                    } else {
                        $field = $collection[$i][$j];
                    }
                } else {
                    $field = $collection[$i][$j];
                }
                $row[$tableFields[$j]] = $field;
            }
            $data[] = $row;
        }

        return $data;
    }

    public static function intToDate(int $int) {
        $date = Carbon::createFromTimestamp((int) ($int - 25569) * 86400)->format('d-m-Y H:m:s');
        return $date;
    }
}
