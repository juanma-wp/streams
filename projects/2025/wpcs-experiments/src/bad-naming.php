<?php

/**
 * Archivo con problemas de nomenclatura
 */

// Variables con nomenclatura incorrecta (no snake_case)
$userName   = 'Juan';
$userAge    = 30;
$isLoggedIn = true;

// Función con nomenclatura incorrecta (no snake_case)
function getUserInfo( $userId ) {
	global $userName, $userAge;

	// Variable con nomenclatura incorrecta
	$userInfo = array(
		'name' => $userName,
		'age'  => $userAge,
		'id'   => $userId,
	);

	return $userInfo;
}

// Clase con nomenclatura incorrecta (debería usar WordPress prefixes)
class UserManager {

	public $currentUser;

	public function getUser( $id ) {
		return getUserInfo( $id );
	}
}

$userManager = new UserManager();
