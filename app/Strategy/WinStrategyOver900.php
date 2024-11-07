<?php

namespace App\Strategy;

/**
 * Class WinStrategyOver900
 * @package App\Strategy\WinStrategyOver900
 */
class WinStrategyOver900 extends WinStrategy
{
    /**
     * @return int
     */
    public function calculateWin(): int
    {
        return $this->number * 0.7;
    }
}
