<?php

namespace App\Utils;

use GuzzleHttp\Client;

class Country extends Client
{
    /**
     * get country filter by calling code
     *
     * @param  $code
     * @return object
     */
    public function FetchCountryByCode($code): object
    {
        $response = $this->get('https://restcountries.herokuapp.com/api/v1/callingcode/' . $code);
        $arr_body = json_decode($response->getBody());
        return $arr_body;
    }

}
