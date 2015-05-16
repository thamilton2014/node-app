<?php
/**
 * Class Element
 */
class Element
{
    /**
     * Summary of property
     *
     * @var
     */
    private $driver;

    /**
     * Summary of property
     *
     * @var
     */
    private $locators;

    /**
     * @param $driver
     * @param $locators
     * @throws Exception
     */
    public function __construct($driver, $locators)
    {
        if ($driver === NULL)
            throw new Exception("[Element] invalid driver");
        if ($locators === NULL)
            throw new Exception("[Element] invalid locators");
        $this->driver = $driver;
        $this->locators = $locators;
    }

    /**
     * This method waits for the element to appear.
     *
     * @return string
     */
    public function whenPresent()
    {
        $element = "";
        foreach ($this->locators[0] as $k => $v) {
            if($v != NULL) {
                $locator = By::set([$k => $v]);
                try {
                    $this->driver->wait(20, 250)->until(
                        WebDriverExpectedCondition::presenceOfElementLocated($locator)
                    );
                    $this->driver->wait(15, 250)->until(
                        WebDriverExpectedCondition::visibilityOfElementLocated($locator)
                    );
                    $this->driver->wait(10, 250)->until(
                        WebDriverExpectedCondition::elementToBeClickable($locator)
                    );
                    $this->driver->wait(5, 250)->until(
                        WebDriverExpectedCondition::visibilityOf($this->driver->findElement($locator))
                    );
                    $element = $this->driver->findElement($locator);
                } catch (Exception $e) {
                    print_r("[Element] could not find " . $k . " => " . $v . "\n");
                }
            }
            /**
             * This will be used for multiple values;
             */
//            if (count($this->driver->findElements($locator)) > 0)
//                break;
        }
        return $element;
    }
}