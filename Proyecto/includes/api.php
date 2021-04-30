<?php
function getDatosPelicula($id, $token) {

	$url = "https://api.themoviedb.org/3/movie/$id?api_key=$token";
	$resultado = file_get_contents($url);
	$obj_pelicula = json_decode($resultado);

	return $obj_pelicula;

}

function buscarPelicula($titulo, $token) {

	$url = "https://api.themoviedb.org/3/search/movie?api_key=$token&query=$titulo&page=1";
	$resultado = file_get_contents($url);
	$obj_pelicula = json_decode($resultado);

	return $obj_pelicula;

}

function getIdPelicula($titulo, $token) {

	$obj_pelicula = buscarPelicula($titulo, $token);

	$id_pelicula = "";

	foreach ($obj_pelicula->results as $pelicula) {
		$id_pelicula = $pelicula->id;
	}

	if (!empty($id_pelicula)) {

		return $id_pelicula;

	} else {

		return FALSE;

	}

}

function getSinopsis($id, $token) {

	$obj_pelicula = getDatosPelicula($id, $token);
	$sinopsis = "";

	foreach ($obj_pelicula as $pelicula) {
		$sinopsis = $obj_pelicula->overview;
	}

	return $sinopsis;

}

// function getImagenPelicula($pelicula) {

// 	$path_imagen = $pelicula->poster_path;

// 	$url_imagen = "https://image.tmdb.org/t/p/w500" . $path_imagen;

// 	return $url_imagen;

// }

function getActores($id, $token) {

	$url = "https://api.themoviedb.org/3/movie/$id/credits?api_key=$token";
	$resultado = file_get_contents($url);
	$obj_cast = json_decode($resultado);

	$actores = array();

	foreach ($obj_cast->cast as $cast) {

		if ($cast->known_for_department === 'Acting') {
			array_push($actores, $cast->name);
		}

	}

	return $actores;

}

function getDirector($id, $token) {

	$url = "https://api.themoviedb.org/3/movie/$id/credits?api_key=$token";
	$resultado = file_get_contents($url);
	$obj_cast = json_decode($resultado);

	$director = "";

	foreach ($obj_cast->cast as $cast) {

		if (isset($cast->job) && $cast->job === 'Director') {
			$director = $cast->name;
		}

	}

	return $director;

}

?>