<?php 
//isset - Determina si una variable esta definida y no es null
//empty - Determina si una variable esta vacia
// trim - Eliminan un espacio en blanco ( u otro tipo de caracteres del inicio y final de la cadena)

if($_POST){
    $usuario = "";
    $correo = "";
    $mensaje = "";

    if(isset($_POST['usuario'])){
        $usuario = filter_var(trim($_POST['usuario']), FILTER_SANITIZE_STRING);
        
    }

    if(isset($_POST['correo'])){
        $correo = filter_var(trim($_POST['correo']), FILTER_VALIDATE_EMAIL);
    }

    if(isset($_POST['mensaje'])){
        $mensaje = filter_var(trim($_POST['mensaje']), FILTER_SANITIZE_STRING);
    }

    if(empty($usuario)){
        echo json_encode(array(
            'error' => true,
            'campo' => 'usuario'
        ));
        return;
    }

    if(empty($correo)){
        echo json_encode(array(
            'error' => true,
            'campo' => 'correo'
        ));
        return;
    }

    if(empty($mensaje)){
        echo json_encode(array(
            'error' => true,
            'campo' => 'mensaje'
        ));
        return;
    }

    // Cuerpo del mensaje

    $cuerpo = 'Usuario: ' . $usuario . '<br>';
    $cuerpo .= 'Email: ' . $correo . '<br>';
    $cuerpo .= 'Mensaje: ' . $mensaje .'<br>';

    //Direccion 
    $destinatario = 'guerrerovillasergio@gmail.com'; 
    $asunto = 'Mensaje de mi sitio web';
    $headers  = 'MIME-Version: 1.0' . "\r\n" .'Content-type: text/html; charset=utf-8' . "\r\n" .'From: ' . $correo . "\r\n";

    if (mail($destinatario, $asunto, $cuerpo, $headers)){

        echo json_encode(array(
            'error' => false,
            'campo' => 'exito'
        ));
    } else {
        echo json_encode(array(
            'error' => true,
            'campo' => 'mail'
        ));
    }


} else {
    echo json_encode(array(
        'error' => true,
        'campo' => 'post'
    ));

}

// echo json_encode($usuario);

