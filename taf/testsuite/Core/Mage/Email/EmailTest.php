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
 * @category    tests
 * @package     selenium
 * @subpackage  tests
 * @author      Magento Core Team <core@magentocommerce.com>
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Test creation new customer from Backend
 *
 * @package     selenium
 * @subpackage  tests
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Core_Mage_Email_EmailTest extends Mage_Selenium_TestCase
{
    /**
     * <p>Preconditions:</p>
     * <p>Navigate to System -> Manage Customers</p>
     */
    protected function assertPreConditions()
    {
        $this->loginAdminUser();
        $this->navigate('system_email_template');
    }

    /**
     *
     * @test
     */
    public function navigation()
    {
        $this->assertTrue($this->buttonIsPresent('add_new_template'),
            'There is no "Add New Template" button on the page');
        $this->clickButton('add_new_template');
        $this->assertTrue($this->checkCurrentPage('create_template'), $this->getParsedMessages());
        $this->assertTrue($this->buttonIsPresent('back'), 'There is no "Back" button on the page');
        $this->assertTrue($this->buttonIsPresent('save_template'), 'There is no "Save" button on the page');
        $this->assertTrue($this->buttonIsPresent('reset'), 'There is no "Reset" button on the page');
    }

    /**
     *
     * @test
     * @depends navigation
     */
    public function createTransactionalEmail()
    {
        $data = $this->loadDataSet('Email', 'create_new_transactional_email');
        $this->emailHelper()->createTemplate($data);
        $this->assertMessagePresent('success', 'success_saved_template');
    }
}