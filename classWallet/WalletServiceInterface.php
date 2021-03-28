<?php

namespace classWallet;

interface WalletServiceInterface
{
    public function __construct(WalletInterface $wallet);

    public function deposit(float $amount, string $note): bool;

    public function withdraw(float $amount, string $note): bool;
}