<?php
/**
 * ReviewComment
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
 * OpenAPI spec version: 0.0.2
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
 * ReviewComment Class Doc Comment
 *
 * @category    Class */
/**
 * @package     Yext\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class ReviewComment implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'ReviewComment';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'author_role' => 'string',
        'visibility' => 'string',
        'author_email' => 'string',
        'author_name' => 'string',
        'parent_id' => 'int',
        'message' => 'string',
        'id' => 'int'
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
        'author_role' => 'authorRole',
        'visibility' => 'visibility',
        'author_email' => 'authorEmail',
        'author_name' => 'authorName',
        'parent_id' => 'parentId',
        'message' => 'message',
        'id' => 'id'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'author_role' => 'setAuthorRole',
        'visibility' => 'setVisibility',
        'author_email' => 'setAuthorEmail',
        'author_name' => 'setAuthorName',
        'parent_id' => 'setParentId',
        'message' => 'setMessage',
        'id' => 'setId'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'author_role' => 'getAuthorRole',
        'visibility' => 'getVisibility',
        'author_email' => 'getAuthorEmail',
        'author_name' => 'getAuthorName',
        'parent_id' => 'getParentId',
        'message' => 'getMessage',
        'id' => 'getId'
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

    const AUTHOR_ROLE_BUSINESS_OWNER = 'BUSINESS_OWNER';
    const AUTHOR_ROLE_CONSUMER = 'CONSUMER';
    const VISIBILITY_PUBLIC = 'PUBLIC';
    const VISIBILITY_PRIVATE = 'PRIVATE';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getAuthorRoleAllowableValues()
    {
        return [
            self::AUTHOR_ROLE_BUSINESS_OWNER,
            self::AUTHOR_ROLE_CONSUMER,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getVisibilityAllowableValues()
    {
        return [
            self::VISIBILITY_PUBLIC,
            self::VISIBILITY_PRIVATE,
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
        $this->container['author_role'] = isset($data['author_role']) ? $data['author_role'] : null;
        $this->container['visibility'] = isset($data['visibility']) ? $data['visibility'] : null;
        $this->container['author_email'] = isset($data['author_email']) ? $data['author_email'] : null;
        $this->container['author_name'] = isset($data['author_name']) ? $data['author_name'] : null;
        $this->container['parent_id'] = isset($data['parent_id']) ? $data['parent_id'] : null;
        $this->container['message'] = isset($data['message']) ? $data['message'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
        $allowed_values = ["BUSINESS_OWNER", "CONSUMER"];
        if (!in_array($this->container['author_role'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'author_role', must be one of #{allowed_values}.";
        }

        $allowed_values = ["PUBLIC", "PRIVATE"];
        if (!in_array($this->container['visibility'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'visibility', must be one of #{allowed_values}.";
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
        $allowed_values = ["BUSINESS_OWNER", "CONSUMER"];
        if (!in_array($this->container['author_role'], $allowed_values)) {
            return false;
        }
        $allowed_values = ["PUBLIC", "PRIVATE"];
        if (!in_array($this->container['visibility'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets author_role
     * @return string
     */
    public function getAuthorRole()
    {
        return $this->container['author_role'];
    }

    /**
     * Sets author_role
     * @param string $author_role
     * @return $this
     */
    public function setAuthorRole($author_role)
    {
        $allowed_values = array('BUSINESS_OWNER', 'CONSUMER');
        if (!is_null($author_role) && (!in_array($author_role, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'author_role', must be one of 'BUSINESS_OWNER', 'CONSUMER'");
        }
        $this->container['author_role'] = $author_role;

        return $this;
    }

    /**
     * Gets visibility
     * @return string
     */
    public function getVisibility()
    {
        return $this->container['visibility'];
    }

    /**
     * Sets visibility
     * @param string $visibility
     * @return $this
     */
    public function setVisibility($visibility)
    {
        $allowed_values = array('PUBLIC', 'PRIVATE');
        if (!is_null($visibility) && (!in_array($visibility, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'visibility', must be one of 'PUBLIC', 'PRIVATE'");
        }
        $this->container['visibility'] = $visibility;

        return $this;
    }

    /**
     * Gets author_email
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->container['author_email'];
    }

    /**
     * Sets author_email
     * @param string $author_email The email address of the person who wrote the comment (if we have it).
     * @return $this
     */
    public function setAuthorEmail($author_email)
    {
        $this->container['author_email'] = $author_email;

        return $this;
    }

    /**
     * Gets author_name
     * @return string
     */
    public function getAuthorName()
    {
        return $this->container['author_name'];
    }

    /**
     * Sets author_name
     * @param string $author_name The name of the person who wrote the comment (if we have it).
     * @return $this
     */
    public function setAuthorName($author_name)
    {
        $this->container['author_name'] = $author_name;

        return $this;
    }

    /**
     * Gets parent_id
     * @return int
     */
    public function getParentId()
    {
        return $this->container['parent_id'];
    }

    /**
     * Sets parent_id
     * @param int $parent_id If this comment is in response to another comment, this is the ID of the parent comment.
     * @return $this
     */
    public function setParentId($parent_id)
    {
        $this->container['parent_id'] = $parent_id;

        return $this;
    }

    /**
     * Gets message
     * @return string
     */
    public function getMessage()
    {
        return $this->container['message'];
    }

    /**
     * Sets message
     * @param string $message Content of the comment.
     * @return $this
     */
    public function setMessage($message)
    {
        $this->container['message'] = $message;

        return $this;
    }

    /**
     * Gets id
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     * @param int $id ID of this comment (assigned by Yext).
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

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