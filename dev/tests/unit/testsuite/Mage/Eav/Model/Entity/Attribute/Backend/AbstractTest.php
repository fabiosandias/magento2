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
 * @package     Mage_Eav
 * @subpackage  unit_tests
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_Eav_Model_Entity_Attribute_Backend_AbstractTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Mage_Eav_Model_Entity_Attribute_Backend_Abstract|PHPUnit_Framework_MockObject_MockObject
     */
    protected $_model;

    protected function setUp()
    {
        $this->_model = $this->getMockForAbstractClass(
            'Mage_Eav_Model_Entity_Attribute_Backend_Abstract',
            array(),
            '',
            false
        );
    }

    public function testGetAffectedFields()
    {
        $valueId = 10;
        $attributeId = 42;

        $attribute = $this->getMock(
            'Mage_Eav_Model_Entity_Attribute_Abstract',
            array('getBackendTable', 'isStatic', 'getAttributeId'),
            array(),
            '',
            false
        );
        $attribute->expects($this->any())
            ->method('getAttributeId')
            ->will($this->returnValue($attributeId));

        $attribute->expects($this->any())
            ->method('isStatic')
            ->will($this->returnValue(false));

        $attribute->expects($this->any())
            ->method('getBackendTable')
            ->will($this->returnValue('table'));

        $this->_model->setAttribute($attribute);

        $object = new Varien_Object();
        $this->_model->setValueId($valueId);

        $this->assertEquals(
            array(
                'table' => array(array(
                    'value_id' => $valueId,
                    'attribute_id' => $attributeId
                ))
            ),
            $this->_model->getAffectedFields($object)
        );
    }
}
