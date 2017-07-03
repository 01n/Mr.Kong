<?php

require_once 'Shopkeeper.php';

class ShopkeeperDenyToLendMoneyTest extends PHPUnit_Framework_TestCase
{
    public function test_not_enough_money() {
        $original_money = 19;
        $lend_money = 20;

        $shopkeeper = new Shopkeeper($original_money);

        $somebody = $this->getMockBuilder('Somebody')
            ->setMethods(['receive', 'tellMe'])
            ->getMock();

        $somebody->expects($this->never())
            ->method('receive');

        $somebody->expects($this->once())
            ->method('tellMe')
            ->with($lend_money);

        $shopkeeper->lendTo($somebody, $lend_money)
            ->whenSuccess(function ($who, $money) {
                $who->receive($money);
            })
            ->whenFail(function ($who, $money) {
                $who->tellMe($money);
            });

        $this->assertEquals(
            $original_money,
            $shopkeeper->hasMoney()
        );
    }

    public function test_over_20_yuan() {
        $original_money = 200;
        $lend_money = 21;

        $shopkeeper = new Shopkeeper($original_money);

        $somebody = $this->getMockBuilder('Somebody')
            ->setMethods(['receive', 'tellMe'])
            ->getMock();

        $somebody->expects($this->never())
            ->method('receive');

        $somebody->expects($this->once())
            ->method('tellMe')
            ->with($lend_money);

        $shopkeeper->lendTo($somebody, $lend_money)
            ->whenSuccess(function ($who, $money) {
                $who->receive($money);
            })
            ->whenFail(function ($who, $money) {
                $who->tellMe($money);
            });

        $this->assertEquals(
            $original_money,
            $shopkeeper->hasMoney()
        );
    }

    public function test_not_enough_money_after_lend() {
        $original_money = 119;
        $lend_money = 20;

        $shopkeeper = new Shopkeeper($original_money);

        $somebody = $this->getMockBuilder('Somebody')
            ->setMethods(['receive', 'tellMe'])
            ->getMock();

        $somebody->expects($this->never())
            ->method('receive');

        $somebody->expects($this->once())
            ->method('tellMe')
            ->with($lend_money);

        $shopkeeper->lendTo($somebody, $lend_money)
            ->whenSuccess(function ($who, $money) {
                $who->receive($money);
            })
            ->whenFail(function ($who, $money) {
                $who->tellMe($money);
            });

        $this->assertEquals(
            $original_money,
            $shopkeeper->hasMoney()
        );
    }
}

?>