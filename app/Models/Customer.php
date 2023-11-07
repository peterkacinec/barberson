<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    private const DEFAULT_STATE = 'new';

    protected $fillable = [
        'state',
        'photo',
        'c_user_id',
        'company_id',
    ];

    public function __construct(array $attributes = [])
    {
        $this->state = self::DEFAULT_STATE;
        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo(CustomerUser::class, 'c_user_id');
    }
}
