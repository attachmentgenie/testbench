<?php
/**
 * Placeholder test
 *
 * PHP version 5
 *
 */

namespace tests;

use attachmentgenie\testbench\mongo\query\TestCase;

/**
 * Placeholder test
 *
 */
class TestTbT extends TestCase
{
    /**
     * Obtain the dataset as specified by the programmer.
     *
     * @return array
     */
    public function getFixtures()
    {
        return array(
            'orders' => array(
                array('size' => 'large', 'toppings' => array('cheese', 'ham')),
                array('size' => 'medium', 'toppings' => array('cheese'))
            )
        );
    }

    /**
     * Obtain the indexes as specified by the programmer.
     *
     * @return array
     */
    public function getIndexes()
    {
        return array(
            'orders' => array(
                array('size' => 1)
            )
        );
    }

    /**
     * Explain query output
     *
     * @return array
     */
    public function setExplain()
    {
        $this->explain = $this->getMongoConnection()->collection('orders')->find(array('size' => 'medium'))->explain();
    }
}
