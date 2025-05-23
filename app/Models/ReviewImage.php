<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReviewImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'review_id',
        'image',
        'filename',
        'mime_type',
    ];

    /**
     * Get the review that owns the image.
     */
    public function review(): BelongsTo
    {
        return $this->belongsTo(Review::class);
    }
}
