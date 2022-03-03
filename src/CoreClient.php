<?php
namespace LUMASERV;

use JsonMapper;

class CoreClient {
    private $apiKey;
    private $baseUrl;
    private $mapper;

    public function __construct ($apiKey, $baseUrl = "https://api.lumaserv.cloud") {
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
     * @return SSHKeySingleResponse
     */
    public function createSSHKey($body, $queryParams = []) {
        $json = $this->request("POST", "/ssh-keys", $queryParams, $body);
        return $this->mapper->map($json, new SSHKeySingleResponse());
    }

    /**
     * @return SSHKeyListResponse
     */
    public function getSSHKeys($queryParams = []) {
        $json = $this->request("GET", "/ssh-keys", $queryParams);
        return $this->mapper->map($json, new SSHKeyListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function startServer($id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/start", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return AvailabilityZoneSingleResponse
     */
    public function createAvailabilityZone($body, $queryParams = []) {
        $json = $this->request("POST", "/availability-zones", $queryParams, $body);
        return $this->mapper->map($json, new AvailabilityZoneSingleResponse());
    }

    /**
     * @return AvailabilityZoneListResponse
     */
    public function getAvailabilityZones($queryParams = []) {
        $json = $this->request("GET", "/availability-zones", $queryParams);
        return $this->mapper->map($json, new AvailabilityZoneListResponse());
    }

    /**
     * @return ServerTemplateSingleResponse
     */
    public function getServerTemplate($id, $queryParams = []) {
        $json = $this->request("GET", "/server-templates/$id", $queryParams);
        return $this->mapper->map($json, new ServerTemplateSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function shutdownServer($id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/shutdown", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ServerSingleResponse
     */
    public function getServer($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id", $queryParams);
        return $this->mapper->map($json, new ServerSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServer($id, $queryParams = []) {
        $json = $this->request("DELETE", "/servers/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ServerSingleResponse
     */
    public function updateServer($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/servers/$id", $queryParams, $body);
        return $this->mapper->map($json, new ServerSingleResponse());
    }

    /**
     * @return ServerStorageClassSingleResponse
     */
    public function getServerStorageClass($id, $queryParams = []) {
        $json = $this->request("GET", "/server-storage-classes/$id", $queryParams);
        return $this->mapper->map($json, new ServerStorageClassSingleResponse());
    }

    /**
     * @return ScheduledServerActionSingleResponse
     */
    public function restoreServer($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/restore", $queryParams, $body);
        return $this->mapper->map($json, new ScheduledServerActionSingleResponse());
    }

    /**
     * @return SSLOrganisationSingleResponse
     */
    public function getSSLOrganisation($id, $queryParams = []) {
        $json = $this->request("GET", "/ssl/organisations/$id", $queryParams);
        return $this->mapper->map($json, new SSLOrganisationSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteSSLOrganisation($id, $queryParams = []) {
        $json = $this->request("DELETE", "/ssl/organisations/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ServerActionSingleResponse
     */
    public function getServerAction($id, $action_id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/actions/$action_id", $queryParams);
        return $this->mapper->map($json, new ServerActionSingleResponse());
    }

    /**
     * @return ServerGraphResponse
     */
    public function getServerGraph($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/graph", $queryParams);
        return $this->mapper->map($json, new ServerGraphResponse());
    }

    /**
     * @return SSLContactSingleResponse
     */
    public function getSSLContact($id, $queryParams = []) {
        $json = $this->request("GET", "/ssl/contacts/$id", $queryParams);
        return $this->mapper->map($json, new SSLContactSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteSSLContact($id, $queryParams = []) {
        $json = $this->request("DELETE", "/ssl/contacts/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return DNSZoneListResponse
     */
    public function getDNSZones($queryParams = []) {
        $json = $this->request("GET", "/dns/zones", $queryParams);
        return $this->mapper->map($json, new DNSZoneListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function recreateServer($id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/recreate", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function sendDomainVerification($name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/verification", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return DomainCheckVerificationResponse
     */
    public function checkDomainVerification($name, $queryParams = []) {
        $json = $this->request("GET", "/domains/$name/verification", $queryParams);
        return $this->mapper->map($json, new DomainCheckVerificationResponse());
    }

    /**
     * @return ServerHostSingleResponse
     */
    public function createServerHost($body, $queryParams = []) {
        $json = $this->request("POST", "/server-hosts", $queryParams, $body);
        return $this->mapper->map($json, new ServerHostSingleResponse());
    }

    /**
     * @return ServerHostListResponse
     */
    public function getServerHosts($queryParams = []) {
        $json = $this->request("GET", "/server-hosts", $queryParams);
        return $this->mapper->map($json, new ServerHostListResponse());
    }

    /**
     * @return ServerSingleResponse
     */
    public function createServer($body, $queryParams = []) {
        $json = $this->request("POST", "/servers", $queryParams, $body);
        return $this->mapper->map($json, new ServerSingleResponse());
    }

    /**
     * @return ServerListResponse
     */
    public function getServers($queryParams = []) {
        $json = $this->request("GET", "/servers", $queryParams);
        return $this->mapper->map($json, new ServerListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerNetwork($id, $network_id, $queryParams = []) {
        $json = $this->request("DELETE", "/servers/$id/networks/$network_id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return DomainCheckResponse
     */
    public function checkDomain($name, $queryParams = []) {
        $json = $this->request("GET", "/domains/$name/check", $queryParams);
        return $this->mapper->map($json, new DomainCheckResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function getDomain($name, $queryParams = []) {
        $json = $this->request("GET", "/domains/$name", $queryParams);
        return $this->mapper->map($json, new DomainSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteDomain($name, $queryParams = []) {
        $json = $this->request("DELETE", "/domains/$name", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function updateDomain($body, $name, $queryParams = []) {
        $json = $this->request("PUT", "/domains/$name", $queryParams, $body);
        return $this->mapper->map($json, new DomainSingleResponse());
    }

    /**
     * @return DomainHandleSingleResponse
     */
    public function getDomainHandle($code, $queryParams = []) {
        $json = $this->request("GET", "/domain-handles/$code", $queryParams);
        return $this->mapper->map($json, new DomainHandleSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteDomainHandle($code, $queryParams = []) {
        $json = $this->request("DELETE", "/domain-handles/$code", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return DomainHandleSingleResponse
     */
    public function updateDomainHandle($body, $code, $queryParams = []) {
        $json = $this->request("PUT", "/domain-handles/$code", $queryParams, $body);
        return $this->mapper->map($json, new DomainHandleSingleResponse());
    }

    /**
     * @return AvailabilityZoneSingleResponse
     */
    public function getAvailabilityZone($id, $queryParams = []) {
        $json = $this->request("GET", "/availability-zones/$id", $queryParams);
        return $this->mapper->map($json, new AvailabilityZoneSingleResponse());
    }

    /**
     * @return AvailabilityZoneSingleResponse
     */
    public function updateAvailabilityZone($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/availability-zones/$id", $queryParams, $body);
        return $this->mapper->map($json, new AvailabilityZoneSingleResponse());
    }

    /**
     * @return ServerBackupSingleResponse
     */
    public function createServerBackup($body, $queryParams = []) {
        $json = $this->request("POST", "/server-backups", $queryParams, $body);
        return $this->mapper->map($json, new ServerBackupSingleResponse());
    }

    /**
     * @return ServerBackupListResponse
     */
    public function getServerBackups($queryParams = []) {
        $json = $this->request("GET", "/server-backups", $queryParams);
        return $this->mapper->map($json, new ServerBackupListResponse());
    }

    /**
     * @return SubnetSingleResponse
     */
    public function createSubnet($body, $queryParams = []) {
        $json = $this->request("POST", "/subnets", $queryParams, $body);
        return $this->mapper->map($json, new SubnetSingleResponse());
    }

    /**
     * @return SubnetListResponse
     */
    public function getSubnets($queryParams = []) {
        $json = $this->request("GET", "/subnets", $queryParams);
        return $this->mapper->map($json, new SubnetListResponse());
    }

    /**
     * @return ServerVolumeSingleResponse
     */
    public function createServerVolume($body, $queryParams = []) {
        $json = $this->request("POST", "/server-volumes", $queryParams, $body);
        return $this->mapper->map($json, new ServerVolumeSingleResponse());
    }

    /**
     * @return ServerVolumeListResponse
     */
    public function getServerVolumes($queryParams = []) {
        $json = $this->request("GET", "/server-volumes", $queryParams);
        return $this->mapper->map($json, new ServerVolumeListResponse());
    }

    /**
     * @return PleskLicenseTypeSingleResponse
     */
    public function getPleskLicenseType($id, $queryParams = []) {
        $json = $this->request("GET", "/licenses/plesk-types/$id", $queryParams);
        return $this->mapper->map($json, new PleskLicenseTypeSingleResponse());
    }

    /**
     * @return ServerStorageClassSingleResponse
     */
    public function createServerStorageClass($body, $queryParams = []) {
        $json = $this->request("POST", "/server-storage-classes", $queryParams, $body);
        return $this->mapper->map($json, new ServerStorageClassSingleResponse());
    }

    /**
     * @return ServerStorageClassListResponse
     */
    public function getServerStorageClasses($queryParams = []) {
        $json = $this->request("GET", "/server-storage-classes", $queryParams);
        return $this->mapper->map($json, new ServerStorageClassListResponse());
    }

    /**
     * @return SearchResponse
     */
    public function search($queryParams = []) {
        $json = $this->request("GET", "/search", $queryParams);
        return $this->mapper->map($json, new SearchResponse());
    }

    /**
     * @return ScheduledServerActionSingleResponse
     */
    public function getScheduledServerAction($id, $action_id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/scheduled-actions/$action_id", $queryParams);
        return $this->mapper->map($json, new ScheduledServerActionSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteScheduledServerAction($id, $action_id, $queryParams = []) {
        $json = $this->request("DELETE", "/servers/$id/scheduled-actions/$action_id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return S3BucketSingleResponse
     */
    public function createS3Bucket($body, $queryParams = []) {
        $json = $this->request("POST", "/storage/s3/buckets", $queryParams, $body);
        return $this->mapper->map($json, new S3BucketSingleResponse());
    }

    /**
     * @return S3BucketListResponse
     */
    public function getS3Buckets($queryParams = []) {
        $json = $this->request("GET", "/storage/s3/buckets", $queryParams);
        return $this->mapper->map($json, new S3BucketListResponse());
    }

    /**
     * @return PleskLicenseTypeListResponse
     */
    public function getPleskLicenseTypes($queryParams = []) {
        $json = $this->request("GET", "/licenses/plesk-types", $queryParams);
        return $this->mapper->map($json, new PleskLicenseTypeListResponse());
    }

    /**
     * @return ServerActionListResponse
     */
    public function getServerActions($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/actions", $queryParams);
        return $this->mapper->map($json, new ServerActionListResponse());
    }

    /**
     * @return ServerStatusResponse
     */
    public function getServerStatus($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/status", $queryParams);
        return $this->mapper->map($json, new ServerStatusResponse());
    }

    /**
     * @return SSLOrganisationSingleResponse
     */
    public function createSSLOrganisation($body, $queryParams = []) {
        $json = $this->request("POST", "/ssl/organisations", $queryParams, $body);
        return $this->mapper->map($json, new SSLOrganisationSingleResponse());
    }

    /**
     * @return SSLOrganisationListResponse
     */
    public function getSSLOrganisations($queryParams = []) {
        $json = $this->request("GET", "/ssl/organisations", $queryParams);
        return $this->mapper->map($json, new SSLOrganisationListResponse());
    }

    /**
     * @return SSLTypeSingleResponse
     */
    public function getSSLType($id, $queryParams = []) {
        $json = $this->request("GET", "/ssl/types/$id", $queryParams);
        return $this->mapper->map($json, new SSLTypeSingleResponse());
    }

    /**
     * @return SSLTypeListResponse
     */
    public function getSSLTypes($queryParams = []) {
        $json = $this->request("GET", "/ssl/types", $queryParams);
        return $this->mapper->map($json, new SSLTypeListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteDNSRecord($name, $id, $queryParams = []) {
        $json = $this->request("DELETE", "/dns/zones/$name/records/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return DNSRecordSingleResponse
     */
    public function updateDNSRecord($body, $name, $id, $queryParams = []) {
        $json = $this->request("PUT", "/dns/zones/$name/records/$id", $queryParams, $body);
        return $this->mapper->map($json, new DNSRecordSingleResponse());
    }

    /**
     * @return PleskLicenseSingleResponse
     */
    public function getPleskLicense($id, $queryParams = []) {
        $json = $this->request("GET", "/licenses/plesk/$id", $queryParams);
        return $this->mapper->map($json, new PleskLicenseSingleResponse());
    }

    /**
     * @return PleskLicenseSingleResponse
     */
    public function updatePleskLicense($body, $id, $queryParams = []) {
        $json = $this->request("PUT", "/licenses/plesk/$id", $queryParams, $body);
        return $this->mapper->map($json, new PleskLicenseSingleResponse());
    }

    /**
     * @return ServerTemplateSingleResponse
     */
    public function createServerTemplate($body, $queryParams = []) {
        $json = $this->request("POST", "/server-templates", $queryParams, $body);
        return $this->mapper->map($json, new ServerTemplateSingleResponse());
    }

    /**
     * @return ServerTemplateListResponse
     */
    public function getServerTemplates($queryParams = []) {
        $json = $this->request("GET", "/server-templates", $queryParams);
        return $this->mapper->map($json, new ServerTemplateListResponse());
    }

    /**
     * @return ServerHostSingleResponse
     */
    public function getServerHost($id, $queryParams = []) {
        $json = $this->request("GET", "/server-hosts/$id", $queryParams);
        return $this->mapper->map($json, new ServerHostSingleResponse());
    }

    /**
     * @return ScheduledServerActionSingleResponse
     */
    public function createScheduledServerAction($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/scheduled-actions", $queryParams, $body);
        return $this->mapper->map($json, new ScheduledServerActionSingleResponse());
    }

    /**
     * @return ScheduledServerActionListResponse
     */
    public function getScheduledServerActions($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/scheduled-actions", $queryParams);
        return $this->mapper->map($json, new ScheduledServerActionListResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function unscheduleDomainDelete($name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/unschedule-delete", $queryParams);
        return $this->mapper->map($json, new DomainSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function stopServer($id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/stop", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return DNSRecordSingleResponse
     */
    public function createDNSZoneRecord($body, $name, $queryParams = []) {
        $json = $this->request("POST", "/dns/zones/$name/records", $queryParams, $body);
        return $this->mapper->map($json, new DNSRecordSingleResponse());
    }

    /**
     * @return DNSRecordListResponse
     */
    public function getDNSZoneRecords($name, $queryParams = []) {
        $json = $this->request("GET", "/dns/zones/$name/records", $queryParams);
        return $this->mapper->map($json, new DNSRecordListResponse());
    }

    /**
     * @return DNSRecordListResponse
     */
    public function updateDNSZoneRecords($body, $name, $queryParams = []) {
        $json = $this->request("PUT", "/dns/zones/$name/records", $queryParams, $body);
        return $this->mapper->map($json, new DNSRecordListResponse());
    }

    /**
     * @return ServerVolumeSingleResponse
     */
    public function getServerVolume($id, $queryParams = []) {
        $json = $this->request("GET", "/server-volumes/$id", $queryParams);
        return $this->mapper->map($json, new ServerVolumeSingleResponse());
    }

    /**
     * @return ServerNetworkSingleResponse
     */
    public function createServerNetwork($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/networks", $queryParams, $body);
        return $this->mapper->map($json, new ServerNetworkSingleResponse());
    }

    /**
     * @return ServerNetworkListResponse
     */
    public function getServerNetworks($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/networks", $queryParams);
        return $this->mapper->map($json, new ServerNetworkListResponse());
    }

    /**
     * @return ServerVariantSingleResponse
     */
    public function createServerVariant($body, $queryParams = []) {
        $json = $this->request("POST", "/server-variants", $queryParams, $body);
        return $this->mapper->map($json, new ServerVariantSingleResponse());
    }

    /**
     * @return ServerVariantListResponse
     */
    public function getServerVariants($queryParams = []) {
        $json = $this->request("GET", "/server-variants", $queryParams);
        return $this->mapper->map($json, new ServerVariantListResponse());
    }

    /**
     * @return ServerStorageSingleResponse
     */
    public function getServerStorage($id, $queryParams = []) {
        $json = $this->request("GET", "/server-storages/$id", $queryParams);
        return $this->mapper->map($json, new ServerStorageSingleResponse());
    }

    /**
     * @return SSHKeySingleResponse
     */
    public function getSSHKey($id, $queryParams = []) {
        $json = $this->request("GET", "/ssh-keys/$id", $queryParams);
        return $this->mapper->map($json, new SSHKeySingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteSSHKey($id, $queryParams = []) {
        $json = $this->request("DELETE", "/ssh-keys/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return AddressListResponse
     */
    public function getAddresses($queryParams = []) {
        $json = $this->request("GET", "/addresses", $queryParams);
        return $this->mapper->map($json, new AddressListResponse());
    }

    /**
     * @return ServerVariantSingleResponse
     */
    public function getServerVariant($id, $queryParams = []) {
        $json = $this->request("GET", "/server-variants/$id", $queryParams);
        return $this->mapper->map($json, new ServerVariantSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerVariant($id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-variants/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteS3AccessKeyGrant($access_key_id, $id, $queryParams = []) {
        $json = $this->request("DELETE", "/storage/s3/access-keys/$access_key_id/grants/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ServerMediaSingleResponse
     */
    public function createServerMedia($body, $queryParams = []) {
        $json = $this->request("POST", "/server-medias", $queryParams, $body);
        return $this->mapper->map($json, new ServerMediaSingleResponse());
    }

    /**
     * @return ServerMediaListResponse
     */
    public function getServerMedias($queryParams = []) {
        $json = $this->request("GET", "/server-medias", $queryParams);
        return $this->mapper->map($json, new ServerMediaListResponse());
    }

    /**
     * @return SubnetSingleResponse
     */
    public function getSubnet($id, $queryParams = []) {
        $json = $this->request("GET", "/subnets/$id", $queryParams);
        return $this->mapper->map($json, new SubnetSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteSubnet($id, $queryParams = []) {
        $json = $this->request("DELETE", "/subnets/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ServerVolumeSingleResponse
     */
    public function attachServerVolume($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/server-volumes/$id/attach", $queryParams, $body);
        return $this->mapper->map($json, new ServerVolumeSingleResponse());
    }

    /**
     * @return PleskLicenseSingleResponse
     */
    public function createPleskLicense($body, $queryParams = []) {
        $json = $this->request("POST", "/licenses/plesk", $queryParams, $body);
        return $this->mapper->map($json, new PleskLicenseSingleResponse());
    }

    /**
     * @return PleskLicenseListResponse
     */
    public function getPleskLicenses($queryParams = []) {
        $json = $this->request("GET", "/licenses/plesk", $queryParams);
        return $this->mapper->map($json, new PleskLicenseListResponse());
    }

    /**
     * @return S3AccessKeySingleResponse
     */
    public function getS3AccessKey($id, $queryParams = []) {
        $json = $this->request("GET", "/storage/s3/access-keys/$id", $queryParams);
        return $this->mapper->map($json, new S3AccessKeySingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteS3AccessKey($id, $queryParams = []) {
        $json = $this->request("DELETE", "/storage/s3/access-keys/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return S3AccessKeySingleResponse
     */
    public function createS3AccessKey($body, $queryParams = []) {
        $json = $this->request("POST", "/storage/s3/access-keys", $queryParams, $body);
        return $this->mapper->map($json, new S3AccessKeySingleResponse());
    }

    /**
     * @return S3AccessKeyListResponse
     */
    public function getS3AccessKeys($queryParams = []) {
        $json = $this->request("GET", "/storage/s3/access-keys", $queryParams);
        return $this->mapper->map($json, new S3AccessKeyListResponse());
    }

    /**
     * @return DNSZoneSingleResponse
     */
    public function getDNSZone($name, $queryParams = []) {
        $json = $this->request("GET", "/dns/zones/$name", $queryParams);
        return $this->mapper->map($json, new DNSZoneSingleResponse());
    }

    /**
     * @return DNSZoneSingleResponse
     */
    public function updateDNSZone($body, $name, $queryParams = []) {
        $json = $this->request("PUT", "/dns/zones/$name", $queryParams, $body);
        return $this->mapper->map($json, new DNSZoneSingleResponse());
    }

    /**
     * @return DomainHandleSingleResponse
     */
    public function createDomainHandle($body, $queryParams = []) {
        $json = $this->request("POST", "/domain-handles", $queryParams, $body);
        return $this->mapper->map($json, new DomainHandleSingleResponse());
    }

    /**
     * @return DomainHandleListResponse
     */
    public function getDomainHandles($queryParams = []) {
        $json = $this->request("GET", "/domain-handles", $queryParams);
        return $this->mapper->map($json, new DomainHandleListResponse());
    }

    /**
     * @return AddressSingleResponse
     */
    public function getAddress($id, $queryParams = []) {
        $json = $this->request("GET", "/addresses/$id", $queryParams);
        return $this->mapper->map($json, new AddressSingleResponse());
    }

    /**
     * @return SSLCertificateSingleResponse
     */
    public function createSSLCertificate($body, $queryParams = []) {
        $json = $this->request("POST", "/ssl/certificates", $queryParams, $body);
        return $this->mapper->map($json, new SSLCertificateSingleResponse());
    }

    /**
     * @return SSLCertificateListResponse
     */
    public function getSSLCertificates($queryParams = []) {
        $json = $this->request("GET", "/ssl/certificates", $queryParams);
        return $this->mapper->map($json, new SSLCertificateListResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function scheduleDomainDelete($body, $name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/schedule-delete", $queryParams, $body);
        return $this->mapper->map($json, new DomainSingleResponse());
    }

    /**
     * @return ServerBackupSingleResponse
     */
    public function getServerBackup($id, $queryParams = []) {
        $json = $this->request("GET", "/server-backups/$id", $queryParams);
        return $this->mapper->map($json, new ServerBackupSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerBackup($id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-backups/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return DomainPriceListResponse
     */
    public function getDomainPricingList($queryParams = []) {
        $json = $this->request("GET", "/pricing/domains", $queryParams);
        return $this->mapper->map($json, new DomainPriceListResponse());
    }

    /**
     * @return SSLCertificateSingleResponse
     */
    public function getSSLCertificate($id, $queryParams = []) {
        $json = $this->request("GET", "/ssl/certificates/$id", $queryParams);
        return $this->mapper->map($json, new SSLCertificateSingleResponse());
    }

    /**
     * @return AddressSingleResponse
     */
    public function createSubnetAddress($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/subnets/$id/addresses", $queryParams, $body);
        return $this->mapper->map($json, new AddressSingleResponse());
    }

    /**
     * @return NetworkSingleResponse
     */
    public function createNetwork($body, $queryParams = []) {
        $json = $this->request("POST", "/networks", $queryParams, $body);
        return $this->mapper->map($json, new NetworkSingleResponse());
    }

    /**
     * @return NetworkListResponse
     */
    public function getNetworks($queryParams = []) {
        $json = $this->request("GET", "/networks", $queryParams);
        return $this->mapper->map($json, new NetworkListResponse());
    }

    /**
     * @return DomainAuthinfoResponse
     */
    public function getDomainAuthinfo($name, $queryParams = []) {
        $json = $this->request("GET", "/domains/$name/authinfo", $queryParams);
        return $this->mapper->map($json, new DomainAuthinfoResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function removeDomainAuthinfo($name, $queryParams = []) {
        $json = $this->request("DELETE", "/domains/$name/authinfo", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return ServerStorageSingleResponse
     */
    public function createServerStorage($body, $queryParams = []) {
        $json = $this->request("POST", "/server-storages", $queryParams, $body);
        return $this->mapper->map($json, new ServerStorageSingleResponse());
    }

    /**
     * @return ServerStorageListResponse
     */
    public function getServerStorages($queryParams = []) {
        $json = $this->request("GET", "/server-storages", $queryParams);
        return $this->mapper->map($json, new ServerStorageListResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function resizeServer($body, $id, $queryParams = []) {
        $json = $this->request("POST", "/servers/$id/resize", $queryParams, $body);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function restoreDomain($name, $queryParams = []) {
        $json = $this->request("POST", "/domains/$name/restore", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return SSLContactSingleResponse
     */
    public function createSSLContact($body, $queryParams = []) {
        $json = $this->request("POST", "/ssl/contacts", $queryParams, $body);
        return $this->mapper->map($json, new SSLContactSingleResponse());
    }

    /**
     * @return SSLContactListResponse
     */
    public function getSSLContacts($queryParams = []) {
        $json = $this->request("GET", "/ssl/contacts", $queryParams);
        return $this->mapper->map($json, new SSLContactListResponse());
    }

    /**
     * @return ServerMediaSingleResponse
     */
    public function getServerMedia($id, $queryParams = []) {
        $json = $this->request("GET", "/server-medias/$id", $queryParams);
        return $this->mapper->map($json, new ServerMediaSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteServerMedia($id, $queryParams = []) {
        $json = $this->request("DELETE", "/server-medias/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return S3AccessGrantSingleResponse
     */
    public function createS3AccessKeyGrant($body, $access_key_id, $queryParams = []) {
        $json = $this->request("POST", "/storage/s3/access-keys/$access_key_id/grants", $queryParams, $body);
        return $this->mapper->map($json, new S3AccessGrantSingleResponse());
    }

    /**
     * @return S3AccessGrantListResponse
     */
    public function getS3AccessKeyGrants($access_key_id, $queryParams = []) {
        $json = $this->request("GET", "/storage/s3/access-keys/$access_key_id/grants", $queryParams);
        return $this->mapper->map($json, new S3AccessGrantListResponse());
    }

    /**
     * @return ServerVNCResponse
     */
    public function getServerVNC($id, $queryParams = []) {
        $json = $this->request("GET", "/servers/$id/vnc", $queryParams);
        return $this->mapper->map($json, new ServerVNCResponse());
    }

    /**
     * @return NetworkSingleResponse
     */
    public function getNetwork($id, $queryParams = []) {
        $json = $this->request("GET", "/networks/$id", $queryParams);
        return $this->mapper->map($json, new NetworkSingleResponse());
    }

    /**
     * @return LabelListResponse
     */
    public function getLabels($queryParams = []) {
        $json = $this->request("GET", "/labels", $queryParams);
        return $this->mapper->map($json, new LabelListResponse());
    }

    /**
     * @return S3BucketSingleResponse
     */
    public function getS3Bucket($id, $queryParams = []) {
        $json = $this->request("GET", "/storage/s3/buckets/$id", $queryParams);
        return $this->mapper->map($json, new S3BucketSingleResponse());
    }

    /**
     * @return EmptyResponse
     */
    public function deleteS3Bucket($id, $queryParams = []) {
        $json = $this->request("DELETE", "/storage/s3/buckets/$id", $queryParams);
        return $this->mapper->map($json, new EmptyResponse());
    }

    /**
     * @return DomainSingleResponse
     */
    public function createDomain($body, $queryParams = []) {
        $json = $this->request("POST", "/domains", $queryParams, $body);
        return $this->mapper->map($json, new DomainSingleResponse());
    }

    /**
     * @return DomainListResponse
     */
    public function getDomains($queryParams = []) {
        $json = $this->request("GET", "/domains", $queryParams);
        return $this->mapper->map($json, new DomainListResponse());
    }

    /**
     * @return ServerVolumeSingleResponse
     */
    public function detachServerVolume($id, $queryParams = []) {
        $json = $this->request("POST", "/server-volumes/$id/detach", $queryParams);
        return $this->mapper->map($json, new ServerVolumeSingleResponse());
    }


}
class SSHKey {
    /**
     * @var string
     */
    public $public_key;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $labels;
}

class DomainVerificationStatus {
    /**
     * @var bool
     */
    public $unverified;
}

class Server {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var Address[]
     */
    public $addresses;
    /**
     * @var string
     */
    public $variant_id;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $media_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $template_id;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $state;
    /**
     * @var object
     */
    public $labels;
}

class Address {
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $subnet_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
}

class DomainRequestNameserver {
    /**
     * @var string[]
     */
    public $addresses;
    /**
     * @var string
     */
    public $name;
}

class Label {
    /**
     * @var ObjectType
     */
    public $object_type;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $value;
    /**
     * @var string
     */
    public $object_id;
}

class PleskLicenseType {
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
}

class SearchResults {
    /**
     * @var Domain[]
     */
    public $domains;
    /**
     * @var DomainHandle[]
     */
    public $domain_handles;
}

class DomainPricing {
    /**
     * @var float
     */
    public $restore;
    /**
     * @var float
     */
    public $create;
    /**
     * @var float
     */
    public $renew;
    /**
     * @var string
     */
    public $tld;
}

class DomainHandle {
    /**
     * @var string
     */
    public $code;
    /**
     * @var string
     */
    public $birth_region;
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
    public $vat_number;
    /**
     * @var string
     */
    public $birth_date;
    /**
     * @var string
     */
    public $id_card;
    /**
     * @var string
     */
    public $organisation;
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
    public $birth_country_code;
    /**
     * @var string
     */
    public $project_id;
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
    public $fax;
    /**
     * @var string
     */
    public $id_card_authority;
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
    public $additional_address;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $birth_place;
    /**
     * @var string
     */
    public $id_card_issue_date;
    /**
     * @var object
     */
    public $labels;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $company_registration_number;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $street_number;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $region;
    /**
     * @var bool
     */
    public $privacy_protection;
}

class ServerBackup {
    /**
     * @var float
     */
    public $size;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $action_id;
    /**
     * @var bool
     */
    public $scheduled;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var ServerBackupState
     */
    public $state;
    /**
     * @var string
     */
    public $title;
}

class DomainAuthinfo {
    /**
     * @var string
     */
    public $valid_until;
    /**
     * @var string
     */
    public $authinfo;
}

class Network {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var int
     */
    public $tag;
    /**
     * @var string
     */
    public $title;
    /**
     * @var NetworkType
     */
    public $type;
    /**
     * @var object
     */
    public $labels;
}

class ServerStatus {
    /**
     * @var int
     */
    public $memory;
    /**
     * @var bool
     */
    public $online;
    /**
     * @var float
     */
    public $memory_usage;
    /**
     * @var float
     */
    public $cpu_usage;
    /**
     * @var int
     */
    public $uptime;
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

abstract class ServerActionState {
    const STARTED = "STARTED";
    const CANCELLED = "CANCELLED";
    const FAILED = "FAILED";
    const SUCCESS = "SUCCESS";
}

class ServerVolume {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var int
     */
    public $size;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $storage_id;
    /**
     * @var string
     */
    public $class_id;
    /**
     * @var bool
     */
    public $root;
    /**
     * @var string
     */
    public $created_at;
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
    public $server_id;
    /**
     * @var object
     */
    public $labels;
}

class DNSRecord {
    /**
     * @var string
     */
    public $data;
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
    public $type;
    /**
     * @var int
     */
    public $ttl;
}

class DNSZone {
    /**
     * @var string
     */
    public $hostmaster;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $name;
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
    public $ns2;
    /**
     * @var string
     */
    public $ns1;
    /**
     * @var object
     */
    public $labels;
}

class AvailabilityZone {
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
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

class ScheduledServerAction {
    /**
     * @var string
     */
    public $backup_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var ScheduledServerActionInterval
     */
    public $interval;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $execute_at;
    /**
     * @var string
     */
    public $server_id;
    /**
     * @var ServerActionType
     */
    public $type;
}

class Domain {
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $admin_handle_code;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $owner_handle_code;
    /**
     * @var string
     */
    public $tech_handle_code;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $zone_handle_code;
    /**
     * @var object
     */
    public $labels;
}

class Subnet {
    /**
     * @var string
     */
    public $network_id;
    /**
     * @var string
     */
    public $address;
    /**
     * @var int
     */
    public $prefix;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
}

class ServerStorageClass {
    /**
     * @var int
     */
    public $replication;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
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

class ServerGraphEntry {
    /**
     * @var int
     */
    public $disk_read;
    /**
     * @var float
     */
    public $memory;
    /**
     * @var float
     */
    public $network_ingress;
    /**
     * @var float
     */
    public $network_egress;
    /**
     * @var float
     */
    public $memory_usage;
    /**
     * @var int
     */
    public $time;
    /**
     * @var float
     */
    public $cpu_usage;
    /**
     * @var int
     */
    public $disk_write;
}

abstract class ObjectType {
    const DOMAIN = "DOMAIN";
    const DOMAIN_HANDLE = "DOMAIN_HANDLE";
    const SSH_KEY = "SSH_KEY";
    const PLESK_LICENSE = "PLESK_LICENSE";
    const SSL_CERTIFICATE = "SSL_CERTIFICATE";
    const SSL_ORGANISATION = "SSL_ORGANISATION";
    const SSL_CONTACT = "SSL_CONTACT";
    const S3_BUCKET = "S3_BUCKET";
    const S3_ACCESS_KEY = "S3_ACCESS_KEY";
    const S3_ACCESS_GRANT = "S3_ACCESS_GRANT";
    const DNS_ZONE = "DNS_ZONE";
    const SERVER = "SERVER";
    const SERVER_VOLUME = "SERVER_VOLUME";
    const SERVER_MEDIA = "SERVER_MEDIA";
    const NETWORK = "NETWORK";
}

class S3AccessKey {
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $labels;
}

class S3Bucket {
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $labels;
}

class S3AccessGrant {
    /**
     * @var string
     */
    public $bucket_id;
    /**
     * @var string
     */
    public $path;
    /**
     * @var string
     */
    public $role;
    /**
     * @var string
     */
    public $id;
    /**
     * @var object
     */
    public $labels;
}

class ServerTemplate {
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
}

abstract class NetworkType {
    const VLAN = "VLAN";
    const VXLAN = "VXLAN";
}

abstract class ServerBackupState {
    const PENDING = "PENDING";
    const SUCCESS = "SUCCESS";
    const FAILED = "FAILED";
}

class SSLType {
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
}

class DomainCheckResult {
    /**
     * @var bool
     */
    public $available;
}

class SSLContact {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $organisation;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $labels;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $fax;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $region;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

class ServerHost {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
}

class PleskLicense {
    /**
     * @var string
     */
    public $license;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $key;
    /**
     * @var object
     */
    public $labels;
}

class SSLCertificate {
    /**
     * @var string
     */
    public $organisation_id;
    /**
     * @var string
     */
    public $valid_until;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $type_id;
    /**
     * @var string
     */
    public $approver_email;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var string
     */
    public $admin_contact_id;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $tech_contact_id;
    /**
     * @var object
     */
    public $labels;
}

class ServerVNC {
    /**
     * @var string
     */
    public $password;
    /**
     * @var int
     */
    public $port;
    /**
     * @var string
     */
    public $host;
}

class ServerNetwork {
    /**
     * @var bool
     */
    public $default;
    /**
     * @var string
     */
    public $network_id;
    /**
     * @var string
     */
    public $address_v6_id;
    /**
     * @var string
     */
    public $created_at;
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
    public $address_v4_id;
    /**
     * @var string
     */
    public $host_id;
    /**
     * @var object
     */
    public $labels;
}

class ServerStorage {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $external_id;
    /**
     * @var string
     */
    public $id;
}

abstract class ScheduledServerActionInterval {
    const DAILY = "DAILY";
    const WEEKLY = "WEEKLY";
    const BI_WEEKLY = "BI_WEEKLY";
    const ONCE = "ONCE";
}

class ServerMedia {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $created_at;
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
    public $title;
    /**
     * @var object
     */
    public $labels;
}

class SSLOrganisation {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $registration_number;
    /**
     * @var string
     */
    public $created_at;
    /**
     * @var object
     */
    public $labels;
    /**
     * @var string
     */
    public $division;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $duns;
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
    public $region;
    /**
     * @var string
     */
    public $fax;
}

abstract class ServerActionType {
    const START = "START";
    const SHUTDOWN = "SHUTDOWN";
    const STOP = "STOP";
    const RESIZE = "RESIZE";
}

class ServerCreateRequestNetwork {
    /**
     * @var string
     */
    public $network_id;
}

class ServerVariant {
    /**
     * @var int
     */
    public $disk;
    /**
     * @var int
     */
    public $cores;
    /**
     * @var int
     */
    public $memory;
    /**
     * @var string
     */
    public $storage_class_id;
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $title;
}

class ServerAction {
    /**
     * @var string
     */
    public $started_at;
    /**
     * @var string
     */
    public $id;
    /**
     * @var ServerActionState
     */
    public $state;
    /**
     * @var ServerActionType
     */
    public $type;
    /**
     * @var bool
     */
    public $cancellable;
    /**
     * @var string
     */
    public $ended_at;
}

class S3AccessGrantListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var S3AccessGrant[]
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

class NetworkSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Network
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

class DomainHandleSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DomainHandle
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

class DomainListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Domain[]
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

class S3AccessGrantSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var S3AccessGrant
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

class ServerHostListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerHost[]
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

class SSLCertificateSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var SSLCertificate
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

class ServerVariantListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerVariant[]
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

class SubnetListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Subnet[]
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

class ServerGraphResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerGraphEntry[]
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

class PleskLicenseSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var PleskLicense
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

class ServerBackupListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerBackup[]
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

class ServerNetworkListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerNetwork[]
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

class AvailabilityZoneSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var AvailabilityZone
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

class ServerStorageClassSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerStorageClass
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

class ServerVariantSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerVariant
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

class DomainPriceListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DomainPricing[]
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

class S3AccessKeyListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var S3AccessKey[]
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

class SSLOrganisationSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var SSLOrganisation
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

class ServerVNCResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerVNC
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

class AddressSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Address
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

class ServerActionListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerAction[]
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

class NetworkListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Network[]
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

class S3BucketListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var S3Bucket[]
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

class ServerStorageSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerStorage
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

class ServerSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Server
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

class ServerStorageClassListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerStorageClass[]
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

class ServerMediaListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerMedia[]
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

class SSHKeySingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var SSHKey
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

class SearchResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var SearchResults
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

class ServerTemplateListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerTemplate[]
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

class ServerHostSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerHost
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

class SSLTypeSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var SSLType
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

class DNSZoneSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DNSZone
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

class SubnetSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Subnet
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

class DNSZoneListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var DNSZone[]
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

class SSLTypeListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var SSLType[]
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

class ServerStorageListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerStorage[]
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

class ScheduledServerActionListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ScheduledServerAction[]
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

class PleskLicenseTypeListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var PleskLicenseType[]
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

class ServerActionSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerAction
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

class DomainHandleListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var DomainHandle[]
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

class S3BucketSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var S3Bucket
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

class DomainCheckVerificationResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DomainVerificationStatus
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

class PleskLicenseTypeSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var PleskLicenseType
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

class AddressListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Address[]
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

class ServerTemplateSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerTemplate
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

class DomainCheckResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DomainCheckResult
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

class SSHKeyListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var SSHKey[]
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

class SSLContactSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var SSLContact
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

class DomainSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var Domain
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

class ServerBackupSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerBackup
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

class DNSRecordSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DNSRecord
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

class PleskLicenseListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var PleskLicense[]
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

class ServerStatusResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerStatus
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

class ServerListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Server[]
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

class ServerMediaSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerMedia
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

class DNSRecordListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var DNSRecord[]
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

class SSLOrganisationListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var SSLOrganisation[]
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

class ServerNetworkSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerNetwork
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

class SSLContactListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var SSLContact[]
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

class SSLCertificateListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var SSLCertificate[]
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

class LabelListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var Label[]
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

class S3AccessKeySingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var S3AccessKey
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

class AvailabilityZoneListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var AvailabilityZone[]
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

class ServerVolumeListResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ResponsePagination
     */
    public $pagination;
    /**
     * @var ServerVolume[]
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

class ServerVolumeSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ServerVolume
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

class DomainAuthinfoResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var DomainAuthinfo
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

class ScheduledServerActionSingleResponse {
    /**
     * @var ResponseMetadata
     */
    public $metadata;
    /**
     * @var ScheduledServerAction
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

class ServerBackupCreateRequest {
    /**
     * @var string
     */
    public $server_id;
    /**
     * @var string
     */
    public $title;
}

class DomainHandleCreateRequest {
    /**
     * @var string
     */
    public $birth_region;
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
    public $vat_number;
    /**
     * @var string
     */
    public $birth_date;
    /**
     * @var string
     */
    public $id_card;
    /**
     * @var string
     */
    public $organisation;
    /**
     * @var string
     */
    public $type;
    /**
     * @var string
     */
    public $birth_country_code;
    /**
     * @var string
     */
    public $project_id;
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
    public $fax;
    /**
     * @var string
     */
    public $id_card_authority;
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
    public $additional_address;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $birth_place;
    /**
     * @var string
     */
    public $id_card_issue_date;
    /**
     * @var object
     */
    public $labels;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $company_registration_number;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $street_number;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $region;
    /**
     * @var bool
     */
    public $privacy_protection;
}

class ServerCreateRequest {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $variant_id;
    /**
     * @var string[]
     */
    public $ssh_keys;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $template_id;
    /**
     * @var ServerCreateRequestNetwork[]
     */
    public $networks;
    /**
     * @var object
     */
    public $labels;
}

class DNSZoneUpdateRequest {
    /**
     * @var string
     */
    public $hostmaster;
    /**
     * @var string
     */
    public $ns2;
    /**
     * @var string
     */
    public $ns1;
    /**
     * @var object
     */
    public $labels;
}

class DNSRecordCreateRequest {
    /**
     * @var string
     */
    public $data;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $type;
    /**
     * @var int
     */
    public $ttl;
}

class ServerTemplateCreateRequest {
    /**
     * @var string
     */
    public $root_slot;
    /**
     * @var object
     */
    public $zones;
    /**
     * @var string
     */
    public $title;
}

class SSLContactCreateRequest {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $last_name;
    /**
     * @var string
     */
    public $organisation;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $labels;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $fax;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $region;
    /**
     * @var string
     */
    public $first_name;
    /**
     * @var string
     */
    public $email;
}

class NetworkCreateRequest {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var int
     */
    public $tag;
    /**
     * @var string
     */
    public $title;
    /**
     * @var NetworkType
     */
    public $type;
}

class ServerVariantCreateRequest {
    /**
     * @var string[]
     */
    public $zone_ids;
    /**
     * @var int
     */
    public $disk;
    /**
     * @var int
     */
    public $cores;
    /**
     * @var int
     */
    public $memory;
    /**
     * @var bool
     */
    public $legacy;
    /**
     * @var string
     */
    public $storage_class_id;
    /**
     * @var string
     */
    public $title;
}

class DomainCreateRequest {
    /**
     * @var int
     */
    public $duration;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $admin_handle_code;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $owner_handle_code;
    /**
     * @var string
     */
    public $tech_handle_code;
    /**
     * @var DomainRequestNameserver[]
     */
    public $nameserver;
    /**
     * @var string
     */
    public $authinfo;
    /**
     * @var string
     */
    public $zone_handle_code;
    /**
     * @var object
     */
    public $labels;
}

class SSLCertificateCreateRequest {
    /**
     * @var string
     */
    public $organisation_id;
    /**
     * @var object
     */
    public $tech_contact;
    /**
     * @var string
     */
    public $csr;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $type_id;
    /**
     * @var object
     */
    public $admin_contact;
    /**
     * @var object
     */
    public $organisation;
    /**
     * @var string
     */
    public $approver_email;
    /**
     * @var string
     */
    public $admin_contact_id;
    /**
     * @var string
     */
    public $tech_contact_id;
    /**
     * @var string
     */
    public $validation_method;
    /**
     * @var object
     */
    public $labels;
}

class ScheduledServerActionCreateRequest {
    /**
     * @var string
     */
    public $backup_id;
    /**
     * @var ScheduledServerActionInterval
     */
    public $interval;
    /**
     * @var string
     */
    public $execute_at;
    /**
     * @var ServerActionType
     */
    public $type;
}

class SSHKeyCreateRequest {
    /**
     * @var string
     */
    public $public_key;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $labels;
}

class ServerStorageCreateRequest {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $external_id;
}

class AvailabilityZoneCreateRequest {
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $config;
}

class ServerNetworkCreateRequest {
    /**
     * @var string
     */
    public $network_id;
}

class AvailabilityZoneUpdateRequest {
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $config;
}

class S3AccessKeyCreateRequest {
    /**
     * @var string
     */
    public $secret_key;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $labels;
}

class SubnetAddressCreateRequest {
    /**
     * @var string
     */
    public $address;
}

class SSLOrganisationCreateRequest {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $registration_number;
    /**
     * @var object
     */
    public $labels;
    /**
     * @var string
     */
    public $division;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $phone;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $duns;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $region;
    /**
     * @var string
     */
    public $fax;
}

class ServerMediaCreateRequest {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $external_id;
    /**
     * @var string
     */
    public $title;
}

class ServerUpdateRequest {
    /**
     * @var string
     */
    public $name;
    /**
     * @var object
     */
    public $labels;
}

class DomainUpdateRequest {
    /**
     * @var string
     */
    public $admin_handle_code;
    /**
     * @var string
     */
    public $owner_handle_code;
    /**
     * @var string
     */
    public $tech_handle_code;
    /**
     * @var DomainRequestNameserver[]
     */
    public $nameserver;
    /**
     * @var string
     */
    public $zone_handle_code;
    /**
     * @var object
     */
    public $labels;
}

class ServerVolumeCreateRequest {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var int
     */
    public $size;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $class_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $labels;
}

class S3AccessGrantCreateRequest {
    /**
     * @var string
     */
    public $bucket_id;
    /**
     * @var string
     */
    public $path;
    /**
     * @var string
     */
    public $role;
    /**
     * @var object
     */
    public $labels;
}

class DNSRecordUpdateRequest {
    /**
     * @var string
     */
    public $data;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $type;
    /**
     * @var int
     */
    public $ttl;
}

class DomainHandleUpdateRequest {
    /**
     * @var string
     */
    public $additional_address;
    /**
     * @var string
     */
    public $birth_region;
    /**
     * @var string
     */
    public $city;
    /**
     * @var string
     */
    public $vat_number;
    /**
     * @var string
     */
    public $birth_date;
    /**
     * @var string
     */
    public $id_card;
    /**
     * @var string
     */
    public $birth_place;
    /**
     * @var string
     */
    public $id_card_issue_date;
    /**
     * @var object
     */
    public $labels;
    /**
     * @var string
     */
    public $birth_country_code;
    /**
     * @var string
     */
    public $country_code;
    /**
     * @var string
     */
    public $company_registration_number;
    /**
     * @var string
     */
    public $phone;
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
    public $street_number;
    /**
     * @var string
     */
    public $postal_code;
    /**
     * @var string
     */
    public $region;
    /**
     * @var string
     */
    public $fax;
    /**
     * @var string
     */
    public $id_card_authority;
    /**
     * @var bool
     */
    public $privacy_protection;
    /**
     * @var string
     */
    public $email;
}

class ServerHostCreateRequest {
    /**
     * @var string
     */
    public $zone_id;
    /**
     * @var string
     */
    public $external_id;
    /**
     * @var string
     */
    public $title;
}

class PleskLicenseCreateRequest {
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $type_id;
    /**
     * @var object
     */
    public $labels;
}

class ServerStorageClassCreateRequest {
    /**
     * @var int
     */
    public $replication;
    /**
     * @var string[]
     */
    public $storage_ids;
    /**
     * @var string
     */
    public $title;
}

class PleskLicenseUpdateRequest {
    /**
     * @var string
     */
    public $address;
    /**
     * @var object
     */
    public $labels;
}

class ServerRestoreRequest {
    /**
     * @var string
     */
    public $backup_id;
}

class S3BucketCreateRequest {
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var string
     */
    public $title;
    /**
     * @var object
     */
    public $labels;
}

class DomainScheduleDeleteRequest {
    /**
     * @var string
     */
    public $date;
}

class SubnetCreateRequest {
    /**
     * @var string
     */
    public $network_id;
    /**
     * @var string
     */
    public $address;
    /**
     * @var bool
     */
    public $public;
    /**
     * @var string
     */
    public $project_id;
    /**
     * @var int
     */
    public $prefix;
}

class ServerVolumeAttachRequest {
    /**
     * @var string
     */
    public $server_id;
}

/* ERROR */class ServerResizeRequest {
    /**
     * @var string
     */
    public $variant_id;
    /**
     * @var bool
     */
    public $resize_disk;
}

