<?php


namespace App\GraphQL\Mutation;


use App\Entity\Astronaut;
use App\Repository\GradeRepository;
use App\Repository\PlanetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\MutationInterface;

/**
 * Class AstronautMutation
 * @package App\GraphQL\Mutation
 */
class AstronautMutation implements MutationInterface, AliasedInterface
{
    /**
     * @var GradeRepository
     */
    private $gradeRepository;

    /**
     * @var PlanetRepository
     */
    private $planetRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * AstronautMutation constructor.
     * @param GradeRepository $gradeRepository
     * @param PlanetRepository $planetRepository
     * @param EntityManagerInterface $em
     */
    public function __construct(GradeRepository $gradeRepository, PlanetRepository $planetRepository, EntityManagerInterface $em)
    {
        $this->gradeRepository = $gradeRepository;
        $this->planetRepository = $planetRepository;
        $this->em = $em;
    }

    /**
     * @param string $pseudonym
     * @param int $gradeId
     * @param int $planetId
     * @return array
     */
    public function newAstronaut(string $pseudonym, int $gradeId, int $planetId): array
    {
        $astronaut = new Astronaut();
        $astronaut->setPseudo($pseudonym);
        $grade = $this->gradeRepository->find($gradeId);
        $astronaut->setGrade($grade);
        $planet = $this->planetRepository->find($planetId);
        $astronaut->setPlanet($planet);

        $this->em->persist($astronaut);
        $this->em->flush();

        return [
            'astronaut' => $astronaut
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getAliases(): array
    {
        return [
            // `NewAstronaut` is the name of the mutation that you SHOULD use inside of your types definition
            // `newAstronaut` is the method that will be executed when you call `@=resolver('NewAstronaut')`
            'newAstronaut' => 'NewAstronaut'
        ];
    }
}