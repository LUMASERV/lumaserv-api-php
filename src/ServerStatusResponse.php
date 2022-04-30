<?php
namespace LUMASERV;

class ServerStatusResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerStatus
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

