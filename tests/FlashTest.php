<?php

// TODO test with an ArrayAccess/Object $storage passed in

use MartynBiz\FlashMessage\Flash;
use Zend\Session\Container;

class FlashTest extends PHPUnit_Framework_TestCase
{
    protected $flash;

    public function testInstantiation()
    {
        $flash = new Flash();

        $this->assertTrue($flash instanceof Flash);
    }

    public function testAddingHasAndFlushing()
    {
        $flash = new Flash();

        // add messages
        $flash->addMessage('key1', 'value1');
        $flash->addMessage('key2', 'value2');
        $flash->addMessage('key3', 'value3');

        // assert has method
        $this->assertTrue( $flash->has('key1') );
        $this->assertTrue( $flash->has('key2') );
        $this->assertTrue( $flash->has('key3') );

        $expected = array(
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3',
        );

        // assert first time to access messages
        $messages = $flash->flushMessages();
        $this->assertEquals($expected, $messages);

        // assert messages have been cleared
        $messages = $flash->flushMessages();
        $this->assertEquals(array(), $messages);
    }

    public function testCustomStorage()
    {
        $container = new Container('mycontainer');
        $flash = new Flash($container);

        $flash->addMessage('key1', 'value1');

        $expected = array(
            'key1' => 'value1',
        );

        // assert first time to access messages
        $messages = $flash->flushMessages();
        $this->assertEquals($expected, $messages);

        // assert messages have been cleared
        $messages = $flash->flushMessages();
        $this->assertEquals(array(), $messages);
    }

    public function testCustomStorageWhenInstancesDestroyed()
    {
        // trying to recreate a new http session here

        $container = new Container('mycontainer');
        $flash = new Flash($container);

        $flash->addMessage('key1', 'value1');

        $expected = array(
            'key1' => 'value1',
        );

        // destroy session (or unset variables anyway)
        unset($container);
        unset($flash);

        // create again]
        $container = new Container('mycontainer');
        $flash = new Flash($container);

        // assert first time to access messages
        $messages = $flash->flushMessages();
        $this->assertEquals($expected, $messages);

        // assert messages have been cleared
        $messages = $flash->flushMessages();
        $this->assertEquals(array(), $messages);
    }

    public function testCustomStorageFlushedNextTimeWhenInstancesDestroyed()
    {
        // trying to recreate a new http session here

        $container = new Container('mycontainer');
        $flash = new Flash($container);

        $flash->addMessage('key1', 'value1');

        $expected = array(
            'key1' => 'value1',
        );

        // assert first time to access messages
        $messages = $flash->flushMessages();
        $this->assertEquals($expected, $messages);

        // destroy session (or unset variables anyway)
        unset($container);
        unset($flash);

        // create again]
        $container = new Container('mycontainer');
        $flash = new Flash($container);

        // assert messages have been cleared
        $messages = $flash->flushMessages();
        $this->assertEquals(array(), $messages);
    }
}
