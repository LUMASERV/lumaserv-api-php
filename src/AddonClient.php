<?php
namespace LUMASERV;

use JsonMapper;

class AddonClient {
    private $apiKey;
    private $baseUrl;
    private $mapper;

    public function __construct ($apiKey, $baseUrl = "https://api.lumaserv.com/addon") {
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
     * @return SSLCertificateSingleResponse
     */
    public function createSSLCertificate($body, $queryParams = []) {
        $json = $this->request("POST", "/ssl/certificates", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\SSLCertificateSingleResponse());
    }

    /**
     * @return SSLCertificateListResponse
     */
    public function getSSLCertificates($queryParams = []) {
        $json = $this->request("GET", "/ssl/certificates", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLCertificateListResponse());
    }

    /**
     * @return PleskLicenseTypeListResponse
     */
    public function getPleskLicenseTypes($queryParams = []) {
        $json = $this->request("GET", "/license/plesk-types", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\PleskLicenseTypeListResponse());
    }

    /**
     * @return SearchResponse
     */
    public function search($queryParams = []) {
        $json = $this->request("GET", "/search", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SearchResponse());
    }

    /**
     * @return SSLCertificateSingleResponse
     */
    public function getSSLCertificate($id, $queryParams = []) {
        $json = $this->request("GET", "/ssl/certificates/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLCertificateSingleResponse());
    }

    /**
     * @return SSLOrganisationSingleResponse
     */
    public function getSSLOrganisation($id, $queryParams = []) {
        $json = $this->request("GET", "/ssl/organisations/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLOrganisationSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteSSLOrganisation($id, $queryParams = []) {
        $json = $this->request("DELETE", "/ssl/organisations/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return SSLContactSingleResponse
     */
    public function createSSLContact($body, $queryParams = []) {
        $json = $this->request("POST", "/ssl/contacts", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\SSLContactSingleResponse());
    }

    /**
     * @return SSLContactListResponse
     */
    public function getSSLContacts($queryParams = []) {
        $json = $this->request("GET", "/ssl/contacts", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLContactListResponse());
    }

    /**
     * @return SSLOrganisationSingleResponse
     */
    public function createSSLOrganisation($body, $queryParams = []) {
        $json = $this->request("POST", "/ssl/organisations", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\SSLOrganisationSingleResponse());
    }

    /**
     * @return SSLOrganisationListResponse
     */
    public function getSSLOrganisations($queryParams = []) {
        $json = $this->request("GET", "/ssl/organisations", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLOrganisationListResponse());
    }

    /**
     * @return SSLTypeSingleResponse
     */
    public function getSSLType($id, $queryParams = []) {
        $json = $this->request("GET", "/ssl/types/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLTypeSingleResponse());
    }

    /**
     * @return SSLContactSingleResponse
     */
    public function getSSLContact($id, $queryParams = []) {
        $json = $this->request("GET", "/ssl/contacts/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLContactSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteSSLContact($id, $queryParams = []) {
        $json = $this->request("DELETE", "/ssl/contacts/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return PleskLicenseSingleResponse
     */
    public function createPleskLicense($body, $queryParams = []) {
        $json = $this->request("POST", "/licenses/plesk", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\PleskLicenseSingleResponse());
    }

    /**
     * @return PleskLicenseListResponse
     */
    public function getPleskLicenses($queryParams = []) {
        $json = $this->request("GET", "/licenses/plesk", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\PleskLicenseListResponse());
    }

    /**
     * @return SSLTypeListResponse
     */
    public function getSSLTypes($queryParams = []) {
        $json = $this->request("GET", "/ssl/types", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLTypeListResponse());
    }

    /**
     * @return PleskLicenseSingleResponse
     */
    public function getPleskLicense($id, $queryParams = []) {
        $json = $this->request("GET", "/licenses/plesk/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\PleskLicenseSingleResponse());
    }

    /**
     * @return PleskLicenseSingleResponse
     */
    public function updatePleskLicense($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/licenses/plesk/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\PleskLicenseSingleResponse());
    }

    /**
     * @return PleskLicenseTypeSingleResponse
     */
    public function getPleskLicenseType($id, $queryParams = []) {
        $json = $this->request("GET", "/license/plesk-types/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\PleskLicenseTypeSingleResponse());
    }


}
