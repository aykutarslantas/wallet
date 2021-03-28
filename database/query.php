<?php

namespace database;

class query
{
    private $conn;

    public function __construct()
    {
        $database = new database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function getUser($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id=:id");
            $stmt->execute(array(':id'=>$id));
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch (\PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function getWallet($id){
        try {
            $stmt = $this->conn->prepare("select * from wallets where id=:id");
            $stmt->execute(array("id"=>$id));
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch (\PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }


    public function getBankWallet($userid){
        // user id yi al bankwallet default değeri 1
        try {
            $stmt = $this->conn->prepare("select * from user_wallets where wallet_id=:wallet_id and user_id=:user_id");
            $stmt->execute(array("user_id"=>$userid,"wallet_id"=>1));
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch (\PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    public function getBonusWallet($userid){
        // user id yi al bonuswallet default değeri 2
        try {
            $stmt = $this->conn->prepare("select * from user_wallets where wallet_id=:wallet_id and user_id=:user_id");
            $stmt->execute(array("user_id"=>$userid,"wallet_id"=>2));
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }catch (\PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public function depositBonus($userID, $amount)
    {
        try {
            $userWallet = $this->getBonusWallet($userID);
            $amountCurrent = $userWallet['amount'];
            $newAmount = $amountCurrent + $amount;

            $stmt = $this->conn->prepare("UPDATE user_wallets set amount=:amount where id=:id");
            $stmt->execute(array("id"=>$userWallet['id'],"amount"=>$newAmount));
            return true;
        }catch (\PDOException $e){
            echo $e;
            return false;
        }
    }
    public function withdrawBonus($userID, $amount): bool
    {
        try {
            $userWallet = $this->getBonusWallet($userID);
            $amountCurrent = $userWallet['amount'];
            $newAmount = $amountCurrent - $amount;

            $stmt = $this->conn->prepare("UPDATE user_wallets set amount=:amount where id=:id");
            $stmt->execute(array("id"=>$userWallet['id'],"amount"=>$newAmount));
            return true;
        }catch (\PDOException $e){
            echo $e;
            return false;
        }
    }

    public function depositBank($userID, $amount)
    {
        try {
            $userWallet = $this->getBankWallet($userID);
            $amountCurrent = $userWallet['amount'];
            $newAmount = $amountCurrent + $amount;

            $stmt = $this->conn->prepare("UPDATE user_wallets set amount=:amount where id=:id");
            $stmt->execute(array("id"=>$userWallet['id'],"amount"=>$newAmount));
            return true;
        }catch (\PDOException $e){
            echo $e;
            return false;
        }
    }
    public function withdrawBank($userID, $amount): bool
    {
        try {
            $userWallet = $this->getBankWallet($userID);
            $amountCurrent = $userWallet['amount'];
            $newAmount = $amountCurrent - $amount;

            $stmt = $this->conn->prepare("UPDATE user_wallets set amount=:amount where id=:id");
            $stmt->execute(array("id"=>$userWallet['id'],"amount"=>$newAmount));
            return true;
        }catch (\PDOException $e){
            echo $e;
            return false;
        }
    }

    public function Log($userID, $walletID, $log): bool
    {
        try {
            $stmt = $this->conn->prepare("INSERT INTO logs set user_id=:user_id, wallet_id=:wallet_id,log=:log");
            $stmt->execute(array("user_id"=>$userID,"wallet_id"=>$walletID,"log"=>$log));
            return true;
        }catch (\PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }
}


