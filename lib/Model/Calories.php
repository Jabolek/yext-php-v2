<?php
/**
 * Calories
 *
 * PHP version 5
 *
 * @category Class
 * @package  Yext\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Yext API
 *
 * 
 *
 * OpenAPI spec version: 2.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Yext\Client\Model;

use \ArrayAccess;

/**
 * Calories Class Doc Comment
 *
 * @category    Class */
/**
 * @package     Yext\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Calories implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Calories';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'calorie' => 'int',
        'range_to' => 'int',
        'name' => 'string'
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'calorie' => 'calorie',
        'range_to' => 'rangeTo',
        'name' => 'name'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'calorie' => 'setCalorie',
        'range_to' => 'setRangeTo',
        'name' => 'setName'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'calorie' => 'getCalorie',
        'range_to' => 'getRangeTo',
        'name' => 'getName'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    const NAME_FIXED = 'FIXED';
    const NAME_RANGE = 'RANGE';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getNameAllowableValues()
    {
        return [
            self::NAME_FIXED,
            self::NAME_RANGE,
        ];
    }
    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['calorie'] = isset($data['calorie']) ? $data['calorie'] : null;
        $this->container['range_to'] = isset($data['range_to']) ? $data['range_to'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        $allowed_values = ["FIXED", "RANGE"];
        if (!in_array($this->container['name'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'name', must be one of #{allowed_values}.";
        }

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properteis are valid
     */
    public function valid()
    {
        $allowed_values = ["FIXED", "RANGE"];
        if (!in_array($this->container['name'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets calorie
     * @return int
     */
    public function getCalorie()
    {
        return $this->container['calorie'];
    }

    /**
     * Sets calorie
     * @param int $calorie Calorie count. Must be greater than or equal to 0 and less than or equal to 1000000.
     * @return $this
     */
    public function setCalorie($calorie)
    {
        $this->container['calorie'] = $calorie;

        return $this;
    }

    /**
     * Gets range_to
     * @return int
     */
    public function getRangeTo()
    {
        return $this->container['range_to'];
    }

    /**
     * Sets range_to
     * @param int $range_to Specified only if `name` is `RANGE`. In that case, this Calories represents a calorie count range from `calorie` to `rangeTo`. Must be greater than `calorie` and less than or equal to 1000000.
     * @return $this
     */
    public function setRangeTo($range_to)
    {
        $this->container['range_to'] = $range_to;

        return $this;
    }

    /**
     * Gets name
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $allowed_values = array('FIXED', 'RANGE');
        if (!is_null($name) && (!in_array($name, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'name', must be one of 'FIXED', 'RANGE'");
        }
        $this->container['name'] = $name;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Yext\Client\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Yext\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}
