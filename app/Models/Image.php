<?php

namespace App\Models;

use Database\Factories\ImageFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Image extends Model
{
    /** @use HasFactory<ImageFactory> */
    use HasFactory;

    protected $fillable = ['path'];

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    protected function url(): Attribute
    {
        return Attribute::get(fn (): string => Str::startsWith($this->path, ['http://', 'https://'])
            ? $this->path
            : Storage::disk('public')->url($this->path));
    }
}
