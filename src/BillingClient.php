<?php
namespace LUMASERV;

use JsonMapper;

class BillingClient {
    private $apiKey;
    private $baseUrl;
    private $mapper;

    public function __construct ($apiKey, $baseUrl = "https://api.lumaserv.com/billing") {
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
        $status = curl_getInfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        if($status < 200 || ($status >= 300 && $status < 400))
            throw new Exception("Status code is {$status}!");
        return json_decode($response);
    }

    /**
     * @return PaymentReminderSingleResponse
     */
    public function getPaymentReminder($id, $queryParams = []) {
        $json = $this->request("GET", "/payment-reminders/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\PaymentReminderSingleResponse());
    }

    /**
     * @return PaymentReminderSingleResponse
     */
    public function updatePaymentReminder($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/payment-reminders/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\PaymentReminderSingleResponse());
    }

    /**
     * @return DebitMandateSingleResponse
     */
    public function createDebitMandate($body, $queryParams = []) {
        $json = $this->request("POST", "/debit-mandates", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DebitMandateSingleResponse());
    }

    /**
     * @return DebitMandateListResponse
     */
    public function getDebitMandates($queryParams = []) {
        $json = $this->request("GET", "/debit-mandates", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DebitMandateListResponse());
    }

    /**
     * @return FileSingleResponse
     */
    public function getInvoiceFile($id, $queryParams = []) {
        $json = $this->request("GET", "/invoices/$id/file", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\FileSingleResponse());
    }

    /**
     * @return InvoicePositionSingleResponse
     */
    public function createInvoicePosition($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/invoices/$id/positions", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\InvoicePositionSingleResponse());
    }

    /**
     * @return InvoicePositionListResponse
     */
    public function getInvoicePositions($id, $queryParams = []) {
        $json = $this->request("GET", "/invoices/$id/positions", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\InvoicePositionListResponse());
    }

    /**
     * @return BillingPositionSingleResponse
     */
    public function getBillingPosition($id, $queryParams = []) {
        $json = $this->request("GET", "/billing-positions/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\BillingPositionSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteBillingPosition($id, $queryParams = []) {
        $json = $this->request("DELETE", "/billing-positions/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return BillingPositionSingleResponse
     */
    public function updateBillingPosition($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/billing-positions/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\BillingPositionSingleResponse());
    }

    /**
     * @return BankTransactionListResponse
     */
    public function getBankTransactions($queryParams = []) {
        $json = $this->request("GET", "/bank-transactions", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\BankTransactionListResponse());
    }

    /**
     * @return DebitMandateSingleResponse
     */
    public function getDebitMandate($id, $queryParams = []) {
        $json = $this->request("GET", "/debit-mandates/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DebitMandateSingleResponse());
    }

    /**
     * @return BankTransactionSingleResponse
     */
    public function getBankTransaction($id, $queryParams = []) {
        $json = $this->request("GET", "/bank-transactions/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\BankTransactionSingleResponse());
    }

    /**
     * @return BillingPositionSingleResponse
     */
    public function createBillingPosition($body, $queryParams = []) {
        $json = $this->request("POST", "/billing-positions", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\BillingPositionSingleResponse());
    }

    /**
     * @return BillingPositionListResponse
     */
    public function getBillingPositions($queryParams = []) {
        $json = $this->request("GET", "/billing-positions", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\BillingPositionListResponse());
    }

    /**
     * @return CustomerSingleResponse
     */
    public function createCustomer($body, $queryParams = []) {
        $json = $this->request("POST", "/customers", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\CustomerSingleResponse());
    }

    /**
     * @return CustomerListResponse
     */
    public function getCustomers($queryParams = []) {
        $json = $this->request("GET", "/customers", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\CustomerListResponse());
    }

    /**
     * @return InvoicePositionSingleResponse
     */
    public function getInvoicePosition($invoice_id, $id, $queryParams = []) {
        $json = $this->request("GET", "/invoices/$invoice_id/positions/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\InvoicePositionSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteInvoicePosition($invoice_id, $id, $queryParams = []) {
        $json = $this->request("DELETE", "/invoices/$invoice_id/positions/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return InvoicePositionSingleResponse
     */
    public function updateInvoicePosition($body, $invoice_id, $id, $queryParams = []) {
        $json = $this->request("PUT", "/invoices/$invoice_id/positions/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\InvoicePositionSingleResponse());
    }

    /**
     * @return ServiceContractSingleResponse
     */
    public function createServiceContract($body, $queryParams = []) {
        $json = $this->request("POST", "/service-contracts", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServiceContractSingleResponse());
    }

    /**
     * @return ServiceContractListResponse
     */
    public function getServiceContracts($queryParams = []) {
        $json = $this->request("GET", "/service-contracts", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServiceContractListResponse());
    }

    /**
     * @return DebitListResponse
     */
    public function getDebits($queryParams = []) {
        $json = $this->request("GET", "/debits", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DebitListResponse());
    }

    /**
     * @return CustomerSingleResponse
     */
    public function getCustomer($id, $queryParams = []) {
        $json = $this->request("GET", "/customers/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\CustomerSingleResponse());
    }

    /**
     * @return CustomerSingleResponse
     */
    public function updateCustomer($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/customers/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\CustomerSingleResponse());
    }

    /**
     * @return InvoiceSingleResponse
     */
    public function getInvoice($id, $queryParams = []) {
        $json = $this->request("GET", "/invoices/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\InvoiceSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteInvoice($id, $queryParams = []) {
        $json = $this->request("DELETE", "/invoices/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return InvoiceSingleResponse
     */
    public function updateInvoice($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/invoices/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\InvoiceSingleResponse());
    }

    /**
     * @return ServiceContractPositionSingleResponse
     */
    public function getServiceContractPosition($contract_id, $id, $queryParams = []) {
        $json = $this->request("GET", "/service-contracts/$contract_id/positions/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServiceContractPositionSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServiceContractPosition($contract_id, $id, $queryParams = []) {
        $json = $this->request("DELETE", "/service-contracts/$contract_id/positions/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServiceContractPositionSingleResponse
     */
    public function updateServiceContractPosition($body, $contract_id, $id, $queryParams = []) {
        $json = $this->request("PUT", "/service-contracts/$contract_id/positions/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServiceContractPositionSingleResponse());
    }

    /**
     * @return InvoiceSingleResponse
     */
    public function createInvoice($body, $queryParams = []) {
        $json = $this->request("POST", "/invoices", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\InvoiceSingleResponse());
    }

    /**
     * @return InvoiceListResponse
     */
    public function getInvoices($queryParams = []) {
        $json = $this->request("GET", "/invoices", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\InvoiceListResponse());
    }

    /**
     * @return DebitSingleResponse
     */
    public function getDebit($id, $queryParams = []) {
        $json = $this->request("GET", "/debits/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DebitSingleResponse());
    }

    /**
     * @return ServiceContractPositionSingleResponse
     */
    public function createServiceContractPosition($body, $contract_id, $queryParams = []) {
        $json = $this->request("POST", "/service-contracts/$contract_id/positions", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServiceContractPositionSingleResponse());
    }

    /**
     * @return ServiceContractPositionListResponse
     */
    public function getServiceContractPositions($contract_id, $queryParams = []) {
        $json = $this->request("GET", "/service-contracts/$contract_id/positions", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServiceContractPositionListResponse());
    }

    /**
     * @return ServiceContractSingleResponse
     */
    public function getServiceContract($id, $queryParams = []) {
        $json = $this->request("GET", "/service-contracts/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServiceContractSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServiceContract($id, $queryParams = []) {
        $json = $this->request("DELETE", "/service-contracts/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServiceContractSingleResponse
     */
    public function updateServiceContract($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/service-contracts/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServiceContractSingleResponse());
    }

    /**
     * @return PaymentReminderSingleResponse
     */
    public function createPaymentReminder($body, $queryParams = []) {
        $json = $this->request("POST", "/payment-reminders", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\PaymentReminderSingleResponse());
    }

    /**
     * @return PaymentReminderListResponse
     */
    public function getPaymentReminders($queryParams = []) {
        $json = $this->request("GET", "/payment-reminders", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\PaymentReminderListResponse());
    }


}
