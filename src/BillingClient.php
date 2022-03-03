<?php
namespace LUMASERV;

use JsonMapper;

class BillingClient {
    private $apiKey;
    private $baseUrl;
    private $mapper;

    public function __construct ($apiKey, $baseUrl = "https://billing.lumaserv.com") {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
        $this->mapper = new JsonMapper();
        $this->mapper->bStrictNullTypes = false;
    }

    public function request ($method, $path, $params, $body = NULL) {
        $curl = curl_init();
        $queryStr = http_build_query($params);
        curl_setopt($curl, CURLOPT_URL, $this->baseUrl . $path . (strlen($queryStr) > 0 ? "?" . $queryStr : ""));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $this->apiKey,
            'Content-Type: application/json'
        ]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($body != NULL)
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    /**
     * @return FileSingleResponse
     */
    public function getInvoiceFile($id, $queryParams = []) {
        $json = $this->request("GET", "/invoices/$id/file", $queryParams);
        return $this->mapper->map($json, new FileSingleResponse());
    }

    /**
     * @return InvoicePositionSingleResponse
     */
    public function createInvoicePosition($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/invoices/$id/positions", $queryParams, $body);
        return $this->mapper->map($json, new InvoicePositionSingleResponse());
    }

    /**
     * @return InvoicePositionListResponse
     */
    public function getInvoicePositions($id, $queryParams = []) {
        $json = $this->request("GET", "/invoices/$id/positions", $queryParams);
        return $this->mapper->map($json, new InvoicePositionListResponse());
    }

    /**
     * @return BillingPositionSingleResponse
     */
    public function getBillingPosition($id, $queryParams = []) {
        $json = $this->request("GET", "/billing-positions/$id", $queryParams);
        return $this->mapper->map($json, new BillingPositionSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteBillingPosition($id, $queryParams = []) {
        $json = $this->request("DELETE", "/billing-positions/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return BillingPositionSingleResponse
     */
    public function updateBillingPosition($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/billing-positions/$id", $queryParams, $body);
        return $this->mapper->map($json, new BillingPositionSingleResponse());
    }

    /**
     * @return ServiceContractPositionSingleResponse
     */
    public function createServiceContractPosition($body, $queryParams = []) {
        $json = $this->request("POST", "/service-contract-positions", $queryParams, $body);
        return $this->mapper->map($json, new ServiceContractPositionSingleResponse());
    }

    /**
     * @return ServiceContractPositionListResponse
     */
    public function getServiceContractPositions($queryParams = []) {
        $json = $this->request("GET", "/service-contract-positions", $queryParams);
        return $this->mapper->map($json, new ServiceContractPositionListResponse());
    }

    /**
     * @return BillingPositionSingleResponse
     */
    public function createBillingPosition($body, $queryParams = []) {
        $json = $this->request("POST", "/billing-positions", $queryParams, $body);
        return $this->mapper->map($json, new BillingPositionSingleResponse());
    }

    /**
     * @return BillingPositionListResponse
     */
    public function getBillingPositions($queryParams = []) {
        $json = $this->request("GET", "/billing-positions", $queryParams);
        return $this->mapper->map($json, new BillingPositionListResponse());
    }

    /**
     * @return CustomerSingleResponse
     */
    public function createCustomer($body, $queryParams = []) {
        $json = $this->request("POST", "/customers", $queryParams, $body);
        return $this->mapper->map($json, new CustomerSingleResponse());
    }

    /**
     * @return CustomerListResponse
     */
    public function getCustomers($queryParams = []) {
        $json = $this->request("GET", "/customers", $queryParams);
        return $this->mapper->map($json, new CustomerListResponse());
    }

    /**
     * @return DebitListResponse
     */
    public function getDebits($queryParams = []) {
        $json = $this->request("GET", "/debits", $queryParams);
        return $this->mapper->map($json, new DebitListResponse());
    }

    /**
     * @return CustomerSingleResponse
     */
    public function getCustomer($id, $queryParams = []) {
        $json = $this->request("GET", "/customers/$id", $queryParams);
        return $this->mapper->map($json, new CustomerSingleResponse());
    }

    /**
     * @return CustomerSingleResponse
     */
    public function updateCustomer($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/customers/$id", $queryParams, $body);
        return $this->mapper->map($json, new CustomerSingleResponse());
    }

    /**
     * @return OnlinePaymentListResponse
     */
    public function getOnlinePayments($queryParams = []) {
        $json = $this->request("GET", "/online-payments", $queryParams);
        return $this->mapper->map($json, new OnlinePaymentListResponse());
    }

    /**
     * @return InvoiceSingleResponse
     */
    public function createInvoice($body, $queryParams = []) {
        $json = $this->request("POST", "/invoices", $queryParams, $body);
        return $this->mapper->map($json, new InvoiceSingleResponse());
    }

    /**
     * @return InvoiceListResponse
     */
    public function getInvoices($queryParams = []) {
        $json = $this->request("GET", "/invoices", $queryParams);
        return $this->mapper->map($json, new InvoiceListResponse());
    }

    /**
     * @return OfferPositionSingleResponse
     */
    public function getOfferPosition($id, $queryParams = []) {
        $json = $this->request("GET", "/offer-positions/$id", $queryParams);
        return $this->mapper->map($json, new OfferPositionSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteOfferPosition($id, $queryParams = []) {
        $json = $this->request("DELETE", "/offer-positions/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return OfferPositionSingleResponse
     */
    public function updateOfferPosition($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/offer-positions/$id", $queryParams, $body);
        return $this->mapper->map($json, new OfferPositionSingleResponse());
    }

    /**
     * @return ServiceContractPositionSingleResponse
     */
    public function getServiceContractPosition($id, $queryParams = []) {
        $json = $this->request("GET", "/service-contract-positions/$id", $queryParams);
        return $this->mapper->map($json, new ServiceContractPositionSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServiceContractPosition($id, $queryParams = []) {
        $json = $this->request("DELETE", "/service-contract-positions/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ServiceContractPositionSingleResponse
     */
    public function updateServiceContractPosition($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/service-contract-positions/$id", $queryParams, $body);
        return $this->mapper->map($json, new ServiceContractPositionSingleResponse());
    }

    /**
     * @return PaymentReminderSingleResponse
     */
    public function getPaymentReminder($id, $queryParams = []) {
        $json = $this->request("GET", "/payment-reminders/$id", $queryParams);
        return $this->mapper->map($json, new PaymentReminderSingleResponse());
    }

    /**
     * @return PaymentReminderSingleResponse
     */
    public function updatePaymentReminder($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/payment-reminders/$id", $queryParams, $body);
        return $this->mapper->map($json, new PaymentReminderSingleResponse());
    }

    /**
     * @return DebitMandateSingleResponse
     */
    public function createDebitMandate($body, $queryParams = []) {
        $json = $this->request("POST", "/debit-mandates", $queryParams, $body);
        return $this->mapper->map($json, new DebitMandateSingleResponse());
    }

    /**
     * @return DebitMandateListResponse
     */
    public function getDebitMandates($queryParams = []) {
        $json = $this->request("GET", "/debit-mandates", $queryParams);
        return $this->mapper->map($json, new DebitMandateListResponse());
    }

    /**
     * @return BankTransactionListResponse
     */
    public function getBankTransactions($queryParams = []) {
        $json = $this->request("GET", "/bank-transactions", $queryParams);
        return $this->mapper->map($json, new BankTransactionListResponse());
    }

    /**
     * @return DebitMandateSingleResponse
     */
    public function getDebitMandate($id, $queryParams = []) {
        $json = $this->request("GET", "/debit-mandates/$id", $queryParams);
        return $this->mapper->map($json, new DebitMandateSingleResponse());
    }

    /**
     * @return BankTransactionSingleResponse
     */
    public function getBankTransaction($id, $queryParams = []) {
        $json = $this->request("GET", "/bank-transactions/$id", $queryParams);
        return $this->mapper->map($json, new BankTransactionSingleResponse());
    }

    /**
     * @return OfferSingleResponse
     */
    public function getOffer($id, $queryParams = []) {
        $json = $this->request("GET", "/offers/$id", $queryParams);
        return $this->mapper->map($json, new OfferSingleResponse());
    }

    /**
     * @return OfferSingleResponse
     */
    public function updateOffer($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/offers/$id", $queryParams, $body);
        return $this->mapper->map($json, new OfferSingleResponse());
    }

    /**
     * @return InvoicePositionSingleResponse
     */
    public function getInvoicePosition($invoice_id, $id, $queryParams = []) {
        $json = $this->request("GET", "/invoices/$invoice_id/positions/$id", $queryParams);
        return $this->mapper->map($json, new InvoicePositionSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteInvoicePosition($invoice_id, $id, $queryParams = []) {
        $json = $this->request("DELETE", "/invoices/$invoice_id/positions/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return InvoicePositionSingleResponse
     */
    public function updateInvoicePosition($body, $invoice_id, $id, $queryParams = []) {
        $json = $this->request("PUT", "/invoices/$invoice_id/positions/$id", $queryParams, $body);
        return $this->mapper->map($json, new InvoicePositionSingleResponse());
    }

    /**
     * @return ServiceContractSingleResponse
     */
    public function createServiceContract($body, $queryParams = []) {
        $json = $this->request("POST", "/service-contracts", $queryParams, $body);
        return $this->mapper->map($json, new ServiceContractSingleResponse());
    }

    /**
     * @return ServiceContractListResponse
     */
    public function getServiceContracts($queryParams = []) {
        $json = $this->request("GET", "/service-contracts", $queryParams);
        return $this->mapper->map($json, new ServiceContractListResponse());
    }

    /**
     * @return InvoiceSingleResponse
     */
    public function getInvoice($id, $queryParams = []) {
        $json = $this->request("GET", "/invoices/$id", $queryParams);
        return $this->mapper->map($json, new InvoiceSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteInvoice($id, $queryParams = []) {
        $json = $this->request("DELETE", "/invoices/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return InvoiceSingleResponse
     */
    public function updateInvoice($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/invoices/$id", $queryParams, $body);
        return $this->mapper->map($json, new InvoiceSingleResponse());
    }

    /**
     * @return OnlinePaymentSingleResponse
     */
    public function getOnlinePayment($id, $queryParams = []) {
        $json = $this->request("GET", "/online-payments/$id", $queryParams);
        return $this->mapper->map($json, new OnlinePaymentSingleResponse());
    }

    /**
     * @return DebitSingleResponse
     */
    public function getDebit($id, $queryParams = []) {
        $json = $this->request("GET", "/debits/$id", $queryParams);
        return $this->mapper->map($json, new DebitSingleResponse());
    }

    /**
     * @return OfferSingleResponse
     */
    public function createOffer($body, $queryParams = []) {
        $json = $this->request("POST", "/offers", $queryParams, $body);
        return $this->mapper->map($json, new OfferSingleResponse());
    }

    /**
     * @return OfferListResponse
     */
    public function getOffers($queryParams = []) {
        $json = $this->request("GET", "/offers", $queryParams);
        return $this->mapper->map($json, new OfferListResponse());
    }

    /**
     * @return ServiceContractSingleResponse
     */
    public function getServiceContract($id, $queryParams = []) {
        $json = $this->request("GET", "/service-contracts/$id", $queryParams);
        return $this->mapper->map($json, new ServiceContractSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServiceContract($id, $queryParams = []) {
        $json = $this->request("DELETE", "/service-contracts/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ServiceContractSingleResponse
     */
    public function updateServiceContract($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/service-contracts/$id", $queryParams, $body);
        return $this->mapper->map($json, new ServiceContractSingleResponse());
    }

    /**
     * @return OfferPositionSingleResponse
     */
    public function createOfferPosition($body, $queryParams = []) {
        $json = $this->request("POST", "/offer-positions", $queryParams, $body);
        return $this->mapper->map($json, new OfferPositionSingleResponse());
    }

    /**
     * @return OfferPositionListResponse
     */
    public function getOfferPositions($queryParams = []) {
        $json = $this->request("GET", "/offer-positions", $queryParams);
        return $this->mapper->map($json, new OfferPositionListResponse());
    }

    /**
     * @return PaymentReminderSingleResponse
     */
    public function createPaymentReminder($body, $queryParams = []) {
        $json = $this->request("POST", "/payment-reminders", $queryParams, $body);
        return $this->mapper->map($json, new PaymentReminderSingleResponse());
    }

    /**
     * @return PaymentReminderListResponse
     */
    public function getPaymentReminders($queryParams = []) {
        $json = $this->request("GET", "/payment-reminders", $queryParams);
        return $this->mapper->map($json, new PaymentReminderListResponse());
    }


}
abstract class BillingInterval {
    const MONTHLY = "MONTHLY";
    const QUARTERLY = "QUARTERLY";
    const SEMI_ANNUAL = "SEMI_ANNUAL";
    const ANNUAL = "ANNUAL";
}

class InvoiceDetailed {
    /**
     * @var string
     */
    public $paid_at;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $due_at;
    /**
     * @var InvoicePosition[]
     */
    public $positions;
    /**
     * @var string
     */
    public $id;
    /**
     * @var InvoiceState
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

class OfferCreateRequestPosition {
    /**
     * @var string
     */
    public $purchasing_price;
    /**
     * @var string
     */
    public $note;
    /**
     * @var string
     */
    public $amount;
    /**
     * @var string
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $interval;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $offer_id;
    /**
     * @var string
     */
    public $vat_rate;
}

class Invoice {
    /**
     * @var string
     */
    public $paid_at;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $due_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var InvoiceState
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

class Customer {
    /**
     * @var float
     */
    public $balance;
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var string
     */
    public $company_name;
    /**
     * @var float
     */
    public $credit_limit;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var BillingInterval
     */
    public $billing_interval;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $next_billing_date;
}

abstract class ServiceContractInterval {
    const WEEKLY = "WEEKLY";
    const MONTHLY = "MONTHLY";
    const QUARTERLY = "QUARTERLY";
    const SEMI_ANNUAL = "SEMI_ANNUAL";
    const ANNUAL = "ANNUAL";
}

class BankTransaction {
    /**
     * @var string
     */
    public $bank_account_id;
    /**
     * @var string
     */
    public $bank_code;
    /**
     * @var string
     */
    public $account_number;
    /**
     * @var string
     */
    public $amount;
    /**
     * @var string
     */
    public $booking_date;
    /**
     * @var string
     */
    public $booking_text;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $debit_id;
    /**
     * @var string
     */
    public $reference;
    /**
     * @var string
     */
    public $depositor;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $extended_reference;
    /**
     * @var string
     */
    public $value_date;
}

class PaymentReminder {
    /**
     * @var string
     */
    public $date;
    /**
     * @var PaymentReminderStage
     */
    public $stage;
    /**
     * @var string
     */
    public $due_date;
    /**
     * @var string
     */
    public $invoice_id;
    /**
     * @var string
     */
    public $id;
    /**
     * @var PaymentReminderState
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

class FileDownload {
    /**
     * @var string
     */
    public $file_id;
    /**
     * @var string
     */
    public $url;
}

class InvoiceCreateRequestPosition {
    /**
     * @var float
     */
    public $amount;
    /**
     * @var string
     */
    public $unit;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var float
     */
    public $vat_rate;
    /**
     * @var string
     */
    public $group;
}

class ResponseMessages {
    /**
     * @var ResponseMessage[]
     */
    public $warnings;
    /**
     * @var ResponseMessage[]
     */
    public $errors;
    /**
     * @var ResponseMessage[]
     */
    public $infos;
}

class CustomerDetailed {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var BillingInterval
     */
    public $billing_interval;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var float
     */
    public $balance;
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var string
     */
    public $street;
    /**
     * @var string
     */
    public $tax_number;
    /**
     * @var string
     */
    public $company_name;
    /**
     * @var float
     */
    public $credit_limit;
    /**
     * @var string
     */
    public $street_number;
    /**
     * @var string
     */
    public $vat_id;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $next_billing_date;
}

class Debit {
    /**
     * @var string
     */
    public $date;
    /**
     * @var string
     */
    public $due_date;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
}

class OnlinePayment {
    /**
     * @var float
     */
    public $amount;
    /**
     * @var string
     */
    public $provider;
    /**
     * @var string
     */
    public $external_id;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

class ServiceContractCreateRequestPosition {
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $title;
    /**
     * @var float
     */
    public $vat_rate;
}

class ServiceContractPosition {
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $service_contract_id;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var float
     */
    public $vat_rate;
}

class ServiceContract {
    /**
     * @var int
     */
    public $cancellation_period;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $runtime;
    /**
     * @var string
     */
    public $id;
    /**
     * @var int
     */
    public $customer_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $accounting_period;
}

abstract class OfferPositionInterval {
    const WEEKLY = "WEEKLY";
    const MONTHLY = "MONTHLY";
    const QUARTERLY = "QUARTERLY";
    const SEMI_ANNUAL = "SEMI_ANNUAL";
    const ANNUAL = "ANNUAL";
}

class ResponseMessage {
    /**
     * @var string
     */
    public $message;
    /**
     * @var string
     */
    public $key;
}

abstract class PaymentReminderStage {
    const STAGE1 = "STAGE1";
    const STAGE2 = "STAGE2";
    const STAGE3 = "STAGE3";
}

abstract class CustomerTransactionType {
    const INVOICE = "INVOICE";
    const REMINDER_FEE = "REMINDER_FEE";
    const ONLINE_PAYMENT = "ONLINE_PAYMENT";
    const BANK = "BANK";
}

class OfferPosition {
    /**
     * @var float
     */
    public $purchasing_price;
    /**
     * @var string
     */
    public $note;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $interval;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $offer_id;
    /**
     * @var float
     */
    public $vat_rate;
}

abstract class PaymentReminderState {
    const DRAFT = "DRAFT";
    const PENDING = "PENDING";
    const PAID = "PAID";
    const CANCELLED = "CANCELLED";
    const FAILED = "FAILED";
}

class ResponsePagination {
    /**
     * @var int
     */
    public $total;
    /**
     * @var int
     */
    public $page;
    /**
     * @var int
     */
    public $page_size;
}

class Offer {
    /**
     * @var string
     */
    public $number;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var string
     */
    public $id;
    /**
     * @var float
     */
    public $net_amount;
    /**
     * @var OfferState
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

class BillingPosition {
    /**
     * @var string
     */
    public $invoice_position_id;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $id;
    /**
     * @var int
     */
    public $customer_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $available_at;
    /**
     * @var float
     */
    public $vat_rate;
    /**
     * @var string
     */
    public $group_key;
}

class DebitMandate {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $bank_code;
    /**
     * @var string
     */
    public $account_number;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $valid_until;
    /**
     * @var string
     */
    public $street;
    /**
     * @var string
     */
    public $street_number;
    /**
     * @var string
     */
    public $bank_name;
    /**
     * @var string
     */
    public $signed_at;
    /**
     * @var string
     */
    public $depositor;
    /**
     * @var string
     */
    public $id;
    /**
     * @var int
     */
    public $customer_id;
    /**
     * @var string
     */
    public $postal_code;
}

class InvoicePosition {
    /**
     * @var float
     */
    public $amount;
    /**
     * @var string
     */
    public $unit;
    /**
     * @var string
     */
    public $updated_at;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var float
     */
    public $position;
    /**
     * @var float
     */
    public $vat_rate;
    /**
     * @var string
     */
    public $group_key;
}

abstract class InvoiceState {
    const OPEN = "OPEN";
    const DRAFT = "DRAFT";
    const FINAL = "FINAL";
}

class File {
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $state;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $object_id;
}

abstract class OfferState {
    const DRAFT = "DRAFT";
    const SENT = "SENT";
    const ACCEPTED = "ACCEPTED";
    const DENIED = "DENIED";
}

class ResponseMetadata {
    /**
     * @var string
     */
    public $transaction_id;
    /**
     * @var string
     */
    public $build_commit;
    /**
     * @var string
     */
    public $build_timestamp;
}

class ServiceContractListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServiceContract[]
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

class CustomerListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Customer[]
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

class InvalidRequestResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var object
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

class PaymentReminderSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var PaymentReminder
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

class ServiceContractPositionSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServiceContractPosition
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

class InvoiceListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Invoice[]
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

class DebitMandateSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DebitMandate
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

class DebitMandateListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var DebitMandate[]
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

class OfferPositionSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var OfferPosition
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

class OfferPositionListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var OfferPosition[]
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

class OnlinePaymentListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var OnlinePayment[]
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

class BillingPositionSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var BillingPosition
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

class InvoicePositionListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var InvoicePosition[]
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

class BankTransactionSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var BankTransaction
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

class PaymentReminderListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var PaymentReminder[]
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

class BankTransactionListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var BankTransaction[]
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

class InvoicePositionSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var InvoicePosition
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

class OfferListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Offer[]
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

class InvoiceSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var InvoiceDetailed
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

class CustomerSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var CustomerDetailed
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

class OfferSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Offer
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

class ServiceContractSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServiceContract
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

class DebitSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Debit
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

class OnlinePaymentSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var OnlinePayment
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

class DebitListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Debit[]
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

class ServiceContractPositionListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServiceContractPosition[]
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

class EmptyResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var bool
     */
    public $success;
    /**
     * @var ResponseMessages
     */
    public $messages;
}

class BillingPositionListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var BillingPosition[]
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

class OfferUpdateRequest {
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $net_amount;
    /**
     * @var OfferState
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

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
     * @var int
     */
    public $customer_id;
}

class OfferPositionUpdateRequest {
    /**
     * @var float
     */
    public $purchasing_price;
    /**
     * @var string
     */
    public $note;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var OfferPositionInterval
     */
    public $interval;
    /**
     * @var string
     */
    public $title;
    /**
     * @var float
     */
    public $vat_rate;
}

class CustomerCreateRequest {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $gender;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var BillingInterval
     */
    public $billing_interval;
    /**
     * @var float
     */
    public $custom_vat_rate;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var InvoiceShippingType
     */
    public $invoice_shipping_type;
    /**
     * @var float
     */
    public $balance;
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var string
     */
    public $street;
    /**
     * @var string
     */
    public $tax_number;
    /**
     * @var string
     */
    public $company_name;
    /**
     * @var bool
     */
    public $auto_finalize;
    /**
     * @var string
     */
    public $street_number;
    /**
     * @var float
     */
    public $credit_limit;
    /**
     * @var int
     */
    public $payment_period;
    /**
     * @var string
     */
    public $vat_id;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

class InvoicePositionUpdateRequest {
    /**
     * @var float
     */
    public $amount;
    /**
     * @var string
     */
    public $unit;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var float
     */
    public $vat_rate;
    /**
     * @var string
     */
    public $group_key;
}

class InvoiceUpdateRequest {
    /**
     * @var string
     */
    public $paid_at;
    /**
     * @var string
     */
    public $cancelled_at;
    /**
     * @var string
     */
    public $due_at;
    /**
     * @var InvoiceState
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

class OfferCreateRequest {
    /**
     * @var string
     */
    public $number;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var OfferCreateRequestPosition[]
     */
    public $positions;
    /**
     * @var float
     */
    public $net_amount;
    /**
     * @var OfferState
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

class PaymentReminderUpdateRequest {
    /**
     * @var string
     */
    public $date;
    /**
     * @var PaymentReminderStage
     */
    public $stage;
    /**
     * @var string
     */
    public $due_date;
    /**
     * @var PaymentReminderState
     */
    public $state;
}

class ServiceContractPositionUpdateRequest {
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $title;
    /**
     * @var float
     */
    public $vat_rate;
}

class BillingPositionUpdateRequest {
    /**
     * @var string
     */
    public $invoice_position_id;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var int
     */
    public $customer_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $available_at;
    /**
     * @var float
     */
    public $vat_rate;
    /**
     * @var string
     */
    public $group_key;
}

class PaymentReminderCreateRequest {
    /**
     * @var string
     */
    public $date;
    /**
     * @var string
     */
    public $stage;
    /**
     * @var string
     */
    public $due_date;
    /**
     * @var string
     */
    public $invoice_id;
    /**
     * @var string
     */
    public $state;
    /**
     * @var int
     */
    public $customer_id;
}

class ServiceContractPositionCreateRequest {
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $service_contract_id;
    /**
     * @var string
     */
    public $description;
    /**
     * @var string
     */
    public $title;
    /**
     * @var float
     */
    public $vat_rate;
}

class BillingPositionCreateRequest {
    /**
     * @var string
     */
    public $invoice_position_id;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var int
     */
    public $customer_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $available_at;
    /**
     * @var float
     */
    public $vat_rate;
    /**
     * @var string
     */
    public $group_key;
}

class InvoicePositionCreateRequest {
    /**
     * @var string
     */
    public $amount;
    /**
     * @var string
     */
    public $unit;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $description;
    /**
     * @var float
     */
    public $vat_rate;
    /**
     * @var string
     */
    public $group_key;
}

class ServiceContractCreateRequest {
    /**
     * @var int
     */
    public $cancellation_period;
    /**
     * @var string
     */
    public $description;
    /**
     * @var ServiceContractInterval
     */
    public $runtime;
    /**
     * @var ServiceContractCreateRequestPosition[]
     */
    public $positions;
    /**
     * @var int
     */
    public $customer_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var ServiceContractInterval
     */
    public $accounting_period;
}

class DebitMandateCreateRequest {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $bank_code;
    /**
     * @var string
     */
    public $account_number;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $valid_until;
    /**
     * @var string
     */
    public $street;
    /**
     * @var string
     */
    public $street_number;
    /**
     * @var string
     */
    public $bank_name;
    /**
     * @var string
     */
    public $signed_at;
    /**
     * @var string
     */
    public $depositor;
    /**
     * @var int
     */
    public $customer_id;
    /**
     * @var string
     */
    public $postal_code;
}

class ServiceContractUpdateRequest {
    /**
     * @var int
     */
    public $cancellation_period;
    /**
     * @var string
     */
    public $description;
    /**
     * @var ServiceContractInterval
     */
    public $runtime;
    /**
     * @var string
     */
    public $title;
    /**
     * @var ServiceContractInterval
     */
    public $accounting_period;
}

class CustomerUpdateRequest {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var BillingInterval
     */
    public $billing_interval;
    /**
     * @var float
     */
    public $custom_vat_rate;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var float
     */
    public $balance;
    /**
     * @var string
     */
    public $street;
    /**
     * @var string
     */
    public $tax_number;
    /**
     * @var string
     */
    public $company_name;
    /**
     * @var bool
     */
    public $auto_finalize;
    /**
     * @var string
     */
    public $street_number;
    /**
     * @var float
     */
    public $credit_limit;
    /**
     * @var int
     */
    public $payment_period;
    /**
     * @var string
     */
    public $vat_id;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

class OfferPositionCreateRequest {
    /**
     * @var float
     */
    public $purchasing_price;
    /**
     * @var string
     */
    public $note;
    /**
     * @var float
     */
    public $amount;
    /**
     * @var float
     */
    public $price;
    /**
     * @var string
     */
    public $description;
    /**
     * @var OfferPositionInterval
     */
    public $interval;
    /**
     * @var string
     */
    public $title;
    /**
     * @var string
     */
    public $offer_id;
    /**
     * @var float
     */
    public $vat_rate;
}

