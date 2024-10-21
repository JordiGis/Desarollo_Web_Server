<?php  
session_start();

const USUARIO = "admin";
const CONTRASENA = "admin";

$user = "";
if (isset($_COOKIE["user"])) {
    $user = $_COOKIE["user"];
}

$password = "";
$error = "";

if (isset($_POST["usuario"]) && isset($_POST["contrasena"])) {
    $user = htmlspecialchars($_POST["usuario"]);
    $pass = htmlspecialchars($_POST["contrasena"]);
    if ($user == USUARIO && $pass == CONTRASENA) {
        $_SESSION["user"] = $user;

        if (isset($_POST["recuerdame"])) {
            setcookie("user", $user, time() + 60 * 60 * 24 * 30);
        }
    } else {
        $error = "Usuario o contraseña incorrectos";
    }
}

if (isset($_SESSION["user"]) && $_SESSION["user"] == USUARIO) {
    session_regenerate_id(true);
    header("Location: index.php");
}


// form de inicio de sesion
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificación</title>
    <link rel="stylesheet" href="./public/estilo.css">
    <link rel="stylesheet" href="./public/modal-error/estilo.css">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <header>
        <h1>Inicio de Sesion</h1>
    </header>
    <main id="app">
        <form action="" method="post">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" id="usuario" autocomplete="off" v-model="user" <?= ($user === "")? "autofocus": "" ?> >

            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" id="contrasena" v-model="password" <?= ($user !== "")? "autofocus": "" ?>>
            
            <label for="recuerdame">Recuerdarme: <input type="checkbox" name="recuerdame" id="recuerdame"></label>
            
            <button type="button" @click="checkLogin">Iniciar Sesion</button>
        </form>
        <modal-error ref="errorModal"></modal-error>
    </main>
    <footer>
        <p>S.A - 3 CIP FP Batoi  Jordi Gisbert Ferriz</p>
    </footer>

    <script src="./public/modal-error/modal.js"></script>
    <script>
        let vue = new Vue({
            el: '#app',
            data: {
                user: '<?= ($user !== "")? "$user" : "" ?>',
                password: '',
                error: '', 
            },
            watch: {
                error(newValue) {
                    if (newValue) {
                        this.$refs.errorModal.openModal(newValue);
                    }
                }
            },
            methods: {
                checkLogin() {
                    if (!this.user || !this.password) {
                        // Si usuario o contraseña están vacíos, dispara el error
                        this.error = "Por favor, complete todos los campos.";
                    } else if (this.password.length < 4) {
                        // Validación de contraseña mínima
                        this.error = "La contraseña debe tener al menos 6 caracteres.";
                    } else {
                        // Si todo está bien, reiniciamos el error (y el modal se cerraría)
                        this.error = '';
                        this.$el.querySelector('form').submit();
                    }
                },
                setError(message) {
                    this.error = message;
                }
            },
            mounted(){
                this.setError(<?= "'$error'" ?>)
            }
        });
    </script>
</body>
</html>
