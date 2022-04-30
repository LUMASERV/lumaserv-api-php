<?php
namespace LUMASERV;

class UserCreateRequest {
    /**
     * @var string
     */
    public $password;
    /**
     * @var Gender
     */
    public $gender;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $company;
    /**
     * @var UserType
     */
    public $type;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

