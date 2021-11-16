<?php
$config = array( # Make an array that stores the variables for creating keys
    "digest_alg" => "sha512", # The algorithm to use
    "private_key_bits" => 4096, # How many bits to make the private key
    "private_key_type" => OPENSSL_KEYTYPE_RSA, # The type of keys to make
);
$res = openssl_pkey_new($config); # Generate new keys and store them to this variable
openssl_pkey_export($res, $private_key); # Export the previously made private key into variable "$private_key"
$public_key = openssl_pkey_get_details($res); # Store details about the public key into this variable
$a = $public_key["key"]; # Redefine this variable as the actual key value
$public_key = $a;
?>