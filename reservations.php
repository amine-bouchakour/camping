

<?php
session_start();
if (isset($_SESSION['login']))
{


    echo '<a href="index.php">Page principale</a><br/><br/>';
    $connexion=mysqli_connect("Localhost","root","","camping");
    $requetetarif = "SELECT jour,borne,disco,yfs FROM tarif";
    $querytarif=mysqli_query($connexion,$requetetarif);
    $resultattarif=mysqli_fetch_all($querytarif);

    // DEFINITION TARIF PAR REQUETE BDD
    $tarifjour=$resultattarif[0][0];
    $tarifborne=$resultattarif[0][1];
    $tarifdisco=$resultattarif[0][2];
    $tarifyfs=$resultattarif[0][3];

    ?>

<!DOCTYPE html>
    <html>
    <head>
        <title>Reservation</title>
        <link rel="stylesheet" type="text/css" href="camping.css">
    </head>
    <body>
        <main>
            <form action="" method="post">
                <label for="">Date de début du séjour : </label>
                <input type="date" name="datedebut"><br>
                <label for="">Date de fin du séjour : </label>
                <input type="date" name="datefin"><br>

        <!-- <select type="text" name="emplacement">
            <option value="" selected="selected">-- Emplacement --</option>
            <option value="plage">La Plage</option>
            <option value="pins">Les Pins</option>
            <option value="maquis">Le Maquis</option>
        </select><br>
        <select type="text" name="habitat">
            <option value="" selected="selected">-- Type d'habitat --</option>
            <option value="tente">En Tente</option>
            <option value="cpgcar">En Camping-car</option>
        </select><br> -->
        <select type="text" name="dureesejour">
            <option value="" selected="selected">-- Nbr de jours --</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
        </select>
        <br>
        Accès à la borne électrique (<?php echo $tarifborne; ?>€/jr)<input type="radio" name="borne" value="<?php echo $tarifborne ?>"><br>
        Accès au Disco-Club “Les girelles dansantes” (<?php echo $tarifdisco; ?>€/jr)<input type="radio" name="disco" value="<?php echo $tarifdisco ?>"><br>
        Accès aux activités Yoga, Frisbee et Ski Nautique (pack à <?php echo $tarifyfs; ?>€/jr)<input type="radio" name="yfs" value="<?php echo $tarifyfs ?>"><br>
        <input type="submit" name="valider">
    </form>
    <?php
    }
    else
    {
        header("location:connexion.php");
        echo 'La page est inacessible si vous n\'êtes connecté.';
    }
    ?>







    <?php




    if(isset($_POST['valider']))
    {
        if(isset($_POST['borne']))
        {
            $option1=$_POST['borne'];
        }
        else
        {
            $option1=0;
        }
        if(isset($_POST['disco']))
        {
            $option2=$_POST['disco'];
        }
        else
        {
            $option2=0;
        }
        if(isset($_POST['yfs']))
        {
            $option3=$_POST['yfs'];
        }
        else
        {
            $option3=0;
        }



        if(!empty($_POST['datedebut']) and !empty($_GET['emplacement']) and !empty($_GET['habitat']))
        {
           
            $habitat=$_GET['habitat'];
            $place=$_GET['emplacement'];

            $dated=$_POST['datedebut'];
            $datef=$_POST['datefin'];
            $datedebut=strftime("%G%m%d", strtotime($dated));
            $datefin=strftime("%G%m%d", strtotime($datef));

            $dateDebut2 = strtotime($dated);
            $dateFin2 = strtotime($datef);


            $connexion=mysqli_connect("Localhost","root","","camping");
            //$requetehabitat="SELECT habitat FROM reservationplace WHERE datedebut BETWEEN '".$datedebut."' AND '".$datefin."' and emplacement='".$place."' OR datefin BETWEEN '".$datedebut."' AND '".$datefin."' and emplacement='".$place."'";
            $requetehabitat = "SELECT habitat,datedebut,datefin FROM reservationplace WHERE $datedebut BETWEEN datedebut AND datefin AND $datefin BETWEEN datedebut AND datefin AND emplacement='".$place."'";
            $queryhabitat=mysqli_query($connexion,$requetehabitat);
            $resultathabitat=mysqli_fetch_all($queryhabitat);

            echo $requetehabitat;
            
            $requeteDate = "SELECT datedebut, datefin FROM reservationplace WHERE emplacement = '".$place."'" ;
            $queryDate = mysqli_query($connexion, $requeteDate);
            $resultDate = mysqli_fetch_all($queryDate);

            var_dump($resultDate);



            var_dump($resultathabitat);

            $j=count($resultathabitat);
            
            
            $i=0;

            
            $placedispo=4;

               while($i<$j)
               {
                    
                    if($resultathabitat[$i][0]=="cpgcar")
                    {

                        $placedispo=$placedispo - 2;
                                //echo $resultat[$i][0].'<br/>';
                                //echo 'Il reste '.$placedispo.' de place disponible<br/><br/>';
                        $i++;

                    }
                    else
                    {
                        $placedispo=$placedispo - 1;
                                //echo $resultat[$i][0].'<br/>';
                                //echo 'Il reste '.$placedispo.' de place disponible<br/><br/>';
                        $i++;
                    }
                    if($placedispo==0)
                    {
                     break;
                    }
                }

                
            
            
         


            //    $finsejour=date("Y-m-d + '".$_POST['dureesejour']."'") ;
            //    echo $finsejour.'<br/>';

        }

         
        //echo $placedispo.'<br/>';


            // CALCUL SOMME TOTAL DU SEJOUR

      
         //$duree=$_POST['dureesejour'];
        

        $duree = abs($dateFin2 - $dateDebut2)/60/60/24 ; 
         $optiontotal= $option1 + $option2 + $option3;
         $totalsejour=($optiontotal*$duree) + $duree*$tarifjour;



         if(isset($_POST['borne']))
         {
            $_POST['borne']='oui';
        }
        else{
            $_POST['borne']='non';
        }
        if(isset($_POST['disco']))
        {
            $_POST['disco']='oui';
        }
        else{
            $_POST['disco']='non';
        }
        if(isset($_POST['yfs']))
        {
            $_POST['yfs']='oui';
        }
        else{
            $_POST['yfs']='non';
        }

        if(($placedispo>=2 and $_GET['habitat']=='cpgcar') or ($placedispo>=1 and $_GET['habitat']=='tente'))
        {

            $connexion=mysqli_connect("Localhost","root","","camping");
            $requetereservation="INSERT INTO reservationplace (datedebut,datefin,emplacement,habitat,dureesejour,borne,disco,yfs,prixtotal,id_utilisateur) VALUES ('".$datedebut."','".$datefin."','".$place."','".$habitat."','".$duree."','".$_POST['borne']."','".$_POST['disco']."','".$_POST['yfs']."','".$totalsejour."','".$_SESSION['ID']."') ";
            $queryreservation=mysqli_query($connexion,$requetereservation);

            echo '<br/>Reservation effectué'.'<br/>'.'<br/>';
            echo 'Date d\'entrée en camping : '.$datedebut.'<br/>';
            echo 'Lieu réservé : '.ucfirst($_GET['emplacement']).'<br/>';
            echo 'Type de logement : '.ucfirst($_GET['habitat']).'<br/>';
            echo 'Votre séjour est d\'une durée de '.$duree.' jours.'.'<br/>';
            echo 'Votre séjour vous coûtera la sommes de '.$totalsejour.'€.'.'<br/>'.'<br/>';
            echo '<a href="profil.php">Voir vos réservations</a><br/>';

            
        }
        else
        {
            echo 'Il ne reste plus de place disponible à cette période et pour ce lieu : '.ucfirst($_GET['emplacement']).'<br/>'.'<br/>'; 
        }



    }
    else
    {
        echo 'Veuillez saisir les informations obligatoires'.'<br/>';
    }


    









    ?>
        </main>
    
    </body>
    </html>
