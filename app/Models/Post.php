<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $user_id
 * @property string image
 * @property string $created_at
 * @property string $updated_at
 */
class Post extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'title',
        'content',
        'user_id',
        'image'
    ];
}
