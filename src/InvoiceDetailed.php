<?php
namespace LUMASERV;

class InvoiceDetailed {
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
     * @var float
     */
    public $net_price;
    /**
     * @var float
     */
    public $gross_price;
    /**
     * @var Position[]
     */
    public $positions;
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

