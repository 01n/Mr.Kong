<?php

class Shopkeeper
{
    private $my_money;
    private $lend_amount_last_time;

    public function __construct($money) {
        $this->my_money = $money;
    }

    public function hasMoney() {
        return $this->my_money;
    }

    public function lendTo($whom, $amount) {
        $this->lend_to_whom = $whom;
        $this->lend_amount_last_time = $amount;

        return $this;
    }

    public function whenSuccess($func_when_success) {
        if ($this->canILendMoney()===true) {
            $this->my_money -= $this->lend_amount_last_time;

            call_user_func(
                $func_when_success,
                $this->lend_to_whom,
                $this->lend_amount_last_time
            );
        }

        return $this;
    }

    public function whenFail($func_when_fail) {
        if ($this->canILendMoney()===false) {
            call_user_func(
                $func_when_fail,
                $this->lend_to_whom,
                $this->lend_amount_last_time
            );
        }

        return $this;
    }

    private function canILendMoney() {
        return $this->hasEnoughMoney()
            && $this->notOverLimited()
            && $this->hasEnoughMoneyAfterLend();
    }

    private function hasEnoughMoney() {
        return $this->my_money >= $this->lend_amount_last_time;
    }

    private function hasEnoughMoneyAfterLend() {
        return $this->my_money - $this->lend_amount_last_time >= 100;
    }

    private function notOverLimited() {
        return $this->lend_amount_last_time <= 20;
    }
}

?>