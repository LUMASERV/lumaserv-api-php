<?php
namespace LUMASERV;

class OfferUpdateRequest {
    /**
     * @var float
     */
    public $amount;
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

