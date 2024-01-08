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
        'customer_user_id',
        'company_id',
    ];

    public function __construct(array $attributes = [])
    {
        $this->state = self::DEFAULT_STATE;
        parent::__construct($attributes);
    }

    public function user()
    {
        return $this->belongsTo(CustomerUser::class, 'customer_user_id');
    }

    public function isPerson(): bool
    {
        return (bool)$this->customer_user_id;
    }

    public function isCompany(): bool
    {
        return (bool)$this->company_id;
    }
}
