<?php 
    function checkErrCode()
    {
        if (!isset($_SESSION['errCode']))
            $_SESSION['errCode'] = 0;
        $errCode= $_SESSION['errCode'];
        
        switch ($errCode) {
            case '1':
                dispErrCode();
                break;
            
            default:
                break;
        }
    }

    function dispErrCode()
    {
        $err='<div class="alert alert-danger alert-dismissible fade show" role="alert">Un des deux champs requis n\'est pas complété !<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo($err);
    }
?>