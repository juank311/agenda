<?php include("includes/header.php") ?>

<?php
//consulta para enviar los valores al select dinamico
$query_search = "SELECT * FROM agenda_s.categories";
$stmt_search = $pdo->prepare($query_search);
$stmt_search->execute();
//resultado de la consulta 
$categories_table = $stmt_search->fetchAll(PDO::FETCH_OBJ);

//Condicional de validacion de seteo boton
if (isset($_POST['crearContacto'])) {
    //recoger los valores
    $name_contacts = $_POST['name_contacts'];
    $last_name_contacts = $_POST['last_name_contacts'];
    $phone_contacts = $_POST['phone_contacts'];
    $email_contacts = $_POST['email_contacts'];
    $categories_id = $_POST['categories_list'];
    //validacion de datos input
    if (!isset($name_contacts) || trim($name_contacts == null) || trim($name_contacts == "") ||
        !isset($last_name_contacts) || trim($last_name_contacts == null) || trim($last_name_contacts == "") ||
        !isset($phone_contacts) || trim($phone_contacts == null) || trim($phone_contacts == "") ||
        !isset($email_contacts) || trim($email_contacts == null) || trim($email_contacts == "")) {
        $error = "Existe un campo vacio";
    } else {//Consulta insert para agregar nuevo contacto a la base de datos. 
        $query_insert = "INSERT INTO agenda_s.contacts(name, last_name, phone, email, id_categories)VALUES(?, ?, ?, ?, ?)";
        $stmt_insert = $pdo->prepare($query_insert);
        $insert = $stmt_insert->execute([$name_contacts, $last_name_contacts, $phone_contacts, $email_contacts, $categories_id]);
        //mensajes de error y exito.
        if($insert) {
            $mensaje = "Se agregó el contacto".$name_contacts." ".$last_name_contacts. " correctamente";
        } else {
            $error = "fallo la conexion y no se pudo crear el nuevo contacto";
        }
    }
}
?>
    <div class="row">
        <div class="col-sm-6">
            <h3>Crear un Nuevo Contacto</h3>
        </div>            
    </div>
    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="name_contacts" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="name_contacts" id="name_contacts" placeholder="Ingresa el nombre">               
            </div>
            <div class="mb-3">
                <label for="last_name_contacts" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" name="last_name_contacts" id="last_name_contacts" placeholder="Ingresa los apellidos">               
            </div>
            <div class="mb-3">
                <label for="phone_contacts" class="form-label">Teléfono:</label>
                <input type="number" class="form-control" name="phone_contacts" id="phone_contacts" placeholder="Ingresa el teléfono">               
            </div>
            <div class="mb-3">
                <label for="email_contacts" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email_contacts" id="email_contacts" placeholder="Ingresa el email">               
            </div>

            <div class="mb-3">
                <label for="categories" class="form-label">Categoría:</label>
                <select class="form-select" aria-label="Default select example" name= "categories_list">
                    <option value="">--Selecciona una Categoría--</option>
                    <?php foreach ($categories_table as $row) : ?>
                    <option value="<?php echo $row->id;?>"><?php echo $row->categories; ?></option>
                    <?php endforeach; ?>              
                </select>
            </div>
            <br />
            <button type="submit" name="crearContacto" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Crear Nuevo Contacto</button>
            </form>
        </div>
    </div>
<?php include("includes/footer.php") ?>
       