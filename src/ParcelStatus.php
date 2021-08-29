<?php

namespace Mikropakket;

class ParcelStatus
{
    private string $api_key;
    private string $endpoint = 'https://www.mikropakket.be:8901/';

    public function setApiKey($api_key): void
    {
        $this->api_key = $api_key;
    }

    public function request(string $parcelNumber, string $postalCode)
    {
        $json = json_encode(['Parcelnr' => $parcelNumber, 'Postalcode' => $postalCode]);

        $response = (new \GuzzleHttp\Client())->request(
            'POST',
            $this->getApiEndpoint(),
            [
                'body' => $json,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'X-ApiKey' => $this->api_key,
                ],
            ]
        );

        return $response->getBody();
    }

    private function getApiEndpoint(): string
    {
        return $this->endpoint.'ParcelStatusService/api/v1-0/Post/Status';
    }
}
