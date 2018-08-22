
 function EnviarDatos()
{
    var funcionAjax = $.ajax({   
    url : '../vendor/Login/ValidarUsuario',
    type: 'POST',
    dataType: 'json',
    data: {Usuario: $("#Usuario").val(), clave: $("#clave").val()}   
    });

    funcionAjax.then(function(dato){
        //PREGUNTAR A LOS PROFES POR QUE SE ENVIA DOS VECES EL RESPONSE
      if(dato.status == "200" && dato.tipo == "Socio")
      {
      //console.log(dato);
      //alert("El mail y la clave estan en la base de datos");
        swal(
          'USUARIO VÁLIDO!',
          'Usted esta registrado en la base de datos!',
          'success',
        {button: 'aceptar',}
        ).then(function(){
          localStorage.setItem("hora",dato.hora);
          localStorage.setItem("idEmpleado",dato.id);
          localStorage.setItem("token",dato.token);
          window.location.replace("../enlaces/estacionamiento.html");
        },function(){
          swal('Algo inesperado ocurrio');
        });
      }
      else if(dato.status == "200" && dato.tipo == "Mozo")
     {
       localStorage.setItem("hora",dato.hora);
       localStorage.setItem("idEmpleado",dato.id);
       localStorage.setItem("token",dato.token);
       swal(
         'USUARIO VÁLIDO!',
         'Usted esta registrado en la base de datos!',
         'success'
       ).then(function(){
         window.location.replace("../enlaces/estacionamientoEmpleado.html");
       },function(){
         swal('Ocurrio algo inesperado!');
       });
     }

     else if(dato.status == "200" && dato.tipo == "Cocinero")
     {
       localStorage.setItem("hora",dato.hora);
       localStorage.setItem("idEmpleado",dato.id);
       localStorage.setItem("token",dato.token);
       swal(
         'USUARIO VÁLIDO!',
         'Usted esta registrado en la base de datos!',
         'success'
       ).then(function(){
         window.location.replace("../enlaces/estacionamientoEmpleado.html");
       },function(){
         swal('Ocurrio algo inesperado!');
       });
     }
     else if(dato.status == "200" && dato.tipo == "Bartender")
     {
       localStorage.setItem("hora",dato.hora);
       localStorage.setItem("idEmpleado",dato.id);
       localStorage.setItem("token",dato.token);
       swal(
         'USUARIO VÁLIDO!',
         'Usted esta registrado en la base de datos!',
         'success'
       ).then(function(){
         window.location.replace("../enlaces/estacionamientoEmpleado.html");
       },function(){
         swal('Ocurrio algo inesperado!');
       });
     }
     else if(dato.status == "200" && dato.tipo == "Cervecero")
     {
       localStorage.setItem("hora",dato.hora);
       localStorage.setItem("idEmpleado",dato.id);
       localStorage.setItem("token",dato.token);
       swal(
         'USUARIO VÁLIDO!',
         'Usted esta registrado en la base de datos!',
         'success'
       ).then(function(){
         window.location.replace("../enlaces/estacionamientoEmpleado.html");
       },function(){
         swal('Ocurrio algo inesperado!');
       });
     }

  else if(dato.status == "400")
  {
     swal('USUARIO INCORRECTO!',
     'Revise su correo electrónico y/o su contraseña',
     'warning').then(function(){
      location.reload();
     });
  }
  else if(dato.status == "401")
  {
    swal('USUARIO INHABILITADO!',
     'Comuniquese con su administrador!',
     'warning');
  }
    },function(dato){
      alert(console.log(dato));
     console.log("ERROR"+dato);
    });
}

function Registrarme()
{
  location.reload();
  window.location.replace("../enlaces/registrar.html");
}

