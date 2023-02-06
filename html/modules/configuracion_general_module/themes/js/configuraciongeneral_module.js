function tooglePassword(id) {
  let x = document.getElementsByName("" + id)[0].type;
  if (x == "password") {
    document.getElementsByName("" + id)[0].type = "text";
  } else {
    document.getElementsByName("" + id)[0].type = "password";
  }
}

$(document).ready(function () {
  let urlNode = "api-node/index.php?action=";

  fetch(urlNode + "connection")
    .then((response) => response.json())
    .then((data) => {
      const resp = JSON.parse(data);
      console.log("the data ", resp);
      console.log("resp.usuario= ", resp.user);
      $("#usuariomariadb").val(resp.user);
      $("input[name=contrasenamariadb]").val(resp.password);
      $("#servidormariadb").val(resp.host);
      $("#basedatosmariadb").val("asterisk");
      $("#sslmariadb").val("No");
    });

  async function createConnection() {
    $("#conexionnoexitosa").css("display", "none");
    $("#conexionexitosa").css("display", "none");

    let information = {
      bdMotor: "mysql",
      bdConnection: {
        user: $("#usuario").val(),
        password: $("input[name=contrasena]").val(),
        host: $("#servidor").val(),
        ssl: $("#sslmdb").val(),
        database: $("#basedatos").val(),
        motor: $("#motor").val(),
      },
    };

    await testConexion(
      $("#motor").val().toLocaleLowerCase(),
      $("#servidor").val(),
      $("#usuario").val(),
      $("input[name=contrasena]").val(),
      $("#basedatos").val(),
      "conexionexitosa",
      "conexionnoexitosa"
    )
      .then((response) => {
        console.log("Response function respuesta ", response);
        var prueba = response;
        if (response && messageContainSuccess(response.json)) {
          $("#conexionexitosa").css("display", "block");
          alert("conexion exitosa");

          console.log("response.json = ", response.json);
          document.form_configuraciongeneral.action = "index.php?menu=configuracion_general_module&action=save";
          document.form_configuraciongeneral.submit();
        } else {
          $("#conexionnoexitosa").text("conexion no exitosa " + response.json);
          alert("conexion no exitosa " + response.json);
        }
      })
      .catch((errno) => {
        console.log("ocurrio un error ", errno);
      });

    if ($("#sslmdb").val() == "No") {
      delete information.ssl;
    }

    /*

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
          asteriskBdMotor: "mariadb",
          asteriskBdConnection: {
            host: $("#servidormariadb").val(),
            user: $("#usuariomariadb").val(),
            password: $("input[name=contrasenamariadb]").val(),
            database: $("#basedatosmariadb").val(),
            ssl: {
              rejectUnauthorized: false,
            },
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
          asteriskBdMotor: $("#motormariadb").val().toLocaleLowerCase(),
          asteriskBdConnection: {
            host: $("#servidormariadb").val(),
            user: $("#usuariomariadb").val(),
            password: $("input[name=contrasenamariadb]").val(),
            database: $("#basedatosmariadb").val(),
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

    if ($("#sslmariadb").val() == "No") {
      delete information.asteriskBdConnection.ssl;
    }

    if ($("#sslmdb").val() == "No") {
      delete information.externalBdConnection.ssl;
    }

    $.ajax({
      contentType: "application/json",
      data: JSON.stringify(information),
      dataType: "json",
      success: function (data, textStatus, xhr) {
        if (xhr.status == 200 && data && messageContainSuccess(data)) {
          $("#conexionexitosa").css("display", "block");
          alert("conexion exitosa");
          document.form_configuraciongeneral.action = "index.php?menu=configuracion_general_module&action=save";
          document.form_configuraciongeneral.submit();
        } else {
          $("#conexionnoexitosa").text("conexion no exitosa " + JSON.stringify(data));
          alert("conexion no exitosa " + JSON.stringify(data));
        }
      },
      error: function (data, textStatus, xhr) {
        $("#conexionnoexitosa").text("conexion no exitosa " + JSON.stringify(data));
        alert("conexion no exitosa " + JSON.stringify(data));
      },
      processData: false,
      type: "POST",
      url: "api-node/index.php?action=config",
    }); 
    */
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
    if (validateOmsSave() == false) {
      createConnection();
    } else {
      alert("debe ingresar todos los valores requeridos");
    }
  });

  function validateMariaDB() {
    let error = false;
    $(".mariadbconn").each(function () {
      if ($(this).val() == "" && error == false) {
        error = true;
      }
    });
    return error;
  }

  function validateOmsSave() {
    if ($("#motor").val() == "") {
      return true;
    }
    let error = false;
    $(".mariadbconn, .omsconn").each(function () {
      if ($(this).val() == "" && error == false) {
        error = true;
      }
    });
    return error;
  }

  async function guardarMariaDB() {
    console.log("iniciaMariaDB");
    await testConexion(
      $("#motormariadb").val().toLocaleLowerCase(),
      $("#servidormariadb").val(),
      $("#usuariomariadb").val(),
      $("input[name=contrasenamariadb]").val(),
      $("#basedatosmariadb").val(),
      "conexionexitosamariadb",
      "conexionnoexitosamariadb"
    )
      .then((response) => {
        console.log("Response function respuesta ", response);
        var prueba = response;
        if (response && messageContainSuccess(response.json)) {
          $("#conexionexitosa").css("display", "block");
          alert("conexion exitosa");

          console.log("response.json = ", response.json);
          /*document.form_configuraciongeneral.action = "index.php?menu=configuracion_general_module&action=saveLocal";
          document.form_configuraciongeneral.submit(); */

          crearConexionConfig(
            "mariadb",
            $("#servidormariadb").val(),
            $("#usuariomariadb").val(),
            $("input[name=contrasenamariadb]").val(),
            $("#basedatosmariadb").val(),
            "conexionexitosamariadb",
            "conexionnoexitosamariadb"
          );
        } else {
          $("#conexionnoexitosa").text("conexion no exitosa " + response.json);
          alert("conexion no exitosa " + response.json);
        }
      })
      .catch((errno) => {
        console.log("ocurrio un error ", errno);
      });
  }

  $("#btnguardardatosmariadb").click(function () {
    if (validateMariaDB() == false) {
      guardarMariaDB();

      /*document.form_configuraciongeneral.action = "index.php?menu=configuracion_general_module&action=saveLocal";
      document.form_configuraciongeneral.submit(); */
    } else {
      alert("debe ingresar todos los valores requeridos");
    }
  });

  function messageContainError(message) {
    let errores = ["error", "errores", "unknown", "EINVAL", "ENOTFOUND", "denied", "could not", "ORA-", "EHOSTUNREACH", "does not support"];

    return errores.some((v) => message.includes(v));
    // There's at least one
  }

  function messageContainSuccess(message) {
    let exito = ["exitosa"];

    return exito.some((v) => message.includes(v));
    // There's at least one
  }

  async function configConexion(motor, servidor, usuario, contrasena, basedatos, divconexionexitosa, divconexionnoexitosa) {
    let result = { response: "", json: "" };
    let information;
    $("#" + divconexionexitosa).css("display", "none");
    $("#" + divconexionnoexitosa).css("display", "none");

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
      case "mariadb":
        motor = "mysql";
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
    if ($("#sslmariadb").val() == "No") {
      delete information["externalBdConnection"]["ssl"];
    }

    await fetch("api-node/index.php?action=test", {
      method: "POST", // *GET, POST, PUT, DELETE, etc.
      mode: "cors", // no-cors, *cors, same-origin
      cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
      //credentials: 'same-origin', // include, *same-origin, omit
      headers: {
        "Content-Type": "application/json",
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: "follow", // manual, *follow, error
      referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body: JSON.stringify(information), // body data type must match "Content-Type" header
    })
      .then(async (res) => {
        console.log("res ", res);
        let resultadoJson = "Error en conexión, servidor no activo";
        await res
          .json()
          .then((resultado) => {
            console.log("resultadooo ", resultado);
            if (resultado) {
              resultadoJson = resultado;
            }
          })
          .catch((error) => console.log(error));

        result = { response: res, json: resultadoJson };
      })
      .catch((err) => {
        console.log("error", err);
      });

    return result;
  }

  async function crearConexionConfig(motor, servidor, usuario, contrasena, basedatos, divconexionexitosa, divconexionnoexitosa) {
    let information = {
      asteriskBdMotor: "mariadb",
      asteriskBdConnection: {
        user: $("#usuariomariadb").val(),
        password: $("input[name=contrasenamariadb]").val(),
        host: $("#servidormariadb").val(),
        database: "asterisk",
        ssl: $("#sslmariadb").val("No"),
      },
    };
    if ($("#sslmariadb").val() == "No") {
      delete information["asteriskBdConnection"]["ssl"];
    }

    await fetch(urlNode + "config", {
      method: "POST", // *GET, POST, PUT, DELETE, etc.
      mode: "cors", // no-cors, *cors, same-origin
      cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
      //credentials: 'same-origin', // include, *same-origin, omit
      headers: {
        "Content-Type": "application/json",
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: "follow", // manual, *follow, error
      referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body: JSON.stringify(information), // body data type must match "Content-Type" header
    })
      .then(async (res) => {
        console.log("res ", res);
        let resultadoJson = "Error en conexión, servidor no activo";
        await res
          .json()
          .then((resultado) => {
            console.log("resultadooo ", resultado);
            if (resultado) {
              resultadoJson = resultado;
              location.reload();
            }
          })
          .catch((error) => console.log(error));

        result = { response: res, json: resultadoJson };
      })
      .catch((err) => {
        console.log("error", err);
      });
  }

  async function testConexion(motor, servidor, usuario, contrasena, basedatos, divconexionexitosa, divconexionnoexitosa) {
    let result = { response: "", json: "" };
    let information;
    $("#" + divconexionexitosa).css("display", "none");
    $("#" + divconexionnoexitosa).css("display", "none");

    switch (motor.toLocaleLowerCase()) {
      case "oracle":
        information = {
          bdMotor: motor.toLocaleLowerCase(),
          bdConnection: {
            user: usuario,
            password: contrasena,
            connectString: servidor + "/" + basedatos,
            externalAuth: false,
          },
        };
        break;
      case "mariadb":
        motor = "mysql";
      case "mysql":
        information = {
          bdMotor: motor,
          bdConnection: {
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
    if ($("#sslmariadb").val() == "No") {
      delete information["bdConnection"]["ssl"];
    }

    await fetch("api-node/index.php?action=test", {
      method: "POST", // *GET, POST, PUT, DELETE, etc.
      mode: "cors", // no-cors, *cors, same-origin
      cache: "no-cache", // *default, no-cache, reload, force-cache, only-if-cached
      //credentials: 'same-origin', // include, *same-origin, omit
      headers: {
        "Content-Type": "application/json",
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: "follow", // manual, *follow, error
      referrerPolicy: "no-referrer", // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
      body: JSON.stringify(information), // body data type must match "Content-Type" header
    })
      .then(async (res) => {
        console.log("res ", res);
        let resultadoJson = "Error en conexión, servidor no activo";
        await res
          .json()
          .then((resultado) => {
            console.log("resultadooo ", resultado);
            if (resultado) {
              resultadoJson = resultado;
            }
          })
          .catch((error) => console.log(error));

        result = { response: res, json: resultadoJson };
      })
      .catch((err) => {
        console.log("error", err);
      });

    return result;
  }

  function probarConexion(motor, servidor, usuario, contrasena, basedatos, divconexionexitosa, divconexionnoexitosa) {
    let information;
    $("#" + divconexionexitosa).css("display", "none");
    $("#" + divconexionnoexitosa).css("display", "none");

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
      case "mariadb":
        motor = "mysql";
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
    if ($("#sslmariadb").val() == "No") {
      delete information["externalBdConnection"]["ssl"];
    }

    console.log("probar infff ", information);

    $.ajax({
      contentType: "application/json",
      data: JSON.stringify(information),
      dataType: "json",
      success: function (data, textStatus, xhr) {
        console.log("data en test ", data);
        if (xhr.status == 200 && data && messageContainSuccess(data)) {
          $("#" + divconexionexitosa).css("display", "block");
        } else {
          $("#" + divconexionnoexitosa).css("display", "block");
          $("#" + divconexionnoexitosa).text("conexion no exitosa " + data);
        }
      },
      error: function (data, textStatus, xhr) {
        console.log("en error ", data);
        $("#" + divconexionnoexitosa).css("display", "block");
        $("#" + divconexionnoexitosa).text("conexion no exitosa " + data.responseText);
      },
      processData: false,
      type: "POST",
      //url: 'modules/configuracion_general/libs/ajaxfunctions.php'
      url: "api-node/index.php?action=test",
    });
  }

  $("#btnprobarconexion").click(function () {
    probarConexion(
      $("#motor").val().toLocaleLowerCase(),
      $("#servidor").val(),
      $("#usuario").val(),
      $("input[name=contrasena]").val(),
      $("#basedatos").val(),
      "conexionexitosa",
      "conexionnoexitosa"
    );
  });

  $("#btnprobarconexionmariadb").click(function () {
    probarConexion(
      $("#motormariadb").val().toLocaleLowerCase(),
      $("#servidormariadb").val(),
      $("#usuariomariadb").val(),
      $("input[name=contrasenamariadb]").val(),
      $("#basedatosmariadb").val(),
      "conexionexitosamariadb",
      "conexionnoexitosamariadb"
    );
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
