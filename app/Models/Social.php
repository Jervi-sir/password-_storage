<?php

namespace App\Models;

use App\Models\Account;
use App\Models\ProjectAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Social extends Model
{
    use HasFactory;

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }


    public function project_accounts()
    {
        return $this->hasMany(ProjectAccount::class);
    }

}
