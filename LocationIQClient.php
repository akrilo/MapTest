<?php

require_once 'RestClient.php';
class LocationIQClient extends RestClient{
    private $restClient;

    public function __construct(RestClient $restClient) {
        $this->restClient = $restClient;
    }

    public function getAddressCoordinates($address) {
        $endpoint = "/v1/search.php";
        $params = [
            'key' => $this->restClient->apiKey,
            'q' => urlencode($address),
            'format' => 'json'
        ];

        return $this->restClient->get($endpoint, $params);
    }

    public function getCoordinatesAddress($latitude, $longitude) {
        $endpoint = "/v1/reverse.php";
        $params = [
            'key' => $this->restClient->apiKey,
            'lat' => $latitude,
            'lon' => $longitude,
            'format' => 'json'
        ];

        return $this->restClient->get($endpoint, $params);
    }
}
