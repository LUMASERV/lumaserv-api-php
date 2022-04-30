<?php
namespace LUMASERV;

class OfferCreateRequest {
    /**
     * @var string
     */
    public $number;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var OfferCreateRequestPosition[]
     */
    public $positions;
    /**
     * @var float
     */
    public $net_amount;
    /**
     * @var OfferState
     */
    public $state;
    /**
     * @var string
     */
    public $customer_id;
}

