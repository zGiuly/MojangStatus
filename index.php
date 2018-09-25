<?php
/** @author zGiuly_
 * Index file
 */
include 'MojangStatus.php';
include 'settings.php';
$Status = new MojangStatus();
if($settings['json_response']){
    header('Content-Type: application/json');
    print_r(json_encode($Status->getAll(true)));
}else {
    echo $Status->getAll();
}
