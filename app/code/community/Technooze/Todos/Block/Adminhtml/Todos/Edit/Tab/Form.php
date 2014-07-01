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
class Technooze_Todos_Block_Adminhtml_Todos_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $todos_data = Mage::getModel('todos/todos')->load($this->getRequest()->getParam('id'));

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('todos_todos_form', array(
            'legend'=>Mage::helper('todos')->__('Information')
        ));

        $fieldset->addField('todos_status', 'select', array(
            'label'     => Mage::helper('todos')->__('Status'),
            'title'     => Mage::helper('todos')->__('Status'),
            'name'      => 'todos_status',
            'required'  => true,
            'options'   => Mage::helper('todos')->getToDoStatuses(),
        ));

        $fieldset->addField('todos_title', 'text', array(
            'name'      => 'todos_title',
            'label'     => Mage::helper('todos')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
        ));

        $fieldset->addField('todos_description', 'textarea', array(
            'name'      => 'todos_description',
            'label'     => Mage::helper('todos')->__('Description'),
            'class'     => 'required-entry',
            'style'     => 'height:90px',
            'note'      => Mage::helper('todos')->__('You can store todo related information here.'),
        ));
        Mage::dispatchEvent('todos_adminhtml_edit_prepare_form', array('block'=>$this, 'form'=>$form));

        if (Mage::registry('todos_data')) {
            $form->setValues(Mage::registry('todos_data')->getData());
        }

        return parent::_prepareForm();
    }
}
