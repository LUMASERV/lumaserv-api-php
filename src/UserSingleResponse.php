<?php
namespace LUMASERV;

class UserSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var User
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

