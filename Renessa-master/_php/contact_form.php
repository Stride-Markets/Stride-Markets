<?php
include("./concerns.php");
include("./telegram.php");
header('Access-Control-Allow-Origin: *');
header("Content-type:application/json");

try{
    $success = false;
    $errors = [];
    /*
    $cuerpo = "<b>Telefono:</b> <a href='https://api.whatsapp.com/send?phone=2996740990'>2996740990</a>\n".
    "<strong>Link</strong>: <a href='https://paginasweb.com'>compra aqui</a>";   
                
    sendMessage($cuerpo, true);
    */
    
    if( isset($_POST) ){
        if( !isset($_POST["name"]) || strlen($_POST["name"]) == 0 ){
            array_push($errors, "Ingrese su nombre");
        } else {
            if( !isValidName($_POST["name"]) ){
                array_push($errors, "Para el nombre ingrese letras y espacios en blanco");
            }
            if( strlen($_POST["name"]) > 80 ){
                array_push($errors, "El limite para el nombre es de 80 caracteres");
            }
        }

        if( !isset($_POST["email"]) || strlen($_POST["email"]) == 0  ){
            array_push($errors, "Ingrese su email");
        } else {
            if( !isValidEmail($_POST["email"]) ){
                array_push($errors, "El email tiene un formato incorrecto");
            }
            if( strlen($_POST["email"]) > 50 ){
                array_push($errors, "El límite para el email es de 50 caracteres");
            }
        }


        if( !isset($_POST["message"]) || strlen($_POST["message"]) < 10 || strlen($_POST["message"]) > 255 ){
            array_push($errors, "Ingrese su consulta con mas de 10 caracteres y menos de 255");
        }        

        if(count($errors) == 0 ){
            
            if($_SERVER['HTTP_HOST']!='localhost'):
                $cuerpo = "<b>Nueva consulta</b>\n".
                "<b>Nombre:</b> ".$_POST["name"]."\n".
                "<b>Email:</b> ".$_POST["email"]."\n".
                "<b>Comentario:</b> ".$_POST["message"];

                // TELEGRAM. SI LO VAS A USAR, DESCOMENTALO
                //sendMessage($cuerpo, false);

                //MAIL PARA FABER
                mail("ventas@paginasweb.com", "Nueva consulta", nl2br($cuerpo),
                    "From: Stride Markets (no responder)<noresponder@paginasweb.com>\r\n".
                    "Content-type: text/html; charset=utf-8\r\n");
            endif;

        } else {
            array_push($errors, "Hay errores en el formulario");
        }
    } else {
        array_push($errors, "Error de solicitud");
    }

    
    header("HTTP/1.1 200 OK");
    echo json_encode(array(
        'success' => count($errors) == 0,
        'errors' => $errors,
    ));
    exit();
        
}catch(Exception $e){
    $error = array(
        'error' => $e->getMessage(),
    );

    header("HTTP/1.1 400 Bad Request");
    echo json_encode($error);
    exit();
}
?>