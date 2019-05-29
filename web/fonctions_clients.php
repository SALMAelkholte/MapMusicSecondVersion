<?php
function SessionExist(){
    if(isset($_SESSION['client'])){
        session_start();
    }
}
?>

