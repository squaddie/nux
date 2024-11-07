<?php

namespace App\Strategy;

/**
 * Class WinStrategyOver300
 * @package App\Strategy\WinStrategyOver300
 */
class WinStrategyOver300 extends WinStrategy
{
    /**
     * @return int
     */
    public function calculateWin(): int
    {
        return $this->number * 0.3;
    }
}
