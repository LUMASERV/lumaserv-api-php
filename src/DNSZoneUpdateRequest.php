<?php
namespace LUMASERV;

class DNSZoneUpdateRequest {
    /**
     * @var string
     */
    public $hostmaster;
    /**
     * @var string
     */
    public $ns2;
    /**
     * @var string
     */
    public $ns1;
    /**
     * @var object
     */
    public $labels;
}

