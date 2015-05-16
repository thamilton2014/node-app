<?php
/**
 * Summary of file
 */

/**
 * Class By
 */
class By
{

    /**
     * Summary of method set
     *
     * Description of method set
     *
     * @param $array -
     * @return WebDriverBy -
     * @throws Exception
     */
    public static function set($array)
    {
        if($array === NULL)
            throw new Exception("invalid array");
        if (array_key_exists("element_id", $array))
            $element = self::id($array['element_id']);
        elseif (array_key_exists("element_name", $array))
            $element = self::name($array['element_name']);
        elseif (array_key_exists("element_xpath", $array))
            $element = self::xpath($array['element_xpath']);
        elseif (array_key_exists("element_linktext", $array))
            $element = self::linkText($array['element_linktext']);
        elseif (array_key_exists("element_partialinktext", $array))
            $element = self::partialLinkText($array['element_partialinktext']);
        elseif (array_key_exists("element_classname", $array))
            $element = self::className($array['element_classname']);
        elseif (array_key_exists("element_css", $array))
            $element = self::cssSelector($array['element_css']);
        else
            throw new Exception("[By] Error: Cannot find value {$array}");
        return $element;
    }

    /**
     * Summary of function id
     *
     * Description of function id
     *
     * @param $id -
     * @return WebDriverBy -
     */
    private static function id($id)
    {
        return WebDriverBy::id($id);
    }

    /**
     * Summary of function name
     *
     * Description of function name
     *
     * @param $name -
     * @return WebDriverBy -
     */
    private static function name($name)
    {
        return WebDriverBy::name($name);
    }

    /**
     * Summary of function xpath
     *
     * Description of function xpath
     *
     * @param $xpath -
     * @return WebDriverBy -
     */
    private static function xpath($xpath)
    {
        return WebDriverBy::xpath($xpath);
    }

    /**
     * Summary of function
     *
     * Description of function
     *
     * @param $className
     * @return WebDriverBy
     */
    private static function className($className)
    {
        return WebDriverBy::className($className);
    }

    /**
     * Summary of function
     *
     * Description of function
     *
     * @param $cssSelector
     * @return WebDriverBy
     */
    private static function cssSelector($cssSelector)
    {
        return WebDriverBy::cssSelector($cssSelector);
    }

    /**
     * Summary of function
     *
     * Description of function
     *
     * @param $linkText
     * @return WebDriverBy
     */
    private static function linkText($linkText)
    {
        return WebDriverBy::linkText($linkText);
    }

    /**
     * Summary of function
     *
     * Description of function
     *
     * @param $partialLinkText
     * @return WebDriverBy
     */
    private static function partialLinkText($partialLinkText)
    {
        return WebDriverBy::partialLinkText($partialLinkText);
    }
}