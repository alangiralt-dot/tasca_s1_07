<?php
declare(strict_types=1);
session_start();
$shouldShow = false;
$errorMessage = '';
$urlVariables = '';
class InvalidUsernameException extends Exception {}
class InvalidPasswordException extends Exception {}
class InvalidLanguageException extends Exception {}
class InvalidModeException extends Exception {}

if (
    $_SERVER["REQUEST_METHOD"] == "POST" &&
    isset($_POST["user_name"]) &&
    isset($_POST["password"]) &&
    isset($_POST["language"]) &&
    isset($_POST["mode"])
) {
    try {
        if (preg_match("/^[a-zA-Z0-9àèéíòóúïü_-]{5,30}$/", $_POST['user_name']) !== 1) throw new InvalidUsernameException('The username is not valid.');
        if (preg_match("/[A-Z]{1,}/", $_POST['password']) !== 1) throw new InvalidPasswordException('The password must have at least one uppercase letter.');
        if (preg_match("/[!@#$%^&*]{1,}/", $_POST['password']) !== 1) throw new InvalidPasswordException('The password must have at least one special character.');
        if (preg_match("/[a-zA-Z0-9àèéíòóúïü_!@#$%^&*-]{8,64}/", $_POST['password']) !== 1) throw new InvalidPasswordException('The password must be between 8 and 64 characters.');
        if (preg_match("/^(?:English|Chinese|Spanish)$/", $_POST['language']) !== 1) throw new InvalidLanguageException('The language is not valid.');
        if (preg_match("/^(?:dark|light)$/", $_POST['mode']) !== 1) throw new InvalidModeException('The mode is not valid.');

        $_SESSION["language"] = $_POST["language"];
        $_SESSION["mode"] = $_POST["mode"];
        $shouldShow = true;
    } catch(InvalidUsernameException $e) {
        $errorMessage ='<div class="error-wrapper"><h3>Error</h3>' . $e->getMessage() . '</div>';
        $urlVariables = '?password=' . urlencode($_POST['password']) . '&language=' . urlencode($_POST['language']) . '&mode=' . urlencode($_POST['mode']);
    } catch(InvalidPasswordException $e) {
        $errorMessage ='<div class="error-wrapper"><h3>Error</h3>' . $e->getMessage() . '</div>';
        $urlVariables = '?user_name=' . urlencode($_POST['user_name']) . '&language=' . urlencode($_POST['language']) . '&mode=' . urlencode($_POST['mode']);
    } catch(InvalidLanguageException $e) {
        $errorMessage ='<div class="error-wrapper"><h3>Error</h3>' . $e->getMessage() . '</div>';
        $urlVariables = '?user_name=' . urlencode($_POST['user_name']) . '&password=' . urlencode($_POST['password']) . '&mode=' . urlencode($_POST['mode']);
    } catch(InvalidModeException $e) {
        $errorMessage ='<div class="error-wrapper"><h3>Error</h3>' . $e->getMessage() . '</div>';
        $urlVariables = '?user_name=' . urlencode($_POST['user_name']) . '&password=' . urlencode($_POST['password']) . '&language=' . urlencode($_POST['language']);
    }
} else {
    $errorMessage =
        '<div class="error-wrapper"><h3>Error</h3>' .
        'At least one key of the form was not found in $_POST' .
        '</div>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>S1 T6 N1 E1</title>
</head>
<body>
    <main>
    <div id="table-container">
        <table>
            <tr><th colspan=2>$_POST</th></tr>
            <tr><th>KEY</th><th>VALUE</th></tr>
            <?php
                if ($shouldShow) {
                    foreach ($_POST as $key => $value) {
                        echo "<tr><td>" . htmlspecialchars($key) . "</td><td>" . htmlspecialchars($value) . "</td></tr>";
                    }
                }
            ?>
        </table>
        <table>
            <tr><th colspan=2>$_SESSION</th></tr>
            <tr><th>KEY</th><th>VALUE</th></tr>
            <?php
                if ($shouldShow) {
                    foreach ($_SESSION as $key => $value) {
                        echo "<tr><td>" . htmlspecialchars($key) . "</td><td>" . htmlspecialchars($value) . "</td></tr>";
                    }
                }
            ?>
        </table>
    </div>
    <?php if (!$shouldShow) echo $errorMessage;?>
    </main>
    <footer>
    <div class="link-container">
        <a href="index.html<?php echo $urlVariables?>">GO BACK</a>
    </div>
    </footer>
</body>
</html>