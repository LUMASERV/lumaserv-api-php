<?php
namespace LUMASERV;

class LoginResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Token
     */
    public $data;
    /**
     * @var bool
     */
    public $success;
    /**
     * @var ResponseMessages
     */
    public $messages;
}

