<?php
namespace LUMASERV;

class S3AccessGrantSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var S3AccessGrant
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

