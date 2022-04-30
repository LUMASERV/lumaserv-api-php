<?php
namespace LUMASERV;

class PaymentReminderCreateRequest {
    /**
     * @var string
     */
    public $date;
    /**
     * @var string
     */
    public $stage;
    /**
     * @var string
     */
    public $due_date;
    /**
     * @var string
     */
    public $invoice_id;
    /**
     * @var string
     */
    public $state;
    /**
     * @var string
     */
    public $customer_id;
}

