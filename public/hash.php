<?php

$thePassword = generateRandomString();



$options = [
    'cost' => 12,
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
$theHash = password_hash($thePassword, PASSWORD_BCRYPT, $options);
echo $thePassword . "<br/>";

echo $theHash . "<br/>";

$thePassword = "umfUVpnwp4";
$theHash = "$2y$12\$AeNMt17uEJi.fE8sR7DM9OSZvYZ8q6Z1wE6xnCBSn9W3FDmdMwr.G";


echo password_verify ($thePassword, $theHash);


function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>