<?php

namespace App\Domains\User;

use App\Domains\Auth\Credential\Type;
use Laravel\Passport\PersonalAccessTokenResult;

class UserRepository
{
    /**
     * @var UserFactory
     */
    private $userFactory;

    /**
     * @param UserFactory $userFactory
     */
    public function __construct(
        UserFactory $userFactory
    )
    {
        $this->userFactory = $userFactory;
    }

    /**
     * @param UserId $userId
     * @return User | null
     */
    public function find(
        UserId $userId
    ): ?User
    {
        $userEloquent = \App\User::query()->find($userId->getValue())->first();
        if (is_null($userEloquent)) return null;
        return $this->userFactory->makeByEloquent($userEloquent);
    }

    /**
     * @param ISocialID $socialId
     * @return User | null
     */
    public function findBySocialId(
        ISocialID $socialId
    ): ?User
    {
        $userEloquent = \App\User::query();

        if ($socialId instanceof GoogleId) {
            $userEloquent->where('google_id', $socialId->getValue());
        } else if ($socialId instanceof Imei) {
            $userEloquent->where('imei', $socialId->getValue());
        }
        $userEloquent = $userEloquent->first();

        if (is_null($userEloquent)) return null;
        return $this->userFactory->makeByEloquent($userEloquent);
    }

    /**
     * @param User $user
     * @return UserId
     */
    public function persist(
        User $user
    ): UserId
    {
        $imei = null;
        $googleId = null;

        if($user->getSocialId()->getLoginType()->getValue() == Type::GOOGLE){
            $googleId = $user->getSocialId()->getValue();
        }
        else{
            $imei = $user->getSocialId()->getValue();
        }
        $eloquent = \App\User::unguarded(function () use ($user, $googleId, $imei){
            return \App\User::query()->updateOrCreate(
                [
                    'id' => !is_null($user->getUserId()) ? $user->getUserId()->getValue() : null
                ],
                [
                    'google_id' => $googleId,
                    'imei' => $imei,
                    'name' => $user->getName()->getValue()
                ]
            );
        });

        return new UserId($eloquent->id);
    }
}