<?php

namespace App\Services;

use App\Factory\StrategyFactory;
use App\Models\History;
use App\Models\Link;
use Exception;

/**
 * Class MakeLuckyService
 * @package App\Services\MakeLuckyService
 */
class MakeLuckyService
{
    /** @var Link $linkModel */
    private Link $linkModel;
    /** @var History $historyModel */
    private History $historyModel;

    /**
     * @param Link $linkModel
     * @param History $historyModel
     */
    public function __construct(Link $linkModel, History $historyModel)
    {
        $this->linkModel = $linkModel;
        $this->historyModel = $historyModel;
    }

    /**
     * @param string $link
     * @return void
     * @throws Exception
     */
    public function makeLucky(string $link): void
    {
        $factory = new StrategyFactory(mt_rand(1, 1000));
        $winResult = $factory->getInstance()->calculateWin();
        $linkInstance = $this->linkModel->findByLink($link);
        $this->historyModel->create(['sum' => $winResult, 'status' => $winResult !== 0, 'link_id' => $linkInstance->id]);
    }
}
