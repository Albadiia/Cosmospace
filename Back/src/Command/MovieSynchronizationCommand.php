<?php

namespace App\Command;

use App\Entity\Movie;
use App\Entity\MovieInfo;
use App\Repository\MovieRepository;
use App\Service\APIRequest;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'movie:synchronization',
    description: 'Add a short description for your command',
)]
class MovieSynchronizationCommand extends Command
{
    public function __construct(
        private APIRequest $apiRequest,
        private MovieRepository $movieRepository,
        private EntityManagerInterface $em
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        //get movie info
        $movies = $this->apiRequest->request('now_playing', 'GET')['results'];

        foreach ($movies as $movie) {
            $title = $movie['title'];
            $overview = $movie['overview'];
            $releaseDate = $movie['release_date'];
            $idAPI = $movie['id'];
            $isAdult = $movie['adult'];
            $voteAverage = $movie['vote_average'];
            $voteCount = $movie['vote_count'];
            $poster = $movie['poster_path'];

            //prevent doublons
            if (!$this->movieRepository->findOneBy(['idAPI' => $idAPI])) {
                $element = new Movie();
                $element->setTitle($title);
                $element->setOverview($overview);
                $element->setReleaseDate(new \DateTime($releaseDate));
                $element->setIdAPI($idAPI);
                $element->setIsAdult($isAdult);
                $element->setVoteAverage($voteAverage);
                $element->setVoteCount($voteCount);
                $element->setPoster($poster);

                $this->em->persist($element);

                //get Movie details
                $movieInfo = $this->apiRequest->request($idAPI, 'GET');
                $genre = $movieInfo['genres'];
                $productionCompany = $movieInfo['production_companies'];
                $productionCountry = $movieInfo['production_countries'];
                $revenue = $movieInfo['revenue'];
                $budget = $movieInfo['budget'];

                $elementInfo = new MovieInfo();
                $elementInfo->setMovie($element);
                $elementInfo->setGenre($genre);
                $elementInfo->setProductionCompany($productionCompany);
                $elementInfo->setProductionCountry($productionCountry);
                $elementInfo->setRevenue($revenue);
                $elementInfo->setBudget($budget);

                $this->em->persist($elementInfo);
            }
        }

        try {
            $this->em->flush();
        } catch (\Throwable $th) {
            throw new Exception($th);
        }

        return Command::SUCCESS;
    }
}
