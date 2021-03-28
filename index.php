<?php

require_once 'autoload.php';
use database\query;
use classWallet\User;
use classWallet\BankWallet as BankWallet;
use classWallet\BonusWallet as BonusWallet;
use classWallet\WalletService;


$user = User::find(1);

$bankWallet = new BankWallet($user);
$bonusWallet = new BonusWallet($user);


$bankWalletService = new WalletService($bankWallet);
$bonusWalletService = new WalletService($bonusWallet);

var_dump($bankWalletService->withdraw(3850.42,"Dellsaddas ...."));
var_dump($bonusWalletService->deposit(38.5,"Dellsaddas ...."));
exit();

