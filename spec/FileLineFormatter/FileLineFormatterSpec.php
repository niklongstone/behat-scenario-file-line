<?php
/**
 * This file is part of the FileLineFormatter library.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace spec\FileLineFormatter;

use Behat\Testwork\Output\Formatter;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileLineFormatterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Formatter::class);
    }
}
