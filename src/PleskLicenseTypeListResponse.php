<?php
namespace LUMASERV;

class PleskLicenseTypeListResponse {
    /**
     * @var ResponseMessages
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var PleskLicenseType[]
     */
    public $data;
    /**
     * @var bool
     */
    public $success;
    /**
     * @var ResponseMessages
     */
    public $messages;
}

