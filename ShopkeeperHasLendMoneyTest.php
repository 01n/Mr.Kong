<?php

require_once 'Shopkeeper.php';

class ShopkeeperHasLendMoneyTest extends PHPUnit_Framework_TestCase
{
    public function test_shopkeeper_has_100_yuan() {
        $shopkeeper = new Shopkeeper(100);
        $this->assertEquals(100, $shopkeeper->hasMoney());
    }

    public function test_shopkeeper_has_lend_money() {
        $original_money = 200;
        $lend_money = 20;

        $shopkeeper = new Shopkeeper($original_money);

        $somebody = $this->getMockBuilder('Somebody')
            ->setMethods(['receive', 'tellMe'])
            ->getMock();

        $somebody->expects($this->once())
            ->method('receive')
            ->with($lend_money);

        $somebody->expects($this->never())
            ->method('tellMe');

        $shopkeeper->lendTo($somebody, $lend_money)
            ->whenSuccess(function ($who, $money) {
                $who->receive($money);
            })
            ->whenFail(function ($who, $money) {
                $who->tellMe($money);
            });

        $this->assertEquals(
            $original_money - $lend_money,
            $shopkeeper->hasMoney()
        );
    }
}

?>