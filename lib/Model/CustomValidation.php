<?php
/**
 * CustomValidation
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
 * CustomValidation Class Doc Comment
 *
 * @category    Class */
 // @description A Custom Field validation object, describing validation rules when a Custom Field value is set or updated.
/**
 * @package     Yext\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class CustomValidation implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'CustomValidation';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'max_date' => 'string',
        'min_height' => 'int',
        'max_value' => 'float',
        'min_value' => 'float',
        'min_width' => 'int',
        'min_char_length' => 'int',
        'max_item_count' => 'int',
        'min_item_count' => 'int',
        'max_char_length' => 'int',
        'aspect_ratio' => 'string',
        'min_date' => 'string'
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
        'max_date' => 'maxDate',
        'min_height' => 'minHeight',
        'max_value' => 'maxValue',
        'min_value' => 'minValue',
        'min_width' => 'minWidth',
        'min_char_length' => 'minCharLength',
        'max_item_count' => 'maxItemCount',
        'min_item_count' => 'minItemCount',
        'max_char_length' => 'maxCharLength',
        'aspect_ratio' => 'aspectRatio',
        'min_date' => 'minDate'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'max_date' => 'setMaxDate',
        'min_height' => 'setMinHeight',
        'max_value' => 'setMaxValue',
        'min_value' => 'setMinValue',
        'min_width' => 'setMinWidth',
        'min_char_length' => 'setMinCharLength',
        'max_item_count' => 'setMaxItemCount',
        'min_item_count' => 'setMinItemCount',
        'max_char_length' => 'setMaxCharLength',
        'aspect_ratio' => 'setAspectRatio',
        'min_date' => 'setMinDate'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'max_date' => 'getMaxDate',
        'min_height' => 'getMinHeight',
        'max_value' => 'getMaxValue',
        'min_value' => 'getMinValue',
        'min_width' => 'getMinWidth',
        'min_char_length' => 'getMinCharLength',
        'max_item_count' => 'getMaxItemCount',
        'min_item_count' => 'getMinItemCount',
        'max_char_length' => 'getMaxCharLength',
        'aspect_ratio' => 'getAspectRatio',
        'min_date' => 'getMinDate'
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

    const ASPECT_RATIO_UNCONSTRAINED = 'UNCONSTRAINED';
    const ASPECT_RATIO__11 = '1:1';
    const ASPECT_RATIO__43 = '4:3';
    const ASPECT_RATIO__32 = '3:2';
    const ASPECT_RATIO__53 = '5:3';
    const ASPECT_RATIO__169 = '16:9';
    const ASPECT_RATIO__31 = '3:1';
    const ASPECT_RATIO__23 = '2:3';
    const ASPECT_RATIO__57 = '5:7';
    const ASPECT_RATIO__45 = '4:5';
    const ASPECT_RATIO__41 = '4:1';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getAspectRatioAllowableValues()
    {
        return [
            self::ASPECT_RATIO_UNCONSTRAINED,
            self::ASPECT_RATIO__11,
            self::ASPECT_RATIO__43,
            self::ASPECT_RATIO__32,
            self::ASPECT_RATIO__53,
            self::ASPECT_RATIO__169,
            self::ASPECT_RATIO__31,
            self::ASPECT_RATIO__23,
            self::ASPECT_RATIO__57,
            self::ASPECT_RATIO__45,
            self::ASPECT_RATIO__41,
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
        $this->container['max_date'] = isset($data['max_date']) ? $data['max_date'] : null;
        $this->container['min_height'] = isset($data['min_height']) ? $data['min_height'] : null;
        $this->container['max_value'] = isset($data['max_value']) ? $data['max_value'] : null;
        $this->container['min_value'] = isset($data['min_value']) ? $data['min_value'] : null;
        $this->container['min_width'] = isset($data['min_width']) ? $data['min_width'] : null;
        $this->container['min_char_length'] = isset($data['min_char_length']) ? $data['min_char_length'] : null;
        $this->container['max_item_count'] = isset($data['max_item_count']) ? $data['max_item_count'] : null;
        $this->container['min_item_count'] = isset($data['min_item_count']) ? $data['min_item_count'] : null;
        $this->container['max_char_length'] = isset($data['max_char_length']) ? $data['max_char_length'] : null;
        $this->container['aspect_ratio'] = isset($data['aspect_ratio']) ? $data['aspect_ratio'] : null;
        $this->container['min_date'] = isset($data['min_date']) ? $data['min_date'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        $allowed_values = ["UNCONSTRAINED", "1:1", "4:3", "3:2", "5:3", "16:9", "3:1", "2:3", "5:7", "4:5", "4:1"];
        if (!is_null($this->container['aspect_ratio']) && !in_array($this->container['aspect_ratio'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'aspect_ratio', must be one of #{allowed_values}.";
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
        $allowed_values = ["UNCONSTRAINED", "1:1", "4:3", "3:2", "5:3", "16:9", "3:1", "2:3", "5:7", "4:5", "4:1"];
        if (!is_null($this->container['aspect_ratio']) && !in_array($this->container['aspect_ratio'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets max_date
     * @return string
     */
    public function getMaxDate()
    {
        return $this->container['max_date'];
    }

    /**
     * Sets max_date
     * @param string $max_date Maximum date, accepted as 'YYYY-MM-DD'.
     * @return $this
     */
    public function setMaxDate($max_date)
    {
        $this->container['max_date'] = $max_date;

        return $this;
    }

    /**
     * Gets min_height
     * @return int
     */
    public function getMinHeight()
    {
        return $this->container['min_height'];
    }

    /**
     * Sets min_height
     * @param int $min_height Minimum photo height, in pixels.
     * @return $this
     */
    public function setMinHeight($min_height)
    {
        $this->container['min_height'] = $min_height;

        return $this;
    }

    /**
     * Gets max_value
     * @return float
     */
    public function getMaxValue()
    {
        return $this->container['max_value'];
    }

    /**
     * Sets max_value
     * @param float $max_value Maximum value.
     * @return $this
     */
    public function setMaxValue($max_value)
    {
        $this->container['max_value'] = $max_value;

        return $this;
    }

    /**
     * Gets min_value
     * @return float
     */
    public function getMinValue()
    {
        return $this->container['min_value'];
    }

    /**
     * Sets min_value
     * @param float $min_value Minimum value.
     * @return $this
     */
    public function setMinValue($min_value)
    {
        $this->container['min_value'] = $min_value;

        return $this;
    }

    /**
     * Gets min_width
     * @return int
     */
    public function getMinWidth()
    {
        return $this->container['min_width'];
    }

    /**
     * Sets min_width
     * @param int $min_width Minimum photo width, in pixels.
     * @return $this
     */
    public function setMinWidth($min_width)
    {
        $this->container['min_width'] = $min_width;

        return $this;
    }

    /**
     * Gets min_char_length
     * @return int
     */
    public function getMinCharLength()
    {
        return $this->container['min_char_length'];
    }

    /**
     * Sets min_char_length
     * @param int $min_char_length Minimum character length.
     * @return $this
     */
    public function setMinCharLength($min_char_length)
    {
        $this->container['min_char_length'] = $min_char_length;

        return $this;
    }

    /**
     * Gets max_item_count
     * @return int
     */
    public function getMaxItemCount()
    {
        return $this->container['max_item_count'];
    }

    /**
     * Sets max_item_count
     * @param int $max_item_count Maximum item count.
     * @return $this
     */
    public function setMaxItemCount($max_item_count)
    {
        $this->container['max_item_count'] = $max_item_count;

        return $this;
    }

    /**
     * Gets min_item_count
     * @return int
     */
    public function getMinItemCount()
    {
        return $this->container['min_item_count'];
    }

    /**
     * Sets min_item_count
     * @param int $min_item_count Minimum item count.
     * @return $this
     */
    public function setMinItemCount($min_item_count)
    {
        $this->container['min_item_count'] = $min_item_count;

        return $this;
    }

    /**
     * Gets max_char_length
     * @return int
     */
    public function getMaxCharLength()
    {
        return $this->container['max_char_length'];
    }

    /**
     * Sets max_char_length
     * @param int $max_char_length Maximum character length.
     * @return $this
     */
    public function setMaxCharLength($max_char_length)
    {
        $this->container['max_char_length'] = $max_char_length;

        return $this;
    }

    /**
     * Gets aspect_ratio
     * @return string
     */
    public function getAspectRatio()
    {
        return $this->container['aspect_ratio'];
    }

    /**
     * Sets aspect_ratio
     * @param string $aspect_ratio Aspect ratio of a photo.
     * @return $this
     */
    public function setAspectRatio($aspect_ratio)
    {
        $allowed_values = array('UNCONSTRAINED', '1:1', '4:3', '3:2', '5:3', '16:9', '3:1', '2:3', '5:7', '4:5', '4:1');
        if (!is_null($aspect_ratio) && (!in_array($aspect_ratio, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'aspect_ratio', must be one of 'UNCONSTRAINED', '1:1', '4:3', '3:2', '5:3', '16:9', '3:1', '2:3', '5:7', '4:5', '4:1'");
        }
        $this->container['aspect_ratio'] = $aspect_ratio;

        return $this;
    }

    /**
     * Gets min_date
     * @return string
     */
    public function getMinDate()
    {
        return $this->container['min_date'];
    }

    /**
     * Sets min_date
     * @param string $min_date Minimum date, accepted as 'YYYY-MM-DD'.
     * @return $this
     */
    public function setMinDate($min_date)
    {
        $this->container['min_date'] = $min_date;

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