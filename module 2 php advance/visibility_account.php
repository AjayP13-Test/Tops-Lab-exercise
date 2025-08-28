<?php
class Account {
    private $balance = 0;

    protected function addBalance($amount) {
        $this->balance += $amount;
    }

    public function deposit($amount) {
        $this->addBalance($amount);
    }

    public function getBalance() {
        return $this->balance;
    }
}

$acc = new Account();
$acc->deposit(1000);
echo "Balance: " . $acc->getBalance();
?>
