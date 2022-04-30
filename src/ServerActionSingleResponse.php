<?php
namespace LUMASERV;

class ServerActionSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerAction
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

