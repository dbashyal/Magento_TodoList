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
/* @var $installer Mage_Catalog_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table 'todos'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('todos'))
    ->addColumn('todos_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Todo Id')
    ->addColumn('todos_title', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Todo Title')
    ->addColumn('todos_description', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
        ), 'Todo Description')
    ->addColumn('todos_status', Varien_Db_Ddl_Table::TYPE_INTEGER, 1, array(
          'nullable'    => false,
          'default'     => 2,
          ), 'Todo Status')
    ->setComment('Todos');
$installer->getConnection()->createTable($table);
$installer->endSetup();

// insert default todo
$installer->getConnection()->insertForce($installer->getTable('todos'), array(
    'todos_id'           => 1,
    'todos_status'       => 0,
    'todos_title'        => 'Create School Manager',
    'todos_description'  => 'Create school manager with functionality to associate it to school group',
));
