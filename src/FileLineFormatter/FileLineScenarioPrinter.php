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

use Behat\Behat\Output\Node\Printer\ScenarioPrinter;
use Behat\Gherkin\Node\FeatureNode;
use Behat\Gherkin\Node\ScenarioLikeInterface as Scenario;
use Behat\Testwork\Output\Formatter;
use Behat\Testwork\Tester\Result\TestResult;

/**
 * Prints scenario filename and line.
 *
 * @author Nicola Pietroluongo <nik.longstone@gmail.com>
 */
final class FileLineScenarioPrinter implements ScenarioPrinter
{
    /**
     * @var string
     */
    private $basePath;

    /**
     * FileLineScenarioPrinter constructor.
     *
     * @param string|null $basePath
     */
    public function __construct($basePath = null)
    {
        $this->basePath = $basePath;
    }

    /**
     * {@inheritdoc}
     */
    public function printHeader(Formatter $formatter, FeatureNode $feature, Scenario $scenario)
    {
        $printer = $formatter->getOutputPrinter();
        $fileAndLine = sprintf('%s:%s', $this->relativePath($feature->getFile()), $scenario->getLine());
        $printer->write(sprintf('%s', $fileAndLine));
    }

    /**
     * {@inheritdoc}
     */
    public function printFooter(Formatter $formatter, TestResult $result)
    {
        $formatter->getOutputPrinter()->writeln();
    }

    /**
     * Makes the path relative.
     *
     * @param string $path
     *
     * @return string
     */
    private function relativePath($path)
    {
        if (!$this->basePath) {
            return $path;
        }

        return str_replace($this->basePath . DIRECTORY_SEPARATOR, '', $path);
    }
}