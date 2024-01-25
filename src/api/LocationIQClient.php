<?php

namespace api;
use http\RestClient;

class LocationIQClient extends RestClient{

    public function __construct() {
        $this->apiKey = "pk.67fd68b34c4522133213238c5fa97c18";
        $this->baseUrl = "https://eu1.locationiq.com";
        parent::__construct($this->apiKey, $this->baseUrl);
    }


    public function getAddressCoordinates($address) {
        $endpoint = "/v1/search.php";
        $params = [
            'key' => $this->apiKey,
            'q' => urlencode($address),
            'format' => 'json'
        ];

        return $this->get($endpoint, $params);
    }

    public function getCoordinatesAddress($latitude, $longitude) {
        $endpoint = "/v1/reverse.php";
        $params = [
            'key' => $this->apiKey,
            'lat' => $latitude,
            'lon' => $longitude,
            'format' => 'json'
        ];

        return $this->get($endpoint, $params);
    }
}
