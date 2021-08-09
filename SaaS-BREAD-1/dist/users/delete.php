<?php
/**
 * Filename:    delete.php
 * Project:     SaaS-BREAD-1
 * Location:    dist\users\
 * Author:      Erol A'NIL <erollooper@gmail.com>
 * Created:     9/8/21
 * Description:
 *      Basic BREAD/CRUD interaction with a Database using PHP.
 *
 *      This file is the "Delete User page"
 *
 *
 *      html:5[TAB] creates a HTML5 page stub (Zen coding/Emmet Coding)
 */

require_once __DIR__ . "/../templates/header.php";
require_once __DIR__ . "/../config.php";

try {
    if (isset($_GET) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $connection = new PDO($dsn, $dbUser, $dbPass, $dbOptions);
        $sql = "SELECT given_name FROM users WHERE id=:id";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $results = $statement->execute();
        $user = $statement->fetch();

        $sql = "DELETE FROM users WHERE id=:id";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $results = $statement->execute();
    }
} catch
(PDOException $error) {
    echo '<main class="container shadow-lg mx-auto bg-gray-50 mt-2 md:mt-8 p-6 mb-8 rounded-md">';
    echo "<h3>Error...</h3>";
    echo "<pre>";
    echo $error->getMessage();
    echo "</pre>";
    echo '</main>';
    die(1);

}
?>

    <main class="container shadow-lg mx-auto bg-gray-50 mt-2 md:mt-8 p-6 mb-8 rounded-md">
        <div class="mt-6 mb-6">
            <h2 class="text-3xl mb-6">Delete User</h2>

            <p class="py-3">User ID:<?= $user['given_name'] ?> has deleted</p>
            <button id="BackButton" name="BackButton" role="button"
                    class="rounded bg-blue-100 hover:bg-blue-900 text-gray-900
                            hover:text-white p-2 px-4 mr-3 border border-2 border-blue-600
                            col-span-1"><a href="/saas_bread/users/browse.php">Back to Browse</a>
            </button>
        </div>
    </main>

<?php
require_once __DIR__ . "/../templates/footer.php";
