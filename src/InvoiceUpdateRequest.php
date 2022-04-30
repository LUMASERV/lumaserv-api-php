<?php
namespace LUMASERV;

class InvoiceUpdateRequest {
    /**
     * @var string
     */
    public $paid_at;
    /**
     * @var string
     */
    public $cancelled_at;
    /**
     * @var string
     */
    public $due_at;
    /**
     * @var InvoiceState
     */
    public $state;
    /**
     * @var string
     */
    public $customer_id;
}

