<?php
namespace LUMASERV;

class PaymentReminder {
    /**
     * @var string
     */
    public $date;
    /**
     * @var PaymentReminderStage
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
    public $id;
    /**
     * @var PaymentReminderState
     */
    public $state;
    /**
     * @var string
     */
    public $customer_id;
}

