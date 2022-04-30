<?php
namespace LUMASERV;

class Offer {
    /**
     * @var string
     */
    public $number;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var string
     */
    public $id;
    /**
     * @var float
     */
    public $net_amount;
    /**
     * @var OfferState
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

