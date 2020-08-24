<?php
namespace App\Service;


class ExchangeRatesApi
{
    /**
     * service url
     */
    const HTTPS_API_EXCHANGERATESAPI = 'https://api.exchangeratesapi.io/';

    /**
     * Latest date label
     */
    const DATE_LATEST = 'latest';

    /**
     * Return latest rates
     *
     * @return \stdClass
     */
    public function getLatest(): \stdClass
    {
        return $this->getRates(self::DATE_LATEST);
    }

    /**
     * Return rates by date
     *
     * @param string $date Date label
     *
     * @return \stdClass
     */
    protected function getRates($date): \stdClass
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::HTTPS_API_EXCHANGERATESAPI . $date);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        $data = json_decode($response);

        return $data;
    }
}