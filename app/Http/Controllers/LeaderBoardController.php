<?php

namespace App\Http\Controllers;

use App\Components\Match\LeaderBoardComponent;
use App\Match\LeaderBoard\LeaderBoard;

class LeaderBoardController extends Controller
{
    /**
     * @var LeaderBoardComponent
     */
    private $leaderBoardComponent;

    /**
     * @param  LeaderBoardComponent $leaderBoardComponent
     */
    public function __construct(
        LeaderBoardComponent $leaderBoardComponent
    )
    {
        $this->leaderBoardComponent = $leaderBoardComponent;
    }

    public function get()
    {
        $leaderBoards = $this->leaderBoardComponent->listTop();

        return response()->protobuf(
            $leaderBoards->map(function (LeaderBoard $leaderBoard) {
                return $leaderBoard->toProtobuf();
            })->toArray()
        );
    }
}