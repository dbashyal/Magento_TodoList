<?php
/**
 * Technooze_Todos Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Technooze
 * @package    Technooze_Todos
 * @author     Damodar Bashyal @dbashyal
 * @copyright  Copyright (c) 2014 dltr.org
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Technooze_Todos_Block_Adminhtml_Todos extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'todos';
        $this->_controller = 'adminhtml_todos';
        $this->_headerText = Mage::helper('todos')->__('Manage To Do List');
        $this->_addButtonLabel = Mage::helper('todos')->__('Add New To Do');
        parent::__construct();
    }
}
