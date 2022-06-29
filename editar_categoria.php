<?php require 'conexion_pgs.php'?>
<?php include("includes/header.php") ?>
<?php



//echo $id_caterogia;

if (isset($_POST['editarCategoria']) ) {
    $id_categories = $_GET['id'];
    $categories_name = $_POST['categories_name'];

    if (!empty($categories_name)) {
        $query_update = "UPDATE agenda_s.categories SET categories = ? WHERE id = ? ";
        $stmt_update = $pdo->prepare($query_update);
        $stmt_update->execute([$categories_name, $id_categories]);
    } if ($stmt_update) {
            $mensaje = "Categoria ". $categories_name. " editada exitosamente!!";  
    }else{
        $error = "La Categoria ".$categories_name. " No se puedo editar, ya que está vacia";
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
                <label for="categories_name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="categories_name" id="categories_name" placeholder="Ingresa el nuevo nombre">               
            </div>          

            <button type="submit" name="editarCategoria" class="btn btn-primary w-100">Editar Categoría</button>
            </form>
        </div>
    </div>
<?php include("includes/footer.php") ?>
       