<?php

class ControllerExtensionDVuefrontCurrency extends Controller
{
    private $codename = "d_vuefront";

    public function currency()
    {
        $this->load->model('localisation/currency');

        $currencies = array();

        $results = $this->model_localisation_currency->getCurrencies();

        foreach ($results as $result) {
            if ($result['status']) {
                $currencies[] = array(
                    'title'        => $result['title'],
                    'code'         => $result['code'],
                    'symbol_left'  => $result['symbol_left'],
                    'symbol_right' => $result['symbol_right'],
                    'active' => $this->session->data['currency'] == $result['code']
                );
            }
        }

        return $currencies;
    }

    public function edit($args)
    {
        $this->session->data['currency'] = $args['code'];
        
        unset($this->session->data['shipping_method']);
        unset($this->session->data['shipping_methods']);

        return $this->currency();
    }
}
