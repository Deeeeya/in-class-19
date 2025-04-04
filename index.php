<?php

header('Content-Type: application/json');

$env = parse_ini_file('.env');
define('DBNAME', $env['DBNAME']);
define('DBHOST', $env['DBHOST']);
define('DBUSER', $env['DBUSER']);
define('DBPASS', $env['DBPASS']);
define('DBPORT', $env['DBPORT']);


try {
    $dsn = "mysql:hostname=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME . ";";
    $pdo = new PDO($dsn, DBUSER, DBPASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $stmt = $pdo->query("SELECT * FROM posts");
    $posts = $stmt->fetchAll();
    
    echo json_encode($posts);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database connection failed: ' . $e->getMessage()]);
}

?>