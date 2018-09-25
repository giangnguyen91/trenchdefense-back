<?php

namespace App\Components\User;


use App\Domains\User\Action\UpdateSettingParameterBuilder;
use App\Domains\User\GameUser;
use App\Domains\User\GameUserID;
use App\Domains\User\GameUserRepository;
use App\Domains\User\Setting\GameSettingRepository;

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
     * @param GameUserRepository $gameUserRepository
     * @param GameSettingRepository $gameSettingRepository
     */
    public function __construct(
        GameUserRepository $gameUserRepository,
        GameSettingRepository $gameSettingRepository
    )
    {
        $this->gameUserRepository = $gameUserRepository;
        $this->gameSettingRepository = $gameSettingRepository;
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
    public function updateSetting(UpdateSettingParameterBuilder $parameter) : void
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
}