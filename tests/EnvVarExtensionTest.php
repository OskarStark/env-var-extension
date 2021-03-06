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

namespace OskarStark\Twig\Tests;

use Ergebnis\Test\Util\Helper;
use OskarStark\Twig\EnvVarExtension;
use PHPUnit\Framework\TestCase;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class EnvVarExtensionTest extends TestCase
{
    use Helper;

    /**
     * @test
     */
    public function extendAbstractExtension(): void
    {
        self::assertClassExtends(
            AbstractExtension::class,
            EnvVarExtension::class
        );
    }

    /**
     * @test
     */
    public function isFinal(): void
    {
        self::assertClassIsFinal(EnvVarExtension::class);
    }

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

    /**
     * @test
     *
     * @dataProvider \Ergebnis\Test\Util\DataProvider\StringProvider::empty()
     * @dataProvider \Ergebnis\Test\Util\DataProvider\StringProvider::blank()
     */
    public function getEnvThrowsExceptionOn(string $value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('String must not be empty');

        $extension = new EnvVarExtension();
        $extension->getEnv($value);
    }

    /**
     * @test
     *
     * @dataProvider \Ergebnis\Test\Util\DataProvider\StringProvider::empty()
     * @dataProvider \Ergebnis\Test\Util\DataProvider\StringProvider::blank()
     */
    public function hasEnvThrowsExceptionOn(string $value): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('String must not be empty');

        $extension = new EnvVarExtension();
        $extension->hasEnv($value);
    }
}
