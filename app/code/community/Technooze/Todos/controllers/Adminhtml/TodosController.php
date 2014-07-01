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
class Technooze_Todos_Adminhtml_TodosController extends Mage_Adminhtml_Controller_action
{
    protected function _initTodo()
    {
        $this->_title($this->__('To Dos'))->_title($this->__('To Dos'));

        Mage::register('current_todos', Mage::getModel('todos/todos'));
        $todoId = $this->getRequest()->getParam('id');
        if (!is_null($todoId)) {
            Mage::registry('current_todos')->load($todoId);
        }

    }
    /**
     * Todo list.
     */
    public function indexAction()
    {
        $this->_title($this->__('To Dos'))->_title($this->__('To Dos'));

        $this->loadLayout();
        $this->_setActiveMenu('todos/todos');
        $this->_addBreadcrumb(Mage::helper('todos')->__('To Dos'), Mage::helper('todos')->__('To Dos'));
        $this->_addBreadcrumb(Mage::helper('todos')->__('To Dos'), Mage::helper('todos')->__('To Dos'));
        $this->_addContent($this->getLayout()->createBlock('todos/adminhtml_todos'));
        $this->renderLayout();
    }

    /**
     * Edit or create todo.
     */
    public function newAction()
    {
        $this->_title($this->__('To Dos'))->_title($this->__('To Dos'));

        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('id');
        $todo = Mage::getModel('todos/todos');

        // 2. Initial checking
        if ($id) {
            $todo->load($id);
            if (! $todo->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('todos')->__('This to do no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($todo->getId() ? $todo->getTodosTitle() : $this->__('New Todo'));

        // 3. Set entered data if was error when we do save
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $todo->setData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('todos', $todo);

        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);

        $this->_setActiveMenu('todos/todos');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('To Dos'), Mage::helper('adminhtml')->__('To Dos'));

        $this->_addContent($this->getLayout()->createBlock('todos/adminhtml_todos_edit'))
            ->_addLeft($this->getLayout()->createBlock('todos/adminhtml_todos_edit_tabs'));
        $this->renderLayout();
    }

    /**
     * Edit todo action. Forward to new action.
     */
    public function editAction()
    {
        $this->_forward('new');
    }

    /**
     * Create or save todo.
     */
    public function saveAction()
    {
        $todo = Mage::getModel('todos/todos');
        $id = $this->getRequest()->getParam('id');
        if (!is_null($id)) {
            $todo->load((int)$id);
        }
        try {
            if ($data = $this->getRequest()->getPost()){
                $todo->addData($data)->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('todos')->__('The to do has been saved.'));

                // get updated or newly inserted ID
                $data['id'] = $todo->getId();
    
                // if save and continue then reload the edit page
                if ($this->getRequest()->getParam('back'))
                {
                    $this->_redirect('*/*/edit', array('id' => $todo->getId()));
                    return;
                }
                // else redirect to manage log page
                $this->_redirect('*/*/');
                return;
            }
            $this->_redirect('*/*/');
            return;
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setTodoData($todo->getData());
            $this->getResponse()->setRedirect($this->getUrl('*/*/edit', array('id' => $id)));
            return;
        }
    }

    /**
     * Delete todo action
     */
    public function deleteAction()
    {
        $todo = Mage::getModel('todos/todos');
        if ($id = (int)$this->getRequest()->getParam('id')) {
            try {
                $todo->load($id);
                $todo->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('todos')->__('The to do has been deleted.'));
                $this->getResponse()->setRedirect($this->getUrl('*/*/'));
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->getResponse()->setRedirect($this->getUrl('*/*/edit', array('id' => $id)));
                return;
            }
        }

        $this->_redirect('*/*');
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('todos/todos');
    }
}