<?php
namespace LUMASERV;

class DomainPriceListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DomainPricing[]
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

