# Writing Tests

## testbench config file

``` xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit backupGlobals="false"
         backupStaticAttributes="false"
         strict="true"
         verbose="true">

  <testsuites>
    <testsuite name="testbench">
      <directory suffix="TbT.php">tests/testbench</directory>
    </testsuite>
  </testsuites>

</phpunit>
```

## Mongo Explain Test

``` bash
<?php
/**
 * Placeholder test
 *
 * PHP version 5
 *
 */

use attachmentgenie\testbench\mongo\query\TestCase as QueryTestCase;

/**
 * Placeholder test
 *
 */
class TestTbT extends QueryTestCase
{

}
```
