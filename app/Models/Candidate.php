<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'registration_number',
        'full_name',
        'birth_place',
        'birth_date',
        'gender',
        'class_name',
        'organization_type',
        'status',
        'notes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    /**
     * Check if candidate passed selection.
     */
    public function isPassed(): bool
    {
        return $this->status === 'passed';
    }

    /**
     * Check if candidate failed selection.
     */
    public function isFailed(): bool
    {
        return $this->status === 'failed';
    }

    /**
     * Check if candidate selection is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Get readable status badge label.
     */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'passed' => 'Diterima (Lolos Seleksi)',
            'failed' => 'Tidak Diterima',
            'pending' => 'Proses Seleksi',
            default => 'Pending',
        };
    }

    /**
     * Generate unique registration number.
     */
    public static function generateRegistrationNumber(?string $organizationType = null): string
    {
        $prefix = 'OSKA-2026-';
        $latestId = self::max('id') + 1;
        
        return $prefix . str_pad((string)$latestId, 4, '0', STR_PAD_LEFT);
    }
}
