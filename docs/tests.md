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

        $this->getMongoConnection()->collection('orders')
            ->ensureIndex(array('size' => 1));

        $this->explain = $this->getMongoConnection()->collection('orders')->find(array('size' => 'medium'))->explain();
    }
}
```
then run the testsuite from the command line.

``` bash
./vendor/bin/testbench db:test
PHPUnit 4.4.2 by Sebastian Bergmann.

Configuration read from /home/attachmentgenie/Projects/testbench/db-test.xml.dist

tests\TestTbT
 [x] Cursor is btree cursor
 [ ] Query is index only
 [x] Query is not using a multi key index
 [x] Query runs in under 100ms
 [x] Objects scanned equals objects returned
```

This shows that the query and indexes as specified in the example work reasonably well as the query uses a index (cursor is of type Btree)
but is not using a multikey index (there are some range based queries, when using multikey indexes). The query is quite effective as the 
query returns in under 100ms and only needs to scan the same amount of database items as the result set to satisfy the query.
The query isnt however perfect as the result set can not completely statisfied using the index.
