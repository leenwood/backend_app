<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

#[AsCommand(
    name: 'user:create',
    description: 'Command create user in doctrine',
)]
class UserCreateCommand extends Command
{
    /**
     * @param UserPasswordHasherInterface $passwordEncoder
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private readonly UserPasswordHasherInterface $passwordEncoder,
        private readonly EntityManagerInterface $entityManager
    )
    {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('username', InputArgument::REQUIRED, 'Username')
            ->addArgument('password', InputArgument::REQUIRED, 'Password')
            ->addOption('isAdmin', 'a', InputOption::VALUE_OPTIONAL, 'Add admin role. Input True / False')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $username = $input->getArgument('username');
        $password = $input->getArgument('password');
        $roles = ['ROLE_USER'];

        if($input->getOption('isAdmin')) {
            $roles[] = 'ROLE_ADMIN';
        }

        $newUser = new User();

        $newUser->setUsername($username);
        $newUser->setRoles($roles);
        $newUser->setPassword($this->passwordEncoder->hashPassword($newUser, $password));

        $this->entityManager->persist($newUser);
        $this->entityManager->flush();

        $io->success('User created');
        return Command::SUCCESS;
    }
}
