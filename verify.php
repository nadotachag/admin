<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activation du compte</title>

    <meta name="author" content="Codeconvey" />
    <!-- Message Box CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!--Only for demo purpose - no need to add.-->
    <link rel="stylesheet" href="css/demo.css" />

</head>

<body>

    <section>
        <div class="rt-container">
            <div class="col-rt-12">
                <div class="Scriptcontent">

                    <!-- partial:index.partial.html -->
                    <div id='card' class="animated fadeIn">
                        <div id='upper-side'>

                            <!-- Generator: Adobe Illustrator 17.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                            <!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd">
                            <svg version="1.1" id="checkmark" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" xml:space="preserve">
                                <path d="M131.583,92.152l-0.026-0.041c-0.713-1.118-2.197-1.447-3.316-0.734l-31.782,20.257l-4.74-12.65
                                        c-0.483-1.29-1.882-1.958-3.124-1.493l-0.045,0.017c-1.242,0.465-1.857,1.888-1.374,3.178l5.763,15.382
                                        c0.131,0.351,0.334,0.65,0.579,0.898c0.028,0.029,0.06,0.052,0.089,0.08c0.08,0.073,0.159,0.147,0.246,0.209
                                        c0.071,0.051,0.147,0.091,0.222,0.133c0.058,0.033,0.115,0.069,0.175,0.097c0.081,0.037,0.165,0.063,0.249,0.091
                                        c0.065,0.022,0.128,0.047,0.195,0.063c0.079,0.019,0.159,0.026,0.239,0.037c0.074,0.01,0.147,0.024,0.221,0.027
                                        c0.097,0.004,0.194-0.006,0.292-0.014c0.055-0.005,0.109-0.003,0.163-0.012c0.323-0.048,0.641-0.16,0.933-0.346l34.305-21.865
                                        C131.967,94.755,132.296,93.271,131.583,92.152z" />
                                <circle fill="none" stroke="#ffffff" stroke-width="5" stroke-miterlimit="10" cx="109.486" cy="104.353" r="32.53" />
                            </svg>

                            <?php
                            //error_reporting(E_ALL);
                            // ini_set("display_errors", 1);
                            include('mailer/smtp/PHPMailerAutoload.php');


                            $link = mysqli_connect("localhost", "dbadmin", "Demo123*", "qos-fixe");

                            // Check connection
                            if ($link === false) {
                                die("ERROR: Could not connect. " . mysqli_connect_error());
                            }

                            if (isset($_GET['email']) && !empty($_GET['email']) and isset($_GET['hash']) && !empty($_GET['hash'])) {
                                // Verify data

                                $email = mysqli_real_escape_string($link, $_REQUEST['email']);
                                $hash = mysqli_real_escape_string($link, $_REQUEST['hash']);

                                $search = mysqli_query($link, "SELECT adresse_email_par, hash_par, active_par FROM participation WHERE adresse_email_par='" . $email . "' AND hash_par='" . $hash . "' AND active_par='0'") or die(mysqli_error($link));
                                $match = mysqli_num_rows($search);

                                if ($match > 0) {
                                    // We have a match, activate the account
                                    mysqli_query($link, "UPDATE participation SET active_par='1' WHERE adresse_email_par='" . $email . "' AND hash_par='" . $hash . "' AND active_par='0'") or die(mysqli_error($link));
                                    $valactive = "ok";

                                    echo "<style>
                                        #upper-side {
                                                background-color: #8bc34a;
                                            }
                                        </style>
                                        ";
                                } else {
                                    // No match -> invalid url or account has already been activated.
                                    $valactive = "no";
                                }
                            } else {
                                // Invalid approach
                                echo '<div class="statusmsg">Veuillez utiliser le lien qui a été envoyé à votre e-mail.</div>';
                            }
                            mysqli_close($link);
                            ?>

                            <h3 id='status'>
                                <?php
                                if ($valactive == "ok")
                                    echo "Votre compte a été activé.<br>لقد تم تفعيل حسابكم";
                                else
                                    echo "Lien invalide<br>رابط غير صحيح";
                                ?>
                            </h3>
                        </div>
                        <div id='lower-side'>
                            <p id='message'>
                                <?php if ($valactive == "ok") { ?>
                                    Veillez consulter votre boite mail pour récupérer le code d’accès à votre espace du volontaire.<br>
                                    المرجو مراجعة بريدكم الإلكتروني للحصول على الرمز السري لولوج فضاء المتطوع<br>
                                <?php } ?>

                                <?php if ($valactive == "no") { ?>
                                    Lien invalide ou vous avez déjà activé votre compte. <br>
                                    رابط غير صحيح أو أنك قمت بتفعيل حسابك<br>

                                <?php } ?>
                            </p>
                            <a href="/participation.php" id="contBtn">Poursuivre / مواصلة</a>
                        </div>
                    </div>
                    <!-- partial -->

                </div>
            </div>
        </div>
    </section>

    <!-- Send mail code -->
    <?php

    if ($valactive == "ok") {

        $errorMsg   = "<center><img src='images/errorMessage.png' width='110px' height='110px'/>Impossible d'envoyer votre email pour des raisons techniques .. <br> Contactez-nous par téléphone, merci de votre compréhension </center>";
        $acesscode = $_GET['anrtcd'];
        $emailPar = $_GET['email'];
        $mebodyFr = "<h2>Campagne d’évaluation de la qualité technique du service Internet fixe</font></h2> 
                    <br>
                    <br>L’ANRT vous remercie pour votre candidature.
                    <p class='text-right'>
                    <br>
                    شكرا على تسجيل مشاركتكم، لقد تم تفعيل حسابكم<br>
                    </p>
                    <br>Connectez-vous à votre espace du volontaire en cliquant sur le lien suivant et utiliser vos identifiants (Email, Code) :
                    <br> https://qosfixe.anrt.ma/private-space/ <br>
                    <br>Email : $email
                    <br>Code : $acesscode 
                    ";

        $mail = new PHPMailer();

        $mail->IsSMTP();
        $mail->Host = "mail.anrt.ma";
        $mail->Port = "25";
        $mail->IsHTML(true);
        $mail->CharSet = "UTF-8";
        $mail->SetFrom("noreply-qosfixe@anrt.ma", "ANRT");

        $mail->Subject = "Compte | Activé";
        $mail->Body = $mebodyFr . "<br>";

        // $mail->AddAddress("qosfixe-support@anrt.ma", "ANRT");
        $mail->AddAddress($emailPar);

        $mail->SMTPOptions = array("ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
            "allow_self_signed" => false
        ));


        if (!$mail->Send()) {
            echo "Erreur envoi de mail";
        } else {
            //echo $successMsg;
            //echo "message send";
        }
    }

    ?>
    <!-- End send mail code -->


</body>

</html>
