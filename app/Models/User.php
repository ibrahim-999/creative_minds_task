<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Twilio\Rest\Client;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username', 'phone', 'password','type',
    ];

    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    protected $guard = 'admin';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function callToVerify()
    {
        $code = random_int(100000, 999999);

        $this->forceFill([
            'verification_code' => $code
        ])->save();

        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        $client->calls->create(
            $this->phone,
            //at this point you can use your own phone and https ngrok url
            "+201143264502", // REPLACE WITH YOUR TWILIO NUMBER
            ["url" => "http://127.0.0.8000/build-twiml/{$code}"]
        );
    }
}
