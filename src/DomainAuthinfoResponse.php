<?php
namespace LUMASERV;

class DomainAuthinfoResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DomainAuthinfo
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

