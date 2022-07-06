<?php require 'conexion_pgs.php'?>
<?php include("includes/header.php") ?>

<?php



//COMPARAR SI EL VALOR YA EXISTE EN BASE DE DATOS 

if (isset($_POST['crearCategoria'])) {
//recoger el valor enviado por POST
    $categories_name = $_POST['categories_name'];
//consulta de comparacion
    $query_search = "SELECT * FROM agenda_s.categories WHERE categories = ? ";
    $stmt_search = $pdo->prepare($query_search);
    $stmt_search->execute([$categories_name]);
    $categories_table = $stmt_search->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($categories_table); 

    if ($categories_table == null) {
        $query_insert = "INSERT INTO agenda_s.categories (categories) VALUES (?)";
        $stmt_insert = $pdo->prepare($query_insert);
        $stmt_insert->execute([$categories_name]);
        
            $mensaje = "Categoria <b><i>" . $categories_name . "</i></b> agregada exitosamente!!";
            header('Location: categorias.php?mensaje=' .urldecode($mensaje));
    } else {

            $error = "La Categoria ".$categories_name. " ya se encuenta creada";

    }
}

?>
<div class="row">
        <div class="col-sm-6">
            <h3>Crear una Nueva Categoría</h3>
        </div>            
    </div>
       <div class="row">
        <div class="col-sm-6 offset-3">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label for="categories_name" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="categories_name" id="categories_name" placeholder="Ingresa el nombre de la Categoria">               
            </div>          

            <button type="submit" name="crearCategoria" class="btn btn-primary w-100">Crear Nueva Categoría</button>
            </form>
        </div>
    </div>
<?php include("includes/footer.php") ?>
       