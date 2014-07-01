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
class Technooze_Todos_Block_Adminhtml_Todos_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('todos_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('todos')->__('Manage To Do'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label'     => Mage::helper('todos')->__('Todo Information'),
            'title'     => Mage::helper('todos')->__('Todo Information'),
            'content'   => $this->getLayout()->createBlock('todos/adminhtml_todos_edit_tab_form')->toHtml(),
        ));

        return parent::_beforeToHtml();
    }
}
