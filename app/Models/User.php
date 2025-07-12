<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, LogsActivity;

    protected $fillable = [
        'name',
        'nis',
        'email',
        'password',
        'kelas',
        'jurusan',
        'jenis_kelamin',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_admin' => 'boolean',
    ];

    // Constants for enum values
    const JURUSAN_IPA = 'IPA';
    const JURUSAN_IPS = 'IPS';
    const JENIS_KELAMIN_LAKI = 'L';
    const JENIS_KELAMIN_PEREMPUAN = 'P';

    // Accessor methods
    public function getJurusanLabelAttribute()
    {
        return match($this->jurusan) {
            self::JURUSAN_IPA => 'Ilmu Pengetahuan Alam',
            self::JURUSAN_IPS => 'Ilmu Pengetahuan Sosial',
            default => '-'
        };
    }

    public function getJenisKelaminLabelAttribute()
    {
        return match($this->jenis_kelamin) {
            self::JENIS_KELAMIN_LAKI => 'Laki-laki',
            self::JENIS_KELAMIN_PEREMPUAN => 'Perempuan',
            default => '-'
        };
    }

    // Static methods for getting options
    public static function getJurusanOptions()
    {
        return [
            self::JURUSAN_IPA => 'Ilmu Pengetahuan Alam (IPA)',
            self::JURUSAN_IPS => 'Ilmu Pengetahuan Sosial (IPS)',
        ];
    }

    public static function getJenisKelaminOptions()
    {
        return [
            self::JENIS_KELAMIN_LAKI => 'Laki-laki',
            self::JENIS_KELAMIN_PEREMPUAN => 'Perempuan',
        ];
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    // ...existing relationships...
}