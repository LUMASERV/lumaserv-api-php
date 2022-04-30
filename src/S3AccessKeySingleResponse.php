<?php
namespace LUMASERV;

class S3AccessKeySingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var S3AccessKey
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

