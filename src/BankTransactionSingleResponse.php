<?php
namespace LUMASERV;

class BankTransactionSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var BankTransaction
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

