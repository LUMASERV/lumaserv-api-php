<?php
namespace LUMASERV;

class PaymentReminderSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var PaymentReminder
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

