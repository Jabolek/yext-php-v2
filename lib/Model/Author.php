<?php
/**
 * Author
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
 * Author Class Doc Comment
 *
 * @category    Class */
 // @description Metadata about the PostEntry’s author.
/**
 * @package     Yext\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Author implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Author';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'profile_url' => 'string',
        'role' => 'string',
        'name' => 'string',
        'photo_url' => 'string'
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
        'profile_url' => 'profileUrl',
        'role' => 'role',
        'name' => 'name',
        'photo_url' => 'photoUrl'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'profile_url' => 'setProfileUrl',
        'role' => 'setRole',
        'name' => 'setName',
        'photo_url' => 'setPhotoUrl'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'profile_url' => 'getProfileUrl',
        'role' => 'getRole',
        'name' => 'getName',
        'photo_url' => 'getPhotoUrl'
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

    const ROLE_BUSINESS_REPRESENTATIVE = 'BUSINESS_REPRESENTATIVE';
    const ROLE_CONSUMER = 'CONSUMER';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getRoleAllowableValues()
    {
        return [
            self::ROLE_BUSINESS_REPRESENTATIVE,
            self::ROLE_CONSUMER,
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
        $this->container['profile_url'] = isset($data['profile_url']) ? $data['profile_url'] : null;
        $this->container['role'] = isset($data['role']) ? $data['role'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['photo_url'] = isset($data['photo_url']) ? $data['photo_url'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        $allowed_values = ["BUSINESS_REPRESENTATIVE", "CONSUMER"];
        if (!in_array($this->container['role'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'role', must be one of #{allowed_values}.";
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
        $allowed_values = ["BUSINESS_REPRESENTATIVE", "CONSUMER"];
        if (!in_array($this->container['role'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets profile_url
     * @return string
     */
    public function getProfileUrl()
    {
        return $this->container['profile_url'];
    }

    /**
     * Sets profile_url
     * @param string $profile_url The URL of the user profile of the person who wrote the PostEntry
     * @return $this
     */
    public function setProfileUrl($profile_url)
    {
        $this->container['profile_url'] = $profile_url;

        return $this;
    }

    /**
     * Gets role
     * @return string
     */
    public function getRole()
    {
        return $this->container['role'];
    }

    /**
     * Sets role
     * @param string $role
     * @return $this
     */
    public function setRole($role)
    {
        $allowed_values = array('BUSINESS_REPRESENTATIVE', 'CONSUMER');
        if (!is_null($role) && (!in_array($role, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'role', must be one of 'BUSINESS_REPRESENTATIVE', 'CONSUMER'");
        }
        $this->container['role'] = $role;

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
     * @param string $name The name of the person who wrote the PostEntry.
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets photo_url
     * @return string
     */
    public function getPhotoUrl()
    {
        return $this->container['photo_url'];
    }

    /**
     * Sets photo_url
     * @param string $photo_url The URL of the profile photo of the PostEntry’s author.
     * @return $this
     */
    public function setPhotoUrl($photo_url)
    {
        $this->container['photo_url'] = $photo_url;

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
