<?php include("includes/header.php") ?>
<?php

    //Consulta para mostrar como placeholder editable
    if (isset($_GET['id'])) {

        $id_categories = $_GET['id']; 

        $query_search = "SELECT * FROM agenda_s.categories WHERE id = ?";
        $stmt_search=$pdo->prepare($query_search);
        $stmt_search->execute([$id_categories]);
        $result_search = $stmt_search->fetch(PDO::FETCH_OBJ);

        //echo $result_search->categories;
    } 
    //Edicion del nombre de la categoria por un nuevo nombre entregado por el usuario
if (isset($_POST['editarCategoria'])) { 
    $categories_name = $_POST['categories_name'];
    $id_categories = $_GET['id']; 
     
    if ( !isset($categories_name) || trim($categories_name) == "" || trim($categories_name) == NULL) {
        $error = "Nombre NO puede estar vacio";
    }   else {
        $query_update = "UPDATE agenda_s.categories SET categories = ? WHERE id = ? ";
        $stmt_update = $pdo->prepare($query_update);
        $stmt_update->execute([$categories_name, $id_categories]);
        if ($stmt_update) {
            $mensaje = "Categoria ". $categories_name. " editada exitosamente!!"; 
            header('Location: editar_codigo.php?mensaje='.urldecode($mensaje).'&id='.$id_categories);
        }
    }
}
 
?>

    <div class="row">
        <div class="col-sm-6">
            <h3>Editar Categoría</h3>
        </div>            
    </div>
                    <?php if (isset($mensaje)) : ?>
                    <!-- mensaje --> 
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><?php echo $mensaje;?></strong> 
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif ?>
                    <!-- error --> 
                    <?php if (isset($error)) : ?>
                        <h6 class="bg-danger text-white"><?php echo $error; ?></h6>
                    <?php endif ?>
                    <!-- end error -->
    <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="id_categories" class="form-label">Códido ID:</label>
                <input type="text" class="form-control" name="id_categories" id="id_categories"  value=<?php echo $result_search->id;?> readonly>
                <br>
                <label for="categories_name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="categories_name" id="categories_name" value="<?php echo $result_search->categories;?>">             
            </div>          

            <button type="submit" name="editarCategoria" class="btn btn-primary w-100"> <i class="bi bi-pencil-fill"></i> Editar Categoría</button>
            </form>
        </div>
    </div>
<?php include("includes/footer.php") ?>
       