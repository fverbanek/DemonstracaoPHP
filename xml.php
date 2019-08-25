<?php 
    if(isset($_GET['key']))
    {
        $key  = $_GET['key'];
        $auth = $_GET['auth'];
        $token = $_GET['token'];

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://app.notasegura.com.br/api/invoices/export?token=".$token."&invoice_key=".$key."&mode=XML",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Accept: */*",
                "Accept-Encoding: gzip, deflate",
                "Authorization: Basic ".$auth,
                "Cache-Control: no-cache",
                "Connection: keep-alive",
                "Host: app.notasegura.com.br",
                "Postman-Token: aa05e2e2-8dcb-4441-9ab5-777a7de1e31f,d540760b-5b53-4ff3-b062-76b002774ca1",
                "User-Agent: PostmanRuntime/7.15.2",
                "cache-control: no-cache"
            ),
            ));
        $response = curl_exec($curl);

        $err = curl_error($curl);
        curl_close($curl);
        
        echo "<pre>";        
        if($err)
        {
            echo $err;
        }else{
            $response = json_decode($response);
            //STRING DO XML
            $xmlString = htmlspecialchars($response->data->xml);
            //XML   FORMATO ARRAY
            $xmlInArray = new SimpleXMLElement($response->data->xml);

            echo "<pre>";
            print_r($xmlString);
        }
        
    }
?>