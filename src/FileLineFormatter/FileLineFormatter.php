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

use Behat\Behat\EventDispatcher\Event\ScenarioTested;
use Behat\Behat\Output\Node\EventListener\AST\ScenarioNodeListener;
use Behat\Behat\Output\Printer\ConsoleOutputPrinter;
use Behat\Testwork\EventDispatcher\TestworkEventDispatcher;
use Behat\Testwork\Output\Formatter;
use Behat\Testwork\EventDispatcher\Event\Event;
use Behat\Testwork\Output\Printer\OutputPrinter;

final class FileLineFormatter implements Formatter
{
    const FORMATTER_NAME = 'fileline';
    private $listener;
    private $subscribedEvents;
    private $outputPrinter;

    /**
     * FileLineFormatter constructor.
     */
    public function __construct()
    {
        $this->listener = new ScenarioNodeListener(
            ScenarioTested::AFTER_SETUP,
            ScenarioTested::AFTER,
            new FileLineScenarioPrinter('/'),
            new FileLineSetupPrinter()
        );
        $this->subscribedEvents = array(TestworkEventDispatcher::BEFORE_ALL_EVENTS => 'listenEvent');
        $this->outputPrinter = new ConsoleOutputPrinter();
    }

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return self::subscribedEvents;
    }

    /**
     * Proxies event to the listener.
     *
     * @param Event       $event
     * @param null|string $eventName
     */
    public function listenEvent($event, $eventName = null)
    {
        $eventName = $eventName ?: $event->getName();
        $this->listener->listenEvent($this, $event, $eventName);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::FORMATTER_NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return 'Prints the feature as is.';
    }

    /**
     * {@inheritdoc}
     */
    public function getOutputPrinter()
    {
        return $this->outputPrinter;

    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($name, $value)
    {
        $this->parameters[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter($name)
    {
        return isset($this->parameters[$name]) ? $this->parameters[$name] : null;
    }
}

