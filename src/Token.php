<?php
namespace LUMASERV;

class Token {
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var TokenScope
     */
    public $scope;
    /**
     * @var string
     */
    public $validUntil;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $token;
}

