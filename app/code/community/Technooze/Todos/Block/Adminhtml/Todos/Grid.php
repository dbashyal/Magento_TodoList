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
class Technooze_Todos_Block_Adminhtml_Todos_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('todosGrid');
        $this->setDefaultSort('todos_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel('todos/todos')->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addExportType('*/*/exportCsv',
                 Mage::helper('todos')->__('CSV'));

        $this->addColumn('todos_id', array(
            'header'    => Mage::helper('todos')->__('ID'),
            'align'     => 'right',
            'width'     => '50px',
            'index'     => 'todos_id',
            'type'      => 'number',
        ));

        $this->addColumn('todos_title', array(
            'header'    => Mage::helper('todos')->__('Title'),
            'align'     => 'left',
            'index'     => 'todos_title',
        ));

        $this->addColumn('todos_status', array(
            'header'    => Mage::helper('todos')->__('Status'),
            'index'     => 'todos_status',
            'type'      =>  'options',
            'options'     => Mage::helper('todos')->getToDoStatuses(),
        ));
        Mage::dispatchEvent('todos_adminhtml_grid_prepare_columns', array('block'=>$this));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('todos_id');
        $this->getMassactionBlock()->setFormFieldName('todos');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('todos')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('todos')->__('Are you sure?')
        ));
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}
