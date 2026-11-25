<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => false, 'message' => 'Method not allowed']);
    exit;
}

// Validasi token pada header Authorization
$headers    = getallheaders();
$authHeader = $headers['Authorization'] ?? '';
if ($authHeader !== 'Bearer secret-token-123') {
    http_response_code(401);
    echo json_encode(['status' => false, 'message' => 'Invalid or missing token']);
    exit;
}

$input    = json_decode(file_get_contents('php://input'), true);
$username = trim($input['username'] ?? '');
$email    = trim($input['email'] ?? '');
$password = $input['password'] ?? '';

if ($username === '' || $email === '' || $password === '') {
    http_response_code(400);
    echo json_encode(['status' => false, 'message' => 'Username, email, dan password wajib diisi']);
    exit;
}

http_response_code(201);
echo json_encode([
    'status'  => true,
    'message' => 'Registrasi pengguna berhasil diproses ',
    'data'    => [
        'username' => $username,
        'email'    => $email,
    ],
]);
