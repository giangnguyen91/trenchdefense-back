<?php

namespace App\Http\Controllers;


use App\Components\Auth\AuthComponent;
use App\Components\User\UserComponent;
use App\Domains\User\Action\UpdateSettingParameter;
use App\Domains\User\GameUserName;
use App\Domains\User\Setting\Bgm;
use App\Domains\User\Setting\Sfx;
use App\Domains\User\Setting\Volume;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @var UserComponent
     */
    private $userComponent;

    /**
     * @var AuthComponent
     */
    private $authComponent;

    /**
     * @param AuthComponent $authComponent
     * @param UserComponent $userComponent
     */
    public function __construct(
        AuthComponent $authComponent,
        UserComponent $userComponent
    )
    {
        $this->userComponent = $userComponent;
        $this->authComponent = $authComponent;
    }

    public function get()
    {
        $gameUserID = $this->authComponent->getGameUserId();
        $user = $this->userComponent->find($gameUserID);
        return response()->protobuf(
            [
                $user->toProtobuf()
            ]
        );
    }

    public function update(Request $request)
    {
        $parameter = $request->get(\App\Proto\UpdateSettingParameter::class);
        $gameUserID = $this->authComponent->getGameUserId();

        $beginBattleParameter = (new UpdateSettingParameter())
            ->withName(new GameUserName($parameter->name))
            ->withVolume(new Volume($parameter->volume))
            ->withSfx(new Sfx($parameter->sfx))
            ->withBgm(new Bgm($parameter->bgm))
            ->withGameUserID($gameUserID)
            ->build();

        $this->userComponent->updateSetting($beginBattleParameter);

        return response()->protobuf([]);
    }
}