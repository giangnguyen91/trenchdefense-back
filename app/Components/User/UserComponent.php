<?php

namespace App\Components\User;


use App\Domains\User\Action\UpdateSettingParameterBuilder;
use App\Domains\User\GameUser;
use App\Domains\User\GameUserID;
use App\Domains\User\GameUserRepository;
use App\Domains\User\Setting\Bgm;
use App\Domains\User\Setting\GameSetting;
use App\Domains\User\Setting\GameSettingFactory;
use App\Domains\User\Setting\GameSettingRepository;
use App\Domains\User\Setting\Sfx;
use App\Domains\User\Setting\Volume;

class UserComponent
{
    /**
     * @var GameUserRepository
     */
    private $gameUserRepository;

    /**
     * @var GameSettingRepository
     */
    private $gameSettingRepository;

    /**
     * @var GameSettingFactory
     */
    private $gameSettingFactory;

    /**
     * @param GameUserRepository $gameUserRepository
     * @param GameSettingRepository $gameSettingRepository
     * @param GameSettingFactory $gameSettingFactory
     */
    public function __construct(
        GameUserRepository $gameUserRepository,
        GameSettingRepository $gameSettingRepository,
        GameSettingFactory $gameSettingFactory
    )
    {
        $this->gameUserRepository = $gameUserRepository;
        $this->gameSettingRepository = $gameSettingRepository;
        $this->gameSettingFactory = $gameSettingFactory;
    }

    /**
     * @param GameUserID $gameUserID
     * @return GameUser
     */
    public function find(GameUserID $gameUserID): GameUser
    {
        return $this->gameUserRepository->findByID($gameUserID);
    }


    /**
     * @param UpdateSettingParameterBuilder $parameter
     * @return mixed
     */
    public function updateSetting(UpdateSettingParameterBuilder $parameter): void
    {
        $gameUser = $this->find($parameter->getGameUserID());
        if (is_null($gameUser)) throw new \Exception('User Not Found');
        $gameUser = $gameUser->setName($parameter->getName());
        $this->gameUserRepository->persist($gameUser);

        $gameSetting = $gameUser->getGameSetting();
        $gameSetting = $gameSetting->setVolume($parameter->getVolume())
            ->setSfx($parameter->getSfx())
            ->setBgm($parameter->getBgm());
        $this->gameSettingRepository->persist($gameSetting);
    }

    /**
     * @param GameUserID $gameUserID
     * @return GameSetting
     */
    public function initGameSetting(
        GameUserID $gameUserID
    )
    {
        $gameSetting = $this->gameSettingFactory->init(
            $gameUserID,
            new Volume(50),
            new Sfx(false),
            new Bgm(false)
        );

        $this->gameSettingRepository->persist($gameSetting);

        return $gameSetting;
    }
}