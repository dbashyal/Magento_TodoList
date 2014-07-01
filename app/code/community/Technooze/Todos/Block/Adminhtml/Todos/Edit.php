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
class Technooze_Todos_Block_Adminhtml_Todos_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'todos';
        $this->_controller = 'adminhtml_todos';

        $this->_updateButton('save', 'label', Mage::helper('todos')->__('Save To do'));
        $this->_updateButton('delete', 'label', Mage::helper('todos')->__('Delete To do'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";

		if( $this->getRequest()->getParam($this->_objectId) ) {
            $model = Mage::getModel('todos/todos')
                ->load($this->getRequest()->getParam($this->_objectId));
            Mage::register('todos_data', $model);
        }

    }

    public function getHeaderText()
    {
        if( Mage::registry('todos_data') && Mage::registry('todos_data')->getId() ) {
            return Mage::helper('todos')->__("Edit %s", $this->escapeHtml(Mage::registry('todos_data')->getTodoTitle()));
        } else {
            return Mage::helper('todos')->__('New To Do');
        }
    }
}
