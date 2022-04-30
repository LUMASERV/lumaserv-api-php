<?php
namespace LUMASERV;

class TokenValidationResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var TokenValidationInfo
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

