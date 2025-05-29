<?php

declare(strict_types=1);

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\RoleType;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property-read int $id
 * @property RoleEnum $role_id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property CarbonImmutable|null $email_verified_at
 * @property string $password
 * @property string|null $avatar_url
 * @property string|null $remember_token
 * @property-read CarbonImmutable|null $created_at
 * @property-read CarbonImmutable|null $updated_at
 * @property-read Cart|null $cart
 * @property-read Collection|CustomerAddress[] $customerAddress
 * @property-read Collection|Order[] $orders
 * @property-read Collection|PaymentDetail[] $paymentDetails
 * @property-read Role $role
 * @property-read Collection|Wishlist[] $wishlist
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
     * Get the role for the user.
     *
     * @return BelongsTo<Role, $this>
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the customer addresses for the user.
     *
     * @return HasMany<CustomerAddress, $this>
     */
    public function customerAddress(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }

    /**
     * Get the orders for the user.
     *
     * @return HasMany<Order, $this>
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the payment details for the user.
     *
     * @return HasMany<PaymentDetail, $this>
     */
    public function paymentDetails(): HasMany
    {
        return $this->hasMany(PaymentDetail::class);
    }

    /**
     * Get the cart for the user.
     *
     * @return HasOne<Cart, $this>
     */
    public function cart(): HasOne
    {
        return $this->hasOne(Cart::class);
    }

    /**
     * Get the wishlist for the user.
     *
     * @return HasMany<Wishlist, $this>
     */
    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Generate the username & avatar for the user while creating.
     */
    protected static function booted(): void
    {
        static::creating(function (User $user): void {
            $baseUsername = mb_strtolower((string) preg_replace('/\W+/', '', $user->first_name.$user->last_name));

            $username = $baseUsername;
            $counter = 1;

            while (static::where('username', $username)->exists()) {
                $username = $baseUsername.$counter++;
            }

            $user->username = $username;

            if (! $user->avatar_url) {
                $user->avatar_url = "https://ui-avatars.com/api/?name={$user->first_name}+{$user->last_name}&background=687387&color=ffffff&bold=true&format=png";
            }
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
            'role_id' => RoleType::class,
            'email_verified_at' => 'immutable_datetime',
            'password' => 'hashed',
            'created_at' => 'immutable_datetime',
            'updated_at' => 'immutable_datetime',
        ];
    }
}
