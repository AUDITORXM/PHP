<?php
function getDatosPelicula($id, $token) {

	$url = "https://api.themoviedb.org/3/movie/$id?api_key=$token&language=es-ES";
	$resultado = file_get_contents($url);
	$obj_pelicula = json_decode($resultado);

	return $obj_pelicula;

}

function buscarPelicula($titulo, $token) {

	$titulo = urlencode($titulo);
	$url = "https://api.themoviedb.org/3/search/movie?api_key=$token&query=$titulo&language=es-ES";
	$resultado = file_get_contents($url);
	$obj_pelicula = json_decode($resultado);

	return $obj_pelicula;

}

function getIdPelicula($titulo, $token) {

	$obj_pelicula = buscarPelicula($titulo, $token);

	$id_pelicula = NULL;

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
	$sinopsis = $obj_pelicula->overview;

	return $sinopsis;

}

function getImagenPelicula($pelicula) {

	$path_imagen = $pelicula->poster_path;

	$url_imagen = "https://image.tmdb.org/t/p/w500" . $path_imagen;

	return $url_imagen;

}

function getActores($id, $token) {

	$obj_cast = getCast($id, $token);
	$actores = array();

	foreach ($obj_cast->cast as $cast) {

		if ($cast->known_for_department === 'Acting') {
			array_push($actores, $cast->name);
		}

	}

	return $actores;

}

function getCast($id, $token){

	$url = "https://api.themoviedb.org/3/movie/$id/credits?api_key=$token";
	$resultado = file_get_contents($url);
	$obj_cast = json_decode($resultado);

	return $obj_cast;

}

function getDirector($id, $token) {

	$obj_cast = getCast($id, $token);

	$director = "";

	foreach ($obj_cast->crew as $crew) {

		if (isset($crew->job) && $crew->job === 'Director') {
			$director = $crew->name;
		}

	}

	return $director;

}

?>