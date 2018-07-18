<?php

namespace App\Http\Controllers;

use App\Components\Auth\IAuthComponent;
use App\Components\User\IUserComponent;
use App\Domains\Auth\AccessToken;
use App\Proto\LinkSocialParameter;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var IAuthComponent
     */
    private $authComponent;

    /**
     * @var IUserComponent
     */
    private $userComponent;

    /**
     * @param IAuthComponent $authComponent
     * @param IUserComponent $userComponent
     */
    public function __construct(
        IAuthComponent $authComponent,
        IUserComponent $userComponent
    )
    {
        $this->authComponent = $authComponent;
        $this->userComponent = $userComponent;
    }

    public function getMySelf(Request $request)
    {
        $userId = $this->authComponent->getUserId();
        $user = $this->userComponent->getUser($userId);
        return response()->protobuf([$user->toProtobuf()]);
    }

    public function linkSocial(Request $request)
    {
        $parameter = $request->get(LinkSocialParameter::class);
        $user = $this->authComponent->doLinkSocial(new AccessToken($parameter->access_code));
        return response()->protobuf([$user->toProtobuf()]);
    }
}
