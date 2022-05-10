<?php
namespace LUMASERV;

use JsonMapper;

class CoreClient {
    private $apiKey;
    private $baseUrl;
    private $mapper;

    public function __construct ($apiKey, $baseUrl = "https://api.lumaserv.com") {
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
     * @return SSHKeySingleResponse
     */
    public function createSSHKey($body, $queryParams = []) {
        $json = $this->request("POST", "/ssh-keys", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\SSHKeySingleResponse());
    }

    /**
     * @return SSHKeyListResponse
     */
    public function getSSHKeys($queryParams = []) {
        $json = $this->request("GET", "/ssh-keys", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSHKeyListResponse());
    }

    /**
     * @return ServerPriceRangeSingleResponse
     */
    public function createServerPriceRange($body, $queryParams = []) {
        $json = $this->request("POST", "/server-price-ranges", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerPriceRangeSingleResponse());
    }

    /**
     * @return ServerPriceRangeListResponse
     */
    public function getServerPriceRanges($queryParams = []) {
        $json = $this->request("GET", "/server-price-ranges", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerPriceRangeListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function startServer($id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/start", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return AvailabilityZoneSingleResponse
     */
    public function createAvailabilityZone($body, $queryParams = []) {
        $json = $this->request("POST", "/availability-zones", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\AvailabilityZoneSingleResponse());
    }

    /**
     * @return AvailabilityZoneListResponse
     */
    public function getAvailabilityZones($queryParams = []) {
        $json = $this->request("GET", "/availability-zones", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\AvailabilityZoneListResponse());
    }

    /**
     * @return ServerTemplateSingleResponse
     */
    public function getServerTemplate($id, $queryParams = []) {
        $json = $this->request("GET", "/server-templates/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerTemplateSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function shutdownServer($id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/shutdown", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerFirewallSingleResponse
     */
    public function getServerFirewall($id, $queryParams = []) {
        $json = $this->request("GET", "/server-firewalls/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerFirewallSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerFirewall($id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-firewalls/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerSingleResponse
     */
    public function getServer($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServer($id, $queryParams = []) {
        $json = $this->request("DELETE", "/servers/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerSingleResponse
     */
    public function updateServer($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/servers/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerSingleResponse());
    }

    /**
     * @return ServerStorageClassSingleResponse
     */
    public function getServerStorageClass($id, $queryParams = []) {
        $json = $this->request("GET", "/server-storage-classes/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerStorageClassSingleResponse());
    }

    /**
     * @return ServerActionSingleResponse
     */
    public function restartServer($id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/restart", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerActionSingleResponse());
    }

    /**
     * @return ScheduledServerActionSingleResponse
     */
    public function restoreServer($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/restore", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ScheduledServerActionSingleResponse());
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
     * @return ServerActionSingleResponse
     */
    public function getServerAction($id, $action_id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/actions/$action_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerActionSingleResponse());
    }

    /**
     * @return ServerGraphResponse
     */
    public function getServerGraph($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/graph", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerGraphResponse());
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
     * @return DNSZoneListResponse
     */
    public function getDNSZones($queryParams = []) {
        $json = $this->request("GET", "/dns/zones", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DNSZoneListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function recreateServer($id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/recreate", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerFirewallSingleResponse
     */
    public function createServerFirewall($body, $queryParams = []) {
        $json = $this->request("POST", "/server-firewalls", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerFirewallSingleResponse());
    }

    /**
     * @return ServerFirewallListResponse
     */
    public function getServerFirewalls($queryParams = []) {
        $json = $this->request("GET", "/server-firewalls", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerFirewallListResponse());
    }

    /**
     * @return ServerFirewallRuleSingleResponse
     */
    public function getServerFirewallRule($id, $rule_id, $queryParams = []) {
        $json = $this->request("GET", "/server-firewalls/$id/rules/$rule_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerFirewallRuleSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerFirewallRule($id, $rule_id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-firewalls/$id/rules/$rule_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
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
     * @return ServerHostSingleResponse
     */
    public function createServerHost($body, $queryParams = []) {
        $json = $this->request("POST", "/server-hosts", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerHostSingleResponse());
    }

    /**
     * @return ServerHostListResponse
     */
    public function getServerHosts($queryParams = []) {
        $json = $this->request("GET", "/server-hosts", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerHostListResponse());
    }

    /**
     * @return ServerSingleResponse
     */
    public function createServer($body, $queryParams = []) {
        $json = $this->request("POST", "/servers", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerSingleResponse());
    }

    /**
     * @return ServerListResponse
     */
    public function getServers($queryParams = []) {
        $json = $this->request("GET", "/servers", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerNetwork($id, $network_id, $queryParams = []) {
        $json = $this->request("DELETE", "/servers/$id/networks/$network_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
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
     * @return AvailabilityZoneSingleResponse
     */
    public function getAvailabilityZone($id, $queryParams = []) {
        $json = $this->request("GET", "/availability-zones/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\AvailabilityZoneSingleResponse());
    }

    /**
     * @return AvailabilityZoneSingleResponse
     */
    public function updateAvailabilityZone($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/availability-zones/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\AvailabilityZoneSingleResponse());
    }

    /**
     * @return ServerBackupSingleResponse
     */
    public function createServerBackup($body, $queryParams = []) {
        $json = $this->request("POST", "/server-backups", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerBackupSingleResponse());
    }

    /**
     * @return ServerBackupListResponse
     */
    public function getServerBackups($queryParams = []) {
        $json = $this->request("GET", "/server-backups", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerBackupListResponse());
    }

    /**
     * @return SubnetSingleResponse
     */
    public function createSubnet($body, $queryParams = []) {
        $json = $this->request("POST", "/subnets", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\SubnetSingleResponse());
    }

    /**
     * @return SubnetListResponse
     */
    public function getSubnets($queryParams = []) {
        $json = $this->request("GET", "/subnets", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SubnetListResponse());
    }

    /**
     * @return ServerVolumeSingleResponse
     */
    public function createServerVolume($body, $queryParams = []) {
        $json = $this->request("POST", "/server-volumes", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerVolumeSingleResponse());
    }

    /**
     * @return ServerVolumeListResponse
     */
    public function getServerVolumes($queryParams = []) {
        $json = $this->request("GET", "/server-volumes", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerVolumeListResponse());
    }

    /**
     * @return PleskLicenseTypeSingleResponse
     */
    public function getPleskLicenseType($id, $queryParams = []) {
        $json = $this->request("GET", "/licenses/plesk-types/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\PleskLicenseTypeSingleResponse());
    }

    /**
     * @return ServerStorageClassSingleResponse
     */
    public function createServerStorageClass($body, $queryParams = []) {
        $json = $this->request("POST", "/server-storage-classes", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerStorageClassSingleResponse());
    }

    /**
     * @return ServerStorageClassListResponse
     */
    public function getServerStorageClasses($queryParams = []) {
        $json = $this->request("GET", "/server-storage-classes", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerStorageClassListResponse());
    }

    /**
     * @return ServerFirewallMemberSingleResponse
     */
    public function getServerFirewallMember($id, $member_id, $queryParams = []) {
        $json = $this->request("GET", "/server-firewalls/$id/members/$member_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerFirewallMemberSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerFirewallMember($id, $member_id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-firewalls/$id/members/$member_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return SearchResponse
     */
    public function search($queryParams = []) {
        $json = $this->request("GET", "/search", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SearchResponse());
    }

    /**
     * @return ScheduledServerActionSingleResponse
     */
    public function getScheduledServerAction($id, $action_id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/scheduled-actions/$action_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ScheduledServerActionSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteScheduledServerAction($id, $action_id, $queryParams = []) {
        $json = $this->request("DELETE", "/servers/$id/scheduled-actions/$action_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return S3BucketSingleResponse
     */
    public function createS3Bucket($body, $queryParams = []) {
        $json = $this->request("POST", "/storage/s3/buckets", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\S3BucketSingleResponse());
    }

    /**
     * @return S3BucketListResponse
     */
    public function getS3Buckets($queryParams = []) {
        $json = $this->request("GET", "/storage/s3/buckets", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\S3BucketListResponse());
    }

    /**
     * @return PleskLicenseTypeListResponse
     */
    public function getPleskLicenseTypes($queryParams = []) {
        $json = $this->request("GET", "/licenses/plesk-types", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\PleskLicenseTypeListResponse());
    }

    /**
     * @return ServerActionListResponse
     */
    public function getServerActions($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/actions", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerActionListResponse());
    }

    /**
     * @return ServerStatusResponse
     */
    public function getServerStatus($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/status", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerStatusResponse());
    }

    /**
     * @return ServerFirewallMemberSingleResponse
     */
    public function createServerFirewallMember($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/server-firewalls/$id/members", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerFirewallMemberSingleResponse());
    }

    /**
     * @return ServerFirewallMemberListResponse
     */
    public function getServerFirewallMembers($id, $queryParams = []) {
        $json = $this->request("GET", "/server-firewalls/$id/members", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerFirewallMemberListResponse());
    }

    /**
     * @return ServerPriceRangeSingleResponse
     */
    public function getServerPriceRange($id, $queryParams = []) {
        $json = $this->request("GET", "/server-price-ranges/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerPriceRangeSingleResponse());
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
     * @return SSLTypeListResponse
     */
    public function getSSLTypes($queryParams = []) {
        $json = $this->request("GET", "/ssl/types", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLTypeListResponse());
    }

    /**
     * @return ServerVariantPriceSingleResponse
     */
    public function getServerVariantPrice($id, $variant_id, $queryParams = []) {
        $json = $this->request("GET", "/server-price-ranges/$id/variant-prices/$variant_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerVariantPriceSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerVariantPrice($id, $variant_id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-price-ranges/$id/variant-prices/$variant_id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerVariantPriceSingleResponse
     */
    public function updateServerVariantPrice($body, $id, $variant_id, $queryParams = []) {
        $json = $this->request("PUT", "/server-price-ranges/$id/variant-prices/$variant_id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerVariantPriceSingleResponse());
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
     * @return ServerTemplateSingleResponse
     */
    public function createServerTemplate($body, $queryParams = []) {
        $json = $this->request("POST", "/server-templates", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerTemplateSingleResponse());
    }

    /**
     * @return ServerTemplateListResponse
     */
    public function getServerTemplates($queryParams = []) {
        $json = $this->request("GET", "/server-templates", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerTemplateListResponse());
    }

    /**
     * @return ServerHostSingleResponse
     */
    public function getServerHost($id, $queryParams = []) {
        $json = $this->request("GET", "/server-hosts/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerHostSingleResponse());
    }

    /**
     * @return ServerFirewallRuleSingleResponse
     */
    public function createServerFirewallRule($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/server-firewalls/$id/rules", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerFirewallRuleSingleResponse());
    }

    /**
     * @return ServerFirewallRuleListResponse
     */
    public function getServerFirewallRules($id, $queryParams = []) {
        $json = $this->request("GET", "/server-firewalls/$id/rules", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerFirewallRuleListResponse());
    }

    /**
     * @return ScheduledServerActionSingleResponse
     */
    public function createScheduledServerAction($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/scheduled-actions", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ScheduledServerActionSingleResponse());
    }

    /**
     * @return ScheduledServerActionListResponse
     */
    public function getScheduledServerActions($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/scheduled-actions", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ScheduledServerActionListResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function unscheduleDomainDelete($name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/unschedule-delete", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function stopServer($id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/stop", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
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
     * @return ServerVolumeSingleResponse
     */
    public function getServerVolume($id, $queryParams = []) {
        $json = $this->request("GET", "/server-volumes/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerVolumeSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerVolume($id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-volumes/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerVolumeSingleResponse
     */
    public function updateServerVolume($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/server-volumes/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerVolumeSingleResponse());
    }

    /**
     * @return ServerNetworkSingleResponse
     */
    public function createServerNetwork($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/networks", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerNetworkSingleResponse());
    }

    /**
     * @return ServerNetworkListResponse
     */
    public function getServerNetworks($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/networks", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerNetworkListResponse());
    }

    /**
     * @return ServerVariantSingleResponse
     */
    public function createServerVariant($body, $queryParams = []) {
        $json = $this->request("POST", "/server-variants", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerVariantSingleResponse());
    }

    /**
     * @return ServerVariantListResponse
     */
    public function getServerVariants($queryParams = []) {
        $json = $this->request("GET", "/server-variants", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerVariantListResponse());
    }

    /**
     * @return ServerStorageSingleResponse
     */
    public function getServerStorage($id, $queryParams = []) {
        $json = $this->request("GET", "/server-storages/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerStorageSingleResponse());
    }

    /**
     * @return SSHKeySingleResponse
     */
    public function getSSHKey($id, $queryParams = []) {
        $json = $this->request("GET", "/ssh-keys/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSHKeySingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteSSHKey($id, $queryParams = []) {
        $json = $this->request("DELETE", "/ssh-keys/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerPriceRangeAssignmentSingleResponse
     */
    public function createServerPriceRangeAssignment($body, $queryParams = []) {
        $json = $this->request("POST", "/server-price-range-assignments", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerPriceRangeAssignmentSingleResponse());
    }

    /**
     * @return ServerPriceRangeAssignmentListResponse
     */
    public function getServerPriceRangeAssignments($queryParams = []) {
        $json = $this->request("GET", "/server-price-range-assignments", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerPriceRangeAssignmentListResponse());
    }

    /**
     * @return AddressListResponse
     */
    public function getAddresses($queryParams = []) {
        $json = $this->request("GET", "/addresses", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\AddressListResponse());
    }

    /**
     * @return ServerVariantSingleResponse
     */
    public function getServerVariant($id, $queryParams = []) {
        $json = $this->request("GET", "/server-variants/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerVariantSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerVariant($id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-variants/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteS3AccessKeyGrant($access_key_id, $id, $queryParams = []) {
        $json = $this->request("DELETE", "/storage/s3/access-keys/$access_key_id/grants/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerMediaSingleResponse
     */
    public function createServerMedia($body, $queryParams = []) {
        $json = $this->request("POST", "/server-medias", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerMediaSingleResponse());
    }

    /**
     * @return ServerMediaListResponse
     */
    public function getServerMedias($queryParams = []) {
        $json = $this->request("GET", "/server-medias", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerMediaListResponse());
    }

    /**
     * @return SubnetSingleResponse
     */
    public function getSubnet($id, $queryParams = []) {
        $json = $this->request("GET", "/subnets/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SubnetSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteSubnet($id, $queryParams = []) {
        $json = $this->request("DELETE", "/subnets/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerVolumeSingleResponse
     */
    public function attachServerVolume($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/server-volumes/$id/attach", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerVolumeSingleResponse());
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
     * @return S3AccessKeySingleResponse
     */
    public function getS3AccessKey($id, $queryParams = []) {
        $json = $this->request("GET", "/storage/s3/access-keys/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\S3AccessKeySingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteS3AccessKey($id, $queryParams = []) {
        $json = $this->request("DELETE", "/storage/s3/access-keys/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return S3AccessKeySingleResponse
     */
    public function createS3AccessKey($body, $queryParams = []) {
        $json = $this->request("POST", "/storage/s3/access-keys", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\S3AccessKeySingleResponse());
    }

    /**
     * @return S3AccessKeyListResponse
     */
    public function getS3AccessKeys($queryParams = []) {
        $json = $this->request("GET", "/storage/s3/access-keys", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\S3AccessKeyListResponse());
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
     * @return AddressSingleResponse
     */
    public function getAddress($id, $queryParams = []) {
        $json = $this->request("GET", "/addresses/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\AddressSingleResponse());
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
     * @return DomainSingleResponse
     */
    public function scheduleDomainDelete($body, $name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/schedule-delete", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\DomainSingleResponse());
    }

    /**
     * @return ServerBackupSingleResponse
     */
    public function getServerBackup($id, $queryParams = []) {
        $json = $this->request("GET", "/server-backups/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerBackupSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerBackup($id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-backups/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return DomainPriceListResponse
     */
    public function getDomainPricingList($queryParams = []) {
        $json = $this->request("GET", "/pricing/domains", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\DomainPriceListResponse());
    }

    /**
     * @return SSLCertificateSingleResponse
     */
    public function getSSLCertificate($id, $queryParams = []) {
        $json = $this->request("GET", "/ssl/certificates/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\SSLCertificateSingleResponse());
    }

    /**
     * @return AddressSingleResponse
     */
    public function createSubnetAddress($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/subnets/$id/addresses", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\AddressSingleResponse());
    }

    /**
     * @return NetworkSingleResponse
     */
    public function createNetwork($body, $queryParams = []) {
        $json = $this->request("POST", "/networks", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\NetworkSingleResponse());
    }

    /**
     * @return NetworkListResponse
     */
    public function getNetworks($queryParams = []) {
        $json = $this->request("GET", "/networks", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\NetworkListResponse());
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
     * @return ServerStorageSingleResponse
     */
    public function createServerStorage($body, $queryParams = []) {
        $json = $this->request("POST", "/server-storages", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerStorageSingleResponse());
    }

    /**
     * @return ServerStorageListResponse
     */
    public function getServerStorages($queryParams = []) {
        $json = $this->request("GET", "/server-storages", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerStorageListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function resizeServer($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/resize", $queryParams, $body);
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
     * @return ServerMediaSingleResponse
     */
    public function getServerMedia($id, $queryParams = []) {
        $json = $this->request("GET", "/server-medias/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerMediaSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerMedia($id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-medias/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return S3AccessGrantSingleResponse
     */
    public function createS3AccessKeyGrant($body, $access_key_id, $queryParams = []) {
        $json = $this->request("POST", "/storage/s3/access-keys/$access_key_id/grants", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\S3AccessGrantSingleResponse());
    }

    /**
     * @return S3AccessGrantListResponse
     */
    public function getS3AccessKeyGrants($access_key_id, $queryParams = []) {
        $json = $this->request("GET", "/storage/s3/access-keys/$access_key_id/grants", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\S3AccessGrantListResponse());
    }

    /**
     * @return ServerPriceRangeAssignmentSingleResponse
     */
    public function getServerPriceRangeAssignment($id, $queryParams = []) {
        $json = $this->request("GET", "/server-price-range-assignments/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerPriceRangeAssignmentSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerPriceRangeAssignment($id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-price-range-assignments/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
    }

    /**
     * @return ServerPriceRangeAssignmentSingleResponse
     */
    public function updateServerPriceRangeAssignment($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/server-price-range-assignments/$id", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerPriceRangeAssignmentSingleResponse());
    }

    /**
     * @return ServerVNCResponse
     */
    public function getServerVNC($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/vnc", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerVNCResponse());
    }

    /**
     * @return NetworkSingleResponse
     */
    public function getNetwork($id, $queryParams = []) {
        $json = $this->request("GET", "/networks/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\NetworkSingleResponse());
    }

    /**
     * @return LabelListResponse
     */
    public function getLabels($queryParams = []) {
        $json = $this->request("GET", "/labels", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\LabelListResponse());
    }

    /**
     * @return S3BucketSingleResponse
     */
    public function getS3Bucket($id, $queryParams = []) {
        $json = $this->request("GET", "/storage/s3/buckets/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\S3BucketSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteS3Bucket($id, $queryParams = []) {
        $json = $this->request("DELETE", "/storage/s3/buckets/$id", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\EmptyResponse());
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
     * @return ServerVolumeSingleResponse
     */
    public function detachServerVolume($id, $queryParams = []) {
        $json = $this->request("POST", "/server-volumes/$id/detach", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerVolumeSingleResponse());
    }

    /**
     * @return ServerVariantPriceSingleResponse
     */
    public function createServerVariantPrice($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/server-price-ranges/$id/variant-prices", $queryParams, $body);
        return $this->mapper->map($json, new \LUMASERV\ServerVariantPriceSingleResponse());
    }

    /**
     * @return ServerVariantPriceListResponse
     */
    public function getServerVariantPrices($id, $queryParams = []) {
        $json = $this->request("GET", "/server-price-ranges/$id/variant-prices", $queryParams);
        return $this->mapper->map($json, new \LUMASERV\ServerVariantPriceListResponse());
    }


}
