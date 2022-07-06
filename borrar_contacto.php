<?php include("includes/header.php") ?>

<?php
if (isset($_GET['idp_contacts'])) {

    $id_contacts = $_GET['idp_contacts'];
    $categories_name = $_GET['categories'];

    $query_search = "SELECT * FROM agenda_s.contacts WHERE id = ?";
    $stmt_search = $pdo->prepare($query_search);
    $stmt_search->execute([$id_contacts]);
    $result_search = $stmt_search->fetch(PDO::FETCH_OBJ);
}

//Condicional de validacion de seteo boton
if (isset($_POST['borrarContacto'])) {
    //recoger los valores

    $query_delete = "DELETE  FROM agenda_s.contacts WHERE id = ?";
    $stmt_delete = $pdo->prepare($query_delete);
    $stmt_delete->execute([$id_contacts]);
        echo $ok_delete;
    if ($stmt_delete) {
        $mensaje = "Contacto eliminado exitosamente!!";
        header('Location: contactos.php?mensaje=' . urldecode($mensaje));
    } else {
        $error = "Existe un contacto con esta categoria, por favor cambielo";
    }
}

?>
<div class="row">
    <div class="col-sm-6">
        <h3>Borrar Contacto</h3>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <!-- mensaje -->
            <?php if (isset($mensaje)) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $mensaje; ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif ?>
            <!-- fin del mensaje -->
            <!-- error -->
            <?php if (isset($error)) : ?>
                <h6 class="bg-danger text-white"><?php echo $error; ?></h6>
            <?php endif ?>
            <!-- end error -->
            <div class="mb-3">
                <label for="name_contacts" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="name_contacts" id="name_contacts" placeholder="Ingresa el nombre" value="<?php echo $result_search->name; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="last_name_contacts" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" name="last_name_contacts" id="last_name_contacts" placeholder="Ingresa los apellidos" value="<?php echo $result_search->last_name; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="phone_contacts" class="form-label">Teléfono:</label>
                <input type="number" class="form-control" name="phone_contacts" id="phone_contacts" placeholder="Ingresa el teléfono" value="<?php echo $result_search->phone; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email_contacts" class="form-label">Email:</label>
                <input type="email" class="form-control" name="email_contacts" id="email_contacts" placeholder="Ingresa el email" value="<?php echo $result_search->email; ?>" readonly>
            </div>

            <div class="mb-3">
                <label for="categories" class="form-label">Categoría:</label>
                <input type="text" class="form-control" name="categories" id="categories" placeholder="Ingresa" value="<?php echo $_GET['categories']?>" readonly>
            </div>

            <button type="submit" name="borrarContacto" class="btn btn-danger"><i class="class = bi bi-trash"></i>  Borrar Contacto</button>
        </form>
    </div>
</div>
<?php include("includes/footer.php") ?>