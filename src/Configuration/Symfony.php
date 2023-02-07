<?php

/**
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ecphp
 */

declare(strict_types=1);

namespace EcPhp\CasBundle\Configuration;

use EcPhp\CasLib\Configuration\Properties as PsrCasConfiguration;
use EcPhp\CasLib\Contract\Configuration\PropertiesInterface;
use ReturnTypeWillChange;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

use const FILTER_VALIDATE_URL;

final class Symfony implements PropertiesInterface
{
    private readonly PropertiesInterface $cas;

    public function __construct(
        ParameterBagInterface $parameterBag,
        private readonly RouterInterface $router
    ) {
        $this->cas = new PsrCasConfiguration(
            $this->routeToUrl(
                $parameterBag->get('cas')
            )
        );
    }

    public function all(): array
    {
        return $this->cas->all();
    }

    #[ReturnTypeWillChange]
    public function offsetExists(mixed $offset): bool
    {
        return $this->cas->offsetExists($offset);
    }

    /**
     * @return array<string, mixed>|mixed
     */
    #[ReturnTypeWillChange]
    public function offsetGet(mixed $offset)
    {
        return $this->cas->offsetGet($offset);
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->cas->offsetSet($offset, $value);
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->cas->offsetUnset($offset);
    }

    /**
     * Transform Symfony routes into absolute URLs.
     *
     * @param array<string, mixed> $properties
     *   The properties.
     *
     * @return array<string, mixed>
     *   The updated properties.
     */
    private function routeToUrl(array $properties): array
    {
        $properties = $this->updateDefaultParameterRouteToUrl(
            $properties,
            'pgtUrl'
        );

        return $this->updateDefaultParameterRouteToUrl(
            $properties,
            'service'
        );
    }

    /**
     * @param array<string, mixed> $properties
     *
     * @return array<string, mixed>
     */
    private function updateDefaultParameterRouteToUrl(array $properties, string $key): array
    {
        foreach ($properties['protocol'] as $protocolKey => $protocol) {
            if (false === isset($protocol['default_parameters'][$key])) {
                continue;
            }

            $route = $protocol['default_parameters'][$key];

            if (false === filter_var($route, FILTER_VALIDATE_URL)) {
                $route = $this
                    ->router
                    ->generate(
                        $route,
                        [],
                        UrlGeneratorInterface::ABSOLUTE_URL
                    );

                $properties['protocol'][$protocolKey]['default_parameters'][$key] = $route;
            }
        }

        return $properties;
    }
}
