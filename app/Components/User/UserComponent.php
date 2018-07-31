<?php

namespace app\Components\User;

use App\Domains\User\Exception\UserNotFound;
use App\Domains\User\ISocialID;
use App\Domains\User\Name;
use App\Domains\User\User;
use App\Domains\User\UserFactory;
use App\Domains\User\UserId;
use App\Domains\User\UserRepository;

class UserComponent implements IUserComponent
{
    /**
     * @var UserRepository;
     */
    private $userRepository;

    /**
     * @var UserFactory;
     */
    private $userFactory;

    /**
     * @param UserRepository $userRepository
     * @param UserFactory $userFactory
     */
    public function __construct(
        UserRepository $userRepository,
        UserFactory $userFactory
    )
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    /**
     * @param ISocialID $imeiId | null
     * @param ISocialID $googleId | null
     * @return User | null
     */
    public function getUserBySocialId(
        ISocialID $imeiId = null,
        ISocialID $googleId = null
    ): ?User
    {
        return $this->userRepository->findBySocialId($imeiId, $googleId);
    }

    /**
     * @param ISocialID $imeiId | null
     * @param ISocialID $googleId | null
     * @param Name $name
     * @return UserId
     */
    public function createUser(
        ISocialID $imeiId = null,
        ISocialID $googleId = null,
        Name $name
    ): UserId
    {
        $user = $this->userFactory->init($imeiId, $googleId, $name);
        return $this->userRepository->persist($user);
    }

    /**
     * @param UserId $userId
     * @return User
     * @throws
     */
    public function getUser(
        UserId $userId
    ): User
    {
        $user = $this->userRepository->find($userId);
        if (is_null($user)) {
            throw new UserNotFound('User not found');
        }
        return $user;
    }

    /**
     * @param User $user
     * @return UserId
     */
    public function persist(
        User $user
    ): UserId
    {
        return $this->userRepository->persist($user);
    }

    /**
     * @param Name $name
     * @return User
     */
    /**
     * @param UserId $userId
     * @param Name $name
     * @return User
     * @throws UserNotFound
     */
    public function updateName(
        UserId $userId,
        Name $name
    ): User
    {
        $user = $this->getUser($userId);
        $user->setName($name);
        $this->persist($user);
        return $user;
    }
}