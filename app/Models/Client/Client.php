<?php

declare(strict_types=1);

namespace App\Models\Client;

use App\Models\Service\Service;
use App\Models\User\User;
use Database\Factories\ClientFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Client extends Model
{
    /** @use HasFactory<ClientFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'clients';
    protected static string $factory = ClientFactory::class;

    protected $fillable = [
        'name',
    ];

    //region Realtions
    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'client_id', 'id');
    }

    public function legalDetail(): HasOne
    {
        return $this->hasOne(LegalDetail::class, 'client_id', 'id');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'client_services', 'client_id', 'service_id');
    }
    //endregion
}
