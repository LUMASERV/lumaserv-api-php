<?php
namespace LUMASERV;

class DNSRecordSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DNSRecord
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

