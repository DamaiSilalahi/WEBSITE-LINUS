<?php
// URL dan API Key dari Supabase
$supabaseUrl = 'https://khorijggrdqoajmxecky.supabase.co'; // Ganti dengan URL Supabase Anda
$supabaseKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imtob3JpamdncmRxb2FqbXhlY2t5Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzI4OTMzNzEsImV4cCI6MjA0ODQ2OTM3MX0.AkP8jfSCL6dQ7AO3ddglS1oGMY9VYedKUBpTnkz4FiU'; // Ganti dengan API key Anda

// Endpoint Supabase (misalnya untuk tabel "users")
$url = $supabaseUrl . '/rest/v1/users'; // Ganti dengan nama tabel yang sesuai

// Fungsi untuk mengambil data dari Supabase
function getUsers() {
    global $url, $supabaseKey;

    // Inisialisasi cURL
    $ch = curl_init($url);

    // Header dengan API Key
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'apikey: ' . $supabaseKey,
        'Authorization: Bearer ' . $supabaseKey,
        'Content-Type: application/json',
    ]);

    // Set metode GET
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Eksekusi dan tangkap respons
    $response = curl_exec($ch);
    curl_close($ch);

    // Decode respons JSON
    return json_decode($response, true);  // Mengembalikan data dalam bentuk array
}
?>
