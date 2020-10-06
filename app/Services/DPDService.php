<?php

namespace App\Services;

use Config;
use Storage;


class DPDService
{
    public static function PrintLabel(string $id, string $labelFile)
    {

        Storage::disk('local')->put($id .'.pdf', $labelFile);
    }

}

?>
