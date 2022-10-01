<?php
/**
 * User: Zura
 * Date: 9/17/2022
 * Time: 6:34 AM
 */

namespace App\Enums;


/**
 * Class OrderStatus
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package App\Enums
 */
enum OrderStatus: string
{
    case Unpaid = 'unpaid';
    case Paid = 'paid';
    case Completed = 'complete';
}
