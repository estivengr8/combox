<?php

require('../config/database.php');

// Recibir los datos
$user_id = $_GET['user_id'] ?? null;

// Validar ID
if (!isset($user_id) || !ctype_digit((string)$user_id)) {
    die("Invalid user ID");
}

// Eliminar usuario
$query = "DELETE FROM users WHERE id = $1";

$res = pg_query_params($supa_conn, $query, array($user_id));

if ($res && pg_affected_rows($res) > 0) {

    echo "<script>
        alert('User deleted successfully.');
        window.location.href = 'list_users.php';
    </script>";

} else {

    echo "<script>
        alert('Error deleting user.');
        window.location.href = 'list_users.php';
    </script>";

}

?>