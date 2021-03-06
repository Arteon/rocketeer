<?php

/*
 * This file is part of Rocketeer
 *
 * (c) Maxime Fabre <ehtnam6@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Rocketeer\Strategies\Dependencies;

use Rocketeer\Binaries\PackageManagers\Bundler;
use Rocketeer\TestCases\RocketeerTestCase;

class BundlerStrategyTest extends RocketeerTestCase
{
    /**
     * @var BundlerStrategy
     */
    protected $bundler;

    public function setUp()
    {
        parent::setUp();

        $bundler = new Bundler($this->container);
        $bundler->setBinary('bundle');

        $this->bundler = $this->builder->buildStrategy('Dependencies', 'Bundler');
        $this->bundler->setBinary($bundler);
    }

    public function testCanInstallDependencies()
    {
        $this->pretend();
        $this->bundler->install();

        $this->assertHistory([
            [
                'cd {server}/releases/{release}',
                'bundle install',
            ],
        ]);
    }

    public function testCanUpdateDependencies()
    {
        $this->pretend();
        $this->bundler->update();

        $this->assertHistory([
            [
                'cd {server}/releases/{release}',
                'bundle update',
            ],
        ]);
    }
}
