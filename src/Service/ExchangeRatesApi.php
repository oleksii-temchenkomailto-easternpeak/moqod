<?php
namespace App\Service;


class ExchangeRatesApi
{
    /**
     * service url
     */
    const HTTPS_API_EXCHANGERATESAPI = 'https://api.exchangeratesapi.io/';

    protected $currencies = ['USD', 'EUR', 'RUB', 'CNY'];

    /**
     * Latest date label
     */
    const DATE_LATEST = 'latest';

    /**
     * Return latest rates
     *
     * @param string $base Base currency
     *
     * @return \stdClass
     *
     * @throws \Exception
     */
    public function latest(string $base = ''): \stdClass
    {
        return $this->extractedRates($base, self::DATE_LATEST);
    }

    /**
     * Return rates by date
     *
     * @param string $base Base currency
     * @param string $date Date label
     *
     * @return \stdClass
     *
     * @throws \Exception
     */
    protected function extractedRates(string $base, string $date): \stdClass
    {
        $data = $this->rates($base, $date);
        return $this->extractRates($data);
    }

    /**
     * Return rates by date
     *
     * @param string $base Base currency
     * @param string $date Date label
     *
     * @return \stdClass
     *
     * @throws \Exception
     */
    protected function rates(string $base, string $date): \stdClass
    {
        $ch = curl_init();
        $url = self::HTTPS_API_EXCHANGERATESAPI . $date . ($base? '?base=' . $base: '');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch);

        $data = json_decode($response);
        if (property_exists($data, 'error')) {
            throw new \Exception($data->error);
        }

        return $data;
    }

    /**
     * @param array $currencies
     */
    public function setCurrencies(array $currencies): void
    {
        $this->currencies = $currencies;
    }

    /**
     * Extract only needed rates
     *
     * @param \stdClass $data Data from response
     *
     * @return \stdClass
     *
     * @throws \Exception
     */
    public function extractRates(\stdClass $data): \stdClass
    {
        if (!property_exists($data, 'rates')) {
            throw new \Exception('Smth went wrong');
        }
        if (!property_exists($data, 'base')) {
            throw new \Exception('Smth went wrong');
        }

        $rates = [];
        foreach ($this->currencies as $currency) {
            if (property_exists($data->rates, $currency)) {
                $rates[$currency] = $data->rates->$currency;
            } else if ($data->base == $currency) {
                $rates[$currency] = 1;
            } else {
                throw new \Exception('Requested currency (' . $currency . ') doesn\'t exist');
            }
        }

        return (object) $rates;
    }
}
