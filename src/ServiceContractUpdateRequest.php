<?php
namespace LUMASERV;

class ServiceContractUpdateRequest {
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
    public $runtime;
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
    public $accounting_period;
}

