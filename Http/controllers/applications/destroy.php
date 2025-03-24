<?php

use Core\App;
use Core\Database;

$id = (int) $routeParams['id'];

// delete from database
App::resolve(Database::class)->query('DELETE FROM applications WHERE id = :id', [
	'id' => $id
]);

redirect(route('/admin/applications'));