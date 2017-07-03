<?php

class MrKong
{
    private $my_money;

    public function __construct($money) {
        $this->my_money = $money;
    }

    public function hasMoney() {
        return $this->my_money;
    }

    public function receive($amount) {
        $this->my_money += $amount;

        return $this->my_money;
    }
}

?>