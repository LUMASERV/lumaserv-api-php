<?php
namespace LUMASERV;

class PasswordChangeRequest {
    /**
     * @var string
     */
    public $new_password_confirm;
    /**
     * @var string
     */
    public $new_password;
    /**
     * @var string
     */
    public $current_password;
}

