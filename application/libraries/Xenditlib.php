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
        $this->apikey = "xnd_production_dZf1l6viwJWHJvtGdDfZvKD1uodVXCQN2kXq4fFSmNFdPzaGY16zlhBVIGBTxRx";
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
            "retail_outlet_name" => $retailcode,
            "name" => $nama,
            "expected_amount" => $amount,
            "expiration_date" => $expired
        ];
        // var_dump($params);
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

    function retail_test()
    {
        Xendit::setApiKey($this->apikey);
        $params = [
            'external_id' => 'TEST-123456789',
            'retail_outlet_name' => 'ALFAMART',
            'name' => 'JOHN DOE',
            'expected_amount' => 25000
        ];
        
        $createFPC = \Xendit\Retail::create($params);
        var_dump($createFPC);
        
        $id = $createFPC['id'];
        
        $getFPC = \Xendit\Retail::retrieve($id);
        var_dump($getFPC);
        
        $updateParams = ['expected_amount' => 20000];
        
        $updateFPC = \Xendit\Retail::update($id, $updateParams);
        var_dump($updateFPC);
    }
}
