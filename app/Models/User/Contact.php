<?php

declare(strict_types=1);

namespace App\Models\User;

use Database\Factories\ContactFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Contact extends Model
{
    /** @use HasFactory<ContactFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'contacts';
    protected static string $factory = ContactFactory::class;

    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'phone',
    ];
}
