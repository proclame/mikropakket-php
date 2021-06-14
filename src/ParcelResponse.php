<?php
namespace Mikropakket;

class ParcelResponse
{

    private $parcelRequestResponse;
    public Parcel $shipmentParcel;
    public ?Parcel $returnParcel = null;

    public function __construct($parcelRequestResponseBody){
        $this->parcelRequestResponse = json_decode($parcelRequestResponseBody, true);

        if(isset($this->parcelRequestResponse['PdfParcels'])){
            $this->shipmentParcel = Parcel::fromArray($this->parcelRequestResponse['PdfParcels'][0]);
            $this->returnParcel = Parcel::fromArray($this->parcelRequestResponse['PdfParcels'][1]);
        } else {
            $this->shipmentParcel = Parcel::fromArray($this->parcelRequestResponse);
        }
    }
}