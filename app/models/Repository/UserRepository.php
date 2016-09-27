<?php
namespace Repository;

use App\Doctrine\Repository;
use Entity\User as Record;

class UserRepository extends Repository
{
    /**
     * @param $username
     * @param $password
     * @return bool|null|object
     */
    public function authenticate($username, $password)
    {
        $login_info = $this->findOneBy(['email' => $username]);

        if (!($login_info instanceof Record))
            return FALSE;

        if ($login_info->verifyPassword($password))
            return $login_info;
        else
            return FALSE;
    }

    /**
     * Creates or returns an existing user with the specified e-mail address.
     *
     * @param $email
     * @return \Entity\User
     */
    public function getOrCreate($email)
    {
        $user = $this->findOneBy(['email' => $email]);

        if (!($user instanceof Record))
        {
            $user = new Record;
            $user->email = $email;
            $user->name = $email;
        }

        return $user;
    }
}