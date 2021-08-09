<?php
/**
 * Filename:    edit.php
 * Project:     SaaS-BREAD-1
 * Location:    dist\users\
 * Author:      EROL A'NIL <erollooper@gmail.com>
 * Created:     9/8/21
 * Description:
 *      Basic BREAD/CRUD interaction with a Database using PHP.
 *
 *      This file is the "Edit user page"
 *
 *      html:5[TAB] creates a HTML5 page stub (Zen coding/Emmet Coding)
 */

require_once __DIR__ . "/../templates/header.php";
require_once __DIR__ . "/../config.php";

$errors = [];
try {
    if (isset($_GET) && isset($_GET['id'])) {
        $id = $_GET['id'];
        /** @var TYPE_NAME $dsn */
        /** @var TYPE_NAME $dbUser */
        /** @var TYPE_NAME $dbPass */
        /** @var TYPE_NAME $dbOptions */
        $connection = new PDO($dsn, $dbUser, $dbPass, $dbOptions);
        $sql = "SELECT * FROM users WHERE id=:id LIMIT 1";
        $statement = $connection->prepare($sql);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $results = $statement->execute();
        $numUsers = $statement->rowCount();
        $user = $statement->fetch();
        $gender =  $user['gender'];
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

/**
 * Expands the code for the gender to full text
 *
 * @param string $gender
 * @return string
 */
function expandGender(string $gender): string
{
    switch ($gender) {
        case 'F':
            $expanded = "Female";
            break;
        case 'M':
            $expanded = "Male";
            break;
        case 'O':
            $expanded = "Other";
            break;
        case 'T':
            $expanded = "Transgender";
            break;
        case 'X':
            $expanded = "Not Disclosed";
            break;
        case 'U':
        default:
            $expanded = "Unknown";
            break;
    }
    return $expanded;
}

if (isset($_POST) && isset($_POST['updateButton'])) {
    $givenName = isset($_POST['givenName']) ? trim($_POST['givenName']) : "";
    $familyName = isset($_POST['familyName']) ? trim($_POST['familyName']) : "";
    $email = isset($_POST['eMailAddress']) ? filter_var(trim($_POST['eMailAddress']), FILTER_SANITIZE_EMAIL) : "";
    $age = isset($_POST['userAge']) ? trim($_POST['userAge']) : "";
    $gender = isset($_POST['userGender']) ? trim($_POST['userGender']) : "";
    $location = isset($_POST['userLocation']) ? trim($_POST['userLocation']) : "";


    if (strlen($givenName) < 1) {
        $errors['Given Name'] = "Given Name is required.";
    }
    if (strlen(filter_var($email, FILTER_VALIDATE_EMAIL)) < 5) {
        $errors['eMail'] = "A valid eMail Address must be given.";
    }
    if ($gender == "" || !strpos('-FMOTUXfmoutx', $gender)) {
        $errors['Gender'] = "Please select a valid gender from the list.";
    }
    if (intval($age) <= 16) {
        $errors['Age'] = "Age must be a positive integer greater than or equal to 16.";
    }
    if (strlen($location) <= 1) {
        $errors['Location'] = "Location must be given and contain a city/town and the 2 ISO country code.";
    }
    if (count($errors) == 0) {


        $sql = "UPDATE users SET given_name=:given_name, family_name = :family_name, email =:email," .
            "  age=:age,gender= :gender, location=:location,  updated_at = now() WHERE id=:id";

        try {
            $connection = new PDO($dsn, $dbUser, $dbPass, $dbOptions);

            $statement = $connection->prepare($sql);

            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            $statement->bindParam(':given_name', $givenName, PDO::PARAM_STR);
            $statement->bindParam(':family_name', $familyName, PDO::PARAM_STR);
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':age', $age, PDO::PARAM_INT);
            $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
            $statement->bindParam(':location', $location, PDO::PARAM_STR);
            $statement->execute();

            header('Location: /saas_bread/users/browse.php', 200);
        } catch (PDOException $error) {
            echo "<h3>Error...</h3>";
            echo "<p>";
            echo $sql . "<br>" . $error->getMessage();
            echo "</p>";
            die(0);
        }
    }
}

?>

    <main class="container shadow-lg mx-auto bg-gray-50 mt-2 md:mt-8 p-6 mb-8 rounded-md">

        <?php

        if ($numUsers !== 1) {
            echo "<p class='py-3'>ID {$id} was not found.</p>";
        } else {
            ?>

            <form action="<?= $_SERVER['REDIRECT_URL']; ?>?id=<?= $id ?>"
                  method="post"
                  class="grid grid-cols-12">

                <div class="col-span-12 px-0 py-2 grid grid-cols-12">
                    <label for="id">User ID:</label>
                    <input type="text" class="form-control" id="id" name="id" value="<?= $user['id'] ?>" readonly>
                </div>

                <div class="col-span-12 px-0 py-2 grid grid-cols-12">
                    <label for="givenName" class="col-span-1 px-0 py-2">Given name</label>
                    <input id="givenName" name="givenName" type="text"
                           class="col-span-6 p-1 border border-gray-400 border-1 border-b-3
                           border-l-0 border-r-0 border-t-0"
                           value="<?= $user['given_name'] ?? '' ?>">
                    <p class="col-span-11 text-trueGray-400 col-start-2 text-xs mt-2 pt-0">
                        Given name must be provided and at least 1 character long.
                    </p>
                </div>

                <div class="col-span-12 px-0 py-2 grid grid-cols-12">
                    <label for="familyName" class="col-span-1 px-0 py-2">Family name</label>
                    <input id="familyName" name="familyName" type="text"
                           class="col-span-6 p-1 border border-gray-400 border-1 border-b-3
                           border-l-0 border-r-0 border-t-0"
                           value="<?= $user['family_name'] ?? '' ?>">
                    <p class="col-span-11 text-trueGray-400 col-start-2 text-xs mt-2 pt-0">
                        The family name is optional.
                    </p>
                </div>

                <div class="col-span-12 px-0 py-2 grid grid-cols-12">
                    <label for="eMailAddress" class="col-span-1 px-0 py-2">eMail</label>
                    <input id="eMailAddress" name="eMailAddress" type="text"
                           class="col-span-8 p-1 border border-gray-400 border-1 border-b-3
                           border-l-0 border-r-0 border-t-0"
                           value="<?= $user['email'] ?? '' ?>">
                    <p class="col-span-11 text-trueGray-400 col-start-2 text-xs mt-2 pt-0">
                        A valid email address is required.
                    </p>
                </div>


                <div class="col-span-12 px-0 py-2 grid grid-cols-12">
                    <label for="userGender" class="col-span-1 px-0 py-2">Gender</label>
                    <select name="userGender" id="userGender"
                            class="col-span-2 border border-gray-400 border-b-1
                                   border-t-0 border-r-0 border-l-0
                                   focus:ring-indigo-500 focus:border-indigo-500 h-full py-0
                                   pl-2 pr-7 bg-transparent sm:text-sm ">
                        <option value=""> disabled>
                            Please select
                        </option>
                        <option value="F" <?= $gender == 'F' ? 'selected' : '' ?>>
                            Female
                        </option>
                        <option value="M" <?= $gender == 'M' ? 'selected' : '' ?>>
                            Male
                        </option>
                        <option value="O" <?= $gender == 'O' ? 'selected' : '' ?>>
                            Other
                        </option>
                        <option value="T" <?= $gender == 'T' ? 'selected' : '' ?>>
                            Transgender
                        </option>
                        <option value="U" <?= $gender == 'U' ? 'selected' : '' ?>>
                            Unknown
                        </option>
                        <option value="X" <?= $gender == 'X' ? 'selected' : '' ?>>
                            Not Given
                        </option>
                    </select>
                    <p class="col-span-11 text-trueGray-400 col-start-2 text-xs mt-2 pt-0">
                        Please select a gender from the list.
                    </p>
                </div>

                <div class="col-span-12 px-0 py-2 grid grid-cols-12">
                    <label for="userAge" class="col-span-1 px-0 py-2">Age</label>
                    <input id="userAge" name="userAge" type="text"
                           class="col-span-2 p-1 border border-gray-400 border-1 border-b-3
                           border-l-0 border-r-0 border-t-0"
                           value="<?= $user['age'] ?? '' ?>">
                    <p class="col-span-11 text-trueGray-400 col-start-2 text-xs mt-2 pt-0">
                        The age must be an integer greater or equal to 16.
                    </p>
                </div>

                <div class="col-span-12 px-0 py-2 grid grid-cols-12">
                    <label for="userLocation" class="col-span-1  px-0 py-2">Location</label>
                    <input id="userLocation" name="userLocation" type="text"
                           class="col-span-6 p-1 border border-gray-400 border-1 border-b-3
                           border-l-0 border-r-0 border-t-0"
                           value="<?= $user['location'] ?? '' ?>">
                    <p class="col-span-11 text-trueGray-400 col-start-2 text-xs mt-2 pt-0">
                        A location is required and must contain city and country code.
                    </p>
                </div>

                <div class="col-span-12 px-0 py-2 grid grid-cols-12">
                    <button id="updateButton" name="updateButton" role="button"
                            type="submit"
                            class="rounded bg-green-200 hover:bg-green-900 text-gray-900
                            hover:text-white p-2 px-6 mr-3 border border-2 border-green-600
                            col-start-2 col-span-1">
                        Update
                    </button>
                    <button id="cancelButton" name="cancelButton" role="button"
                            type="reset"
                            class="rounded bg-red-100 hover:bg-red-900 text-gray-900
                            hover:text-white p-2 px-4 mr-3 border border-2 border-red-600
                            col-span-1"><a href="/saas_bread/users/browse.php">Cancel</a>
                    </button>
                </div>
            </form>
            <?php
        }
        ?>

    </main>

<?php
require_once __DIR__ . "/../templates/footer.php";