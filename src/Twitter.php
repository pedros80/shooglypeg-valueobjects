<?php

declare(strict_types=1);

namespace ShooglyPeg;

use ShooglyPeg\StringValue;

final class Twitter extends StringValue
{
    /**
     * @return string
     */
    public function handle(): string
    {
        return "@{$this->value}";
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return "http://www.twitter.com/{$this->value}";
    }

    /**
     * @return string
     */
    public function link(): string
    {
        return "<a href=\"{$this->url()}\">{$this->handle()}</a>";
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'handle' => $this->handle(),
            'url'    => $this->url(),
            'link'   => $this->link(),
        ];
    }
}
