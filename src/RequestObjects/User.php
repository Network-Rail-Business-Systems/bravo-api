<?php

namespace NetworkRailBusinessSystems\BravoApi\RequestObjects;

class User
{
    public ?string $name;
    public ?int $id;
    public ?string $login;

    public function toArray(): array
    {
        $user = [];

        if (isset($this->name)) {
            $user['name'] = $this->name;
        }

        if (isset($this->id)) {
            $user['id'] = $this->id;
        }

        if (isset($this->login)) {
            $user['login'] = $this->login;
        }

        return $user;
    }
}
