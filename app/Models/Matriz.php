<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matriz extends Model
{
    use HasFactory;

    use TenantTrait;

    protected $fillable = [
        'id',
        'tenant_id',
        'user_id',
        'name',
        'cnpj',
        'email',
        'phone',
        'natureza',
        'data_cnpj',
        'data_fundacao',
        'profile_photo_path'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
