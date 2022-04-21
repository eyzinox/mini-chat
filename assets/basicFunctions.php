<?php 
    function PagesCount()
    {
        $bdd= connectBDD();
        $listMsg= $bdd->query('SELECT id FROM chat ORDER BY id DESC');
        $cpt_messages= $listMsg->rowCount();
        $nbPages= ceil($cpt_messages / 10);
        $_SESSION['nbPages']= $nbPages;
        $listMsg->closeCursor();
        
        return $nbPages;
    }

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

    function delErrCode()
    {
        $_SESSION['errCode']= 0;
    }

    function pagem1()
    {
        $page = $_GET['page'];
        if($page== 1)
            $page= '<a class="invisible disabled" href="./index.php?page=' . ($page) . '"><button type="button" class="btn btn-primary invisible disabled">' . ($page) . '</button></a>';
        else  
            $page= '<a href="./index.php?page=' . ($page - 1) . '"><button type="button" class="btn btn-primary">' . ($page - 1) . '</button></a>';
        echo $page;

    }

    function page()
    {
        $page = $_GET['page'];
        $page= '<a href="./index.php?page=' . ($page) . '"><button type="button" class="btn btn-primary">' . ($page) . '</button></a>';
        echo $page;
    }
    
    function pagep1()
    {
        $page = $_GET['page'];
        if($page== PagesCount())
            $page= '<a class="invisible disabled" href="./index.php?page=' . ($page) . '"><button type="button" class="btn btn-primary invisible disabled">' . ($page) . '</button></a>';
        else
            $page= '<a href="./index.php?page=' . ($page + 1) . '"><button type="button" class="btn btn-primary">' . ($page + 1) . '</button></a>';
        echo $page;
    }
?>