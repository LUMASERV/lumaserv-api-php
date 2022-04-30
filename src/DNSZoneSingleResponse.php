<?php
namespace LUMASERV;

class DNSZoneSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DNSZone
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

