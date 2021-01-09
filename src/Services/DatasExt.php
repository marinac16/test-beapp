<?php


namespace App\Services;


class DatasExt
{

    public function getDatas($url) {
        $json = file_get_contents($url);
        $obj = json_decode($json);

        return $obj;

    }

}