<?php
namespace LUMASERV;

class CustomerCreateRequest {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $gender;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var BillingInterval
     */
    public $billing_interval;
    /**
     * @var float
     */
    public $custom_vat_rate;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var float
     */
    public $balance;
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var string
     */
    public $street;
    /**
     * @var string
     */
    public $tax_number;
    /**
     * @var string
     */
    public $company_name;
    /**
     * @var bool
     */
    public $auto_finalize;
    /**
     * @var string
     */
    public $street_number;
    /**
     * @var float
     */
    public $credit_limit;
    /**
     * @var int
     */
    public $payment_period;
    /**
     * @var string
     */
    public $vat_id;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

