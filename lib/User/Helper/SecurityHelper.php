<?php

namespace Da\User\Helper;

use yii\base\Security;

class SecurityHelper
{
    /**
     * @var Security
     */
    protected $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * Generates a secure hash from a password and a random salt.
     *
     * @param string $password
     * @param null|int $cost
     *
     * @return string
     */
    public function generatePasswordHash($password, $cost = null)
    {
        return $this->security->generatePasswordHash($password, $cost);
    }

    public function generateRandomString($length = 32)
    {
        return $this->security->generateRandomString($length);
    }

    public function validatePassword($password, $hash)
    {
        return $this->security->validatePassword($password, $hash);
    }

    public function generatePassword($length)
    {
        $sets = [
            'abcdefghjkmnpqrstuvwxyz',
            'ABCDEFGHJKMNPQRSTUVWXYZ',
            '23456789',
        ];
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }

        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++) {
            $password .= $all[array_rand($all)];
        }

        $password = str_shuffle($password);

        return $password;
    }
}
