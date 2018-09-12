<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/11/18
 * Time: 14:09
 */

namespace App\Domains\User;


use App\User;

class GameUserFactory
{
    public function make(
        GameUserID $id,
        GameUserName $name,
        Imei $imei,
        GameUserEmail $email = null
    ): GameUser
    {
        return new GameUser($id, $name, $imei, $email);
    }

    public function makeByEloquent(User $userEloquent): GameUser
    {
        $id = new GameUserID($userEloquent->id);
        $name = new GameUserName($userEloquent->name);
        $email = is_null($userEloquent->email) ? null : new GameUserEmail($userEloquent->email);
        $imei = new Imei($userEloquent->imei);
        return $this->make($id, $name, $imei, $email);
    }

    public function initialize(Imei $imei, GameUserName $name = null): GameUser
    {
        $id = new GameUserID();
        $email = null;
        if(is_null($name)){
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