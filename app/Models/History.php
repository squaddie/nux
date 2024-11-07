<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 * @package App\Models\History
 * @property int $sum
 * @property bool $status
 * @property int $link_id
 */
class History extends Model
{
    use HasFactory;

    private const HISTORY_LIMIT = 3;

    /** @var string[] $fillable */
    protected $fillable = [
        'sum',
        'status',
        'link_id',
    ];

    /**
     * @param int $linkId
     * @return Collection
     */
    public function getLatestHistoryFilteredByLinkID(int $linkId): Collection
    {
        return $this->where('link_id', $linkId)->limit(self::HISTORY_LIMIT)->latest()->get();
    }

    /**
     * @param int $linkId
     * @return History
     */
    public function getLastHistoryFilteredByLinkID(int $linkId): History
    {
        return $this->where('link_id', $linkId)->latest()->first();
    }
}
