<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Mage_Core
 * @subpackage  unit_tests
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Mage_Core_Model_ShellAbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Mage_Core_Model_ShellAbstract|PHPUnit_Framework_MockObject_MockObject
     */
    protected $_model;

    public function setUp()
    {
        $this->_model = $this->getMockForAbstractClass(
            'Mage_Core_Model_ShellAbstract',
            array(array()),
            '',
            true,
            true,
            true,
            array('_applyPhpVariables')
        );
    }

    public function tearDown()
    {
        unset($this->_model);
    }

    /**
     * @param array $arguments
     * @param string $argName
     * @param string $expectedValue
     *
     * @dataProvider setGetArgDataProvider
     */
    public function testSetGetArg($arguments, $argName, $expectedValue)
    {
        $this->_model->setRawArgs($arguments);
        $this->assertEquals($this->_model->getArg($argName), $expectedValue);
    }

    /**
     * @return array
     */
    public function setGetArgDataProvider()
    {
        return array(
            'argument with no value' => array(
                'arguments' => array(
                    'argument', 'argument2'
                ),
                'argName' => 'argument',
                'expectedValue' => true
            ),
            'dashed argument with value' => array(
                'arguments' => array(
                    '-argument',
                    'value'
                ),
                'argName' => 'argument',
                'expectedValue' => 'value'
            ),
            'double-dashed argument with separate value' => array(
                'arguments' => array(
                    '--argument-name',
                    'value'
                ),
                'argName' => 'argument-name',
                'expectedValue' => 'value'
            ),
            'double-dashed argument with included value' => array(
                'arguments' => array(
                    '--argument-name=value'
                ),
                'argName' => 'argument-name',
                'expectedValue' => 'value'
            ),
            'argument with value, then single argument with no value' => array(
                'arguments' => array(
                    '-argument',
                    'value',
                    'argument2'
                ),
                'argName' => 'argument',
                'expectedValue' => 'value'
            ),
        );
    }
}
