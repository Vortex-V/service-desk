<?php

declare(strict_types=1);

namespace App\Models\Client;

use Database\Factories\LegalDetailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

final class LegalDetail extends Model
{
    /** @use HasFactory<LegalDetailFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'legal_details';
    protected static string $factory = LegalDetailFactory::class;

    protected $fillable = [
        'inn',
        'kpp',
        'ogrn',
        'bik',
        'country',
        'city',
        'street',
        'house',
        'postcode',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
