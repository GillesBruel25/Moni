<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Moni</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="icon" type="image/png" href="img/Logo.png">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header class="container-fluid p-3 mb-5 bg-info text-light text-center shadow">
        <h2>Moni</h2>
    </header>
   
    <section class="container col-md-9 mb-5">
        <img src="img/Logo.png" class="col col-sm-3  img-responsive img-rounded">
            <nav class="navbar navbar-expand-sm navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <form class="form-inline my-2 my-lg-0 col-md-4 pull-left" method="post" action="lexique.php">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="terme">
                        <button class="btn btn-outline-info my-2 my-sm-0" type="submit" name="s">Search</button>
                    </form>
                </div>
            </nav>
        <br />
        <div class="dropdown">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">Menus</button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="index.html"> Home</a></li>
                <li><a class="dropdown-item" href="lexique.php"> Lexique</a></li>
                <li><a class="dropdown-item" href=""> Link</a></li>
            </ul>
        </div>
        <br>
        <div class="container-fluid p-3 mb-5  text-center shadow"><!--POINT D OMBRE SUR LES P3 ET MB5-->
        <section class="bg-info">
        <?php
        
        $bdd=new PDO('mysql:host=localhost;dbname=test', 'root', '');
            if (isset($_POST["s"]))
            {
             $_POST["terme"] = htmlspecialchars($_POST["terme"]); //pour sécuriser le formulaire contre les failles html
             $terme = $_POST["terme"];
             $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
             $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
            }
            if (isset($terme)) {
                $terme = strtolower($terme);
                $select_terme = $bdd->prepare('SELECT nom,description FROM lexique WHERE nom LIKE ?');
                $select_terme->execute(array("%".$terme."%"));
                if($select_terme->rowcount()){//rowcount retourne le nombre de lignes affectees par une requete
                    while($terme_trouve = $select_terme->fetch()){
                        echo "<div><h2>".$terme_trouve['nom']."</h2><p> ".$terme_trouve['description']."</p>";
                        }
                    $select_terme->closeCursor();
                }else{
                    ?><font color="red">
                    <?php echo 'Mot absent du lexique';?></font><?php
                }
            }
            else{
                echo "Vous devez entrer votre requete dans la barre de recherche";
             }
        ?>
        </section>
        <table class="table table-bordered table-striped table-condensed">
            <legend>
                <h2 class="success">Lexique de la monnaie</h2>
            </legend>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $bdd=new PDO('mysql:host=localhost;dbname=test', 'root', '');
                $req1=$bdd->query('SELECT * FROM lexique');
                while($donnees=$req1->fetch()){
                ?>
                <tr>
                    <td><?php echo $donnees['nom']?></td>
                    <td><?php echo $donnees['description'];?></td>
                </tr>
            <?php 
            }
            $req1->closeCursor();
            ?>
            </tbody>
        </table>
        </div>
        <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i><span class="glyphicon
glyphicon-ok-sign" style="color:#4f4;"></span> d</a>
    </section>
    <hr>
    <footer class="text-center">
        <p>Copyright &copy; 2019 Moni &ndash; All Rights Reserved. </p>
    </footer>
    <script src="js/app.js"></script>
</body>
</html>