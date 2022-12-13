<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    protected $table = 'users';

    protected static function boot()
    {
        parent::boot();

        static::creating(function(User $pengguna) {
            $pengguna->password = Hash::make($pengguna->password);
        });
        
        static::updating(function(User $pengguna) {
            if($pengguna->isDirty(['password'])) {
                $pengguna->password = Hash::make($pengguna->password);
            }
        });
    }


}
