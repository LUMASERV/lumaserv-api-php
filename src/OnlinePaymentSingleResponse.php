<?php
namespace LUMASERV;

class OnlinePaymentSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var OnlinePayment
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

