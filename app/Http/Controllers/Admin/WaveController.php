<?php

namespace App\Http\Controllers\Admin;

use App\Components\Wave\WaveComponent;
use App\Components\Wave\WaveZombieComponent;
use App\Components\Zombie\ZombieComponent;
use App\Domains\Wave\WaveFactory;
use App\Domains\Wave\WaveID;
use App\Domains\Wave\WaveRepository;
use App\Domains\Wave\Zombie\WaveZombieFactory;
use App\Domains\Zombie\ZombieRepository;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class WaveController extends Controller
{

    /**
     * @var WaveComponent
     */
    private $waveComponent;

    /**
     * @var WaveRepository
     */
    private $waveRepository;

    /**
     * @var ZombieRepository
     */
    private $zombieRepository;

    /**
     * @var ZombieComponent
     */
    private $zombieComponent;

    /**
     * @var WaveFactory
     */
    private $waveFactory;

    /**
     * @var WaveZombieFactory
     */
    private $waveZombieFactory;

    /**
     * @var WaveZombieComponent
     */
    private $waveZombieComponent;

    /**
     * @param WaveComponent $waveComponent
     * @param ZombieComponent $zombieComponent
     * @param WaveFactory $waveFactory
     * @param WaveZombieFactory $waveZombieFactory
     * @param WaveRepository $waveRepository
     * @param ZombieRepository $zombieRepository
     * @param WaveZombieComponent $waveZombieComponent
     */
    public function __construct(
        WaveComponent $waveComponent,
        ZombieComponent $zombieComponent,
        WaveFactory $waveFactory,
        WaveZombieFactory $waveZombieFactory,
        WaveRepository $waveRepository,
        ZombieRepository $zombieRepository,
        WaveZombieComponent $waveZombieComponent
    )
    {
        $this->waveComponent = $waveComponent;
        $this->zombieComponent = $zombieComponent;
        $this->waveFactory = $waveFactory;
        $this->waveZombieFactory = $waveZombieFactory;
        $this->waveRepository = $waveRepository;
        $this->zombieRepository = $zombieRepository;
        $this->waveZombieComponent = $waveZombieComponent;
    }

    public function index()
    {
        $waves = $this->waveComponent->getAllWave();
        return view('admin.wave.list', compact('waves'));
    }

    public function getCreate()
    {
        $mode = 'create';
        $zombies = $this->zombieComponent->getAllZombie();
        return view('admin.wave.form', compact('mode', 'zombies'));
    }

    public function postCreate(Request $request)
    {
        $params = $request->input();
        $wave = $this->waveFactory->makeByArray($params);
        $waveId = $this->waveComponent->addNewWave($wave);

        $zombieIDs = isset($params['wave_zombie']['zombie_id']) ? $params['wave_zombie']['zombie_id'] : array();

        $quantities = isset($params['wave_zombie']['quantity']) ? $params['wave_zombie']['quantity'] : array();

        foreach ($zombieIDs as $index => $zombieID) {
            $data = array(
                'wave_id' => $waveId->getValue(),
                'zombie_id' => $zombieID,
                'quantity' => isset($quantities[$index]) ? $quantities[$index] : 0
            );

            $waveZombie = $this->waveZombieFactory->makeByArray($data, $this->zombieRepository, $this->waveRepository);

            $this->waveZombieComponent->persist($waveZombie);
        }

        return redirect()->route('admin.wave.index');
    }

    public function getUpdate(int $waveID)
    {
        $wave = $this->waveComponent->get(new WaveID($waveID));

        if (is_null($wave)) throw new \Exception('Not Found');

        $default = $wave->toArray();
        $mode = 'update';

        $waveZombies = $this->waveZombieComponent->getByWave($wave);

        $zombies = $this->zombieComponent->getAllZombie();
        return view('admin.wave.form', compact('default', 'mode', 'waveZombies', 'zombies'));
    }

    public function postUpdate(Request $request, int $waveID)
    {

        $wave = $this->waveComponent->get(new WaveID($waveID));

        if (is_null($wave)) throw new \Exception('Not Found');

        $params = $request->input();
        $params['id'] = $waveID;

        $data = $this->waveFactory->makeByArray($params);

        $this->waveComponent->addNewWave($data);

        $this->waveZombieComponent->removeByWave($wave);

        $zombieIDs = isset($params['wave_zombie']['zombie_id']) ? $params['wave_zombie']['zombie_id'] : array();

        $quantities = isset($params['wave_zombie']['quantity']) ? $params['wave_zombie']['quantity'] : array();

        foreach ($zombieIDs as $index => $zombieID) {
            $data = array(
                'wave_id' => $waveID,
                'zombie_id' => $zombieID,
                'quantity' => isset($quantities[$index]) ? $quantities[$index] : 0
            );

            $waveZombie = $this->waveZombieFactory->makeByArray($data, $this->zombieRepository, $this->waveRepository);

            $this->waveZombieComponent->persist($waveZombie);
        }

        return redirect()->route('admin.wave.index');
    }

    public function delete(int $waveID)
    {
        $wave = $this->waveComponent->get(new WaveID($waveID));

        if (is_null($wave)) throw new \Exception('Not Found');

        $this->waveComponent->remove($wave);
        return redirect()->route('admin.wave.index');
    }

}
