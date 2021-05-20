<?php
$token = "98fee347b91da83932ea8b9daa0edece";

function getPeliculas($token) {

	$url = "https://api.themoviedb.org/3/movie/popular?api_key=$token&language=es-ES&page=1";
	$resultado = file_get_contents($url);
	$obj_pelicula = json_decode($resultado);

	return $obj_pelicula;

}

function getSinopsis($id, $token) {

	$obj_pelicula = getDatosPelicula($id, $token);
	$sinopsis = $obj_pelicula->overview;

	return $sinopsis;

}

function getImagenPelicula($path_imagen) {

	$url_imagen = "https://image.tmdb.org/t/p/w500" . $path_imagen;

	return $url_imagen;

}

function getGeneros($generos, $token) {

	$url = "https://api.themoviedb.org/3/genre/movie/list?api_key=$token&language=es-ES";
	$resultado = file_get_contents($url);
	$obj_generos = json_decode($resultado);

	$resultado_generos = array();

	foreach ($obj_generos->genres as $api_generos) {
		if (in_array($api_generos->id, $generos)) {

			array_push($resultado_generos, $api_generos->name);

		}
	}

	return $resultado_generos;

}

// function getActores($id, $token) {

// 	$obj_cast = getCast($id, $token);
// 	$actores = array();

// 	foreach ($obj_cast->cast as $cast) {

// 		if ($cast->known_for_department === 'Acting') {
// 			array_push($actores, $cast->name);
// 		}

// 	}

// 	return $actores;

// }

// function getCast($id, $token){

// 	$url = "https://api.themoviedb.org/3/movie/$id/credits?api_key=$token";
// 	$resultado = file_get_contents($url);
// 	$obj_cast = json_decode($resultado);

// 	return $obj_cast;

// }

// function getDirector($id, $token) {

// 	$obj_cast = getCast($id, $token);

// 	$director = "";

// 	foreach ($obj_cast->crew as $crew) {

// 		if (isset($crew->job) && $crew->job === 'Director') {
// 			$director = $crew->name;
// 		}

// 	}

// 	return $director;

// }

?>