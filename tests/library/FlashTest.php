<?php

use MartynBiz\FlashMessage\Flash;

class ControllerTest extends PHPUnit_Framework_TestCase
{
    protected $flash;

    public function setUp()
    {
        $this->flash = new Flash();
    }

    public function testInitialization()
    {
        $flash = new Flash();

        $this->assertTrue($flash instanceof Flash); // yey!
    }
}
