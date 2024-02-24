<?php

declare(strict_types=1);

namespace App\Models;

use App\Common\Domain\ValueObject\FullName;
use App\Notifications\ForgotPasswordNotification;
use DateTimeInterface;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;

class CustomerUser extends Authenticatable implements MustVerifyEmail
{
    public const ACCESS_TOKEN_NAME = "CUSTOMER_USER_TOKEN";

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'surname',
        'birthdate',
        'phone', //todo treba?
        'email',
        'language',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'customer_user_id');
    }

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => FullName::create(
                $attributes['first_name'],
                $attributes['surname'],
            )->toString(),
        )->shouldCache();
    }

    public function sendPasswordResetNotification($token)
    {
        $url = config('app.frontend_hostname') . 'reset-password?token='.$token.'&email='.$this->email;

        $this->notify(new ForgotPasswordNotification($this, $url));
    }

    /**
     * overwrite basic createToken because I want to delete() all tokens before generating a new one
     */
    public function createToken(string $name, array $abilities = ['*'], DateTimeInterface $expiresAt = null): NewAccessToken
    {
        $this->tokens()->delete();

        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(40)),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);

        return new NewAccessToken($token, $token->getKey().'|'.$plainTextToken);
    }
}
