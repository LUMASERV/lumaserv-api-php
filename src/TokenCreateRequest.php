<?php
namespace LUMASERV;

class TokenCreateRequest {
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
    public $title;
}

