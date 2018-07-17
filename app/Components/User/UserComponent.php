<?php
namespace app\Components\User;

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

    public function __construct(
        UserRepository $userRepository,
        UserFactory $userFactory
    )
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
    }

    public function getUserBySocialId(
        ISocialID $socialID
    ): ?User
    {
        return $this->userRepository->findBySocialId($socialID);
    }

    public function createUser(
        ISocialID $socialID,
        Name $name
    ): UserId
    {
        $user =  $this->userFactory->init($name, $socialID);
        return $this->userRepository->persist($user);
    }

}