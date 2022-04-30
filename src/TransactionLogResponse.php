<?php
namespace LUMASERV;

class TransactionLogResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var object[]
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

