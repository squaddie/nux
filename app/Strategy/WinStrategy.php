<?php

namespace App\Strategy;

/**
 * Class WinStrategy
 * @package App\Strategy\WinStrategy
 *
 * @property int $number
 */
abstract class WinStrategy implements WinStrategyInterface
{
    /** @var int $number */
    protected int $number;

    /**
     * @param int $number
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    abstract public function calculateWin(): int;
}
