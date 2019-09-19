<?php

declare(strict_types=1);

namespace App\Renders;

class HtmlDocument
{
    protected $body = '';

    /**
     * @param string $text
     * @return $this
     */
    public function print(string $text): self
    {
        $this->body .= $text;
        return $this;
    }

    /**
     * @return string
     */
    public function render(): string
    {
        return $this->body;
    }
}
