<?php
namespace LUMASERV;

class ServerGraphEntry {
    /**
     * @var int
     */
    public $disk_read;
    /**
     * @var float
     */
    public $memory;
    /**
     * @var float
     */
    public $network_ingress;
    /**
     * @var float
     */
    public $network_egress;
    /**
     * @var float
     */
    public $memory_usage;
    /**
     * @var int
     */
    public $time;
    /**
     * @var float
     */
    public $cpu_usage;
    /**
     * @var int
     */
    public $disk_write;
}

