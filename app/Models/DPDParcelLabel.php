<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DPDParcelLabel extends Model
{
    use HasFactory;

    public string $parcels; // Parcel number list, parcel numbers are separated with “|”.
    public string $printType; // pdf/epl/zpl
    public string $printFormat; // A4, A5, A6
}
