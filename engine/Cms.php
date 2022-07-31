<?php

namespace Engine;

class Cms
{

    /**
     * @var
     */
    private $di;

    /**
     * @param $di
     */
    public function __construct($di)
    {
        $this->di = $di;
    }

    public function run()
    {
        echo 'hello cms!';
    }

}