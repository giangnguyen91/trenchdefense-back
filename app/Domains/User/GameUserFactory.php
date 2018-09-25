<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/11/18
 * Time: 14:09
 */

namespace App\Domains\User;


use App\Domains\User\Setting\GameSetting;
use App\Domains\User\Setting\GameSettingRepository;
use App\User;

class GameUserFactory
{
    /**
     * @var GameSettingRepository
     */
    private $gameSettingRepository;

    /**
     * @param GameSettingRepository $gameSettingRepository
     */
    public function __construct(
        GameSettingRepository $gameSettingRepository
    )
    {
        $this->gameSettingRepository = $gameSettingRepository;
    }

    /**
     * @param GameUserID $id
     * @param GameUserName $name
     * @param Imei $imei
     * @param GameSetting $gameSetting | null
     * @param GameUserEmail $email | null
     * @return GameUser
     */
    public function make(
        GameUserID $id,
        GameUserName $name,
        Imei $imei,
        GameSetting $gameSetting = null,
        GameUserEmail $email = null
    ): GameUser
    {
        return new GameUser(
            $id,
            $name,
            $imei,
            $gameSetting,
            $email
        );
    }

    /**
     * @param User $userEloquent
     * @return GameUser
     */
    public function makeByEloquent(User $userEloquent): GameUser
    {
        $id = new GameUserID($userEloquent->id);
        $name = new GameUserName($userEloquent->name);
        $email = is_null($userEloquent->email) ? null : new GameUserEmail($userEloquent->email);
        $imei = new Imei($userEloquent->imei);

        $gameSetting = $this->gameSettingRepository->findByID($id);
        return $this->make(
            $id,
            $name,
            $imei,
            $gameSetting,
            $email
        );
    }

    /**
     * @param Imei $imei
     * @param GameUserName $name
     * @return GameUser
     */
    public function initialize(Imei $imei, GameUserName $name = null): GameUser
    {
        $id = new GameUserID();
        $email = null;
        if (is_null($name)) {
            $name = new GameUserName($imei->getValue());
        }

        return $this->make(
            $id,
            $name,
            $imei,
            $email
        );
    }
}