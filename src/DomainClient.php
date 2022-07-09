<?php
namespace LUMASERV;

use JsonMapper;

class DomainClient {
    private $apiKey;
    private $baseUrl;
    private $mapper;

    public function __construct ($apiKey, $baseUrl = "https://api.lumaserv.com/domain") {
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
     * @return DomainHandleSingleResponse
     */
    public function getDomainHandle($code, $queryParams = []) {
        $json = $this->request("GET", "/domain-handles/$code", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainHandleSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteDomainHandle($code, $queryParams = []) {
        $json = $this->request("DELETE", "/domain-handles/$code", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return DomainHandleSingleResponse
     */
    public function updateDomainHandle($body, $code, $queryParams = []) {
        $json = $this->request("PUT", "/domain-handles/$code", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DomainHandleSingleResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function unscheduleDomainDelete($name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/unschedule-delete", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainSingleResponse());
    }

    /**
     * @return DNSRecordSingleResponse
     */
    public function createDNSZoneRecord($body, $name, $queryParams = []) {
        $json = $this->request("POST", "/dns/zones/$name/records", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DNSRecordSingleResponse());
    }

    /**
     * @return DNSRecordListResponse
     */
    public function getDNSZoneRecords($name, $queryParams = []) {
        $json = $this->request("GET", "/dns/zones/$name/records", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DNSRecordListResponse());
    }

    /**
     * @return DNSRecordListResponse
     */
    public function updateDNSZoneRecords($body, $name, $queryParams = []) {
        $json = $this->request("PUT", "/dns/zones/$name/records", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DNSRecordListResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function scheduleDomainDelete($body, $name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/schedule-delete", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DomainSingleResponse());
    }

    /**
     * @return SearchResponse
     */
    public function search($queryParams = []) {
        $json = $this->request("GET", "/search", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SearchResponse());
    }

    /**
     * @return DomainPriceListResponse
     */
    public function getDomainPricingList($queryParams = []) {
        $json = $this->request("GET", "/pricing/domains", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainPriceListResponse());
    }

    /**
     * @return DomainAuthinfoResponse
     */
    public function getDomainAuthinfo($name, $queryParams = []) {
        $json = $this->request("GET", "/domains/$name/authinfo", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainAuthinfoResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function removeDomainAuthinfo($name, $queryParams = []) {
        $json = $this->request("DELETE", "/domains/$name/authinfo", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function restoreDomain($name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/restore", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return DNSZoneListResponse
     */
    public function getDNSZones($queryParams = []) {
        $json = $this->request("GET", "/dns/zones", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DNSZoneListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteDNSRecord($name, $id, $queryParams = []) {
        $json = $this->request("DELETE", "/dns/zones/$name/records/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return DNSRecordSingleResponse
     */
    public function updateDNSRecord($body, $name, $id, $queryParams = []) {
        $json = $this->request("PUT", "/dns/zones/$name/records/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DNSRecordSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function sendDomainVerification($name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/verification", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return DomainCheckVerificationResponse
     */
    public function checkDomainVerification($name, $queryParams = []) {
        $json = $this->request("GET", "/domains/$name/verification", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainCheckVerificationResponse());
    }

    /**
     * @return DNSZoneSingleResponse
     */
    public function getDNSZone($name, $queryParams = []) {
        $json = $this->request("GET", "/dns/zones/$name", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DNSZoneSingleResponse());
    }

    /**
     * @return DNSZoneSingleResponse
     */
    public function updateDNSZone($body, $name, $queryParams = []) {
        $json = $this->request("PUT", "/dns/zones/$name", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DNSZoneSingleResponse());
    }

    /**
     * @return LabelListResponse
     */
    public function getLabels($queryParams = []) {
        $json = $this->request("GET", "/labels", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\LabelListResponse());
    }

    /**
     * @return DomainHandleSingleResponse
     */
    public function createDomainHandle($body, $queryParams = []) {
        $json = $this->request("POST", "/domain-handles", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DomainHandleSingleResponse());
    }

    /**
     * @return DomainHandleListResponse
     */
    public function getDomainHandles($queryParams = []) {
        $json = $this->request("GET", "/domain-handles", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainHandleListResponse());
    }

    /**
     * @return DomainCheckResponse
     */
    public function checkDomain($name, $queryParams = []) {
        $json = $this->request("GET", "/domains/$name/check", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainCheckResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function createDomain($body, $queryParams = []) {
        $json = $this->request("POST", "/domains", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DomainSingleResponse());
    }

    /**
     * @return DomainListResponse
     */
    public function getDomains($queryParams = []) {
        $json = $this->request("GET", "/domains", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainListResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function getDomain($name, $queryParams = []) {
        $json = $this->request("GET", "/domains/$name", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteDomain($name, $queryParams = []) {
        $json = $this->request("DELETE", "/domains/$name", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function updateDomain($body, $name, $queryParams = []) {
        $json = $this->request("PUT", "/domains/$name", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DomainSingleResponse());
    }


}
