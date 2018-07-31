<?php

namespace App\Http\Controllers;

use App\Components\Auth\IAuthComponent;
use App\Domains\Auth\Credential\CredentialFactory;
use App\Proto\AuthenticateParameter;
use Illuminate\Http\Request;

class AuthenticateController extends Controller
{
    /**
     * @var CredentialFactory
     */
    private $credentialFactory;

    /**
     * @var IAuthComponent
     */
    private $authComponent;

    /**
     * @param CredentialFactory $credentialFactory
     * @param IAuthComponent $authComponent
     */
    public function __construct(
        CredentialFactory $credentialFactory,
        IAuthComponent $authComponent
    )
    {
        $this->credentialFactory = $credentialFactory;
        $this->authComponent = $authComponent;
    }

    public function grantAccesToken(Request $request)
    {
        $parameter = $request->get(AuthenticateParameter::class);
        $accessToken = $parameter->access_code;
        $imei = $parameter->imei;
        $type = $parameter->login_type;

        $credential = $this->credentialFactory->make(
            $accessToken,
            $imei,
            $type
        );

        $auth = $this->authComponent->validate($credential);
        return response()->protobuf([$auth->toProtobuf()]);
    }

}
