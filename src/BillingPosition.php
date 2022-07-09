<?php
namespace LUMASERV;

class BillingPosition {
    /**
     * @var string
     */
    public $invoice_position_id;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var string
     */
    public $sync_key;
    /**
     * @var float
     */
    public $price;
    /**
     * @var bool
     */
    public $draft;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $customer_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $available_at;
    /**
     * @var float
     */
    public $vat_rate;
    /**
     * @var string
     */
    public $group_key;
}

