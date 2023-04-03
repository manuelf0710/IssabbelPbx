<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL); 
session_name("issabelSession");
session_start();
include("IssabelExternalConnection.class.php");

function recarga_asterisk ()
		{
			$socket = fsockopen("127.0.0.1","5038", $errno, $errstr, 10);
	        if (!$socket){
			echo "$errstr ($errno)\n";
		}
		else
		{
            fputs($socket, "Action: Login\r\n");
            fputs($socket, "UserName: admin\r\n");
            fputs($socket, "Secret: C745k926\r\n\r\n");

            fputs($socket, "Action: Command\r\n");
            //fputs($socket, "Command: sip reload\r\n\r\n");
 
            fputs($socket, "Command: reload\r\n\r\n");
//            fputs($socket, "Command: sip show peers\r\n\r\n");
            fputs($socket, "Action: Logoff\r\n\r\n");
         			
			while (!feof($socket)){
			$cadena1 = fgets($socket);
			$cadena="Message: Authentication accepted";
		if(strncmp($cadena,$cadena1,32) == 0)
		{
		echo'
			<div id="message_error" class="div_msg_errors">
				<div style="height:24px">
					<div class="div_msg_errors_title" style="padding-left:5px">
						<b style="color:red;">
						!Operación Exitosa
						</b>
					</div>
					<div class="div_msg_errors_dismiss">
						<input type="button" value="aceptar" onclick="hide_message_error();"></input>
					</div>
				</div>
					<div style="padding:2px 10px 2px 10px">
						<b style="color:green;">
						¡El dialplan se ha cargado correctamente!
						</b>
						<br></br>
						Puede ver sus encuestas dando click <a href="../administrar_encuestas/administrar.php">aqui</a>.
					</div>
				</div>
				';
				break;
					
		}
		else 
		{	
				
		}
							
		$cadena2="Message: Authentication failed";
		if(strncmp($cadena2,$cadena1,30) == 0)
		{
			echo'
				<div id="message_error" class="div_msg_errors">
					<div style="height:24px">
						<div class="div_msg_errors_title" style="padding-left:5px">
							<b style="color:red;">
							Operación Exitosa
							</b>
							<b style="color:BROWN;">
							¡El dialplan no ha podido cargarse correctamente!
							</b>
						</div>
					<div class="div_msg_errors_dismiss">
						<input type="button" value="aceptar" onclick="hide_message_error();"></input>
					</div>
				</div>
				<div style="padding:2px 10px 2px 10px">
				<b>
				La encuesta se ha creado con algunos problemas.
				</b>
				<br></br>
				Puede ver sus encuestas dando click <a href="../administrar_encuestas/administrar.php">aqui</a>.
				</div>
				</div>';
				break;
				}
				else 
				{	
				}
				/*
				echo fgets($socket).'<br>';*/
		}
            fclose($socket);
            }
				}

if(isset($_GET['action']) && $_GET['action'] != ''){
    $action = $_GET['action'];
    $payload = json_decode(file_get_contents('php://input'));
    $externalConnection = new IssabelExternalConnection();
    if($action == 'config'){
       return $externalConnection->config2($payload);
    }
    if($action == 'test'){
        
        return $externalConnection->test($payload);
    } 
    if($action == 'connection'){
        echo $externalConnection->getConnection();
    }
    if($action == 'saveLogDatabaseConnection'){
		include_once "/var/www/html/libs/paloSantoDB.class.php";
		include_once "/var/www/html/libs/misc.lib.php";	
		$user = isset($_SESSION['issabel_user']) ? $_SESSION['issabel_user'] : "unknown";
		//echo(json_encode($payload));
		$conectionType = $payload->conectionType;
		$motor = $payload->motor;
		$bd = $payload->bd;
		$host = $payload->servidor;
		$password = $payload->password;
		$ssl = $payload->ssl;
		$message = $payload->message;
		$status = $payload->status == 'Exitosa' ? 'Informativa': 'Error';
		insertLogToDB( 'conexionesbd  '.$conectionType.' '.$status.'  {user:'.$user.', motor.'.$motor.', host:'.$host.', ssl:'.$ssl.', password:'.$password.', bd:'.$bd.' } for '.$user.'  "conexionesbd" from '.$_SERVER["REMOTE_ADDR"].' '.$message, $modulo="conexionbd", $status,$accion=NULL);
    }	
	
    if($action == 'reload'){

        //recarga_asterisk();

        echo("ingreso");
        require_once("/var/www/html/admin/functions.inc.php");       
        $response = do_reload();
        header("Content-type: application/json");
        echo json_encode($response);

        exit;
        $url = '../config.php';

        // Inicializa una sesión cURL
        $ch = curl_init($url);
        
        // Configura las opciones de cURL necesarias
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        
        // Crea un array con los valores del formulario
        $formData = array(
            'handler' => 'reload'
        );
        
        // Codifica los valores del formulario en formato FormData
        $formDataEncoded = http_build_query($formData);
        
        // Configura los encabezados de la petición
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded'
        ));
        
        // Configura los datos de la petición con los valores del formulario codificados
        curl_setopt($ch, CURLOPT_POSTFIELDS, $formDataEncoded);
        
        // Ejecuta la petición y obtiene la respuesta
        $response = curl_exec($ch);
        
        // Cierra la sesión cURL
        curl_close($ch);
        
        // Imprime la respuesta
        echo $response;        
        
    }             


}