<?php
/**
 * HybridAuth Plugin example config
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 */

$config ['HybridAuth'] = array (
        'providers' => array (
                'OpenID' => array ('enabled' => true ),
                "Google" => array ("enabled" => true,
                        "keys" => array (
                                "id" => "304735334650-h8k4i3hgf1047v40lpnmu73r1429ipd5.apps.googleusercontent.com",
                                "secret" => "Ysmfiy1kQRYtCW3pYFyA8ONG" ) ),
                
                "Facebook" => array ("enabled" => true,
                        "keys" => array ("id" => "886696084724277",
                                "secret" => "3503e6380317ef2c303e42ac7761e0dd" ),
                        "trustForwarded" => false ) ),
        'debug_mode' => ( bool ) Configure::read('debug'),
        'debug_file' => LOGS . 'hybridauth.log' );
