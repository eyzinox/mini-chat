<?php 

    function connectBDD()
    {
        try {
            $bdd= new PDO('mysql:host=localhost; dbname=chat', 'eyzinox', 'b5S8wp9L#', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
        return $bdd;
    }

    function addMessage(string $pseudo, string $message)
    {   
        $bdd= connectBDD();
        $req= $bdd->prepare('INSERT INTO chat(pseudo , message) VALUES(:pseudo , :message)');
        $req->execute(array(
            'pseudo' => $pseudo,
            'message' => $message
        ));
    }

    function listMessages(int $page)
    {
        $bdd= connectBDD();

        /* COMPTEUR MESSAGES | NBR PAGES */
        $listMsg= $bdd->query('SELECT id FROM chat ORDER BY id DESC');
        $cpt_messages= $listMsg->rowCount();
        $nbPages= ceil($cpt_messages / 10);
        $_SESSION['nbPages']= $nbPages;

        /* LIMITES */
        $lim_max= $page * 10 ;
        $lim_min= $lim_max - 10;

        if($nbPages== 0)
        {
            $lim_min= 0;
            $lim_max= 10;
        }
        
        $listMsg->closeCursor();
        /* OLD DISPLAY */
        /* $disp= $bdd->query('SELECT pseudo , message FROM chat ORDER BY id DESC LIMIT' . $lim_min . ',' . $lim_max); */
        
        /* DISPLAY MESSAGES */
        $disp= $bdd->prepare('SELECT pseudo , message FROM chat ORDER BY id DESC LIMIT :lim_min, :lim_max');
        $disp->bindParam(':lim_min', $lim_min, PDO::PARAM_INT);
        $disp->bindParam(':lim_max', $lim_max, PDO::PARAM_INT);
        $disp->execute();

        while($data= $disp->fetch())
        {
            $mes= '<div class="text-break"><strong>' . $data['pseudo'] . '</strong>: ' . $data['message'] . '</div>';
            echo($mes);
        }
        $disp->closeCursor();

        /* DEBUG */
/*         echo $cpt_messages . ' message<br> ';
        echo $nbPages . ' pages<br> ';
        echo $lim_min . '-' . $lim_max . ' <br> '; */
    }
?>