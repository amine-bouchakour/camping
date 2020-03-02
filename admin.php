<!DOCTYPE html>
<html>
    <head>
        <title>Page Admin</title>
        <link rel="stylesheet" type="text/css" href="camping.css">
    </head>

    <body id="bodyAdmin">
        <?php include('header.php'); ?>
        <main id="mainAdmin">
            <?php


                if($_SESSION['login'] == "admin")
                {
                    ?><meta http-equiv="refresh" content="30;"/><?php

                    echo '<p id="titreAdmin">Bienvenue admninistrateur'.'</p><br/>';

                    $connexion=mysqli_connect("Localhost","root","","camping");
                                       


                    $requetePins="SELECT * FROM utilisateurs INNER JOIN reservationplace WHERE utilisateurs.Id = reservationplace.id_utilisateur and emplacement='pins' ORDER BY datedebut DESC";
                    $queryPins=mysqli_query($connexion,$requetePins);
                    $resultatPins=mysqli_fetch_all($queryPins);
                    

                    $requeteResaPins = "SELECT * FROM reservationplace WHERE emplacement='pins'";
                    $queryResaPins = mysqli_query($connexion,$requeteResaPins);
                    $resultatResaPins = mysqli_fetch_all($queryResaPins);
                    
                    
                    // CALCUL SOMME TOTAL GAGNEE POUR LES PINS
                    $requetePrixPins="SELECT SUM(prixtotal) FROM reservationplace WHERE emplacement='pins'";
                    $queryPrixPins=mysqli_query($connexion,$requetePrixPins);
                    $resultatPrixPins=mysqli_fetch_row($queryPrixPins);


                    ?> 
                    <div class="infoEmplacement">
                        <p>Réservation pour les Pins</p>
                        <p>Nb de réservations total : <?php echo count($resultatResaPins) ?></p>
                        <p>Sommes total cumulé sur les Pins : <?php echo $resultatPrixPins[0]; ?> euros</p>

                    </div>
                    
                 
                    <section class="sectionadmin">
                        <article>
                            <?php
                                $j=0;
                                while($j<count($resultatPins))
                                {

                                    $id=$resultatPins[$j][3];
                                    $id_utilisateur=$resultatPins[$j][12];
                                    $login=ucfirst($resultatPins[$j][1]);
                                    $nb_reservation=count($resultatPins);
                                    $datedebut=$resultatPins[$j][4];
                                    $datefin=$resultatPins[$j][5];
                                    $emplacement=$resultatPins[$j][6];
                                    $habitat=ucfirst($resultatPins[$j][7]);
                                    $duree=$resultatPins[$j][8];
                                    $borne=ucfirst($resultatPins[$j][9]);
                                    $disco=ucfirst($resultatPins[$j][10]);
                                    $yfs=ucfirst($resultatPins[$j][11]);
                                    $prixtotal=number_format($resultatPins[$j][12],2);

                                    ?>
                                    <table>
                                        <th><?php echo $login ?></th>
                                        <tr>
                                            <td>Date d'entrée en camping = <?php echo $datedebut ?></td>
                                        </tr>
                                        <tr>
                                            <td>Date de sortie du camping = <?php echo $datefin?></td>
                                        </tr>
                                        <tr>
                                            <td>Type d'hébergement = <?php echo $habitat ?></td>
                                        </tr>
                                        <tr>
                                            <td>Durée du séjour = <?php echo $duree."jours" ?></td>
                                        </tr>
                                        <tr>
                                            <td>Accès à la borne électrique = <?php echo $borne ?></td>
                                        </tr>
                                        <tr>
                                            <td>Accès au Disco-Club “Les girelles dansantes” = <?php echo $disco ?></td>
                                        </tr>
                                        <tr>
                                            <td>Accès aux activités Yoga, Frisbee et Ski Nautique = <?php echo $yfs ?></td>
                                        </tr>
                                        <tr>
                                            <td>Prix total TTC = <?php echo $prixtotal."Euros" ?></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href='admin.php?id=<?php echo $id ?>'>ANNULER RESERVATION</a>
                                                <a href='admin.php?idbis=<?php echo $id_utilisateur ?>'>SUPPRIMER COMPTE</a>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php
                                    ++$j;
                                }
                            ?>
                                    
                        </article>
                    </section>
                    <?php

                    // SUPPRESSION RESERVATION
                    if(isset($_GET['id'])){
                        $requeteDeleteResa="DELETE FROM reservationplace WHERE id='".$_GET['id']."'";
                        $query1=mysqli_query($connexion,$requeteDeleteResa);
                        $_GET['id']=0;
                    }

                    // SUPPRESSION COMPTE ET RESERVATION
                    if(isset($_GET['idbis'])){
                        $requeteDeleteUser="DELETE FROM utilisateurs  WHERE utilisateurs.id='".$_GET['idbis']."'";
                        $query2=mysqli_query($connexion,$requeteDeleteUser);
                        $requeteDeleteResaUser="DELETE FROM reservationplace WHERE reservationplace.id_utilisateur='".$_GET['idbis']."'";
                        $query3=mysqli_query($connexion,$requeteDeleteResaUser);
                    }

                  

                    $requetePlage="SELECT DISTINCT * FROM utilisateurs INNER JOIN reservationplace WHERE utilisateurs.Id = reservationplace.id_utilisateur and emplacement='plage' ORDER BY datedebut DESC";
                    $queryPlage=mysqli_query($connexion,$requetePlage);
                    $resultatPlage=mysqli_fetch_all($queryPlage);
                     
                    
                    $requeteResaPlage = "SELECT * FROM reservationplace WHERE emplacement='plage'";
                    $queryResaPlage = mysqli_query($connexion,$requeteResaPlage);
                    $resultatResaPlage=mysqli_fetch_all($queryResaPlage);
                    

                    // CALCUL SOMME TOTAL GAGNEE POUR LA PLAGE
                    $requetePrixPlage = "SELECT SUM(prixtotal) FROM reservationplace WHERE emplacement='plage'";
                    $queryPrixPlage = mysqli_query($connexion,$requetePrixPlage);
                    $resultatPrixPlage=mysqli_fetch_row($queryPrixPlage);
                  


                    ?> 
                    <div class="infoEmplacement">
                        <p>Réservation pour la Plage</p>
                        <p>Nb de réservations total : <?php echo count($resultatResaPlage) ?></p>
                        <p>Sommes total cumulé sur le plage : <?php echo $resultatPrixPlage[0]; ?> euros</p>
                    </div>
                    


                    <?php

                    ?>
                    <section class="sectionadmin">
                        <article>
                            <?php
                                $j=0;
                                while($j<count($resultatPlage))
                                {

                                    $id=$resultatPlage[$j][3];
                                    $id_utilisateur=$resultatPlage[$j][12];
                                    $login=ucfirst($resultatPlage[$j][1]);
                                    $nb_reservation=count($resultatPlage);
                                    $datedebut=$resultatPlage[$j][4];
                                    $datefin=$resultatPlage[$j][5];
                                    $emplacement=$resultatPlage[$j][6];
                                    $habitat=ucfirst($resultatPlage[$j][7]);
                                    $duree=$resultatPlage[$j][8];
                                    $borne=ucfirst($resultatPlage[$j][9]);
                                    $disco=ucfirst($resultatPlage[$j][10]);
                                    $yfs=ucfirst($resultatPlage[$j][11]);
                                    $prixtotal=number_format($resultatPlage[$j][12],2);
                            
                                    ?>
                                    <table>
                                    <th><?php echo $login ?></th>
                                    <tr>
                                        <td>Date d'entrée en camping = <?php echo $datedebut ?></td>
                                    </tr>
                                    <tr>
                                        <td>Date de sortie du camping = <?php echo $datefin ?></td>
                                    </tr>
                                    <tr>
                                        <td>Type d'hébergement = <?php echo $habitat ?></td>
                                    </tr>
                                    <tr>
                                        <td>Durée du séjour = <?php echo $duree."jours" ?></td>
                                    </tr>
                                    <tr>
                                        <td>Accès à la borne électrique = <?php echo $borne ?></td>
                                    </tr>
                                    <tr>
                                        <td>Accès au Disco-Club “Les girelles dansantes” = <?php echo $disco ?></td>
                                    </tr>
                                    <tr>
                                        <td>Accès aux activités Yoga, Frisbee et Ski Nautique = <?php echo $yfs ?></td>
                                    </tr>
                                    <tr>
                                        <td>Prix total TTC = <?php echo $prixtotal."Euros" ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href='admin.php?id1=<?php echo $id ?>'>ANNULER RESERVATION</a>
                                            <a href='admin.php?id1bis=<?php echo $id_utilisateur ?>'>SUPPRIMER COMPTE</a>
                                        </td>
                                    </tr>
                                </table>
                                    <?php

                                        ++$j;
                                    
                            
                                }
                            ?>
                            
                        </article>
                    </section>
                    <?php

                    // SUPPRESSION RESERVATION
                    if(isset($_GET['id1'])){
                        $requeteDeleteResa="DELETE FROM reservationplace WHERE id='".$_GET['id1']."'";

                        $query1=mysqli_query($connexion,$requeteDeleteResa);
                        
                        header('location:admin.php');
                    }
                    // SUPPRESSION COMPTE ET RESERVATION
                    if(isset($_GET['id1bis'])){
                        $requeteDeleteUser="DELETE FROM utilisateurs WHERE utilisateurs.id='".$_GET['id1bis']."'";
                        $query2=mysqli_query($connexion,$requeteDeleteUser);
                        $requeteDeleteResaUser="DELETE FROM reservationplace WHERE reservationplace.id_utilisateur='".$_GET['id1bis']."'";
                        $query3=mysqli_query($connexion,$requeteDeleteResaUser);
                    }
                   

                    $requeteMaquis = "SELECT DISTINCT * FROM utilisateurs INNER JOIN reservationplace WHERE utilisateurs.Id = reservationplace.id_utilisateur and emplacement='maquis' ORDER BY datedebut DESC";
                    $queryMaquis=mysqli_query($connexion,$requeteMaquis);
                    $resultatMaquis=mysqli_fetch_all($queryMaquis);
                    
                    $requeteResaMaquis = "SELECT * FROM reservationplace WHERE emplacement='maquis'";
                    $queryResaMaquis = mysqli_query($connexion,$requeteResaMaquis);
                    $resultatResaMaquis=mysqli_fetch_all($queryResaMaquis);
                  
                    // CALCUL SOMME TOTAL GAGNEE POUR LE MAQUIS
                    $requetePrixMaquis = "SELECT SUM(prixtotal) FROM reservationplace WHERE emplacement='maquis'";
                    $queryPrixMaquis = mysqli_query($connexion,$requetePrixMaquis);
                    $resultatPrixMaquis = mysqli_fetch_row($queryPrixMaquis);


                    ?> 
                    <div class="infoEmplacement">
                        <p>Réservation pour le Maquis</p>
                        <p>Nb de réservations total : <?php echo count($resultatResaMaquis) ?></p>
                        <p>Sommes total cumulé sur le maquis : <?php echo $resultatPrixMaquis[0]; ?> euros</p>
                    </div>
                    

                   
                    <?php

                    ?> <section class="sectionadmin"><article><?php
                    $j=0;
                    while($j<count($resultatMaquis)){

                        $id=$resultatMaquis[$j][3];
                        $id_utilisateur=$resultatMaquis[$j][12];
                        $login=ucfirst($resultatMaquis[$j][1]);
                        $nb_reservation=count($resultatMaquis);
                        $datedebut=$resultatMaquis[$j][4];
                        $datefin=$resultatMaquis[$j][5];
                        $emplacement=$resultatMaquis[$j][6];
                        $habitat=ucfirst($resultatMaquis[$j][7]);
                        $duree=$resultatMaquis[$j][8];
                        $borne=ucfirst($resultatMaquis[$j][9]);
                        $disco=ucfirst($resultatMaquis[$j][10]);
                        $yfs=ucfirst($resultatMaquis[$j][11]);
                        $prixtotal=number_format($resultatMaquis[$j][12],2);
                
                        ?>
                        <table>
                            <th><?php echo $login ?></th>
                            <tr>
                                <td>Date d'entrée en camping = <?php echo $datedebut ?></td>
                            </tr>
                            <tr>
                                <td>Date de sortie du camping = <?php echo $datefin ?></td>
                            </tr>
                            <tr>
                                <td>Type d'hébergement = <?php echo $habitat ?></td>
                            </tr>
                            <tr>
                                <td>Durée du séjour = <?php echo $duree."jours" ?></td>
                            </tr>
                            <tr>
                                <td>Accès à la borne électrique = <?php echo $borne ?></td>
                            </tr>
                            <tr>
                                <td>Accès au Disco-Club “Les girelles dansantes” = <?php echo $disco ?></td>
                            </tr>
                            <tr>
                                <td>Accès aux activités Yoga, Frisbee et Ski Nautique = <?php echo $yfs ?></td>
                            </tr>
                            <tr>
                                <td>Prix total TTC = <?php echo $prixtotal."Euros" ?></td>
                            </tr>
                            <tr>
                                <td>
                                    <a href='admin.php?id2=<?php echo $id ?>'>ANNULER RESERVATION</a>
                                    <a href='admin.php?id2bis=<?php echo $id_utilisateur ?>'>SUPPRIMER COMPTE</a>
                                </td>
                            </tr>
                        </table>

                        <?php
                        ++$j;
                        
                        }
                        ?></article>
                    </section>
                    
                    <?php

                    // SUPPRESSION RESERVATION
                    if(isset($_GET['id2'])){
                        $requeteDeleteResa="DELETE FROM reservationplace WHERE id='".$_GET['id2']."'";
                        $query1=mysqli_query($connexion,$requeteDeleteResa);
                       
                       header('location:admin.php');
                    }

                    // SUPPRESSION COMPTE ET RESERVATION
                    if(isset($_GET['id2bis'])){
                        $requeteDeleteUser="DELETE FROM utilisateurs WHERE utilisateurs.id='".$_GET['id2bis']."'";
                        $query2=mysqli_query($connexion,$requeteDeleteUser);
                       
                        $requeteDeleteResaUser="DELETE FROM reservationplace WHERE reservationplace.id_utilisateur='".$_GET['id2bis']."'";
                        $query3=mysqli_query($connexion,$requeteDeleteResaUser);

                       header('location:admin.php');
                    }
                    
                    $connexion=mysqli_connect("Localhost","root","","camping");
                    $requetePrix = "SELECT jour,borne,disco,yfs FROM tarif";
                    $queryPrix = mysqli_query($connexion,$requetePrix);
                    $resultatPrix = mysqli_fetch_all($queryPrix);
                
                    // DEFINITION TARIF PAR REQUETE BDD
                    $tarifjour=$resultatPrix[0][0];
                    $tarifborne=$resultatPrix[0][1];
                    $tarifdisco=$resultatPrix[0][2];
                    $tarifyfs=$resultatPrix[0][3];

                    ?>

                    <!-- MODIFICATION VALEUR PRIX -->
                    <section id="modifPrix">
                        <p>Modifier les tarifs</p> 

                        <form action="" method="POST">
                            <label for="">Tarif borne :</label><input type="text" name="borne" value="<?php echo $tarifborne ?>"><br>
                            <label for="">Tarif Disco :</label><input type="text" name="disco" value="<?php echo $tarifdisco ?>"><br>
                            <label for="">Tarif Formule YFS :</label><input type="text" name="yfs" value="<?php echo $tarifyfs ?>"><br>
                            <label for="">Tarif Journalier location :</label><input type="text" name="jour" value="<?php echo $tarifjour ?>"><br>
                            <input type="submit" name="modifier">
                        </form>
                    </section>
                    

                    <?php
               
               if(isset($_POST['modifier']) and isset($_POST['borne']) and isset($_POST['disco']) and isset($_POST['yfs']) and isset($_POST['jour'])){

                    $requete = "UPDATE tarif SET jour='".$_POST['jour']."',borne='".$_POST['borne']."', disco='".$_POST['disco']."', yfs='".$_POST['yfs']."'";
                    $query=mysqli_query($connexion,$requete);
                    
                    header('location:admin.php');
                }
               

                }
                else{
                    echo '<div class="erreur">Cette page vous est inacessible</div>'.'<br/>';
                }


            ?>
            <?php include('footer.php'); ?>
        </main>
    </body>
</html>