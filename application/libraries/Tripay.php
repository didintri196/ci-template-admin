<?php

class Tripay
{
    protected $_ci;
    protected $apikey;
    protected $privateKey;
    protected $merchantCode;

    function __construct()
    {
        $this->_ci = &get_instance();
        $this->apikey = "XcWfwEaZQ0DOSbfWSPXasSdFyEkpPAmWEFS2Ctyi";
        $this->privateKey = "8XPhr-bYhWh-aKxdO-jZtL4-b7plr";
        $this->merchantCode = "T1585";
    }

    function virtualaccount_create($external_id, $bankCode, $nama, $email, $phone, $paket, $periode, $amount)
    {
        $data = [
            'method'            => $bankCode,
            'merchant_ref'      => $external_id,
            'amount'            => $amount,
            'customer_name'     => $nama,
            'customer_email'    => $email,
            'customer_phone'    => $phone,
            'order_items'       => [
                [
                    'sku'       => 'REGIS',
                    'name'      => 'Registrasi periode '.$periode,
                    'price'     => 0,
                    'quantity'  => 1
                ],
                [
                    'sku'       => 'PAKET',
                    'name'      => $paket,
                    'price'     => $amount,
                    'quantity'  => 1
                ]
            ],
            'callback_url'      => base_url() . '/webhook/tripay',
            'return_url'        => base_url() . '/account/dashboard',
            'expired_time'      => (time() + (6 * 60 * 60)), // 24 jam
            'signature'         => hash_hmac('sha256', $this->merchantCode . $external_id . $amount, $this->privateKey)
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_FRESH_CONNECT     => true,
            CURLOPT_URL               => "https://payment.tripay.co.id/api/transaction/create",
            CURLOPT_RETURNTRANSFER    => true,
            CURLOPT_HEADER            => false,
            CURLOPT_HTTPHEADER        => array(
                "Authorization: Bearer " . $this->apikey
            ),
            CURLOPT_FAILONERROR       => false,
            CURLOPT_POST              => true,
            CURLOPT_POSTFIELDS        => http_build_query($data)
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        echo !empty($err) ? $err : $response;
    }

    // function retail_create($external_id, $retailcode, $nama, $amount, $expired)
    // {
    //     Xendit::setApiKey($this->apikey);
    //     $params = [
    //         "external_id" => $external_id,
    //         "retail_outlet_name " => $retailcode,
    //         "name" => $nama,
    //         "expected_amount" => $amount,
    //         "expiration_date" => $expired
    //     ];

    //     $createFPC = \Xendit\Retail::create($params);
    //     // var_dump($createFPC);
    //     return $createFPC;
    // }

    // function qr_create($external_id, $amount)
    // {
    //     Xendit::setApiKey($this->apikey);
    //     $params = [
    //         'external_id' => $external_id,
    //         'type' => 'STATIC',
    //         'callback_url' => 'https://britaincourse.id/webhook/qris',
    //         'amount' => $amount,
    //     ];

    //     $qr_code = \Xendit\QRCode::create($params);
    //     return $qr_code;
    // }

    // function virtualaccount_test()
    // {
    //     Xendit::setApiKey($this->apikey);
    //     $params = [
    //         "external_id" => "COBA-VA0000",
    //         "retail_outlet_name " => "ALFAMART",
    //         "name" => "DIDIN",
    //         "expected_amount" => 150000
    //     ];

    //     $createVA = \Xendit\Retail::create($params);
    //     // var_dump($createVA);
    //     return $createVA;
    // }
}
