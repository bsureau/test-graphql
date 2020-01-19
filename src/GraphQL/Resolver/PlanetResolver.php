<?php


namespace App\GraphQL\Resolver;


use App\Entity\Astronaut;
use App\Repository\PlanetRepository;
use Overblog\GraphQLBundle\Definition\Resolver\AliasedInterface;
use Overblog\GraphQLBundle\Definition\Resolver\ResolverInterface;

/**
 * Class PlanetResolver
 * @package App\Resolver
 */
class PlanetResolver implements ResolverInterface, AliasedInterface
{
    /**
     * @var PlanetRepository
     */
    private $planetRepository;

    /**
     * PlanetResolver constructor.
     * @param PlanetRepository $planetRepository
     */
    public function __construct(PlanetRepository $planetRepository)
    {
        $this->planetRepository = $planetRepository;
    }

    /**
     * @param int $id
     * @return \App\Entity\Planet|null
     */
    public function resolve(int $id)
    {
           return $this->planetRepository->find($id);
    }

    /**
     * @inheritDoc
     */
    public static function getAliases(): array
    {
        return [
            'resolve' => 'Planet'
        ];
    }
}