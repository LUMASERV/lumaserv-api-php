<?php
namespace LUMASERV;

class ServerGraphResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerGraphEntry[]
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

