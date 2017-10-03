<?php


DELETE FROM `persona` 

INSERT INTO `persona`(`id`, `Nombre`, `Clave`) VALUES ("federico","456");

DELETE FROM `persona` WHERE "id"=1;

UPDATE `persona` SET Nombre="alguno", WHERE id="6";

INSERT INTO `persona`(`Nombre`, `Clave`) VALUES ("caca","789"),("joaquin","sombielle");

SELECT Clave FROM `persona` 

SELECT Clave as Apellido FROM `persona` ;


SELECT P.Nombre,L.Descripcion FROM `persona` as P, `localidad` as L WHERE P.id_localidad=L.Id;


INSERT INTO `envios`(`Numero`, `pNumero`, `Cantidad`) VALUES (100,1,500);
INSERT INTO `envios`(`Numero`, `pNumero`, `Cantidad`) VALUES (100,2,1500);
INSERT INTO `envios`(`Numero`, `pNumero`, `Cantidad`) VALUES (100,3,100);
INSERT INTO `envios`(`Numero`, `pNumero`, `Cantidad`) VALUES (101,2,55);
INSERT INTO `envios`(`Numero`, `pNumero`, `Cantidad`) VALUES (101,3,225);
INSERT INTO `envios`(`Numero`, `pNumero`, `Cantidad`) VALUES (102,1,600);
INSERT INTO `envios`(`Numero`, `pNumero`, `Cantidad`) VALUES (102,3,300);



//--------------------------//---------------------//-----------------------//--------------


1 - SELECT * FROM `productos` ORDER BY(pNombre)

2 - 

?>