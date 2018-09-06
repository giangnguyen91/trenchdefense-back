<?php

use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * @var array
     */
    private $eloquentClasses = [
        \App\Weapon::class,
        \App\Zombie::class,
        \App\Wave::class,
        \App\WaveZombie::class,
    ];
    /**
     * @var \Illuminate\Database\Connection
     */
    private $conn;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $this->conn = DB::connection('mysql');
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function run()
    {
        $orderdEloquentClasses = collect($this->eloquentClasses);

        try {
            // Since it is truncate rather than delete, foreign key constraints will work regardless of the presence of data, so temporarily cancel
            $this->conn->statement("SET foreign_key_checks=0");
            $orderdEloquentClasses->reverse()->each(function (string $orderedEloquentClass) {
                $this->command->getOutput()->writeln("  <info>Truncating:</info> " . $orderedEloquentClass);
                $orderedEloquentClass::truncate();
                $this->command->getOutput()->writeln("  <info>Truncated:</info> " . $orderedEloquentClass);
            });
        } finally {
            $this->conn->statement("SET foreign_key_checks=1");
        }

        $orderdEloquentClasses->each(function (string $orderedEloquentClass) {
            $this->command->getOutput()->writeln("  <info>Seeding:</info> " . $orderedEloquentClass);
            $this->seed($orderedEloquentClass);
            $this->command->getOutput()->writeln("  <info>Seeded:</info> " . $orderedEloquentClass);
        });
    }

    /**
     * @param string $eloquentClass
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     * @throws Exception
     */
    private function seed(string $eloquentClass)
    {
        $sampleEloquent = new $eloquentClass;

        if (!$sampleEloquent instanceof \Illuminate\Database\Eloquent\Model) {
            throw new \LogicException('Not instance of model class = ' . $eloquentClass);
        }

        $sheet = new \Google\Api\Sheet();
        $items = $sheet->getData($sampleEloquent::GRID_ID);
        foreach ($items as $csv) {
            $eloquents = $sampleEloquent::fromCsvArray($csv);
            $eloquents->each(function (\Illuminate\Database\Eloquent\Model $eloquent) {
                $eloquent->save();
            });
        }

    }
}
