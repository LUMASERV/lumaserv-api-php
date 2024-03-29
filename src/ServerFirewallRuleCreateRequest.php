<?php
namespace LUMASERV;

class ServerFirewallRuleCreateRequest {
    /**
     * @var string[]
     */
    public $addresses;
    /**
     * @var ServerFirewallRuleProtocol
     */
    public $protocol;
    /**
     * @var string
     */
    public $description;
    /**
     * @var bool
     */
    public $disabled;
    /**
     * @var ServerFirewallRuleType
     */
    public $type;
    /**
     * @var string[]
     */
    public $ports;
}

