<?php

namespace App\Strategy;

/**
 * Interface WinStrategyInterface
 * @package App\Strategy\WinStrategyInterface
 */
interface WinStrategyInterface
{
    /**
     * @param int $number
     */
    public function __construct(int $number);

    /**
     * @return int
     */
    public function calculateWin(): int;
}
