<?php
namespace LUMASERV;

abstract class ServerActionState {
    const STARTED = "STARTED";
    const CANCELLED = "CANCELLED";
    const FAILED = "FAILED";
    const SUCCESS = "SUCCESS";
}

