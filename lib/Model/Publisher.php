<?php
/**
 * Publisher
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
 * Publisher Class Doc Comment
 *
 * @category    Class */
/**
 * @package     Yext\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Publisher implements ArrayAccess
{
    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Publisher';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'name' => 'string',
        'url' => 'string',
        'supported_location_types' => '\Yext\Client\Model\LocationType[]',
        'supported_countries' => 'string[]',
        'alternate_brands' => '\Yext\Client\Model\PublisherAlternateBrands[]',
        'id' => 'string',
        'typical_update_speed' => 'int',
        'features' => 'string[]'
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
        'name' => 'name',
        'url' => 'url',
        'supported_location_types' => 'supportedLocationTypes',
        'supported_countries' => 'supportedCountries',
        'alternate_brands' => 'alternateBrands',
        'id' => 'id',
        'typical_update_speed' => 'typicalUpdateSpeed',
        'features' => 'features'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
        'url' => 'setUrl',
        'supported_location_types' => 'setSupportedLocationTypes',
        'supported_countries' => 'setSupportedCountries',
        'alternate_brands' => 'setAlternateBrands',
        'id' => 'setId',
        'typical_update_speed' => 'setTypicalUpdateSpeed',
        'features' => 'setFeatures'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
        'url' => 'getUrl',
        'supported_location_types' => 'getSupportedLocationTypes',
        'supported_countries' => 'getSupportedCountries',
        'alternate_brands' => 'getAlternateBrands',
        'id' => 'getId',
        'typical_update_speed' => 'getTypicalUpdateSpeed',
        'features' => 'getFeatures'
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

    const FEATURES_DUAL_SYNC = 'DUAL_SYNC';
    const FEATURES_SUBMISSION = 'SUBMISSION';
    const FEATURES_SUPPRESSION = 'SUPPRESSION';
    const FEATURES_SUPPRESS_BY_URL = 'SUPPRESS_BY_URL';
    const FEATURES_REVIEW_MONITORING = 'REVIEW_MONITORING';
    const FEATURES_PUBLISHER_SUGGESTIONS = 'PUBLISHER_SUGGESTIONS';
    const FEATURES_ANALYTICS = 'ANALYTICS';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getFeaturesAllowableValues()
    {
        return [
            self::FEATURES_DUAL_SYNC,
            self::FEATURES_SUBMISSION,
            self::FEATURES_SUPPRESSION,
            self::FEATURES_SUPPRESS_BY_URL,
            self::FEATURES_REVIEW_MONITORING,
            self::FEATURES_PUBLISHER_SUGGESTIONS,
            self::FEATURES_ANALYTICS,
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['url'] = isset($data['url']) ? $data['url'] : null;
        $this->container['supported_location_types'] = isset($data['supported_location_types']) ? $data['supported_location_types'] : null;
        $this->container['supported_countries'] = isset($data['supported_countries']) ? $data['supported_countries'] : null;
        $this->container['alternate_brands'] = isset($data['alternate_brands']) ? $data['alternate_brands'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['typical_update_speed'] = isset($data['typical_update_speed']) ? $data['typical_update_speed'] : null;
        $this->container['features'] = isset($data['features']) ? $data['features'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];
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
        return true;
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
     * @param string $name Publisher name
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets url
     * @return string
     */
    public function getUrl()
    {
        return $this->container['url'];
    }

    /**
     * Sets url
     * @param string $url Publisher home page. Will link to Apple App Store for mobile-only apps
     * @return $this
     */
    public function setUrl($url)
    {
        $this->container['url'] = $url;

        return $this;
    }

    /**
     * Gets supported_location_types
     * @return \Yext\Client\Model\LocationType[]
     */
    public function getSupportedLocationTypes()
    {
        return $this->container['supported_location_types'];
    }

    /**
     * Sets supported_location_types
     * @param \Yext\Client\Model\LocationType[] $supported_location_types List of Location types that are supported by this Publisher
     * @return $this
     */
    public function setSupportedLocationTypes($supported_location_types)
    {
        $this->container['supported_location_types'] = $supported_location_types;

        return $this;
    }

    /**
     * Gets supported_countries
     * @return string[]
     */
    public function getSupportedCountries()
    {
        return $this->container['supported_countries'];
    }

    /**
     * Sets supported_countries
     * @param string[] $supported_countries List of countries where this Publisher publishes listings. Countries are denoted by ISO 3166 2-letter country codes
     * @return $this
     */
    public function setSupportedCountries($supported_countries)
    {
        $this->container['supported_countries'] = $supported_countries;

        return $this;
    }

    /**
     * Gets alternate_brands
     * @return \Yext\Client\Model\PublisherAlternateBrands[]
     */
    public function getAlternateBrands()
    {
        return $this->container['alternate_brands'];
    }

    /**
     * Sets alternate_brands
     * @param \Yext\Client\Model\PublisherAlternateBrands[] $alternate_brands List of Publisher's alternate brands where listings are syndicated
     * @return $this
     */
    public function setAlternateBrands($alternate_brands)
    {
        $this->container['alternate_brands'] = $alternate_brands;

        return $this;
    }

    /**
     * Gets id
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     * @param string $id Publisher ID
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets typical_update_speed
     * @return int
     */
    public function getTypicalUpdateSpeed()
    {
        return $this->container['typical_update_speed'];
    }

    /**
     * Sets typical_update_speed
     * @param int $typical_update_speed Typical speed for updates to go live, in seconds
     * @return $this
     */
    public function setTypicalUpdateSpeed($typical_update_speed)
    {
        $this->container['typical_update_speed'] = $typical_update_speed;

        return $this;
    }

    /**
     * Gets features
     * @return string[]
     */
    public function getFeatures()
    {
        return $this->container['features'];
    }

    /**
     * Sets features
     * @param string[] $features List of features supported by this Publisher
     * @return $this
     */
    public function setFeatures($features)
    {
        $allowed_values = array('DUAL_SYNC', 'SUBMISSION', 'SUPPRESSION', 'SUPPRESS_BY_URL', 'REVIEW_MONITORING', 'PUBLISHER_SUGGESTIONS', 'ANALYTICS');
        if (!is_null($features) && (array_diff($features, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'features', must be one of 'DUAL_SYNC', 'SUBMISSION', 'SUPPRESSION', 'SUPPRESS_BY_URL', 'REVIEW_MONITORING', 'PUBLISHER_SUGGESTIONS', 'ANALYTICS'");
        }
        $this->container['features'] = $features;

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
