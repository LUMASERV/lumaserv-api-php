<?php
namespace LUMASERV;

class ServiceContractCreateRequest {
    /**
     * @var string
     */
    public $unit;
    /**
     * @var int
     */
    public $cancellation_period;
    /**
     * @var string
     */
    public $description;
    /**
     * @var ServiceContractInterval
     */
    public $billing_interval;
    /**
     * @var float
     */
    public $unit_amount;
    /**
     * @var string
     */
    public $customer_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var ServiceContractInterval
     */
    public $renewal_interval;
    /**
     * @var float
     */
    public $unit_price;
    /**
     * @var float
     */
    public $vat_rate;
}

