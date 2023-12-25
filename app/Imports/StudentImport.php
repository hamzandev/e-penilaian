<?php

namespace App\Imports;

use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        // return dd($collection[2]);
        // Student::create();
        $tableFields = iterator_to_array($collection[0]);
        // return dd($tableFields);
        $mustHaveField = ['name', 'nisn', 'dob', 'gender', 'address'];
        if (array_diff($tableFields, $mustHaveField)) {
            session()->flash('error', 'File yang kamu upload memiliki format data yang salah!');
            echo '<script>window.location.href = "'.env('APP_URL').'/master-data/student";</script>';
            return false;
        }
        $data = $this->collectionToArray($tableFields, $collection, true);
        foreach ($data as $row) {
            $checkDuplicate = Student::select('id')->whereNisn($row['nisn'])->first();
            if ($checkDuplicate) {
                session()->flash('error', 'File kamu mengandung data NISN yang telah ada di Database!');
                echo '<script>window.location.href = "'.env('APP_URL').'/master-data/student";</script>';
                return false;
            }
        }
        Student::insert($data);
        session()->flash('message', count($data) . ' data Siswa berhasil di import!');
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
