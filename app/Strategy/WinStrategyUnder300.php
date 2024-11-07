<?php

namespace App\Strategy;

/**
 * Class WinStrategyUnder300
 * @package App\Strategy\WinStrategyUnder300
 */
class WinStrategyUnder300 extends WinStrategy
{
    /**
     * @return int
     */
    public function calculateWin(): int
    {
        return $this->number * 0.1;
    }
}
