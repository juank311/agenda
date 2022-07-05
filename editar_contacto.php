<?php include("includes/header.php") ?>
<?php
 //Se recibe el id y el nombre de la categoria que viene de del botn editar para el place holder
 if (isset($_GET['idp_contacts'])) {

    $id_categories = $_GET['id_categories']; 
    echo $id_categories;
    $categories = $_GET['categories']; 
    //Recibe el ID del contacto y la prepara para ser usada
    $id_contacts = $_GET['idp_contacts'];
    echo $id_contacts;

    //consulta para traer y mostrar los valores con relacion al id del usuario, para cuestion de placeholder
    $query_search = "SELECT * FROM agenda_s.contacts WHERE id = $id_contacts";
    $query_search = $pdo->query($query_search);
    $contact = $query_search->fetch();
    var_dump($contact);

    //consulta para enviar los valores al select dinamico
    $query_search = "SELECT * FROM agenda_s.categories";
    $stmt_search = $pdo->prepare($query_search);
    $stmt_search->execute();
    //resultado de la consulta select dinamico
    $categories_table = $stmt_search->fetchAll(PDO::FETCH_OBJ);
}

//Condicional de validacion de seteo boton para insercion de nuevos datos por el usuario
if (isset($_POST['editarContacto'])) {
    //recoger los valores con las variables siguientes:
    $name_contacts = $_POST['name_contacts'];
    $last_name_contacts = $_POST['last_name_contacts'];
    $phone_contacts = $_POST['phone_contacts'];
    $email_contacts = $_POST['email_contacts'];
    $categories_id = $_POST['categories_id'];
    
    //validacion de datos input
    if (!isset($name_contacts) || trim($name_contacts == null) || trim($name_contacts == "") ||
        !isset($last_name_contacts) || trim($last_name_contacts == null) || trim($last_name_contacts == "") ||
        !isset($phone_contacts) || trim($phone_contacts == null) || trim($phone_contacts == "") ||
        !isset($email_contacts) || trim($email_contacts == null) || trim($email_contacts == "") ||
        !isset($categories_id) || trim($categories_id == null) || trim($categories_id == "")) {
        $error = "Existe un campo vacio";
    } else {// Insert para agregar nuevo contacto a la base de datos. 

        

        $query_insert = "UPDATE  agenda_s.contacts SET name = ?, last_name = ?, phone = ?, email = ?, id_categories = ? ";
        $stmt_insert = $pdo->prepare($query_insert);
        $insert = $stmt_insert->execute([$name_contacts, $last_name_contacts, $phone_contacts, $email_contacts, $categories_id]);
        //mensajes de error y exito.
        if($insert) {
            $mensaje = "Se agregó el contacto ".$name_contacts." ".$last_name_contacts. " correctamente";
        } else {
            $error = "fallo la conexion y no se pudo crear el nuevo contacto";
        }
    }
}
?>
<div class="row">
        <div class="col-sm-6">
            <h3>Editar Contacto</h3>
        </div>            
    </div>
    <div class="row">
        <div class="col-sm-6 offset-3">
            <!-- mensaje -->
        <?php if (isset($mensaje)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><?php echo $mensaje;?></strong> 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif ?>
        <!-- fin del mensaje -->
        <!-- error --> 
        <?php if (isset($error)) : ?>
            <h6 class="bg-danger text-white"><?php echo $error; ?></h6>
        <?php endif ?>
        <!-- end error -->
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        
            <div class="mb-3">
                <label for="name_contacts" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="name_contacts" id="name_contacts" value="<?php echo $contact['name']?>">               
            </div>
            <div class="mb-3">
                <label for="last_name_contacts" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" name="last_name_contacts" id="last_name_contacts" value="<?php echo $contact['last_name']?>">               
            </div>
            <div class="mb-3">
                <label for="phone_contacts" class="form-label">Teléfono:</label>
                <input type="number" class="form-control" name="phone_contacts" id="phone_contacts" value="<?php echo $contact['phone']?>">               
            </div>
            <div class="mb-3">
                <label for="email_contacts" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email_contacts" id="email_contacts" value="<?php echo $contact['email']?>">               
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Categoría:</label>
                <select class="form-select" aria-label="Default select example" name="categories_id">
                    <option value="<?php echo $id_categories?>"><?php echo $categories ?></option>
                    <?php foreach ($categories_table as $row) : ?>
                    <option value="<?php echo $row->id;?>"><?php echo $row->categories; ?></option>
                    <?php endforeach; ?>               
                </select>
            </div>
            <br />
            <button type="submit" name="editarContacto" class="btn btn-primary w-100"><i class="bi bi-person-bounding-box"></i> Editar Contacto</button>
            </form>
        </div>
    </div>
<?php include("includes/footer.php") ?>
       