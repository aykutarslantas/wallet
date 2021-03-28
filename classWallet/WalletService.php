<?php


namespace classWallet;

use database\query;

class WalletService implements WalletServiceInterface
{
    public WalletInterface $wallet; // wallet servisteki wallet_id
    public function __construct(WalletInterface $wallet)
    {
        $this->wallet = $wallet;
    }

    public function deposit(float $amount, string $note): bool
    {
        $w = new BonusWallet(User::find($this->wallet->userID));
        if ($w->deposit($amount,$note)){
            $a = file_get_contents('http://127.0.0.1/wallet/deposit.php?user_id='.$this->wallet->userID);
            if ($a){
                $query = new query();
                $query->Log($this->wallet->userID,$this->wallet->walletID,'D - Note:'.$note.' Amount:'.$amount);
                return true;
            }else{
                $w->deposit($amount,$note);
                $query = new query();
                $query->Log($this->wallet->userID,$this->wallet->walletID,'Error-W - Note:'.$note.' Amount:'.$amount);

                return false;
            }
        }
        return true;
    }

    public function withdraw(float $amount, string $note): bool
    {
        $w = new BankWallet(User::find($this->wallet->userID));
        if ($w->withdraw($amount,$note)){
            $a = file_get_contents('http://127.0.0.1/wallet/withdraw.php?user_id='.$this->wallet->userID);
            if (!$a){
                $query = new query();
                $query->Log($this->wallet->userID,$this->wallet->walletID,'W - Note:'.$note.' Amount:'.$amount);
                return true;
            }else{
                // deposit işlemini geri alalım
                $w->deposit($amount,$note);
                $query = new query();
                $query->Log($this->wallet->userID,$this->wallet->walletID,'Error-W - Note:'.$note.' Amount:'.$amount);

                return false;
            }
        }
    }
}
