<?php
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
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
// konversi ke array dari json
  $array_response = json_decode($response, TRUE);
  $dataprovinsi = $array_response["rajaongkir"]["results"];

  echo "<option value=''>--Pilih Provinsi--</option>";


  foreach ($dataprovinsi as $key => $tiapprovinsi) {
    echo "<option value='" . $tiapprovinsi["province_id"] . "'id_provinsi='" . $tiapprovinsi["province_id"] . "'>";
    echo $tiapprovinsi["province"];
    echo "</option>";

  }
  echo "<pre>";
  print_r($dataprovinsi);
  echo "</pre>";

}
?>