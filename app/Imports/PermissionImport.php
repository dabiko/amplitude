<?php

namespace App\Imports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\ToModel;

class PermissionImport implements ToModel
{

    public function model(array $row): Model|Permission|null
    {
        return new Permission([
            'name'     => $row[0],
            'group_name'    => $row[1],
            'user_id' => Auth::id(),
        ]);
    }
}
