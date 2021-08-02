<?php
/**
 * Filename:    index.php
 * Project:     SaaS-BREAD-1
 * Location:    dist\
 * Author:      Erol A'NIL <erollooper@gmail.com>
 * Created:     2/8/21
 * Description:
 *      Basic BREAD/CRUD interaction with a Database using PHP.
 *
 *      This file is the "home page"
 *
 *
 *      html:5[TAB] creates a HTML5 page stub (Zen coding/Emmet Coding)
 */

require_once "./templates/header.php";
?>
<main class="container shadow-lg mx-auto bg-gray-50 mt-2 md:mt-8 p-6 md-8 rounded-md">
    <div class="mt-6 mb-6">
        <h2 class="text-3xl mb-6">Add</h2>
        <p class="py-3">Add new user:</p>
        <dl class="grid grid-cols-12">
            <dt class="col-span-11 px-0 py-2">
                <dd class="col-span-11 px-0 py-2">
                <input type="text" class="p-1 border border-gray-400 border-1 border-b-3 border-l-0 border-r-0 borer-t-0">
            </dd>
            </dt>
        </dl>
    </div>
</main>

<?php
require_once "./templates/footer.php";