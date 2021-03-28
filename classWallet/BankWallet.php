<?php

namespace classWallet;
use database\query;

class BankWallet implements WalletInterface
{
    public int $walletID;
    public int $userID;

    public function __construct(User $user)
    {
        $this->userID = $user->id;
        $this->walletID = $this->getWalletId();
    }

    public function getWalletId(): int
    {
        $query = new query();
        $a = $query->getBankWallet($this->userID);
        return $a['id'];
    }

    public function deposit(float $amount, string $note): bool
    {
        $query = new query();
        $dep = $query->depositBank($this->userID,$amount);
        if ($dep){
            return true;
        }else{
            return false;
        }
        // burda amount arttırma işlemini yapacağız.
        // ardından istek atacağız istek true ise işlem tamam
        // işlem başarısız ise son işlemi iptal et

    }

    public function withdraw(float $amount, string $note): bool
    {
        $query = new query();
        $dep = $query->withdrawBank($this->userID,$amount);
        if ($dep){
            return true;
        }else{
            return false;
        }

        // burda amount değerini azaltma işlemini yapacağız.
        // ardından istek atacağız istek true ise işlem tamam
        // işlem başarısız ise son işlemi iptal et

    }
}

