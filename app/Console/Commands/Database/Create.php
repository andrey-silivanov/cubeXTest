<?php
declare(strict_types = 1);

namespace App\Console\Commands\Database;

use Illuminate\Console\Command;

/**
 * Class Create
 * @package App\Console\Commands\Database
 */
class Create extends Command
{
    /** @var string The name and signature of the console command. */
    protected $signature = 'db:create';

    /** @var string The console command description. */
    protected $description = 'Creates the database defined in config';

    public function handle()
    {
        $dfconn = config('database.default');
        $driver = config("database.connections.{$dfconn}.driver");
        if ('mysql' !== $driver) {
            $this->error("Sorry, but only MySQL driver supported. Your driver is '{$driver}'");
        }

        $dbhost = config("database.connections.{$dfconn}.host");
        $dbuser = config("database.connections.{$dfconn}.username");
        $dbpass = config("database.connections.{$dfconn}.password");
        $dbname = config("database.connections.{$dfconn}.database");
        $cnames = config("database.connections.{$dfconn}.charset");

        /** @var \PDO $conn */
        $conn = new \PDO(
            "{$driver}:host={$dbhost}", $dbuser, $dbpass,
            [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES '{$cnames}'"]
        );
        /** @var \PDOStatement $statement */
        $stmt = $conn->query("CREATE DATABASE `{$dbname}`");
        if ($stmt) {
            $this->info("Database '{$dbname}' has been created");
        } else {
            $this->error("Couldn't create the database '{$dbname}'. Error: {$stmt->errorInfo()}");
        }
    }
}