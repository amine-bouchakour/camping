<!DOCTYPE html>
<html>

<head>
    <title>Page profil</title>
    <link rel="stylesheet" href="camping.css">
</head>


    <body id="bodyprofil">
        <?php include('header.php'); ?>
        <main id="mainprofil">
            <?php

            $connexion= mysqli_connect("localhost","root","","camping");

            $requeteInfosProfil = "SELECT * FROM utilisateurs WHERE id = '".$_SESSION['id']."'";
            $queryInfosProfil = mysqli_query($connexion, $requeteInfosProfil);
            $resultatInfosProfil = mysqli_fetch_assoc($queryInfosProfil);

            if(isset($_SESSION['login'])){ ?>

                <div class="formulaireprofil">
                    <h1 id="titreprofil">Modifier votre profil </h1>
                    <form action="profil.php" method="post">
                        

                        <div class="infoprofil">
                            
                            <label for="login">Login :<br> </label>
                            <input type="text" name="login" id="login" placeholder="<?php echo $resultatInfosProfil['login']?>">

                            <br>
                            <br>

                            <label for="password">Mot de passe :<br></label>
                            <input type="password" name="password" id="password">

                            <br>
                            <br>

                            <label for="confirmpassword">Confirmer Mot de passe :<br></label>
                            <input type="password" name="passwordcon" id="confirmpassword">

                            <br>
                            <br>

                            <input type="submit" value="Modifier" name="modifier" /><br>
                        </div>

                    </form>
                    <br>
                    <a href="profil.php?supp=true"><h3>Supprimer mon compte</h3></a>

                    <?php 

     
                                          
                    if(isset($_POST['modifier']))
                    {
                        

                        

                                         
                        

                        $login = $_POST["login"];
                        $requeteLogin = "SELECT login FROM utilisateurs WHERE login = '$login'";
                        $queryLogin = mysqli_query($connexion, $requeteLogin);
                        $resultatLogin = mysqli_fetch_all($queryLogin);
                        
                        if( !empty($resultatLogin) && $resultatLogin[0][0] == $_POST['login'] ) 
                        { 
                                    
                            echo "Login Already Used<br />";
                                
                        }
                        if ( empty($resultatLogin) && !empty($_POST['login']) ) 
                        {
                             $upLog = "UPDATE utilisateurs SET login = \"$login\" WHERE utilisateurs.login='".$resultatInfosProfil['login']."'";
                                $result = mysqli_query($connexion, $upLog);
                                    
                            header("Location:profil.php");
                        }


                        if ($_POST["password"] != $_POST["passwordcon"]) 
                        {
                            
                            echo "Mot de passe différents";
                            
                        } 
                        elseif(isset($_POST['password']) && !empty($_POST['password']) ) 
                        {
                            $password1 = $_POST['password'];
                            $passwordhash = password_hash($password1, PASSWORD_BCRYPT, array('cost' => 12)); 
                            $upPass = "UPDATE utilisateurs SET password = \"$passwordhash\" WHERE utilisateurs.password='".$resultatInfosProfil['password']."'";
                                $result = mysqli_query($connexion, $upPass);
                            header('Location:profil.php');
                        }
                    }


                ?>
                </div>
                
                
            
            <section id="reservationUser">
                <?php



                    echo '<h1>'.'Toutes vos réservations'.'</h1><br/>';

                    // TOUTES LES RESERVATIONS DE L'UTILISATEUR CONNECTEE
                    $connexion=mysqli_connect("localhost","root","","camping");
                    $requeteInfosResa="SELECT * FROM reservationplace INNER JOIN utilisateurs ON reservationplace.id_utilisateur=utilisateurs.Id WHERE login='".$resultatInfosProfil['login']."' ORDER BY datedebut ASC";
                    $queryInfosResa=mysqli_query($connexion,$requeteInfosResa);
                    $resultatInfosResa=mysqli_fetch_all($queryInfosResa);
        

                    // CALCUL SOMME TOTAL DEBOURSER PAR UTILISATEUR
                    $requetePrixTotal="SELECT SUM(prixtotal) FROM reservationplace INNER JOIN utilisateurs ON reservationplace.id_utilisateur=utilisateurs.Id WHERE login='".$resultatInfosProfil['login']."'";
                    $queryPrixTotal=mysqli_query($connexion,$requetePrixTotal);
                    $resultatTotalPrix=mysqli_fetch_row($queryPrixTotal);
       

                    $prixtotal=$resultatTotalPrix[0];
                    if(!empty($resultatInfosResa)){
                        $Id=$resultatInfosResa[0][9];
            
                    }
                    $nb_reservation=count($resultatInfosResa);

                    echo '<p>Réservation fait par : '.ucfirst($resultatInfosProfil['login']).'<br/>
                    Nombre de réservation total : '.$nb_reservation.'</br>
                    Dépense total : '.$prixtotal.' euros</p>';
                ?>
            </section>

            <section id="tableauReservationProfil">
                <?php

                $j=0;
                foreach($resultatInfosResa as $ligne)
                {
                    $login=$ligne[1];
                    $datedebut=$ligne[1];
                    $datefin = $ligne[2];
                    $emplacement=$ligne[3];
                    $habitat=ucfirst($ligne[4]);
                    $duree=$ligne[5];
                    $borne=ucfirst($ligne[6]);
                    $disco=ucfirst($ligne[7]);
                    $yfs=ucfirst($ligne[8]);
                    $id=$ligne[0];
                    ?>
                    <section id="backprofil">
                    <table id="tableReservationProfil">
                        <thead>
                            <td>Date Debut</td>
                            <td>Date Fin</td>
                            <td>Lieu</td>
                            <td>Type d'habitat</td>
                            <td>Durée du séjour</td>
                            <td>Option borne electrique</td>
                            <td>Option Acces Discothèque</td>
                            <td>Option Formule YFS</td>
                            <td>Réservations</td>
                        </thead>
                        <tr>
                            <td><?php echo $datedebut ?></td>
                            <td><?php echo $datefin ?></td>
                            <td><?php echo $emplacement ?></td>
                            <td><?php echo $habitat ?></td>
                            <td><?php echo $duree.'jours'?></td>
                            <td><?php echo $borne ?></td>
                            <td><?php echo $disco ?></td>
                            <td><?php echo $yfs ?></td>
                            <td><a href='profil.php?id=<?php echo $ligne[0]?>'>Supprimer réservations<a></td>
                            </tr>
                    </table>
                    </section>
                    <br><br>

                <?php 
                   if(isset($_GET['id']) and !isset($_GET['pg'])){
                    $requete1="DELETE FROM reservationplace WHERE id='".$_GET['id']."'";
                    $query1=mysqli_query($connexion,$requete1);
                    header('location:profil.php');

                } 
                }


                

                ?>
                <div id="actionUser">
                    <a href="index.php"><h3>Faire une nouvelle réservation</h3></a>
                </div>

            
        </section>

            <?php

            if(isset($_GET['supp']) and $_GET['supp']==true){
                $connexion=mysqli_connect('localhost','root','','camping');
                $requete="DELETE FROM utilisateurs WHERE login='".$resultatInfosProfil['login']."'";
                $query=mysqli_query($connexion,$requete);
                // echo $requete;

                $requete1="DELETE FROM reservationplace WHERE reservationplace.id_utilisateur='".$Id."'";
                $query1=mysqli_query($connexion,$requete1);
                // echo $requete1;

                header('location:deconnexion.php');
            }

        }
        else{
            header('location:connexion.php');
        }
        ?>
        </main>
        <?php include('footer.php'); ?>
    </body>
</html>

