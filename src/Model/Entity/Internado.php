<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Auth\LegacyPasswordHasher;

class Internado extends Entity
{

    // Define os campos acessíveis
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];

}
