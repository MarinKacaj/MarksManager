<?php
/**
 * Created by PhpStorm.
 * User: C.R.C
 * Date: 6/8/2015
 * Time: 10:02 PM
 */

namespace fti\adv_db\dom\util;


class AttributeBuilder
{

    /**
     * @param array $classNames
     * @return string
     */
    public static function buildFullClassName($classNames)
    {
        $fullClassName = '';
        $prependWhitespace = false;

        foreach ($classNames as $className) {
            if (true === $prependWhitespace) {
                $fullClassName .= ' ' . $className;
            } else {
                $fullClassName .= $className;
                $prependWhitespace = true;
            }
        }
        unset($className);

        return $fullClassName;
    }
}