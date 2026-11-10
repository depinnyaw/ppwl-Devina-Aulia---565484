<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'status',
        'thumbnail',
        'category_id',
    ];

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)
            ->orderBy('sort_order');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class, 'project_technology')
            ->withTimestamps();
    }

    public static function generateMissingSlugs(): void
    {
        $projects = self::whereNull('slug')->orWhere('slug', '')->get();

        foreach ($projects as $project) {
            $baseSlug = Str::slug($project->title);
            $slug = $baseSlug;
            $counter = 1;

            while (self::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $project->slug = $slug;
            $project->save();
        }
    }
}