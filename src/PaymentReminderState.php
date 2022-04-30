<?php
namespace LUMASERV;

abstract class PaymentReminderState {
    const DRAFT = "DRAFT";
    const PENDING = "PENDING";
    const PAID = "PAID";
    const CANCELLED = "CANCELLED";
    const FAILED = "FAILED";
}

