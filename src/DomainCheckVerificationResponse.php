<?php
namespace LUMASERV;

class DomainCheckVerificationResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DomainVerificationStatus
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

