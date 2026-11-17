
<?php

require('../config/database.php');

// Recibir ID mediante GET
$user_id = $_GET['user_id'] ?? null;

// Validar ID
if (!$user_id || !ctype_digit((string)$user_id)) {
    die("Invalid user ID");
}

// Desactivar usuario
$query = "UPDATE users SET status = FALSE WHERE id = $1";

$res = pg_query_params($supa_conn, $query, array($user_id));

// Comprobar errores
if (!$res) {

    die("Error updating user: " . pg_last_error($supa_conn));

}

// Comprobar si se actualizó el usuario
if (pg_affected_rows($res) > 0) {

    echo "<script>
        alert('User deactivated successfully.');
        window.location.href = 'list_users.php';
    </script>";

} else {

    echo "<script>
        alert('User not found or already inactive.');
        window.location.href = 'list_users.php';
    </script>";

}

?>

