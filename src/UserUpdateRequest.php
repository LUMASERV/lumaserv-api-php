<?php
namespace LUMASERV;

class UserUpdateRequest {
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
     * @var UserState
     */
    public $state;
    /**
     * @var UserType
     */
    public $type;
    /**
     * @var string
     */
    public $customer_id;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

