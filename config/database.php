<?php
/**
 * Database Configuration & PDO Connection
 * Serenity Planners - Production Ready Database Layer
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'serenity_events');
define('DB_CHARSET', 'utf8mb4');

class Database {
    private static ?PDO $instance = null;

    /**
     * Get Singleton PDO Connection
     */
    public static function getConnection(): PDO {
        if (self::$instance === null) {
            $ports = [3307, 3306];
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET
            ];

            $lastException = null;
            foreach ($ports as $port) {
                try {
                    $dsn = "mysql:host=" . DB_HOST . ";port=" . $port . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
                    self::$instance = new PDO($dsn, DB_USER, DB_PASS, $options);
                    return self::$instance;
                } catch (PDOException $e) {
                    $lastException = $e;
                    // If database does not exist (1049), try to auto-run installer on this port
                    if ($e->getCode() === 1049) {
                        require_once __DIR__ . '/installer.php';
                        if (runDatabaseInstaller($port)) {
                            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $options);
                            return self::$instance;
                        }
                    }
                }
            }

            error_log("Database Connection Error: " . ($lastException ? $lastException->getMessage() : 'Unknown'));
            die("<div style='font-family:sans-serif;padding:30px;max-width:600px;margin:50px auto;border:1px solid #e2e8f0;border-radius:12px;box-shadow:0 10px 25px rgba(0,0,0,0.05);background:#fff;'>
                <h2 style='color:#0f172a;margin-top:0;'>Serenity Planners - Database Notice</h2>
                <p style='color:#64748b;line-height:1.6;'>Could not connect to MySQL server. Please ensure MySQL is running in your XAMPP Control Panel.</p>
                <p style='color:#e11d48;font-size:13px;background:#ffe4e6;padding:10px;border-radius:6px;'>Details: " . htmlspecialchars($lastException ? $lastException->getMessage() : 'Connection Refused') . "</p>
            </div>");
        }
        return self::$instance;
    }
}

/**
 * Global helper function to get PDO instance
 */
function getDB(): PDO {
    return Database::getConnection();
}
