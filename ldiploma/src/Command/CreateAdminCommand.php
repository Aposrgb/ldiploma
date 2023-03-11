<?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateAdminCommand extends Command
{
    public function __construct(
        protected UserRepository              $userRepository,
        protected UserPasswordHasherInterface $hasher
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('create:user:admin')
            ->setDescription('Create default admin');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        <?php

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateAdminCommand extends Command
{
    public function __construct(
        protected UserRepository              $userRepository,
        protected UserPasswordHasherInterface $hasher
    )
    {
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('create:user:admin')
            ->setDescription('Create default admin');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($this->userRepository->findOneBy(['email' => 'admin@admin.com'])) {
            return Command::SUCCESS;
        }
        $user = (new User())
            ->setRoles(['ROLE_ADMIN']);
        $user
            ->setEmail('admin@admin.com')
            ->setPassword($this->hasher->hashPassword($user, 'admin'));

        $this->userRepository->save($user, true);
        return Command::SUCCESS;
    }

}
        $user = (new User())
            ->setRoles(['ROLE_ADMIN']);
        $user
            ->setEmail('admin@admin.com')
            ->setPassword($this->hasher->hashPassword($user, 'admin'));

        $this->userRepository->save($user, true);
        return Command::SUCCESS;
    }

}
