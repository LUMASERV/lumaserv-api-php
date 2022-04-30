<?php
namespace LUMASERV;

class OfferPositionUpdateRequest {
    /**
     * @var float
     */
    public $purchasing_price;
    /**
     * @var string
     */
    public $note;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var OfferPositionInterval
     */
    public $interval;
    /**
     * @var string
     */
    public $title;
    /**
     * @var float
     */
    public $vat_rate;
}

