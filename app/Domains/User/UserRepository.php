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
     * @param ISocialID $imeiId | null
     * @param ISocialID $googleId | null
     * @return User | null
     */
    public function findBySocialId(
        ISocialID $imeiId = null,
        ISocialID $googleId = null
    ): ?User
    {
        $userEloquent = \App\User::query();

        if (!is_null($imeiId)) {
            $userEloquent->where('imei', $imeiId->getValue());
        } else if (!is_null($googleId)) {
            $userEloquent->where('google_id', $googleId->getValue());
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

        $eloquent = \App\User::unguarded(function () use ($user) {
            return \App\User::query()->updateOrCreate(
                [
                    'id' => !is_null($user->getUserId()) ? $user->getUserId()->getValue() : null
                ],
                [
                    'google_id' => !is_null($user->getGoogleId()) ? $user->getGoogleId()->getValue() : null,
                    'imei' => !is_null($user->getImei()) ? $user->getImei()->getValue() : null,
                    'name' => $user->getName()->getValue()
                ]
            );
        });

        return new UserId($eloquent->id);
    }
}