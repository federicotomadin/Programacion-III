<?php

include_once "Usuario.php";

if((Usuario::BuscarUsuario("titulo")<>-1) || (Usuario::BuscarTitulo("titulo")<>-1))



{
echo "<table class='table'>
<thead>
    <tr>
        <th>  NOMBRE </th>
        <th>  EDAD   </th>
        <th>  COMENTARIO     </th>
        <th>  FOTO      </th>
    </tr> 
</thead>";   

foreach (Usuario::$_listaUsuarios as $cont){

 echo "<tr>
 <td>".$cont->GetNombre()."</td>
 <td>".$cont->GetEdad()."</td>
 <td>".Usuario::$_listaComentarios[2]."</td>
 <td><img src='imagenesDeComentario/".Usuario::$_listaComentarios[0]."' width='100px' height='100px'></td>
</tr>";
 echo "</table>";		
}

}


?>

