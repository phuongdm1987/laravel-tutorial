<?php
declare(strict_types=1);

namespace App\Models\Comment;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Comment
 * @package App\Models\Comment
 */
class Comment extends Model
{
    use HasFactory;

    /**
     * @return HasOne
     */
    public function parent(): HasOne
    {
        return $this->hasOne(__CLASS__, 'parent_id');
    }

    /**
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(__CLASS__, 'parent_id');
    }
}
