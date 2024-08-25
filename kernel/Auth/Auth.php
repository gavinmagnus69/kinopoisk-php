<?php


namespace App\Kernel\Auth;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;

class Auth implements AuthInterface {
    

    public function __construct(
        private DatabaseInterface $db,
        private SessionInterface $session,

    )
    {
        
    }
    public function attempt(string $username, string $password): bool
    {
        return true;
        
    }

    public function logout(): void
    {
        
    }

    public function user(): ?array
    {
        return [];
    }

    public function check(): bool
    {
        return true;
        
    }
}