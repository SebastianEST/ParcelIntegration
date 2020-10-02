<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DPDShipment extends Model
{
    use HasFactory;

    public string $name1; // Recipient's/Company name
    public ?string $name2; // Company name if name1 is Recipient name
    public string $street;
    public string $city;
    public string $country;
    public string $pcode; //postcode(index)
    public string $parcel_type;
    public string $num_of_parcel;
    public string $phone;
    public ?string $email;
    public ?string $order_number; //max 200. Goes to Shipment label
    public ?string $remark; // Delivery instructions to courier.

}
