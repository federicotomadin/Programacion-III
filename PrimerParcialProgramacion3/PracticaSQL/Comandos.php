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

2 - SELECT * FROM `proveedores` WHERE Localidad="Quilmes"

3 - SELECT * FROM `envios` WHERE Cantidad>200 and Cantidad<300

4 - SELECT SUM(Cantidad) FROM `envios` 

5 - SELECT * FROM `envios` LIMIT 0,3;

6 - SELECT P.pNombre,PP.Nombre FROM `productos` as P , `proveedores` as PP WHERE PP.Numero=Numero and P.pNumero=pNumero

7 - SELECT P.Precio * E.Cantidad as Resultado INNER JOIN `envios` as E on P.pNumero=E.numero;

8 - SELECT SUM(Cantidad) as Suma FROM `envios` WHERE pNumero="1";

9 - SELECT P.pNumero,PP.Localidad FROM `productos` as P, `proveedores` as PP WHERE PP.Localidad="Avellaneda";

10 - SELECT  PP.Domiclilio,PP.Localidad FROM `proveedores` as PP  WHERE PP.Nombre like '%i%';

11 - INSERT INTO `productos`(`pNombre`, `Precio`, `Tamaño`) VALUES ("Chocolate",25.35,"chico");

12 - INSERT INTO `proveedores`(`Numero`) VALUES (104);

13 - INSERT INTO `proveedores`(`Numero`,`Nombre`,`Localidad`) VALUES (107,"Rosales","La plata");

14 - UPDATE `productos` SET Precio=97.50 WHERE Tamaño="Grande";

16 - DELETE FROM `productos` WHERE pNumero=1;

?>