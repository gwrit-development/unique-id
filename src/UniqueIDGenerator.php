<?php namespace GwritDevelopment\UniqueID;

class UniqueIDGenerator
{
    /**
     * @return string
     */
    static function generate(): string
    {
        $microtime = explode(' ', microtime());

        $microtime[0] = (explode('.', $microtime[0]))[1];

        $machine = (int) config('app.machine_id', 0);

        return $microtime[1] . $microtime[0] . $machine;
    }
}