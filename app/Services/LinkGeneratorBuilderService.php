<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * Class LinkGeneratorBuilderService
 * @package App\Services\LinkGeneratorBuilderService
 */
class LinkGeneratorBuilderService
{
    private const LINK_TTL = 7;

    /** @var string $link */
    private string $link;
    private Link $linkModel;

    /**
     * @param Link $link
     */
    public function __construct(Link $link)
    {
        $this->linkModel = $link;
    }

    /**
     * @return self
     */
    public function createLink(): self
    {
        $this->link = Str::uuid();

        return $this;
    }

    /**
     * @param int $userId
     * @return $this
     */
    public function storeLink(int $userId): self
    {
        $this->linkModel->create([
            'link' => $this->link,
            'user_id' => $userId,
            'expired_at' => Carbon::now()->addDays(self::LINK_TTL),
        ]);

        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }
}
