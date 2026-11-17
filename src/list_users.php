
<?php
require('../config/database.php');

$sql = "
    SELECT
        id,
        firstname,
        lastname,
        mobile_phone,
        email,
        CASE
            WHEN u.status = true THEN 'Active'
            ELSE 'Inactive'
        END AS users_status,
        photo_url
    FROM users u
    ORDER BY lastname ASC
";

$res = pg_query($supa_conn, $sql);

if (!$res) {
    die("Error en la consulta: " . pg_last_error($supa_conn));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Users Combox</title>
    <link rel="icon" type="image/png" href="icons/my logo 0.1.png">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container mt-5">

        <center>
            <h3 class="mb-4">List all</h3>
        </center>

        <div class="border rounded overflow-hidden shadow-sm bg-white">

            <div class="table-responsive">

                <table class="table table-striped table-hover mb-0 align-middle">

                    <thead class="table-primary">

                        <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Photo</th>
                            <th>Actions</th>
                        </tr>

                    </thead>

                    <tbody>

                    <?php
                    while ($row = pg_fetch_assoc($res)) {
                    ?>

                    <tr>

                        <td><?php echo htmlspecialchars($row['firstname']); ?></td>

                        <td><?php echo htmlspecialchars($row['lastname']); ?></td>

                        <td><?php echo htmlspecialchars($row['mobile_phone']); ?></td>

                        <td><?php echo htmlspecialchars($row['email']); ?></td>

                        <td><?php echo htmlspecialchars($row['users_status']); ?></td>

                        <td align="center">
                            <img src="<?php echo htmlspecialchars($row['photo_url'] ?? ''); ?>" width="30">
                        </td>

                        <td>

                            <!-- Botón Ver -->
                            <a href="view_user.php?id=<?php echo urlencode($row['id']); ?>">
                                <button type="button" class="btn btn-primary btn-sm">
                                    <img src="icons/lupa.png" width="15">
                                    Ver
                                </button>
                            </a>

                            <!-- Botón Editar -->
                            <a href="edit_user.php?id=<?php echo urlencode($row['id']); ?>">
                                <button type="button" class="btn btn-warning btn-sm">
                                    <img src="icons/lapiz.png" width="15">
                                    Editar
                                </button>
                            </a>
                            <!-- Botón Eliminar -->
                            <a href="delete_user.php?user_id=<?php echo urlencode($row['id']); ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('¿Deseas eliminar este usuario?');">

                                <img src="icons/basura.png" width="15" alt="Delete icon">
                                Eliminar
                            </a>
                            
                            <!-- Botón Inactivar -->
                            <a href="deactivate_user.php?user_id=<?php echo urlencode($row['id']); ?>"
                                class="btn btn-secondary btn-sm"
                            onclick="return confirm('¿Deseas Inactivar este usuario?');">

                                <img src="icons/desactivar.png" width="15" alt="Deactivate icon">
                                Inactivar

                            </a>
                        </td>

                    </tr>

                    <?php
                    }
                    ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>
</html>
