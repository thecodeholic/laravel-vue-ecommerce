<?php
/**
 * User: Zura
 * Date: 9/17/2022
 * Time: 6:34 AM
 */

namespace App\Enums;


/**
 * Class AddressTypoe
 *
 * @author  Zura Sekhniashvili <zurasekhniashvili@gmail.com>
 * @package App\Enums
 */
enum AddressType
{
    case Shipping;
    case Billing;
}
