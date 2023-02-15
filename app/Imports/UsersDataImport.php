<?php

namespace App\Imports;

use App\Models\UserData;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class UsersDataImport implements OnEachRow,WithHeadingRow
{
        
    /**
     * onRow
     *
     * @param  mixed $row
     * @return void
     */
    public function onRow(Row $row)
    {
         return UserData::updateOrCreate([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'phone'    => $row['phone'],
            'address'   => $row['address'],
        ]);
        
    }

    /**
     * rules
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => [Rule::unique(['UserData', 'email'])],
            'phone' => [Rule::unique(['UserData', 'phone'])]
        ];
    }
    
    /**
     * customValidationMessages
     *
     * @return void
     */
    public function customValidationMessages()
    {
        return [
            'email.unique' => 'Duplicate',
            'phone.unique' => 'Duplicate',
        ];
    
    }

}