<?php

require 'AWSSDK/aws.phar';

$az = file_get_contents('http://169.254.169.254/latest/meta-data/placement/availability-zone');
$region = substr($az, 0, -1);

$ssm_client = new Aws\Ssm\SsmClient([
    'version' => 'latest',
    'region'  => $region
]);

$result = $ssm_client->GetParametersByPath(['Path' => '/dev']);

$db_masterurl = "";
$db_rrurl = "";
$db_name = "";
$db_user = "";
$db_password = "";

foreach($result['Parameters'] as $p) {
    if ($p['Name'] == '/dev/dbMasterUrl') $db_masterurl = $p['Value'];
    if ($p['Name'] == '/dev/dbRRUrl') $db_rrurl = $p['Value'];
    if ($p['Name'] == '/dev/dbName') $db_name = $p['Value'];
    if ($p['Name'] == '/dev/dbUser') $db_user = $p['Value'];
    if ($p['Name'] == '/dev/dbPassword') $db_password = $p['Value'];
}

?>




