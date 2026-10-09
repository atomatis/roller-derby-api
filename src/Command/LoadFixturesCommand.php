<?php

declare(strict_types=1);

namespace App\Command;

use App\Dto\Club as ClubDto;
use App\Dto\Team as TeamDto;
use App\Entity\Club;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\SerializerInterface;

/** @author Alexandre Tomatis <alexandre.tomatis@gmail.com> */
#[AsCommand(name: 'fixtures:load')]
final class LoadFixturesCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly SerializerInterface $serializer,
        ?string $name = null
    ) {
        parent::__construct($name);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $clubMap = [];
//        $this->entityManager->getRepository(Game::class)->cleanAll();
//        $this->entityManager->getRepository(Team::class)->cleanAll();
//        $this->entityManager->getRepository(Club::class)->cleanAll();

        $clubDto = $this->serializer->deserialize(file_get_contents(Fixtures::CLUB_FILE), ClubDto::class.'[]', 'json');

        foreach ($clubDto as $clubIoDto) {
            if ($this->entityManager->find(Club::class, $clubIoDto->getId()) !== null) {
                continue;
            }

            $club = $clubIoDto->toEntity();
            foreach ($clubIoDto->getTeamIds() as $teamId) {
                $clubMap[$teamId][] = $club;
            }
            $this->entityManager->persist($club);
        }

        $teamDto = $this->serializer->deserialize(file_get_contents(Fixtures::TEAM_FILE), TeamDto::class.'[]', 'json');

        foreach ($teamDto as $teamIoDto) {
            if ($this->entityManager->find(Team::class, $teamIoDto->getId()) !== null) {
                continue;
            }

            $team = $teamIoDto->toEntity();

            // TODO FIX it
            $found  = false;
            foreach ($clubMap[$team->getId()] ?? [] as $club) {
                $output->writeln("+");
                $team->setClub($club);
                $found = true;
            }

            if (!$found) {
                continue;
            }

            $this->entityManager->persist($team);
        }

        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}
