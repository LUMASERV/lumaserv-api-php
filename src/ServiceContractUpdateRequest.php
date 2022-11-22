<?php
namespace LUMASERV;

class ServiceContractUpdateRequest {
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
     * @var float
     */
    public $unit_price;
    /**
     * @var ServiceContractInterval
     */
    public $renewal_interval;
    /**
     * @var ServiceContractInterval
     */
    public $accounting_period;
}

