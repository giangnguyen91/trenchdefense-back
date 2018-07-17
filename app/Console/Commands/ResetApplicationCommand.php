<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ResetApplicationCommand extends Command
{
    use EnvAwareTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset {--force} {--env=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset application';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->line("<info>Artisan:</info> Reset");

        $force = $this->option('force');

        $this->dropIfExistsAndCreateDatabase(
            env('DB_HOST', '127.0.0.1'),
            env('DB_USERNAME', 'root'),
            env('DB_PASSWORD', 'secret'),
            env('DB_DATABASE', 'trenchdefense'));

        $this->line('');
        $this->line("<info>Artisan: app:reset is All Done!</info>");
    }

    /**
     * @param string $hostName
     * @param string $userName
     * @param string $password
     * @param string $dbName
     */
    protected function dropIfExistsAndCreateDatabase(
        string $hostName,
        string $userName,
        string $password,
        string $dbName)
    {
        /** @var \PDO $pdo */
        $pdo = new \PDO("mysql:host=".$hostName, $userName, $password);
        if ($this->existsDatabase($pdo, $dbName)) {
            $this->dropDatabase($pdo, $dbName);
        }
        $this->createDatabase($pdo, $dbName);
    }

    /**
     * @param \PDO $pdo
     * @param string $dbName
     * @return bool
     */
    protected function existsDatabase(\PDO $pdo, string $dbName)
    {
        $stmt = $pdo->query("SELECT COUNT(*) FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '{$dbName}'");
        return (bool) $stmt->fetchColumn();
    }

    /**
     * @param \PDO $pdo
     * @param string $dbName
     */
    protected function dropDatabase(\PDO $pdo, string $dbName)
    {
        $pdo->exec("drop database {$dbName}");
    }

    /**
     * @param \PDO $pdo
     * @param string $dbName
     */
    protected function createDatabase(\PDO $pdo, string $dbName)
    {
        $pdo->exec("create database {$dbName}");
    }
}
