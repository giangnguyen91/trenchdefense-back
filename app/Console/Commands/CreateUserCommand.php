<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Database\Connection;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {--id=} {--name=noname}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * @var Connection
     */
    private $conn;

    /**
     * Create a new command instance.
     *
     * @param Connection $conn
     */
    public function __construct(Connection $conn)
    {
        $this->conn = $conn;
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $userID = intval($this->option('id'));
        $name = $this->option('name');

        $debug = config('app.debug');

        if (!$debug) {
            logger()->info('Debug mode disabled, can not create user');
            return 0;
        }

        try {
            $this->conn->beginTransaction();

            // 既存の重複ユーザをチェック
            if (!empty($userID)) {
                $this->checkNoDuplicatedUser($userID);
            }

            $user = \App\User::unguarded(function () use ($userID, $name) {
                return \App\User::query()->updateOrCreate(
                    [
                        'id' => $userID
                    ],
                    [
                        'name' => $name,
                        'imei' => rand(1000000, 999999)
                    ]
                );
            });

            $token = $user->createToken(config('app.name'))->accessToken;

            logger()->info('token '.$token);

            $this->conn->commit();
        } catch (\Exception $e) {
            $this->conn->rollBack();
            $this->error($e->getMessage());
            return 0;
        } catch (\Exception $e) {
            $this->conn->rollBack();
            $this->error("Failed to create user: " . $e->getMessage());
            return 1;
        }

        $this->info("created user. id={$user->id}");
    }

    /**
     * @param int $id
     * @throws \Exception
     */
    private function checkNoDuplicatedUser(int $id)
    {
        $duplicatedAuthUser = User::query()->find($id);
        if (!is_null($duplicatedAuthUser)) {
            throw new \Exception("auth user id={$id} already exists. aborted.", 0);
        }
    }
}
