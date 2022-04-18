<?php
session_start();

require('./assets/bddFunctions.php');

if (!isset($_SESSION['pseudo']))
    $_SESSION['pseudo'] = NULL;

if (!isset($_SESSION['errCode']))
    $_SESSION['errCode'] = NULL;

if (!isset($_SESSION['nbPages']))
    $_SESSION['nbPages'] = PagesCount();

if (!isset($_GET['page']))
    $_GET['page'] = 1;
$page = $_GET['page'];
$page = $_GET['page'];

$nbPages = $_SESSION['nbPages'];

if ($page < 1)
{
    $page = 1;
    header("Refresh: 0; URL=./index.php?page=1");
}

if ($_GET['page'] >= $nbPages)
    $page = $nbPages;

/*     print_r($page . '( <br> ');
    echo($nbPages . ') <br> ');
    print_r($_SESSION);
    print_r($_GET); */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Mini-Chat | eyzinox</title>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="./assets/img/favicon.png" alt="" width="32" height="32">
            MiniChat
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./assets/">Assets</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container" style="display: flex;">
        <!-- INPUT -->
        <div class="container-fluid" style="width: 500px;">
            <!-- ERROR CODE -->
            <?php
            switch ($_SESSION['errCode']) {
                case '1':
                    echo ('
                        <div class="alert alert-danger" role="alert">
                            Un des deux champs requis n\'est pas complété !
                        </div>
                    ');
                    break;

                default:

                    break;
            }
            ?>

            <form method="POST" action="./assets/chatFunctions.php">
                <div class="mb-3">
                    <label for="pseudoInput" class="form-label" id="pseudo" name="pseudo">Pseudonyme</label>
                    <input type="text" class="form-control" name="pseudoInput" id="pseudoInput" aria-describedby="peusdoHelp" value="<?php echo ($_SESSION['pseudo']); ?>">
                </div>
                <div class="mb-3">
                    <label for="messageInput" class="form-label" id="message" name="message">Message</label>
                    <textarea name="textInput" id="textInput" rows="3" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                    <a href="./" class="btn btn-primary">⟳</a>
                    <div class="btn-group me-2" role="group">
                        <a href="./index.php?page=<?php echo ($page - 1); ?>"><button type="button" class="btn btn-primary"><?php echo ($page - 1); ?></button></a>
                        <a href="./index.php?page=<?php echo ($page); ?>"><button type="button" class="btn btn-primary"><?php echo ($page); ?></button></a>
                        <a href="./index.php?page=<?php echo ($page + 1); ?>"><button type="button" class="btn btn-primary"><?php echo ($page + 1); ?></button></a>
                        <button type="button" class="btn btn-secondary"><?php echo ($page . '/' . $nbPages); ?></button>
                    </div>
                </div>
            </form>
        </div>

        <!-- CHAT -->
        <div class="container">
            <div class="container-fluid">
                <h4>LISTE DES MESSAGES: </h4>
                <?php listMessages($page); ?>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="margin: auto; text-align: center; position: absolute; bottom: 0; background-color: #dcdcdc;">
        <footer>
            <br>
            <p>Credits: Mathieu (développeur) et Louis (testeur). Merci à Lui (Louis ou Lewis pour les intimes). Mauvais jeu de mot allez bisous.</p>
            <p>&copy 2022. eyzinox.</p>
        </footer>
    </div>
</body>

</html>