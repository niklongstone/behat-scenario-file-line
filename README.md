# Behat File:Line output formatter

A Behat 3 output formatter which shows a list of scenarios with filename and line.  
i.e.: `feature/feature/MyScenario/login.feature:2`

### Installation
#### Require the library via [Composer](https://getcomposer.org/)
`composer require niklongstone/behat-scenario-file-line:dev-master`

#### Add the formatter to your `behat.yml`:
```
default:
    formatters:
        Behat\Behat\Output\Node\Printer\Digest\DigestFormatter:
```
#### From the command line run:  
`bin/behat --dry-run` to list the scenarios files with lines.
