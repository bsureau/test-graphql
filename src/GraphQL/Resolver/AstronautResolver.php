<?php


namespace App\GraphQL\Resolver;


use App\Repository\AstronautRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class AstronautResolver
 * @package App\GraphQL\Resolver
 */
class AstronautResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var AstronautRepository
     */
    private $astronautRepository;

    /**
     * AstronautResolver constructor.
     * @param AstronautRepository $astronautResolver
     */
    public function __construct(AstronautRepository $astronautResolver)
    {
        $this->astronautRepository = $astronautResolver;
    }

    /**
     * @param int $id
     * @return \App\Entity\Astronaut|null
     */
    public function resolveAstronautById(int $id)
    {
        return $this->astronautRepository->find($id);
    }

    /**
     * @return \App\Entity\Astronaut[]
     */
    public function resolveAllAstronauts()
    {
        return $this->astronautRepository->findAll();
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return [
            'resolveAllAstronauts' => 'Astronauts',
            'resolveAstronautById' => 'Astronaut'
        ];
    }
}