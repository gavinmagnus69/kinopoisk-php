<?php

namespace App\Kernel\Auth;

use App\Kernel\Config\ConfigInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Session\SessionInterface;

class Auth implements AuthInterface
{
    public function __construct(
        private DatabaseInterface $db,
        private SessionInterface $session,
        private ConfigInterface $config
    ) {}

    public function attempt(string $username, string $password): bool
    {
        $user = $this->db->first($this->table(), [$this->username() => $username]);

        if (! $user) {
            return false;
        }

        if (! password_verify($password, $user[$this->password()])) {
            return false;
        }

        $this->session->set($this->sessionField(), $user['id']);

        return true;
    }

    public function logout(): void
    {
        $this->session->remove($this->sessionField());
    }

    public function user(): ?User
    {
        if (! $this->check()) {
            return null;
        }

        $usr = $this->db->first($this->table(), ['id' => $this->session->get($this->sessionField())]);

        if ($usr) {
            return new User($usr['id'], $usr[$this->username()], $usr[$this->password()], $usr['name']);
        }

        return null;
    }

    public function check(): bool
    {
        return $this->session->has($this->sessionField());
    }

    public function username(): string
    {
        return $this->config->get('auth.username', 'email');
    }

    public function password(): string
    {
        return $this->config->get('auth.password', 'password');
    }

    public function table(): string
    {
        return $this->config->get('auth.table', 'users');
    }

    public function sessionField(): string
    {
        return $this->config->get('auth.session_field', 'user_id');
    }
}
