<?php
/**
 * Automated Database Installer and Seeder
 * Serenity Planners
 */

function runDatabaseInstaller(?int $forcedPort = null): bool {
    $host = defined('DB_HOST') ? DB_HOST : 'localhost';
    $user = defined('DB_USER') ? DB_USER : 'root';
    $pass = defined('DB_PASS') ? DB_PASS : '';
    $ports = $forcedPort ? [$forcedPort] : [3307, 3306];

    $sqlPath = dirname(__DIR__) . '/database/database.sql';
    if (!file_exists($sqlPath)) {
        error_log("SQL installation file not found at: {$sqlPath}");
        return false;
    }

    $sql = file_get_contents($sqlPath);

    foreach ($ports as $port) {
        try {
            $pdo = new PDO("mysql:host={$host};port={$port};charset=utf8mb4", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            // Execute multi-statement SQL
            $pdo->exec($sql);
            return true;
        } catch (Exception $e) {
            error_log("Installer port {$port} error: " . $e->getMessage());
        }
    }

    return false;
}

if (php_sapi_name() === 'cli' || (isset($_GET['install']) && $_GET['install'] === 'auto')) {
    if (runDatabaseInstaller()) {
        echo "Database and seed data successfully initialized for Serenity Planners.\n";
    } else {
        echo "Failed to initialize database. Please ensure MySQL is started in XAMPP on port 3307 or 3306.\n";
    }
}
