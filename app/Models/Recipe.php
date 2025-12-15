<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Recipe extends Model
{
    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'steps',
        'image_path',
        'user_id',
        'is_public',
    ];

    // relationships

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(
            RecipeCategory::class,
            'recipe_recipe_category',
            'recipe_id',
            'recipe_category_id'
        );
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // query scopes

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        return $search
            ? $query->where('name', 'like', '%' . $search . '%')
            : $query;
    }

    public function scopeInCategories(Builder $query, array $categories): Builder
    {
        if (empty($categories)) {
            return $query;
        }

        return $query->whereHas('categories', function ($q) use ($categories) {
            $q->whereIn('recipe_categories.id', $categories);
        });
    }

    public function scopeVisibleTo(Builder $query, ?User $user): Builder
    {
        if (! $user) {
            return $query->where('is_public', true);
        }

        return $query->where(function ($q) use ($user) {
            $q->where('is_public', true)
              ->orWhere('user_id', $user->id);
        });
    }

    // permissions

    public function canBeViewedBy(?User $user): bool
    {
        if ($this->is_public) return true;
        if (! $user) return false;

        return $user->canManageRecipe($this);
    }

    // data

    public function averageRating(): float
    {
        return (float) ($this->ratings()->avg('rating') ?? 0);
    }

    public function userRating(?User $user): int
    {
        if (! $user) return 0;

        return (int) (
            $this->ratings()
                ->where('user_id', $user->id)
                ->value('rating') ?? 0
        );
    }

    // write operations

    public static function createFromRequest(
        User $user,
        array $data,
        ?UploadedFile $image
    ): self {
        $path = $image ? $image->store('images', 'public') : null;

        $recipe = $user->recipes()->create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'ingredients' => $data['ingredients'],
            'steps'       => $data['steps'],
            'image_path'  => $path,
            'is_public'   => $data['is_public'] ?? 1,
        ]);

        $recipe->syncCategories($data['categories']);

        return $recipe;
    }

    public function updateFromRequest(array $data, ?UploadedFile $image): self
    {
        $path = $this->image_path;

        if ($image) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            $path = $image->store('images', 'public');
        }

        $this->update([
            'name'        => $data['name'],
            'description' => $data['description'],
            'ingredients' => $data['ingredients'],
            'steps'       => $data['steps'],
            'image_path'  => $path,
            'is_public'   => $data['is_public'] ?? $this->is_public,
        ]);

        $this->syncCategories($data['categories']);

        return $this;
    }

    public function deleteWithImage(): void
    {
        if ($this->image_path) {
            Storage::disk('public')->delete($this->image_path);
        }

        $this->delete();
    }

    public function syncCategories($categories): void
    {
        if (is_string($categories)) {
            $categories = json_decode($categories, true) ?? [];
        }

        $this->categories()->sync((array) $categories);
    }

    public function rateBy(User $user, int $rating): float
    {
        $this->ratings()->updateOrCreate(
            ['user_id' => $user->id],
            ['rating' => $rating]
        );

        return (float) ($this->ratings()->avg('rating') ?? 0);
    }
}
