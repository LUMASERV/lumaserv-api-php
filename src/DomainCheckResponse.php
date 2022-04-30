<?php
namespace LUMASERV;

class DomainCheckResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DomainCheckResult
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

