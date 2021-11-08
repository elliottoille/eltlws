<?php
$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 4096,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
);
$res = openssl_pkey_new($config);
openssl_pkey_export($res, $private_key);
echo $private_key;
$public_key = openssl_pkey_get_details($res);
$public_key = $public_key["key"];
echo $public_key;
?>