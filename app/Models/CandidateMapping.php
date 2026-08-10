<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CandidateMapping extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'organization_type',
        'paslon_number',
        'chairman_id',
        'vice_chairman_id',
        'vision',
        'mission',
        'photo',
        'votes_count',
    ];

    /**
     * Get the chairman candidate for this mapping.
     */
    public function chairman(): BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'chairman_id');
    }

    /**
     * Get the vice chairman candidate for this mapping.
     */
    public function viceChairman(): BelongsTo
    {
        return $this->belongsTo(Candidate::class, 'vice_chairman_id');
    }

    /**
     * Accessor for full photo URL or null.
     */
    public function getPhotoUrlAttribute(): ?string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }

        return null;
    }
}
