<?php
$ekspedisi = $_POST["ekspedisi"];
$distrik = $_POST["distrik"];
$berat = $_POST["berat"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=501&destination=" . $distrik . "&weight=" . $berat . "&courier=" . $ekspedisi,
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
  $array_response = json_decode($response, TRUE);

  $datapaket = $array_response["rajaongkir"]["results"]["0"]["costs"];


  echo "<option value=''>--Pilih Paket--</option>";

  foreach ($datapaket as $key => $tiappaket) {
    echo "<option
     paket='" . $tiappaket['service'] . "'
     ongkir='" . $tiappaket["cost"]["0"]["value"] . "'
     etd='" . $tiappaket["cost"]["0"]["etd"] . "' >";
    echo $tiappaket["service"] . " ";
    echo number_format($tiappaket["cost"]["0"]["value"]) . " ";
    echo $tiappaket["cost"]["0"]["etd"];
    echo "</option>";
  }
}
?>