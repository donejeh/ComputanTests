<?php

namespace App\Imports;

use App\Models\UserData;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersDataExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return UserData::select("id", "name", "email","phone","address")->get();
       // return UserData::all();
    }
    
    /**
     * headings
     *
     * @return array
     */
    public function headings(): array
    {
        return ["Id", "Name", "Email","Phone","Address"];
    }

    
}
