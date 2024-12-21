<?php

namespace App\Models\Client;

use Database\Factories\LegalDetailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegalDetail extends Model
{
    /** @use HasFactory<LegalDetailFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'legal_details';

    protected $fillable = [
        'inn',
        'kpp',
        'ogrn',
        'bik',
    ];
}
