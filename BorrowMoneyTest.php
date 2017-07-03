<?php

require_once 'MrKong.php';
require_once 'Shopkeeper.php';

class BorrowMoneyTest extends PHPUnit_Framework_TestCase
{
    public function test_Mr_Kong_has_borrowed_20_yuan_from_shopkeeper() {
        $mr_kong = new MrKong(0);
        $shopkeeper = new Shopkeeper(120);

        $shopkeeper->lendTo($mr_kong, 20)
            ->whenSuccess(function ($who, $amount) {
                $who->receive($amount);
            });

        $this->assertEquals(20, $mr_kong->hasMoney());
        $this->assertEquals(120-20, $shopkeeper->hasMoney());
    }

    public function test_Mr_Kong_borrows_20_yuan_fail_because_shopkeeper_has_not_enough_money() {
        $mr_kong = new MrKong(0);
        $shopkeeper = new Shopkeeper(19);

        $shopkeeper->lendTo($mr_kong, 20)
            ->whenSuccess(function ($who, $amount) {
                $who->receive($amount);
            });

        $this->assertEquals(0, $mr_kong->hasMoney());
        $this->assertEquals(19, $shopkeeper->hasMoney());
    }

    public function test_Mr_Kong_borrows_20_yuan_fail_because_over_limited() {
        $mr_kong = new MrKong(0);
        $shopkeeper = new Shopkeeper(200);

        $shopkeeper->lendTo($mr_kong, 21)
            ->whenSuccess(function ($who, $amount) {
                $who->receive($amount);
            });

        $this->assertEquals(0, $mr_kong->hasMoney());
        $this->assertEquals(200, $shopkeeper->hasMoney());
    }
}

?>