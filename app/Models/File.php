<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'originName',
        'filePath',
        'fileExt',
        'fileSize',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'id', 'avatar_id');
    }

    public function productImage(): BelongsTo {
        return $this->belongsTo(ProductImage::class, 'id', 'file_id');
    }
}
