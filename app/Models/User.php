<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RoleEnum;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

/**
 * @property-read int $id
 * @property RoleEnum $role_id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property-read CarbonImmutable|null $email_verified_at
 * @property string $password
 * @property string|null $avatar_url
 * @property-read string|null $remember_token
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'role_id',
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'avatar_url',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return BelongsTo<Role, $this>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * @return HasMany<CustomerAddress, $this>
     */
    public function customerAddress(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }

    /**
     * @return HasMany<Order, $this>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany<PaymentDetail, $this>
     */
    public function paymentDetails(): HasMany
    {
        return $this->hasMany(PaymentDetail::class);
    }

    /**
     * @return HasOne<Cart, $this>
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * @return HasMany<Wishlist, $this>
     */
    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    protected static function booted(): void
    {
        static::creating(function (User $user): void {
            $baseUsername = Str::slug($user->first_name.' '.$user->last_name);
            $username = $baseUsername;
            $counter = 1;

            while (static::where('username', $username)->exists()) {
                $username = $baseUsername.$counter++;
            }

            $user->username = $username;
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role_id' => RoleEnum::class,
            'email_verified_at' => 'immutable_datetime',
            'password' => 'hashed',
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];
    }
}
