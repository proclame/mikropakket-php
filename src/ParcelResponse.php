<?php

namespace Mikropakket;

class ParcelResponse
{
    public Parcel $shipmentParcel;
    public ?Parcel $returnParcel = null;

    public function __construct($parcelRequestResponseBody)
    {
        $parcelRequestResponse = json_decode($parcelRequestResponseBody, true);

        if (isset($parcelRequestResponse['PdfParcels'])) {
            $this->shipmentParcel = Parcel::fromArray($parcelRequestResponse['PdfParcels'][0]);
            $this->returnParcel = Parcel::fromArray($parcelRequestResponse['PdfParcels'][1]);
        } else {
            $this->shipmentParcel = Parcel::fromArray($parcelRequestResponse);
        }
    }
}
