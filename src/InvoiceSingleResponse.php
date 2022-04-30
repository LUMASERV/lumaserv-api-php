<?php
namespace LUMASERV;

class InvoiceSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var InvoiceDetailed
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

