<?php
namespace LUMASERV;

class ServiceContractCreateRequest {
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
     * @var CreateRequestPosition[]
     */
    public $positions;
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

