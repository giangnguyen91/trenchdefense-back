<?php
/**
 * Created by PhpStorm.
 * User: luan.tran
 * Date: 9/13/18
 * Time: 14:59
 */

namespace App\Http\Controllers;


use App\Domains\Character\Character;
use App\Domains\Character\CharacterRepository;

class CharacterController extends Controller
{
    private $characterRepository;

    public function __construct(
        CharacterRepository $characterRepository
    )
    {
        $this->characterRepository = $characterRepository;
    }

    public function get()
    {
        $characters = $this->characterRepository->all();

        return response()->protobuf(
            $characters->map(function (Character $character) {
                return $character->toProtobuf();
            })->toArray()
        );
    }
}