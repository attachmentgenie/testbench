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
