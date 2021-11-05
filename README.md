# Que se hizo

CRUD: Create Read Update Delete (Tareas basicas que se hacen con una tabla a nivel base de datos)
Crear, Leer, Actualizar y Borrar

1. **index.php**: Tiene la capacidad de generar una consulta a toda la tabla actors, limitada para generar paginación en experiencia usuario, el dato de la página es capturado desde metodo GET (URL) en el super arreglo global $_GET, renderiza una tabla HTML con los resultados de la consulta a traves del ciclo foreach, tambien provee enlaces para editar, eliminar y crear un nuevo registro.

2. **create.php**: Renderiza un formulario con los campos primer nombre y apellido para el nuevo actor, tambien tiene lógica backend PHP que opera con el super arreglo $_POST el cual obtiene los datos enviados por este metodo desde el formulario, genera la query capaz de insertar un nuevo registro en la tabla, y lo envia hacia la base de datos, en función de la respuesta emitira un mensaje de exito o fallo según corresponda. A su vez valida antes de insertar un registro que previamente un actor con exactamente el mismo nombre y apellido no exista en dicha tabla.

3. **update.php**: Renderiza un formulario con datos pre-cargados con la información de un registro en base de datos y permite la edición del mismo, creando una instrucción de tipo UPDATE y enviandola hacia MySQL para actualizar dicho registro, importante destacar que captura la llave primaria desde un parametro de tipo GET.

4. **delete.php**: Archivo sin interfaz, capaz de eliminar un registro en base de datos luego de capturar su llave primaria por metodo GET, antes de llegar a esta lógica el archivo index.php lugar donde se puede dar click a eliminar, tiene un control de evento jquery que permite emitir una alerta de tipo confirmación.