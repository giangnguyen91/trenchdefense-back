<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class ResetApplicationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset';

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

        $this->dropIfExistsAndCreateDatabase(
            env('DB_HOST', '127.0.0.1'),
            env('DB_USERNAME', 'root'),
            env('DB_PASSWORD', 'secret'),
            env('DB_DATABASE', 'trenchdefense'));

        //Flush cache redis
        $redis = config('database.redis');
        unset($redis['client']);

        foreach ($redis as $redisCluster) {
            $this->doFlushAll($redisCluster['host'], $redisCluster['port'], $redisCluster['database']);
        }

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
        $pdo = new \PDO("mysql:host=" . $hostName, $userName, $password);
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
        return (bool)$stmt->fetchColumn();
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

    /**
     * @param string $host
     * @param string $port
     * @param int $database
     */
    private function doFlushAll(
        string $host,
        string $port,
        int $database
    ): void
    {
        $redis = new \Predis\Client(
            [
                'scheme' => 'tcp',
                'host' => $host,
                'port' => $port,
                'database' => $database
            ]
        );
        $redis->flushall();
    }
}
