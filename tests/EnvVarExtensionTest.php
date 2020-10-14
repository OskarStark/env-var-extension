<?php

declare(strict_types=1);

namespace OskarStark\Tests\Twig;

use OskarStark\Twig\EnvVarExtension;
use PHPUnit\Framework\TestCase;
use Twig\TwigFunction;

final class EnvVarExtensionTest extends TestCase
{
    /**
     * @test
     */
    public function numberOfFunctions(): void
    {
        $extension = new EnvVarExtension();

        static::assertCount(2, $extension->getFunctions());
    }

    /**
     * @test
     *
     * @depends numberOfFunctions
     */
    public function functions(): void
    {
        $extension = new EnvVarExtension();

        $functions = $extension->getFunctions();

        $function = $functions[0];
        static::assertInstanceOf(TwigFunction::class, $function);
        static::assertSame('env', $function->getName());

        $function = $functions[1];
        static::assertInstanceOf(TwigFunction::class, $function);
        static::assertSame('has_env', $function->getName());
    }
}
