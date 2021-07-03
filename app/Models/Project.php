<?php

namespace App\Models;

use App\Models\User;
use App\Models\ProjectAccount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    public function project_accounts()
    {
        return $this->hasMany(ProjectAccount::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
