<?php

namespace classWallet;
use database\query;

class BonusWallet implements WalletInterface
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
        $a = $query->getBonusWallet($this->userID);
        return $a['id'];
    }

    public function deposit(float $amount, string $note): bool
    {
        $query = new query();
        $dep = $query->depositBonus($this->userID,$amount);
        if ($dep){
            return true;
        }else{
            return false;
        }
    }

    public function withdraw(float $amount, string $note): bool
    {
        $query = new query();
        $dep = $query->withdrawBonus($this->userID,$amount);
        if ($dep){
            return true;
        }else{
            return false;
        }
    }
}
