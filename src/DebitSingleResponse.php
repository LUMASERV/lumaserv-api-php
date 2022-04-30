<?php
namespace LUMASERV;

class DebitSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Debit
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

