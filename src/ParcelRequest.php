<?php

namespace Mikropakket;

use Exception;

class ParcelRequest
{
    protected array $required = ['SendersCountryCode', 'MPCustomerNumber', 'SendersName', 'SendersStreet', 'SendersHouseNumber', 'SendersZipcode', 'SendersCity', 'ReceiversName', 'ReceiversStreet', 'ReceiversHouseNumber', 'ReceiversZipcode', 'ReceiversCity', 'ReceiversCountryCode'];
    protected array $optional = ['ParcelNumber', 'SendersPhoneNumber', 'ReceiversPhoneNumber', 'ReceiversAcceptant', 'DeliveryNote', 'CashDeliveryInCents', 'CashDeliveryReference', 'DeliveryTimeWindow', 'PickUpDate', 'AlsoSaturday', 'CreateRetourLabel', 'PickupType', 'Reference', 'ReceiversEmail', 'ReceiversNote', 'SendersNote'];
    private array $attributes = [];
    private int $paper_size = Papersize::A6;
    private string $api_key;

    private string $testing_endpoint = 'https://mpws.mikropakket.nl:9220/';
    private string $production_endpoint = 'https://mpws.mikropakket.nl:9200/';

    private bool $isProduction;

    public function setApiKey($api_key, bool $isProduction = false): void
    {
        $this->api_key = $api_key;
        $this->isProduction = $isProduction;
    }

    public function setJson(string $json): void
    {
        $this->setAttributes(json_decode($json, true));
    }

    public function setAttributes(array $attributes): void
    {
        $this->attributes = array_merge($this->attributes, $attributes);
        $this->cleanAttributes();
    }

    public function request()
    {
        if (!$this->checkRequired()) {
            throw new Exception('Not all required attributes are set');
        }

        $json = json_encode($this->attributes, JSON_THROW_ON_ERROR);

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

        return new ParcelResponse($response->getBody());
    }

    private function getApiEndpoint(): string
    {
        $endpoint = $this->isProduction ? $this->production_endpoint : $this->testing_endpoint;
        $endpoint .= 'mikropakketparcellabel/api/v1-1/parcel-label/'.$this->paper_size;

        return $endpoint;
    }

    private function cleanAttributes(): void
    {
        $this->attributes = array_filter(
            $this->attributes,
            fn ($key) => in_array($key, [...$this->required, ...$this->optional], true),
            ARRAY_FILTER_USE_KEY
        );
    }

    private function checkRequired(): bool
    {
        foreach ($this->required as $requiredAttribute) {
            if (!array_key_exists($requiredAttribute, $this->attributes)) {
                return false;
            }
        }

        return true;
    }
}
