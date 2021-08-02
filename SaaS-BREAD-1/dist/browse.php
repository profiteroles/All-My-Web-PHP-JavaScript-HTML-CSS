<?php

require_once "./templates/header.php";

require_once "config.php";
$connection = new PDO($dsn, $dbUser, $dbPass, $dbOption);
$sql = "SELECT * FROM users";
$statement = $connection->prepare($sql);
$results = $statement->execute();
?>

    <main class="container shadow-lg mx-auto bg-gray-50 mt-2 md:mt-8 p-6  mb-8 rounded-md">
        <div class="mt-6 mb-6">
            <h2 class="text-3xl mb-6">Browse</h2>
            <table class="table-auto w-full border border-blue-700">
                <thead class="bg-blue-900 text-white">
                <tr>
                    <th class="text-left p-1 pl-2 py-4">ID</th>
                    <th class="text-left p-1 pl-2 py-4">Name</th>
                    <th class="text-left p-1 pl-2 py-4">Surname</th>
                    <th class="text-left p-1 pl-2 py-4">Location</th>
                    <th class="text-left p-1 pl-2 py-4">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while ($aUser = $statement->fetch()) {
                    $id = $aUser['id'];
                    $given_name = $aUser['given_name'];
                    $family_name = $aUser['family_name'];
                    $email = $aUser['email'];
                    $age = $aUser['age'];
                    $gender = $aUser['gender'];
                    $location = $aUser['location'];

                    ?>

                <tr class="hover:bg-blue-200 border-blue-700 border border-bottom-1">
                    <td class="p-1 pl-2"><?=$id?></td>
                    <td class="p-1 pl-2"><?=$given_name?></td>
                    <td class="p-1 pl-2"><?=$family_name?></td>
                    <td class="p-1 pl-2"><?=$location?></td>
                    <td class="p-1 pl-2">Read Edit Delete</td>
                </tr>
                    <?php
                    }
                    ?>

                </tbody>
                <tfoot>
                <!--tfoot>tr.bg-blue-900.text-gray-200.border.border-top-blue.border-blue-700>td[colspan=5].px-4.py-4-->
                <tr class="bg-blue-900 text-gray-200 border border-top-2 border-blue-700">
                    <td colspan="5" class="px-4 py-4">
                        <a class="bg-white hover:bg-blue-500 text-blue-700 hover:text-white rounded p-2 transition-colors transition-bg duration-500 ease-in-out"
                           href="#">First</a>
                        <a class="bg-white hover:bg-blue-500 text-blue-700 hover:text-white rounded p-2 transition-colors transition-bg duration-500 ease-in-out"
                           href="#">Prev</a>
                        <a class="bg-white hover:bg-blue-500 text-blue-700 hover:text-white rounded p-2 transition-colors transition-bg duration-500 ease-in-out"
                           href="#">1</a>
                        <a class="bg-white hover:bg-blue-500 text-blue-700 hover:text-white rounded p-2 transition-colors transition-bg duration-500 ease-in-out"
                           href="#">2</a>
                        <a class="bg-white hover:bg-blue-500 text-blue-700 hover:text-white rounded p-2 transition-colors transition-bg duration-500 ease-in-out"
                           href="#">3</a>
                        <a class="bg-white hover:bg-blue-500 text-blue-700 hover:text-white rounded p-2 transition-colors transition-bg duration-500 ease-in-out"
                           href="#">4</a>
                        <a class="bg-white hover:bg-blue-500 text-blue-700 hover:text-white rounded p-2 transition-colors transition-bg duration-500 ease-in-out"
                           href="#">5</a>
                        <a class="bg-white hover:bg-blue-500 text-blue-700 hover:text-white rounded p-2 transition-colors transition-bg duration-500 ease-in-out"
                           href="#">Next</a>
                        <a class="bg-white hover:bg-blue-500 text-blue-700 hover:text-white rounded p-2 transition-colors transition-bg duration-500 ease-in-out"
                           href="#">Last</a>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </main>

<?php
require_once "./templates/footer.php";
?>