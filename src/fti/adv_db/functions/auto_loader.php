<?php
/**
 * Created by PhpStorm.
 * User: Marin Kaçaj
 * Date: 6/8/2015
 * Time: 7:22 PM
 */

/**
 * @param string $full_namespace_class_name
 */
function class_auto_loader($full_namespace_class_name)
{
    $full_namespace_class_path = dirname(dirname(dirname(dirname(__FILE__))));
    $namespace_list = explode('\\', $full_namespace_class_name);
    foreach ($namespace_list as $namespace)
    {
        $full_namespace_class_path .= DIRECTORY_SEPARATOR . $namespace;
    }
    $full_namespace_class_path .= '.php' ;
    require_once $full_namespace_class_path;
    unset($namespace);
}