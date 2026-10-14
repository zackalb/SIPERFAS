<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Dapatkan nilai pengaturan berdasarkan key.
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Simpan atau perbarui nilai pengaturan.
     */
    public static function set(string $key, $value): self
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }

    /**
     * Dapatkan URL logo aktif aplikasi.
     * Mengembalikan URL logo kustom jika ada, atau fallback ke logo default.
     */
    public static function getLogo(): string
    {
        $customPath = static::get('app_logo');
        if (!empty($customPath)) {
            // Cek apakah file ada di direktori public
            $fullPath = public_path($customPath);
            if (File::exists($fullPath)) {
                return asset($customPath);
            }
        }

        return asset('logo.png');
    }
}
