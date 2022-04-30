<?php
namespace LUMASERV;

class PaymentReminderUpdateRequest {
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
     * @var PaymentReminderState
     */
    public $state;
}

