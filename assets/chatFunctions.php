<?php 
    session_start();
    include('./bddFunctions.php');
    connectBDD();

    /* Var CONTROL */
    if(!isset($_POST['pseudoInput']))
        $_POST['pseudoInput']= NULL;
    if(!isset($_POST['textInput']))
        $_POST['textInput']= NULL;

    $_SESSION['errCode']= NULL;

    $pseudo= htmlspecialchars($_POST['pseudoInput']);
    $message= htmlspecialchars($_POST['textInput']);

    /* MESSAGE WRITTING */
    if($pseudo== NULL || $message== NULL)
        $_SESSION['errCode']= 1;
    else
        addMessage($pseudo, $message);

    /* PSEUDO SAVE */
    $_SESSION['pseudo']= $pseudo;
    
    /* DEBUG */
    print_r($_POST);
    /* END DEBUG */

    header("Refresh: 0; URL=../index.php");
    die;
?>