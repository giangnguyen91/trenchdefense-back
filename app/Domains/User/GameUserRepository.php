<?php

namespace App\Domains\User;

use App\User;
use App\WeaponGroup as WeaponGroupEloquent;
use Illuminate\Support\Collection;
use App\User as UserEloquent;
use Illuminate\Support\Facades\Hash;

class GameUserRepository
{
    /**
     * @var GameUserFactory
     */
    private $gameUserFactory;

    public function __construct( GameUserFactory $gameUserFactory )
    {
        $this->gameUserFactory = $gameUserFactory;
    }

    /**
     * @param GameUserID $gameUserID
     * @return GameUser|null
     */
    public function findByID(GameUserID $gameUserID): ?GameUser
    {
        $gameUserEloquent = User::find($gameUserID->getValue());
        if(is_null($gameUserEloquent)) return null;

        return $this->gameUserFactory->makeByEloquent($gameUserEloquent);
    }

    /**
     * Find game user by IMEI
     * @param Imei $imei
     * @return GameUser|null
     */
    public function findByIMEI(Imei $imei): ?GameUser
    {
        $gameUserEloquent = User::where("imei", "=", $imei->getValue())->first();
        if(is_null($gameUserEloquent)) return null;

        return $this->gameUserFactory->makeByEloquent($gameUserEloquent);
    }

    /**
     * @param GameUser $gameUser
     * @return GameUserID
     */
    public function persist(GameUser $gameUser): GameUserID
    {
        $eloquent = UserEloquent::unguarded(function() use ($gameUser){
            return UserEloquent::query()->updateOrCreate(
                [
                    'id' => is_null($gameUser->getID()->getValue()) ? null : $gameUser->getID()->getValue()
                ],
                [
                    'name' => $gameUser->getName()->getValue(),
                    'email' => is_null($gameUser->getEmail()) ? null : $gameUser->getEmail()->getValue(),
                    'imei' => $gameUser->getImei()->getValue(),
                    'password' => Hash::make($gameUser->getImei()->getValue())
                ]
            );
        });
        return new GameUserID($eloquent->id);
    }
}