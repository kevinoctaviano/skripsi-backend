<?php

use App\Models\PegawaiModel;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($otentikasiHeader)
{
  if (is_null($otentikasiHeader)) {
    throw new Exception("Token Required!");
  }
  return explode(" ", $otentikasiHeader)[1];
}

function validateJWT($encodedToken)
{
  $key = getenv("JWT_SECRET_KEY");
  $decodedToken = JWT::decode($encodedToken, new Key($key, 'HS256'));
  $modelOtentikasi = new PegawaiModel();
  $modelOtentikasi->getDataPegawai($decodedToken->email);
  $modelOtentikasi->getDivisiPegawai($decodedToken->email);
}

function createJWT($email, $division)
{
  $waktuRequest = time();
  $waktuToken = getenv("JWT_TIME_TO_LIVE");
  $waktuExpired = $waktuRequest + $waktuToken;
  $payload = [
    "email" => $email,
    "division" => $division,
    "iat" => $waktuRequest,
    "exp" => $waktuExpired
  ];
  $jwt = JWT::encode($payload, getenv("JWT_SECRET_KEY"), "HS256");
  return $jwt;
}
