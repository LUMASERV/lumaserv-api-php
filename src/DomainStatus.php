<?php
namespace LUMASERV;

abstract class DomainStatus {
    const PENDING = "PENDING";
    const OK = "OK";
    const FAILED = "FAILED";
    const RESTRICTED = "RESTRICTED";
    const SUSPENDED = "SUSPENDED";
    const UNKNOWN = "UNKNOWN";
}

