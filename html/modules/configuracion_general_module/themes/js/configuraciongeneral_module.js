$(document).ready(function () {
  function createConnection() {
    $("#conexionnoexitosa").css("display", "none");
    $("#conexionexitosa").css("display", "none");

    let information;

    switch ($("#motor").val().toLocaleLowerCase()) {
      case "oracle":
        information = {
          externalBdMotor: $("#motor").val().toLocaleLowerCase(),
          externalBdConnection: {
            user: $("#usuario").val(),
            password: $("input[name=contrasena]").val(),
            connectString: $("#servidor").val() + "/" + $("#basedatos").val(),
            externalAuth: false,
          },
          asteriskBdMotor: "oracle",
          asteriskBdConnection: {
            user: $("#usuario").val(),
            password: $("input[name=contrasena]").val(),
            connectString: $("#servidor").val() + "/" + $("#basedatos").val(),
            externalAuth: false,
          },
        };
        break;
      case "mysql":
        information = {
          externalBdMotor: $("#motor").val().toLocaleLowerCase(),
          externalBdConnection: {
            host: $("#servidor").val(),
            user: $("#usuario").val(),
            password: $("input[name=contrasena]").val(),
            database: $("#basedatos").val(),
            ssl: {
              rejectUnauthorized: false,
            },
          },
          asteriskBdMotor: $("#motor").val().toLocaleLowerCase(),
          asteriskBdConnection: {
            host: $("#servidor").val(),
            user: $("#usuario").val(),
            password: $("input[name=contrasena]").val(),
            database: $("#basedatos").val(),
            ssl: {
              rejectUnauthorized: false,
            },
          },
        };
        break;
    }
    if ($("#activo").val() == "Inactivo") {
      document.form_configuraciongeneral.action = "index.php?menu=configuracion_general_module&action=save";
      document.form_configuraciongeneral.submit();
      return false;
    }

    if($("#sslmariadb").val() == 'No'){
      delete information.asteriskBdConnection.ssl
    }


    $.ajax({
      contentType: "application/json",
      data: JSON.stringify(information),
      dataType: "json",
      success: function (data, textStatus, xhr) {
        if (xhr.status == 200 && data && !messageContainError(data)) {
          $("#conexionexitosa").css("display", "block");
          alert("conexion exitosa");
          document.form_configuraciongeneral.action = "index.php?menu=configuracion_general_module&action=save";
          document.form_configuraciongeneral.submit();
        }else{
          $("#conexionnoexitosa").text("conexion no exitosa " + data.responseText);
          alert("conexion no exitosa " + data.responseText);          
        }
      },
      error: function (data, textStatus, xhr) {
        $("#conexionnoexitosa").text("conexion no exitosa " + data.responseText);
        alert("conexion no exitosa " + data.responseText);
      },
      processData: false,
      type: "POST",
      url: "api-node/index.php?action=config",
    });
  }

  $("#motor").change(function () {
    if ($("#motor").val() != "") {
      document.form_configuraciongeneral.submit();
      $("#btnprobarconexion").css("display", "block");
    } else {
      $("#btnprobarconexion").css("display", "none");
    }
  });

  $("#btnguardardatos").click(function () {
    createConnection();
  });

  $("#btnguardardatosmariadb").click(function () {
    document.form_configuraciongeneral.action = "index.php?menu=configuracion_general_module&action=saveLocal";
    document.form_configuraciongeneral.submit();
  }); 

  function messageContainError(message){

    let errores = ["error","errores", "unknown", "ENOTFOUND","denied","could not","ORA-","EHOSTUNREACH","does not support"];

     return (errores.some(v => message.includes(v)))
      // There's at least one

  }
  
  function probarConexion(motor, servidor, usuario, contrasena, basedatos, divconexionexitosa, divconexionnoexitosa){
    let information;
    $("#"+divconexionexitosa).css("display", "none");
    $("#"+divconexionnoexitosa).css("display", "none");    
    
    switch (motor.toLocaleLowerCase()) {
      case "oracle":
        information = {
          externalBdMotor: motor.toLocaleLowerCase(),
          externalBdConnection: {
            user: usuario,
            password: contrasena,
            connectString: servidor + "/" + basedatos,
            externalAuth: false,
          },
        };
        break;
      case "mariadb": motor= 'mysql';
      case "mysql":
        information = {
          externalBdMotor: motor,
          externalBdConnection: {
            host: servidor,
            user: usuario,
            password: contrasena,
            database: basedatos,
            ssl: {
              rejectUnauthorized: false,
            },
          },
        };
        break;
    }  
    alert($("#sslmariadb").val());
    if($("#sslmariadb").val() == 'No'){
      delete information['externalBdConnection']['ssl'];
    }

    console.log("probar infff ",information);
    
    $.ajax({
      contentType: "application/json",
      data: JSON.stringify(information),
      dataType: "json",
      success: function (data, textStatus, xhr) {
        console.log("data en test ", data)
        if (xhr.status == 200 && data && !messageContainError(data)) {
          $("#"+divconexionexitosa).css("display", "block");
        }else{
          $("#"+divconexionnoexitosa).css("display", "block");
          $("#"+divconexionnoexitosa).text("conexion no exitosa " + data);          
        }
      },
      error: function (data, textStatus, xhr) {
        console.log("en error ", data);
        $("#"+divconexionnoexitosa).css("display", "block");
        $("#"+divconexionnoexitosa).text("conexion no exitosa " + data.responseText);
      },
      processData: false,
      type: "POST",
      //url: 'modules/configuracion_general/libs/ajaxfunctions.php'
      url: "api-node/index.php?action=test",
    });    
  }

  $("#btnprobarconexion").click(function () {   
    probarConexion($("#motor").val().toLocaleLowerCase(), $("#servidor").val(), $("#usuario").val(), $("input[name=contrasena]").val(), $("#basedatos").val(), 'conexionexitosa', 'conexionnoexitosa');
  });

  $("#btnprobarconexionmariadb").click(function () {   
    probarConexion($("#motormariadb").val().toLocaleLowerCase(), $("#servidormariadb").val(), $("#usuariomariadb").val(), $("input[name=contrasenamariadb]").val(), $("#basedatosmariadb").val(), 'conexionexitosamariadb', 'conexionnoexitosamariadb');
  });

  $(".chkivr").change(function () {
    let id = $(this).attr("id");
    let checked = $("#" + id).is(":checked");
    let selectToShowAndHide = id.split("_")[1];
    $("#ivr" + selectToShowAndHide).css("display", "none");

    if (checked) {
      $("#ivr" + selectToShowAndHide).css("display", "block");
    }
  });
});
