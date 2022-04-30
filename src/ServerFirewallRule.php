<?php
namespace LUMASERV;

class ServerFirewallRule {
    /**
     * @var string[]
     */
    public $addresses;
    /**
     * @var ServerFirewallRuleProtocol
     */
    public $protocol;
    /**
     * @var bool
     */
    public $applied;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var ServerFirewallRuleType
     */
    public $type;
    /**
     * @var string[]
     */
    public $ports;
}

