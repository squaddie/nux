<?php

namespace App\Strategy;

/**
 * Class WinStrategyOver600
 * @package App\Strategy\WinStrategyOver600
 */
class WinStrategyOver600 extends WinStrategy
{
    /**
     * @return int
     */
    public function calculateWin(): int
    {
        return $this->number * 0.5;
    }
}
