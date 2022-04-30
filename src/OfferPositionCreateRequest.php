<?php
namespace LUMASERV;

class OfferPositionCreateRequest {
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
     * @var string
     */
    public $offer_id;
    /**
     * @var float
     */
    public $vat_rate;
}

