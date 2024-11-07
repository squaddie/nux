<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * Class Link
 * @package App\Models\Link
 * @property int $id
 * @property bool $disabled
 * @property Carbon $expired_at
 */
class Link extends Model
{
    use HasFactory;

    /** @var string[] $fillable */
    protected $fillable = [
        'link',
        'expired_at',
        'user_id',
        'disabled',
    ];
    /*** @var string[] $casts */
    protected $casts = [
        'expired_at' => 'datetime',
    ];

    /**
     * @param string $link
     * @return Link
     */
    public function findByLink(string $link): Link
    {
        return $this->where('link', $link)->firstOrFail();
    }

    /**
     * @param string $link
     * @return bool
     */
    public function disable(string $link): bool
    {
        $linkInstance = $this->findByLink($link);
        $linkInstance->disabled = true;

        return $linkInstance->save();
    }

    /**
     * @return bool
     */
    public function isLinkExpired(): bool
    {
        return Carbon::now()->greaterThan($this->expired_at);
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
