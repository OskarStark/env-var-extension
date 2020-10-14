<?php

declare(strict_types=1);

namespace OskarStark\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class EnvVarExtension extends AbstractExtension
{
    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'env',
                [$this, 'getEnv']
            ),
            new TwigFunction(
                'has_env',
                [$this, 'hasEnv']
            ),
        ];
    }

    /**
     * @return string|false
     */
    public function getEnv(string $env)
    {
        $env = self::validate($env);

        if (!$this->hasEnv($env)) {
            return '';
        }

        return getenv($env);
    }

    public function hasEnv(string $env): bool
    {
        $env = self::validate($env);

        if (getenv($env)) {
            return true;
        }

        return false;
    }

    private static function validate(string $string): string
    {
        $string = trim($string);

        if ('' === $string) {
            throw new \InvalidArgumentException('String must not be empty');
        }

        return $string;
    }
}
