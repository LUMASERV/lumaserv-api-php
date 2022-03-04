<?php
namespace LUMASERV;

use JsonMapper;

class AuthClient {
    private $apiKey;
    private $baseUrl;
    private $mapper;

    public function __construct ($apiKey, $baseUrl = "https://auth.lumaserv.cloud") {
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
     * @return ProjectSingleResponse
     */
    public function createProject($body, $queryParams = []) {
        $json = $this->request("POST", "/projects", $queryParams, $body);
        return $this->mapper->map($json, new ProjectSingleResponse());
    }

    /**
     * @return ProjectListResponse
     */
    public function getProjects($queryParams = []) {
        $json = $this->request("GET", "/projects", $queryParams);
        return $this->mapper->map($json, new ProjectListResponse());
    }

    /**
     * @return ProjectSingleResponse
     */
    public function getProject($id, $queryParams = []) {
        $json = $this->request("GET", "/projects/$id", $queryParams);
        return $this->mapper->map($json, new ProjectSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteProject($id, $queryParams = []) {
        $json = $this->request("DELETE", "/projects/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ProjectSingleResponse
     */
    public function updateProject($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/projects/$id", $queryParams, $body);
        return $this->mapper->map($json, new ProjectSingleResponse());
    }

    /**
     * @return LoginResponse
     */
    public function login($body, $queryParams = []) {
        $json = $this->request("POST", "/login", $queryParams, $body);
        return $this->mapper->map($json, new LoginResponse());
    }

    /**
     * @return UserSingleResponse
     */
    public function createUser($body, $queryParams = []) {
        $json = $this->request("POST", "/users", $queryParams, $body);
        return $this->mapper->map($json, new UserSingleResponse());
    }

    /**
     * @return UserListResponse
     */
    public function getUsers($queryParams = []) {
        $json = $this->request("GET", "/users", $queryParams);
        return $this->mapper->map($json, new UserListResponse());
    }

    /**
     * @return UserSingleResponse
     */
    public function getUser($id, $queryParams = []) {
        $json = $this->request("GET", "/users/$id", $queryParams);
        return $this->mapper->map($json, new UserSingleResponse());
    }

    /**
     * @return UserSingleResponse
     */
    public function updateUser($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/users/$id", $queryParams, $body);
        return $this->mapper->map($json, new UserSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function requestPasswordReset($body, $queryParams = []) {
        $json = $this->request("POST", "/password-reset", $queryParams, $body);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function executePasswordReset($body, $queryParams = []) {
        $json = $this->request("PUT", "/password-reset", $queryParams, $body);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return AuditLogResponse
     */
    public function searchAuditLog($body, $queryParams = []) {
        $json = $this->request("POST", "/audit-log", $queryParams, $body);
        return $this->mapper->map($json, new AuditLogResponse());
    }

    /**
     * @return TokenSingleResponse
     */
    public function createToken($body, $queryParams = []) {
        $json = $this->request("POST", "/tokens", $queryParams, $body);
        return $this->mapper->map($json, new TokenSingleResponse());
    }

    /**
     * @return TokenListResponse
     */
    public function getTokens($queryParams = []) {
        $json = $this->request("GET", "/tokens", $queryParams);
        return $this->mapper->map($json, new TokenListResponse());
    }

    /**
     * @return CountrySingleResponse
     */
    public function getCountry($code, $queryParams = []) {
        $json = $this->request("GET", "/countries/$code", $queryParams);
        return $this->mapper->map($json, new CountrySingleResponse());
    }

    /**
     * @return TokenSingleResponse
     */
    public function getToken($id, $queryParams = []) {
        $json = $this->request("GET", "/tokens/$id", $queryParams);
        return $this->mapper->map($json, new TokenSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteToken($id, $queryParams = []) {
        $json = $this->request("DELETE", "/tokens/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return TokenValidationResponse
     */
    public function validateToken($token, $queryParams = []) {
        $json = $this->request("GET", "/validate/$token", $queryParams);
        return $this->mapper->map($json, new TokenValidationResponse());
    }

    /**
     * @return ProjectMemberListResponse
     */
    public function getProjectMembers($id, $queryParams = []) {
        $json = $this->request("GET", "/projects/$id/members", $queryParams);
        return $this->mapper->map($json, new ProjectMemberListResponse());
    }

    /**
     * @return TokenValidationResponse
     */
    public function validateSelf($queryParams = []) {
        $json = $this->request("GET", "/validate/self", $queryParams);
        return $this->mapper->map($json, new TokenValidationResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function removeProjectMember($id, $user_id, $queryParams = []) {
        $json = $this->request("DELETE", "/projects/$id/members/$user_id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ProjectMemberListResponse
     */
    public function getUserProjectMemberships($id, $queryParams = []) {
        $json = $this->request("GET", "/users/$id/project_memberships", $queryParams);
        return $this->mapper->map($json, new ProjectMemberListResponse());
    }

    /**
     * @return CountryListResponse
     */
    public function getCountries($queryParams = []) {
        $json = $this->request("GET", "/countries", $queryParams);
        return $this->mapper->map($json, new CountryListResponse());
    }


}
class User {
    /**
     * @var Gender
     */
    public $gender;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $id;
    /**
     * @var UserState
     */
    public $state;
    /**
     * @var string
     */
    public $customer_id;
    /**
     * @var UserType
     */
    public $type;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

abstract class UserState {
    const PENDING = "PENDING";
    const ACTIVATED = "ACTIVATED";
    const LOCKED = "LOCKED";
}

class Token {
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var TokenScope
     */
    public $scope;
    /**
     * @var string
     */
    public $validUntil;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $token;
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

abstract class Gender {
    const MALE = "MALE";
    const FEMALE = "FEMALE";
    const OTHER = "OTHER";
}

class Project {
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
}

class TokenValidationInfo {
    /**
     * @var ProjectMember[]
     */
    public $project_memberships;
    /**
     * @var User
     */
    public $user;
    /**
     * @var Token
     */
    public $token;
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

class TokenScope {
    /**
     * @var string
     */
    public $project_id;
}

class Country {
    /**
     * @var string
     */
    public $code;
    /**
     * @var string
     */
    public $title;
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

class ProjectMember {
    /**
     * @var string
     */
    public $role;
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var string
     */
    public $project_id;
}

abstract class UserType {
    const CUSTOMER = "CUSTOMER";
    const ADMIN = "ADMIN";
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

class TokenListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Token[]
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

class LoginResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Token
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

class ProjectSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Project
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

class ProjectListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Project[]
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

class TokenSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Token
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

class AuditLogResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var object[]
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

class CountrySingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Country
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

class ProjectMemberListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ProjectMember[]
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

class CountryListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Country[]
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

class UserSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var User
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

class UserListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var User[]
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

class TokenValidationResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var TokenValidationInfo
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

class RequestPasswordResetRequest {
    /**
     * @var string
     */
    public $username;
}

class ExecutePasswordResetRequest {
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $token;
}

class TokenCreateRequest {
    /**
     * @var string
     */
    public $user_id;
    /**
     * @var TokenScope
     */
    public $scope;
    /**
     * @var string
     */
    public $title;
}

class LoginRequest {
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $username;
}

class ProjectCreateRequest {
    /**
     * @var string
     */
    public $title;
}

class ProjectUpdateRequest {
    /**
     * @var string
     */
    public $title;
}

class UserUpdateRequest {
    /**
     * @var string
     */
    public $password;
    /**
     * @var Gender
     */
    public $gender;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $company;
    /**
     * @var UserState
     */
    public $state;
    /**
     * @var UserType
     */
    public $type;
    /**
     * @var string
     */
    public $customer_id;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

class UserCreateRequest {
    /**
     * @var string
     */
    public $password;
    /**
     * @var Gender
     */
    public $gender;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $company;
    /**
     * @var UserType
     */
    public $type;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

class AuditLogRequest {
    /**
     * @var object
     */
    public $query;
    /**
     * @var int
     */
    public $limit;
    /**
     * @var object
     */
    public $sort;
}

