<?php
include './vendor/autoload.php';

use Xendit\Xendit;

class Xenditlib
{
    protected $_ci;
    protected $apikey;

    function __construct()
    {
        $this->_ci = &get_instance();
        $this->apikey = "xnd_production_IXSnjf8PNwPX7dHxVLOzs56owYqwiCG3VaidQgTpB31uR7ISkKzPilf9e4j14m6j";
    }
    function get_ballance()
    {
        Xendit::setApiKey($this->apikey);
        $getBalance = \Xendit\Balance::getBalance('CASH');
        var_dump($getBalance);
    }
    function virtualaccount_create($external_id, $bankCode, $nama, $amount, $expired)
    {
        Xendit::setApiKey($this->apikey);
        $params = [
            "external_id" => $external_id,
            "bank_code" => $bankCode,
            "name" => $nama,
            "is_closed" => true,
            "expected_amount" => $amount,
            // "suggested_amount" => $amount,
            "expiration_date" => $expired
        ];

        $createVA = \Xendit\VirtualAccounts::create($params);
        // var_dump($createVA);
        return $createVA;
    }

    function retail_create($external_id, $retailcode, $nama, $amount, $expired)
    {
        Xendit::setApiKey($this->apikey);
        $params = [
            "external_id" => $external_id,
            "retail_outlet_name " => $retailcode,
            "name" => $nama,
            "expected_amount" => $amount,
            "expiration_date" => $expired
        ];
        
        $createFPC = \Xendit\Retail::create($params);
        // var_dump($createFPC);
        return $createFPC;
    }

    function qr_create($external_id, $amount)
    {
        Xendit::setApiKey($this->apikey);
        $params = [
            'external_id' => $external_id,
            'type' => 'STATIC',
            'callback_url' => 'https://britaincourse.id/webhook/qris',
            'amount' => $amount,
        ];
        
        $qr_code = \Xendit\QRCode::create($params);
        return $qr_code;
    }

    function virtualaccount_test()
    {
        Xendit::setApiKey($this->apikey);
        $params = [
            "external_id" => "COBA-VA0000",
            "retail_outlet_name " => "ALFAMART",
            "name" => "DIDIN",
            "expected_amount" => 150000
        ];

        $createVA = \Xendit\Retail::create($params);
        // var_dump($createVA);
        return $createVA;
    }
}
