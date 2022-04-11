# clientes_telefonos

Se ha utilizado como base para la construccion de esta API el siguiente material:
https://www.php.net
https://www.w3schools.com/php
https://code.tutsplus.com/es/tutorials/how-to-build-a-simple-rest-api-in-php--cms-37000



Rutas

Para agregar nuevas rutas, hay un arreglo que recibe el nombre del modelo, la accion y el metodo.
Ejemplo: para que una ruta quede: ".../telefono/lista" se debe agregar al arreglo algo como esto: Model:telefono / Accion:lista.

Clases Cliente y Telefono
Reciben los parametros correspondientes que estan en la base de datos. Llaman los metodos para CRUD y construye las consultas.

Respuesta
Es el estandar de respuesta entre el controlador y la vista

Index
Se registran los controladores y se inicializan en caso de lo que sea llamado en ese momento. Se cargan las rutas y se verifica cual es el metodo a llamar

Bootstrap
Se cargan los modelos para la utilización en todo el proyecto, la base del controlador y la clase respuesta. Tambien se puede agregar cualquier clase generica que se requiere.
