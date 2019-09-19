<?php

declare(strict_types=1);

namespace App\Renders;

class Spacer
{
    /** @var  */
    protected $symbol;

    public function __construct($symbol, $value)
    {
        $this->symbol = $symbol;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return str_repeat($this->symbol, $this->value);
    }
}
