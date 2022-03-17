<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];

// form validation
if(isset($_POST['email']) && isset($_POST['passe'])){

    $email = strip_tags(trim(addcslashes($_POST['email'], "'")));
    //$passe = md5(md5(strip_tags(trim(addcslashes($_POST['passe'], "'")))));
    $pass = strip_tags(trim(addcslashes($_POST['passe'], "'")));

    if(empty($email)){
        $errors['form_validation']['email'] = '<span class="form-validation">Ce champ est requis</span>';
    }

    if(empty($pass)){
        $errors['form_validation']['passe'] = '<span class="form-validation">Ce champ est requis</span>';
    }

    if(!empty($pass) && !empty($email)){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors['form_validation']['email'] = '<span class="form-validation">S\'il vous plaît, mettez une adresse email valide.</span>';
        }
    }

    if(count($errors) != 0){
        echo json_encode($errors);
    }
    else{

        include ('./includes/connection.php');
        include ('./includes/fonctionnaire.php');
        $_FON = new Fonctionnaire();

        $connectedAdmin = $_FON->getFonctionnaireToConnect($email, $pass);

        //wrong email or password
        if ($connectedAdmin == null)
            echo json_encode([
                'status' => 'error',
                'msg' => '<span class="messageError setMarginTop">E-mail ou mot de passe incorrect</span>'
            ]);
        else
        {

            if ($connectedAdmin['etat'] == 0 && $connectedAdmin['archiver'] == 0)
            {
                $_SESSION['id_fon'] = $connectedAdmin['id_fon'];
                $_SESSION['nom_fon'] = $connectedAdmin['nom_fon'];
                $_SESSION['prenom_fon'] = $connectedAdmin['prenom_fon'];
                $_SESSION['email_fon'] = $connectedAdmin['email_fon'];
                $_SESSION['role_fon'] = $connectedAdmin['role_fon'];
                $_SESSION['adminSuper'] = $connectedAdmin['adminSuper'];
                $_SESSION['image_fon'] = $connectedAdmin['image_fon'];

                echo json_encode([
                    'status' => 'success',
                    'redirect' => './participation_liste_yes.php',
                    'msg' => '<span class="messageResult setMarginTop">Bienvenue</span>'
                ]);
            }
            else
                echo json_encode([
                    'status' => 'error',
                    'msg' => '<span class="messageResult setMarginTop">admin a été archivé</span>'
                ]);
        }
    }
}

?>
