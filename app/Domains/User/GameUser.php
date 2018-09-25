<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/11/18
 * Time: 14:02
 */

namespace App\Domains\User;

use App\Domains\User\Setting\GameSetting;
use App\Proto\User;

class GameUser
{
    /**
     * @var GameUserID
     */
    private $id;

    /**
     * @var GameUserName
     */
    private $name;

    /**
     * @var GameUserEmail
     */
    private $email;

    /**
     * @var Imei
     */
    private $imei;

    /**
     * @var GameSetting
     */
    private $gameSetting;

    /**
     * @param GameUserID $id
     * @param GameUserName $name
     * @param Imei $imei
     * @param GameSetting $gameSetting | null
     * @param GameUserEmail $email | null
     */
    public function __construct(
        GameUserID $id,
        GameUserName $name,
        Imei $imei,
        GameSetting $gameSetting = null,
        GameUserEmail $email = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->imei = $imei;
        $this->email = $email;
        $this->gameSetting = $gameSetting;
    }

    /**
     * @return GameUserName
     */
    public function getName(): GameUserName
    {
        return $this->name;
    }

    /**
     * @return Imei
     */
    public function getImei(): Imei
    {
        return $this->imei;
    }

    /**
     * @return GameUserEmail|null
     */
    public function getEmail(): ?GameUserEmail
    {
        return $this->email;
    }

    /**
     * @return GameUserID
     */
    public function getID(): GameUserID
    {
        return $this->id;
    }

    /**
     * @param GameUserName $gameUserName
     * @return GameUser
     */
    public function setName(GameUserName $gameUserName) : GameUser
    {
        $this->name = $gameUserName;
        return $this;
    }

    /**
     * @return GameSetting
     */
    public function getGameSetting(): ?GameSetting
    {
        return $this->gameSetting;
    }

    /**
     * @return User
     */
    public function toProtobuf(): User
    {
        $model = new User();
        $model->name = $this->getName()->getValue();
        $model->sfx = !is_null($this->gameSetting) ? $this->gameSetting->getSfx()->getValue() : false;
        $model->bgm = !is_null($this->gameSetting) ? $this->gameSetting->getBgm()->getValue() : false;
        $model->volume = !is_null($this->gameSetting) ? $this->gameSetting->getVolume()->getValue() : 50;
        return $model;
    }
}