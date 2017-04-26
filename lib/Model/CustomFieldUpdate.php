<?php
/**
 * CustomFieldUpdate
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
 * CustomFieldUpdate Class Doc Comment
 *
 * @category    Class */
/**
 * @package     Yext\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class CustomFieldUpdate implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'CustomFieldUpdate';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'description' => 'string',
        'alternate_language_behavior' => 'string',
        'group' => 'string',
        'name' => 'string',
        'options' => '\Yext\Client\Model\CustomOption[]'
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
        'description' => 'description',
        'alternate_language_behavior' => 'alternateLanguageBehavior',
        'group' => 'group',
        'name' => 'name',
        'options' => 'options'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'description' => 'setDescription',
        'alternate_language_behavior' => 'setAlternateLanguageBehavior',
        'group' => 'setGroup',
        'name' => 'setName',
        'options' => 'setOptions'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'description' => 'getDescription',
        'alternate_language_behavior' => 'getAlternateLanguageBehavior',
        'group' => 'getGroup',
        'name' => 'getName',
        'options' => 'getOptions'
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

    const GROUP_NONE = 'NONE';
    const GROUP_GROUP_1 = 'GROUP_1';
    const GROUP_GROUP_2 = 'GROUP_2';
    const GROUP_GROUP_3 = 'GROUP_3';
    const GROUP_GROUP_4 = 'GROUP_4';
    const GROUP_GROUP_5 = 'GROUP_5';
    const GROUP_GROUP_6 = 'GROUP_6';
    const GROUP_GROUP_7 = 'GROUP_7';
    const GROUP_GROUP_8 = 'GROUP_8';
    const GROUP_GROUP_9 = 'GROUP_9';
    const GROUP_GROUP_10 = 'GROUP_10';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getGroupAllowableValues()
    {
        return [
            self::GROUP_NONE,
            self::GROUP_GROUP_1,
            self::GROUP_GROUP_2,
            self::GROUP_GROUP_3,
            self::GROUP_GROUP_4,
            self::GROUP_GROUP_5,
            self::GROUP_GROUP_6,
            self::GROUP_GROUP_7,
            self::GROUP_GROUP_8,
            self::GROUP_GROUP_9,
            self::GROUP_GROUP_10,
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
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['alternate_language_behavior'] = isset($data['alternate_language_behavior']) ? $data['alternate_language_behavior'] : null;
        $this->container['group'] = isset($data['group']) ? $data['group'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['options'] = isset($data['options']) ? $data['options'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        $allowed_values = ["NONE", "GROUP_1", "GROUP_2", "GROUP_3", "GROUP_4", "GROUP_5", "GROUP_6", "GROUP_7", "GROUP_8", "GROUP_9", "GROUP_10"];
        if (!is_null($this->container['group']) && !in_array($this->container['group'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'group', must be one of #{allowed_values}.";
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
        $allowed_values = ["NONE", "GROUP_1", "GROUP_2", "GROUP_3", "GROUP_4", "GROUP_5", "GROUP_6", "GROUP_7", "GROUP_8", "GROUP_9", "GROUP_10"];
        if (!is_null($this->container['group']) && !in_array($this->container['group'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets description
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     * @param string $description The Custom Field's description which, if provided, will be shown as a tooltip next to the Custom Field in the Knowledge Manager. Providing a description is highly recommended when creating Apps.
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets alternate_language_behavior
     * @return string
     */
    public function getAlternateLanguageBehavior()
    {
        return $this->container['alternate_language_behavior'];
    }

    /**
     * Sets alternate_language_behavior
     * @param string $alternate_language_behavior Custom Field multi-language profile behavior, which is one of:  `PRIMARY_ONLY`: The Custom Field can only have a value set on its primary language profile.  `OVERRIDABLE`: The Custom Field can have a value set on any alternate language profiles, which will override the primary language profile value when the alternate language profile is requested. When requested, if a value is not set for an alternate language profile, the primary language profile value will be returned.  `LANGUAGE_SPECIFIC`: The Custom Field can have a value set on any alternate language profiles. When requested, if a value is not set for an alternate language profile, no value will be returned.
     * @return $this
     */
    public function setAlternateLanguageBehavior($alternate_language_behavior)
    {
        $this->container['alternate_language_behavior'] = $alternate_language_behavior;

        return $this;
    }

    /**
     * Gets group
     * @return string
     */
    public function getGroup()
    {
        return $this->container['group'];
    }

    /**
     * Sets group
     * @param string $group The Custom Field's group.
     * @return $this
     */
    public function setGroup($group)
    {
        $allowed_values = array('NONE', 'GROUP_1', 'GROUP_2', 'GROUP_3', 'GROUP_4', 'GROUP_5', 'GROUP_6', 'GROUP_7', 'GROUP_8', 'GROUP_9', 'GROUP_10');
        if (!is_null($group) && (!in_array($group, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'group', must be one of 'NONE', 'GROUP_1', 'GROUP_2', 'GROUP_3', 'GROUP_4', 'GROUP_5', 'GROUP_6', 'GROUP_7', 'GROUP_8', 'GROUP_9', 'GROUP_10'");
        }
        $this->container['group'] = $group;

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
     * @param string $name The Custom Field's name.
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets options
     * @return \Yext\Client\Model\CustomOption[]
     */
    public function getOptions()
    {
        return $this->container['options'];
    }

    /**
     * Sets options
     * @param \Yext\Client\Model\CustomOption[] $options Present if and only if `type` is `SINGLE_OPTION` or `MULTI_OPTION`.  List of options (key/value pairs) for the Custom Field.  Example: {   {      \"key\": \"2413\",     \"value\": \"Temporarily Closed\"   },   {     \"key\": \"2414\",     \"value\": \"Coming Soon\"   },   {     \"key\": \"2415\",     \"value\": \"Closed\"   },   {     \"key\": \"2416\",     \"value\": \"Open\"   } }
     * @return $this
     */
    public function setOptions($options)
    {
        $this->container['options'] = $options;

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
