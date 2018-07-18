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
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(
        Filesystem $files
    )
    {
        parent::__construct();
        $this->files = $files;
    }

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
        $this->flushFacades();

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

    /**
     *  Clear cache framework
     */
    public function flushFacades()
    {
        foreach ($this->files->files(storage_path('framework/cache')) as $file) {
            if (preg_match('/facade-.*\.php$/', $file)) {
                $this->files->delete($file);
            }
        }
    }
}
