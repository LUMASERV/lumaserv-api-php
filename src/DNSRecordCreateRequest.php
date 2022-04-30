<?php
namespace LUMASERV;

class DNSRecordCreateRequest {
    /**
     * @var string
     */
    public $data;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $type;
    /**
     * @var int
     */
    public $ttl;
}

