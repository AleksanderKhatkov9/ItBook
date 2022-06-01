<?php

class User
{

    private $name;
    private $login;
    private $password;
    private $email;

    /**
     * User constructor.
     * @param $name
     * @param $login
     * @param $password
     * @param $email
     */
    public function __construct($name, $login, $password, $email)
    {
        $this->name = $name;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }


}