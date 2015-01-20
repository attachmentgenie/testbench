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

``` php
<?php
/**
 * Placeholder test
 *
 * PHP version 5
 *
 */

namespace tests;

use attachmentgenie\testbench\mongo\query\TestCase as QueryTestCase;

/**
 * Placeholder test
 *
 */
class TestTbT extends QueryTestCase
{
    public function setUp()
    {
        $this->fixture = array(
            'orders' => array(
                array('size' => 'large', 'toppings' => array('cheese', 'ham')),
                array('size' => 'medium', 'toppings' => array('cheese'))
            )
        );
        parent::setUp();

        $this->getConnection()->collection('orders')
            ->ensureIndex(array('size' => 1));

        $this->explain = $this->getConnection()->collection('orders')->find(array('size' => 'medium'))->explain();
    }
}
```
