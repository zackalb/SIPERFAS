<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ActivityLog extends Model
{
    protected $fillable = [
        'id_user',
        'user_name',
        'user_role',
        'action',
        'description',
        'ip_address',
        'user_agent',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Catat log aktivitas baru ke database.
     */
    public static function record(string $action, string $description, ?User $user = null, ?array $properties = null): ?self
    {
        try {
            $currentUser = $user ?? Auth::user();

            $log = new static();
            $log->id_user = $currentUser?->id_user;
            $log->user_name = $currentUser?->nama ?? 'Sistem / Anonim';
            $log->user_role = $currentUser?->status ?? $currentUser?->role ?? 'pengguna';
            $log->action = strtoupper($action);
            $log->description = $description;
            $log->ip_address = request()->ip() ?? '127.0.0.1';
            $log->user_agent = request()->userAgent();
            $log->properties = $properties;
            $log->save();

            return $log;
        } catch (\Throwable $e) {
            Log::warning('Gagal mencatat ActivityLog: ' . $e->getMessage());
            return null;
        }
    }
}
