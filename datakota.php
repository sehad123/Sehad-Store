<?php
$idprov = $_GET["id_provinsi"];
$curl = curl_init();

curl_setopt_array(
  $curl,
  array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=" . $idprov,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "key: 9dd58bf97b3f0da986a9199de5e3a100"
    ),
  )
);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  //   echo $response;
  $array_response = json_decode($response, TRUE);
  $datakota = $array_response["rajaongkir"]["results"];

  echo "<option value=''>--Pilih kabupaten/kota--</option>";


  foreach ($datakota as $key => $tiapkota) {
    echo "<option value='' 
    id_distrik='" . $tiapkota["city_id"] . "'
    nama_provinsi='" . $tiapkota["province"] . "'
     nama_distrik='" . $tiapkota["city_name"] . "'
      tipe_distrik='" . $tiapkota["type"] . "'
       kodepos='" . $tiapkota["postal_code"] . "'>";
    echo $tiapkota["type"] . " ";
    echo $tiapkota["city_name"];
    echo "</option>";

  }

}
?>