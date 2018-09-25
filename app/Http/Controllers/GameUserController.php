<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/11/18
 * Time: 17:15
 */

namespace App\Http\Controllers;


use App\Components\Auth\AuthComponent;
use App\Domains\Auth\TokenRepository;
use App\Domains\User\GameUser;
use App\Domains\User\GameUserFactory;
use App\Domains\User\GameUserRepository;
use App\Domains\User\Imei;
use App\Proto\AccessCode;
use Illuminate\Http\Request;
use App\Proto\RequestAccessTokenParameter;

class GameUserController extends Controller
{
    /**
     * @var GameUserRepository
     */
    private $gameUserRepository;

    /**
     * @var GameUserFactory
     */
    private $gameUserFactory;

    /**
     * @var TokenRepository
     */
    private $tokenRepository;

    /**
     * @var AuthComponent
     */
    private $authComponent;

    public function __construct(
        GameUserRepository $gameUserRepository,
        GameUserFactory $gameUserFactory,
        TokenRepository $tokenRepository
    )
    {
        $this->gameUserRepository = $gameUserRepository;
        $this->gameUserFactory = $gameUserFactory;
        $this->tokenRepository = $tokenRepository;
    }

    public function createAccessToken(Request $request)
    {
        $requestAccessTokenParameter = $request->get(RequestAccessTokenParameter::class);
        $gameUser =  $this->gameUserRepository->findByIMEI(new Imei($requestAccessTokenParameter->imei));
        if(is_null($gameUser)){
            $gameUser = $this->createNewGameUser($requestAccessTokenParameter->imei);
        }
        $token = $this->tokenRepository->createTokenForGameUser($gameUser);

        $accessCode = new AccessCode();
        $accessCode->tokenID = $token->getTokenID()->getValue();
        $accessCode->gameUserID = $token->getGameUserID()->getValue();
        $accessCode->token = $token->getAccessToken()->getValue();

        return response()->protobuf([$accessCode]);
    }

    private function createNewGameUser(string $imei): GameUser
    {
        $gameUser = $this->gameUserFactory->initialize(new Imei($imei));
        $gameUserID = $this->gameUserRepository->persist($gameUser);
        return $this->gameUserRepository->findByID($gameUserID);
    }

    public function getInfo(Request $request)
    {
        $loggedInUserID = $this->authComponent->getGameUserId();
        $gameUser = $this->gameUserRepository->findByID($loggedInUserID);
        return response()->protobuf([$gameUser->toProtobuf()]);
    }

}