<?php

namespace App\Factory;

use App\Strategy\WinStrategyInterface;
use App\Strategy\WinStrategyOver300;
use App\Strategy\WinStrategyOver600;
use App\Strategy\WinStrategyOver900;
use App\Strategy\WinStrategyUnder300;
use Exception;

/**
 * Class StrategyFactory
 * @package App\Factory\StrategyFactory
 */
class StrategyFactory
{
    /** @var int $number */
    private int $number;
    /** @var array[] $strategies */
    private array $strategies = [
        [
            'threshold' => 900,
            'class' => WinStrategyOver900::class,
            'rule' => '>',
        ],
        [
            'threshold' => 600,
            'class' => WinStrategyOver600::class,
            'rule' => '>',
        ],
        [
            'threshold' => 300,
            'class' => WinStrategyOver300::class,
            'rule' => '>',
        ],
        [
            'threshold' => 300,
            'class' => WinStrategyUnder300::class,
            'rule' => '<=',
        ],
    ];

    /**
     * @param int $number
     */
    public function __construct(int $number)
    {
        $this->number = $number;
    }

    /**
     * @throws Exception
     */
    public function getInstance(): WinStrategyInterface
    {
        foreach ($this->strategies as $strategy) {
            if (class_exists($strategy['class'])) {
                switch ($strategy['rule']) {
                    case '<=':
                        if ($this->number <= $strategy['threshold']) {
                            return new $strategy['class']($this->number);
                        }
                        break;
                    case '>':
                        if ($this->number > $strategy['threshold']) {
                            return new $strategy['class']($this->number);
                        }
                        break;
                }
            }
        }

        return new $this->strategies[0]['class']($this->number);
    }
}
