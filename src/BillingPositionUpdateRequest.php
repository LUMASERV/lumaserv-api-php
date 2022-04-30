<?php
namespace LUMASERV;

class BillingPositionUpdateRequest {
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
    public $unit;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
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

