<?php
namespace LUMASERV;

class Invoice {
    /**
     * @var string
     */
    public $paid_at;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $due_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var InvoiceState
     */
    public $state;
    /**
     * @var string
     */
    public $customer_id;
}

