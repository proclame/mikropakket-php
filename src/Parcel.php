<?php

namespace Mikropakket;

class Parcel
{
    public string $parcelNumber;
    private string $PdfParcel;

    public function __construct($parcelNumber, $PdfParcel)
    {
        $this->parcelNumber = $parcelNumber;
        $this->PdfParcel = $PdfParcel;
    }

    public static function fromArray(array $parcelData): Parcel
    {
        return new static($parcelData['ParcelNumber'], $parcelData['PdfParcel']);
    }

    public function getParcelNumber(): string
    {
        return $this->parcelNumber;
    }

    public function getBase64(): string
    {
        return $this->PdfParcel;
    }

    public function getLabel()
    {
        return base64_decode($this->PdfParcel);
    }

    public function stream($filename = 'mikropakket-label.pdf'): void
    {
        header('Content-type:application/pdf');
        header('Content-Disposition:inline;filename="'.$filename.'"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        echo $this->getLabel();

        exit;
    }

    public function download($filename = 'mikropakket-label.pdf'): void
    {
        header('Content-type:application/pdf');
        header('Content-Disposition:attachment;filename="'.$filename.'"');
        echo $this->getLabel();

        exit;
    }
}
