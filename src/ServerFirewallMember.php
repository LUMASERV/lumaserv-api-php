<?php
namespace LUMASERV;

class ServerFirewallMember {
    /**
     * @var string
     */
    public $label_value;
    /**
     * @var bool
     */
    public $applied;
    /**
     * @var ServerFirewallMember[]
     */
    public $children;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var ServerFirewallMemberType
     */
    public $type;
    /**
     * @var string
     */
    public $server_id;
    /**
     * @var string
     */
    public $label_name;
}

