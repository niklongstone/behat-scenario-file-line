<?php
/**
 * This file is part of the FileLineFormatter library.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FileLineFormatter;

use Behat\Testwork\Output\Formatter;
use Behat\Testwork\Tester\Setup\Setup;
use Behat\Testwork\Tester\Setup\Teardown;
use Behat\Behat\Output\Node\Printer\SetupPrinter;

class FileLineSetupPrinter implements SetupPrinter
{
    /**
     * {@inheritdoc}
     */
    public function printSetup(Formatter $formatter, Setup $setup)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function printTeardown(Formatter $formatter, Teardown $teardown)
    {
    }
}
