<?php

namespace App\Http\Controllers;

use App\Models\DPDShipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Config;

class DPDController extends Controller
{
    private string $BASE_URL = "https://ee.integration.dpd.eo.pl";

    public function CreateShipment(DPDShipment $shipment = null)
    {

        $url = "/ws-mapper-rest/createShipment_";

        $shipment = new DPDShipment();

        $shipment->name1 = "Sebastian Sõeruer";
        $shipment->street = "Valdeku 118A-52";
        $shipment->city = "Tallinn";
        $shipment->country = "EE";
        $shipment->pcode = "11215";
        $shipment->parcel_type = "D-B2C";
        $shipment->phone = "+37256656151";

        //validate data
        //Do POST Request
        //Save shipment number(return)

        try {
            $response = Http::asForm()->post(
                $this->BASE_URL . $url, [
                    'username' => config('DPDConfig.dpd_username') . "1",
                    'password' => config('DPDConfig.dpd_password'),
                    'name1' => $shipment->name1,
                    'street' => $shipment->street,
                    'city' => $shipment->city,
                    'country' => $shipment->country,
                    'pcode' => $shipment->pcode,
                    'parcel_type' => $shipment->parcel_type,
                    'phone' => $shipment->phone
                ]
            );
            if($response['status'] == "ok") {
                return $response['pl_number'];
            } else {
                return $response['errlog'];
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function CancelShipment($id)
    {
        $url = "/ws-mapper-rest/parcelDelete_";

        $response = HTTP::asForm()->post($this->BASE_URL . $url, [
            'username' => config('DPDConfig.dpd_username'),
            'password' => config('DPDConfig.dpd_password'),
            'parcels' => $id

        ]);
    }

    public function CreateParcelLabel($id)
    {
        $url="/ws-mapper-rest/parcelPrint_";

        $response = HTTP::asForm()->post($this->BASE_URL . $url, [
            'username' => config('DPDConfig.dpd_username'),
            'password' => config('DPDConfig.dpd_password'),
            'parcels' => $id,
            'printType' => config('DPDConfig.dpd_print_type'),
            'printFormat' => config('DPDConfig.dpd_print_format')
        ]);
        return $response;
    }

    public function CloseManifest()
    {

    }

    public function RequestCourier()
    {

    }

}
