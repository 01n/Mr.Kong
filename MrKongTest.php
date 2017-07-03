<?php

require_once 'MrKong.php';

class MrKongTest extends PHPUnit_Framework_TestCase
{
    public function test_Mr_Kong_has_nothing() {
        $mr_kong = new MrKong(0);
        $this->assertEquals(0, $mr_kong->hasMoney());
    }

    public function test_Mr_Kong_receive_20_yuan() {
        $mr_kong = new MrKong(1);
        $mr_kong->receive(20);

        $this->assertEquals(1+20, $mr_kong->hasMoney());
    }
}

?>