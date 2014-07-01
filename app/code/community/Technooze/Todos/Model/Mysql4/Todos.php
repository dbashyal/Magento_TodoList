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
class Technooze_Todos_Model_Mysql4_Todos extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the todos_id refers to the key field in your database table.
        $this->_init('todos/todos', 'todos_id');
    }
}