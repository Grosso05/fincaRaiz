<?php
include("conexion.php");

$query = "SELECT * FROM roles";
$resultado_roles = mysqli_query($conn, $query);

if (isset($_POST['agregar'])) {
    $id_usuario = $_POST['id'];
    $nombre_completo = $_POST['nombre'];
    $usuario = $_POST['usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rol_id = $_POST['rol'];

    $query = "INSERT INTO usuarios (id, nombre, usuario, email, password, rol_id, fecha_creacion)
              VALUES ('$id_usuario', '$nombre_completo', '$usuario', '$email', '$password', '$rol_id', NOW())";

    if (mysqli_query($conn, $query)) {
        $mensaje = "El usuario se ha agregado correctamente.";
    } else {
        $mensaje = "No se pudo insertar en la base de datos. " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <title>FRSC - Admin</title>
</head>

<body>
    <?php include("header.php"); ?>

    <div id="contenedor-admin">
        <?php include("contenedor-menu.php"); ?>

        <div class="contenedor-principal">
            <div id="configuracion">
                <h2>Crear Nuevo Usuario</h2>
                <hr>

                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="box-configuracion">
                        <!-- ID (Cédula) -->
                        <label for="id">Cédula del Usuario</label>
                        <input type="text" name="id" placeholder="Ingrese la cédula del usuario" required autocomplete="off" class="input-entrada-texto">

                        <!-- Nombre Completo -->
                        <label for="nombre">Nombre Completo</label>
                        <input type="text" name="nombre" placeholder="Nombre Completo del Usuario" required autocomplete="off" class="input-entrada-texto">

                        <!-- Nombre de Usuario -->
                        <label for="usuario">Nombre de Usuario</label>
                        <input type="text" name="usuario" placeholder="Nombre de Usuario" required autocomplete="off" class="input-entrada-texto">

                        <!-- Correo de Usuario -->
                        <label for="email">Correo Electrónico</label>
                        <input type="email" name="email" placeholder="Correo Electrónico" required autocomplete="off" class="input-entrada-texto">
                        <br><br>
                        
                        <!-- Password de Usuario -->
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" placeholder="Contraseña" required autocomplete="off" class="input-entrada-texto">
                        <br><br>

                        <!-- Rol "List" de Usuario -->
                        <label for="rol">Rol</label>
                        <select name="rol" id="select" required class="input-entrada-texto">
                            <?php while ($row = mysqli_fetch_assoc($resultado_roles)) : ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre_rol'] ?></option>
                            <?php endwhile ?>
                        </select>
                        <br>
                        <br>

                        <input type="submit" name="agregar" value="Crear Usuario" class="btn-accion">
                    </div>
                </form>

                <?php if (isset($_POST['agregar'])) : ?>
                    <script>
                        Swal.fire({
                            title: '¿Estás seguro de crear el usuario ' + "<?php echo $nombre_completo; ?>" + '?',
                            text: '¡Este usuario será agregado al sistema!',
                            icon: 'warning',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Sí, crear usuario'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: '¡Usuario creado correctamente!',
                                    icon: 'success',
                                    timer: 3000,
                                    showConfirmButton: false
                                }).then(() => {
                                    window.location.href = 'ver-usuarios.php';
                                });
                            }
                        });
                    </script>
                <?php endif ?>

            </div>
        </div>
    </div>

    <script>
        $('#link-create-user').addClass('pagina-activa');
    </script>
</body>

</html>