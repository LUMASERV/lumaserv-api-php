<?php
namespace LUMASERV;

use JsonMapper;

class AuthClient {
    private $apiKey;
    private $baseUrl;
    private $mapper;

    public function __construct ($apiKey, $baseUrl = "https://auth.lumaserv.com") {
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
     * @return ProjectSingleResponse
     */
    public function createProject($body, $queryParams = []) {
        $json = $this->request("POST", "/projects", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ProjectSingleResponse());
    }

    /**
     * @return ProjectListResponse
     */
    public function getProjects($queryParams = []) {
        $json = $this->request("GET", "/projects", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ProjectListResponse());
    }

    /**
     * @return ProjectSingleResponse
     */
    public function getProject($id, $queryParams = []) {
        $json = $this->request("GET", "/projects/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ProjectSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteProject($id, $queryParams = []) {
        $json = $this->request("DELETE", "/projects/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ProjectSingleResponse
     */
    public function updateProject($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/projects/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ProjectSingleResponse());
    }

    /**
     * @return LoginResponse
     */
    public function login($body, $queryParams = []) {
        $json = $this->request("POST", "/login", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\LoginResponse());
    }

    /**
     * @return UserSingleResponse
     */
    public function createUser($body, $queryParams = []) {
        $json = $this->request("POST", "/users", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\UserSingleResponse());
    }

    /**
     * @return UserListResponse
     */
    public function getUsers($queryParams = []) {
        $json = $this->request("GET", "/users", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\UserListResponse());
    }

    /**
     * @return UserSingleResponse
     */
    public function getUser($id, $queryParams = []) {
        $json = $this->request("GET", "/users/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\UserSingleResponse());
    }

    /**
     * @return UserSingleResponse
     */
    public function updateUser($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/users/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\UserSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function requestPasswordReset($body, $queryParams = []) {
        $json = $this->request("POST", "/password-reset", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function executePasswordReset($body, $queryParams = []) {
        $json = $this->request("PUT", "/password-reset", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function insertAuditLogEntry($body, $queryParams = []) {
        $json = $this->request("POST", "/audit-log", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return AuditLogEntryListResponse
     */
    public function searchAuditLog($queryParams = []) {
        $json = $this->request("GET", "/audit-log", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\AuditLogEntryListResponse());
    }

    /**
     * @return TokenSingleResponse
     */
    public function createToken($body, $queryParams = []) {
        $json = $this->request("POST", "/tokens", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\TokenSingleResponse());
    }

    /**
     * @return TokenListResponse
     */
    public function getTokens($queryParams = []) {
        $json = $this->request("GET", "/tokens", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\TokenListResponse());
    }

    /**
     * @return CountrySingleResponse
     */
    public function getCountry($code, $queryParams = []) {
        $json = $this->request("GET", "/countries/$code", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\CountrySingleResponse());
    }

    /**
     * @return TokenSingleResponse
     */
    public function getToken($id, $queryParams = []) {
        $json = $this->request("GET", "/tokens/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\TokenSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteToken($id, $queryParams = []) {
        $json = $this->request("DELETE", "/tokens/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return TokenValidationResponse
     */
    public function validateToken($token, $queryParams = []) {
        $json = $this->request("GET", "/validate/$token", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\TokenValidationResponse());
    }

    /**
     * @return ProjectMemberSingleResponse
     */
    public function addProjectMember($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/projects/$id/members", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ProjectMemberSingleResponse());
    }

    /**
     * @return ProjectMemberListResponse
     */
    public function getProjectMembers($id, $queryParams = []) {
        $json = $this->request("GET", "/projects/$id/members", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ProjectMemberListResponse());
    }

    /**
     * @return TransactionLogResponse
     */
    public function searchTransactionLog($body, $queryParams = []) {
        $json = $this->request("POST", "/transaction-log", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\TransactionLogResponse());
    }

    /**
     * @return TokenValidationResponse
     */
    public function validateSelf($queryParams = []) {
        $json = $this->request("GET", "/validate/self", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\TokenValidationResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function removeProjectMember($id, $user_id, $queryParams = []) {
        $json = $this->request("DELETE", "/projects/$id/members/$user_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ProjectMemberListResponse
     */
    public function getUserProjectMemberships($id, $queryParams = []) {
        $json = $this->request("GET", "/users/$id/project_memberships", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ProjectMemberListResponse());
    }

    /**
     * @return CountryListResponse
     */
    public function getCountries($queryParams = []) {
        $json = $this->request("GET", "/countries", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\CountryListResponse());
    }


}
