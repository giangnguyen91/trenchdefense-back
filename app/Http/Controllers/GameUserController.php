<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/11/18
 * Time: 17:15
 */

namespace App\Http\Controllers;


use App\Domains\Auth\TokenRepository;
use App\Domains\User\GameUser;
use App\Domains\User\GameUserFactory;
use App\Domains\User\GameUserRepository;
use App\Domains\User\Imei;
use Illuminate\Http\Request;

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
        $imei = $request->get('imei');
        $gameUser =  $this->gameUserRepository->findByIMEI(new Imei($imei));
        if(is_null($gameUser)){
            $gameUser = $this->createNewGameUser($imei);
        }
        $token = $this->tokenRepository->createTokenForGameUser($gameUser);
        $data = [
            'id' => $token->getTokenID()->getValue(),
            'game_user_id' => $token->getGameUserID()->getValue(),
            'access_token' => $token->getAccessToken()->getValue()

        ];
        return response()->json($data);
    }

    private function createNewGameUser(string $imei): GameUser
    {
        $gameUser = $this->gameUserFactory->initialize(new Imei($imei));
        $gameUserID = $this->gameUserRepository->persist($gameUser);
        return $this->gameUserRepository->findByID($gameUserID);
    }

    public function getInfo(Request $request)
    {
        $loggedInUser = app('auth')->guard()->user();
        return response()->json(['loggedinuserid' => "xxx"]);
    }

}