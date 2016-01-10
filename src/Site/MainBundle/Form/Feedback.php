<?php

namespace Site\MainBundle\Form;

class Feedback
{

    /**
     * Имя
     *
     * @var
     */
    private $name;

    /**
     * Телефон
     *
     * @var
     */
    private $phone;

    /**
     * Email
     *
     * @var
     */
    private $email;

    /**
     * Тема
     *
     * @var
     */
    private $theme;

    /**
     * Сообщение
     *
     * @var
     */
    private $message;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;

        return $this;
    }

    public function getTheme()
    {
        return $this->theme;
    }

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

}
