<?php declare(strict_types=1);

namespace Nuvola\CQRS\Utils\NameResolver;

use InvalidArgumentException;
use function class_exists;
use function get_class;
use function is_object;
use function preg_match;
use function sprintf;

class FqcnNameResolver implements NameResolverInterface
{
    public function resolve($input): string
    {
        $this->validate($input);

        if (is_object($input)) {
            $input = get_class($input);
        }

        preg_match('/(?<name>[^\\\]+)(?:Query|Command)(?:Handler)?$/', $input, $matches);

        if (false === isset($matches['name'])) {
            throw new InvalidArgumentException(sprintf('Input "%s" could not be resolved!', $input));
        }

        return $matches['name'];
    }

    private function validate($input): void
    {
        if (is_object($input)) {
            return;
        }

        if (class_exists($input)) {
            return;
        }

        throw new InvalidArgumentException('Input is not valid!');
    }
}
