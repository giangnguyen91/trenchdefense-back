<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/11/18
 * Time: 14:02
 */

namespace App\Domains\User;

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

    public function __construct(
        $id,
        $name,
        $imei,
        $email = null
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->imei = $imei;
        $this->email = $email;
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
}