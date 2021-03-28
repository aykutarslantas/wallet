<?php

namespace classWallet;

interface WalletInterface
{
    public function __construct(User $user);

    public function getWalletId(): int;

    public function deposit(float $amount, string $note): bool;

    public function withdraw(float $amount, string $note): bool;
}