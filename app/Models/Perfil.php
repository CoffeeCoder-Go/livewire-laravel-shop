<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('perfil')]
class Perfil extends Model
{
    //
    protected $fillable = [
        "id","nickname","birthday","type","foto"
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
