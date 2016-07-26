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

use Behat\Behat\Output\Node\Printer\ScenarioPrinter;
use Behat\Testwork\Output\Printer\OutputPrinter;
use Behat\Testwork\Tester\Result\TestResult;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Behat\Gherkin\Node\FeatureNode;
use Behat\Gherkin\Node\ScenarioLikeInterface as Scenario;
use Behat\Testwork\Output\Formatter;

class FileLineScenarioPrinterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ScenarioPrinter::class);
    }

    function its_printHeader_should_output_file_and_line(Formatter $formatter, FeatureNode $featureNode, Scenario $scenario, OutputPrinter $printer)
    {
        $filename = 'file';
        $lineNumber = 2;
        $formatter->getOutputPrinter()->shouldBeCalled()->willReturn($printer);
        $featureNode->getFile()->shouldBeCalled()->willReturn($filename);
        $scenario->getLine()->shouldBeCalled()->willReturn($lineNumber);
        $printer->write("$filename:$lineNumber")->shouldBeCalled();

        $this->printHeader($formatter, $featureNode, $scenario);
    }

    function its_printHeader_when_basePath_is_specified_should_output_file_and_line_with_relative_path(Formatter $formatter, FeatureNode $featureNode, Scenario $scenario, OutputPrinter $printer)
    {
        $folderName = 'foldername';
        $filename = 'file';
        $lineNumber = 2;
        $this->beConstructedWith($folderName);


        $formatter->getOutputPrinter()->shouldBeCalled()->willReturn($printer);
        $featureNode->getFile()->shouldBeCalled()->willReturn($folderName . '/' . $filename);
        $scenario->getLine()->shouldBeCalled()->willReturn($lineNumber);
        $printer->write("$filename:$lineNumber")->shouldBeCalled();

        $this->printHeader($formatter, $featureNode, $scenario);
    }

    function its_printFooter_should_write_empty_line(Formatter $formatter, OutputPrinter $printer, TestResult $testResult)
    {
        $printer->writeln()->shouldBeCalled();
        $formatter->getOutputPrinter()->shouldBecalled()->willReturn($printer);

        $this->printFooter($formatter, $testResult);
    }
}
