<?php

// Récupère les coordonnées depuis la requête AJAX
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];

// Appel à l'API d'Aladhan.com pour obtenir la ville en fonction des coordonnées
$api_url = "http://api.aladhan.com/v1/reverse?latitude={$latitude}&longitude={$longitude}";

$api_response = file_get_contents($api_url);

echo $api_response;

$api_data = json_decode($api_response, true);

// Initialise la réponse
$response = array();


if ($api_data && isset($api_data['data']['address']['city'])) {
    $city = $api_data['data']['address']['city'];
    // Inclut la ville dans la réponse
    $response['message'] = "Coordonnées reçues avec succès. Ville : {$city}";
    $response['geolocation_data'] = $api_data['data'];
    // Appel à l'API d'Aladhan.Com pour obtenir les horaires de prière pour la ville
    $currentYear = date("Y");
    $currentMonth = date("m");
    $prayer_times_url = "http://api.aladhan.com/v1/calendarByCity/{$currentYear}/{$currentMonth}?city={$city}&country=France&method=12";

    $prayer_times_response = file_get_contents($prayer_times_url);
    $prayer_times_data = json_decode($prayer_times_response, true);

    // Vérifie si la réponse pour les horaires de prière est valide
    if ($prayer_times_data && isset($prayer_times_data['data'])) {
        // Inclut les horaires de prière dans la réponse
        $response['prayer_times'] = $prayer_times_data['data'];
    } else {
        // Inclut un message générique si les horaires de prière ne sont pas disponibles
        $response['prayer_times'] = array();
        $response['message'] .= ' Horaires de prière non disponibles.';
    }

} else {
    // Inclut un message générique si les informations de la ville ne sont pas disponibles
    $response['message'] = 'Coordonnées reçues avec succès, mais la ville n\'a pas pu être déterminée.';
    $response['geolocation_data'] = $api_data;
    $response['latitude'] = $latitude;
    $response['longitude'] = $longitude; 
}

// Indique que la réponse est au format JSON
header('Content-Type: application/json');

// Renvoie la réponse au format JSON
echo json_encode($response);

?>
