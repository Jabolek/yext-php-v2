<?php
/**
 * UserAcl
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
 * UserAcl Class Doc Comment
 *
 * @category    Class */
/**
 * @package     Yext\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class UserAcl implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'User_acl';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'role_id' => 'string',
        'on' => 'string',
        'account_id' => 'string',
        'on_type' => 'string',
        'role_name' => 'string'
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
        'role_id' => 'roleId',
        'on' => 'on',
        'account_id' => 'accountId',
        'on_type' => 'onType',
        'role_name' => 'roleName'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'role_id' => 'setRoleId',
        'on' => 'setOn',
        'account_id' => 'setAccountId',
        'on_type' => 'setOnType',
        'role_name' => 'setRoleName'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'role_id' => 'getRoleId',
        'on' => 'getOn',
        'account_id' => 'getAccountId',
        'on_type' => 'getOnType',
        'role_name' => 'getRoleName'
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

    const ON_TYPE_ACCOUNT = 'ACCOUNT';
    const ON_TYPE_FOLDER = 'FOLDER';
    const ON_TYPE_LOCATION = 'LOCATION';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getOnTypeAllowableValues()
    {
        return [
            self::ON_TYPE_ACCOUNT,
            self::ON_TYPE_FOLDER,
            self::ON_TYPE_LOCATION,
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
        $this->container['role_id'] = isset($data['role_id']) ? $data['role_id'] : null;
        $this->container['on'] = isset($data['on']) ? $data['on'] : null;
        $this->container['account_id'] = isset($data['account_id']) ? $data['account_id'] : null;
        $this->container['on_type'] = isset($data['on_type']) ? $data['on_type'] : null;
        $this->container['role_name'] = isset($data['role_name']) ? $data['role_name'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        $allowed_values = ["ACCOUNT", "FOLDER", "LOCATION"];
        if (!is_null($this->container['on_type']) && !in_array($this->container['on_type'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'on_type', must be one of #{allowed_values}.";
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
        $allowed_values = ["ACCOUNT", "FOLDER", "LOCATION"];
        if (!is_null($this->container['on_type']) && !in_array($this->container['on_type'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets role_id
     * @return string
     */
    public function getRoleId()
    {
        return $this->container['role_id'];
    }

    /**
     * Sets role_id
     * @param string $role_id The Yext Role ID.
     * @return $this
     */
    public function setRoleId($role_id)
    {
        $this->container['role_id'] = $role_id;

        return $this;
    }

    /**
     * Gets on
     * @return string
     */
    public function getOn()
    {
        return $this->container['on'];
    }

    /**
     * Sets on
     * @param string $on The ID of the account, folder, or location that this role gives the user access to.
     * @return $this
     */
    public function setOn($on)
    {
        $this->container['on'] = $on;

        return $this;
    }

    /**
     * Gets account_id
     * @return string
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     * @param string $account_id The ID of the account that contains the folder or location that this role applies to.  If ``onType`` is ``ACCOUNT``, the value of ``accountId`` is the same as the value of ``on``.
     * @return $this
     */
    public function setAccountId($account_id)
    {
        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets on_type
     * @return string
     */
    public function getOnType()
    {
        return $this->container['on_type'];
    }

    /**
     * Sets on_type
     * @param string $on_type The type of object that this role gives the user access to.
     * @return $this
     */
    public function setOnType($on_type)
    {
        $allowed_values = array('ACCOUNT', 'FOLDER', 'LOCATION');
        if (!is_null($on_type) && (!in_array($on_type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'on_type', must be one of 'ACCOUNT', 'FOLDER', 'LOCATION'");
        }
        $this->container['on_type'] = $on_type;

        return $this;
    }

    /**
     * Gets role_name
     * @return string
     */
    public function getRoleName()
    {
        return $this->container['role_name'];
    }

    /**
     * Sets role_name
     * @param string $role_name The Role's Name.
     * @return $this
     */
    public function setRoleName($role_name)
    {
        $this->container['role_name'] = $role_name;

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
