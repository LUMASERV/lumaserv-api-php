<?php
namespace LUMASERV;

class InvoiceCreateRequest {
    /**
     * @var string
     */
    public $due_at;
    /**
     * @var InvoiceCreateRequestPosition[]
     */
    public $positions;
    /**
     * @var string
     */
    public $customer_id;
}

