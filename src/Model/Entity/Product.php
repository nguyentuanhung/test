<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Product Entity
 * 
 * @author Hung
 *        
 */
class Product extends Entity {
    
    // Make all fields mass assignable for now.
    protected $_accessible = [ '*' => true ];
}