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
class Technooze_Todos_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getToDoStatuses(){
        return array(
            'todo'          => Mage::helper('todos')->__('To Do'),
            'done'          => Mage::helper('todos')->__('Done'),
            'in_progress'   => Mage::helper('todos')->__('In progress'),
            'with_client'   => Mage::helper('todos')->__('Waiting for client\'s Feedback'),
            'with_qa'       => Mage::helper('todos')->__('With QA'),
            'deprecated'    => Mage::helper('todos')->__('Deprecated'),
        );
    }
}
