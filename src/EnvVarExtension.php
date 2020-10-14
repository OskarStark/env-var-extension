<?php

declare(strict_types=1);

/*
 * This file is part of oskarstark/env-var-extension.
 *
 * (c) Oskar Stark <oskarstark@googlemail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
