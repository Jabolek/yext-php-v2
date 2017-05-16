<?php
/**
 * CustomValidation
 *
 * PHP version 5
 *
 * @category Class
 * @package  Yext\Client
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Yext API
 *
 * # Policies and Conventions  This section gives you the basic information you need to use our APIs.  ## API Availability  We currently offer three APIs: * **Knowledge API** * **Live API** * **Administrative API**  Each API is designed for a particular set of users.  To determine which APIs are available to users like you, see the \"Overview\" page in the Docs section of this site.  ## Authentication All requests must be authenticated using an app’s API key.  <pre>GET https://api.yext.com/v2/accounts/[accountId]/locations?<b>api_key=API_KEY</b>&v=YYYYMMDD</pre>  The API key should be kept secret.  ## Versioning All requests must be versioned using the **`v`** parameter.  <pre>GET https://api.yext.com/v2/accounts/[accountId]/locations?api_key=API_KEY&<b>v=YYYYMMDD</b></pre>  The **`v`** parameter (a date in `YYYYMMDD` format) is designed to give you the freedom to adapt to Yext API changes on your own schedule. When you pass this parameter, any backward-incompatiable changes we made to the API after the specified date will not affect the behavior of the request or the content of the response. You will still benefit from any bug fixes or backward-compatible changes we may have made after the date you've specified.  **NOTE:** Yext has the ability to make changes that affect previous versions of the API, if necessary.  ## Serialization API v2 only accepts data in JSON format.  ## Content-Type Headers For all requests that include a request body, the `Content-Type` header must be included and set to `application/json`.  ## PUT Requests Generally, all `PUT` operations behave as true RESTful `PUT`s, in which entire objects are overwritten with the provided content.  However, certain endpoints used to work with large, frequently-changing object models may have different semantics to prevent the accidental removal of content (e.g., Locations: Update lets you omit fields you don’t wish to change).  ## Errors and Warnings There are three kinds of issues that can be reported for a given request:  * **`FATAL_ERROR`**     * An issue caused the entire request to be rejected. * **`NON_FATAL_ERROR`**     * An item is rejected, but other items present in the request are accepted (e.g., one invalid Product List item).     * A field is rejected, but the item otherwise is accepted (e.g., invalid website URL in a Location). * **`WARNING`**     * The request did not adhere to our best practices or recommendations, but the data was accepted anyway (e.g., data was sent that may cause some listings to become unavailable, a deprecated API was used, or we changed the format of a field's content to meet our requirements).  **For a complete list of error codes and their meanings, see the \"Error Messages\" page in the Support section of this site.**  ## Validation Modes  API v2 will support two request validation modes: *Strict Mode* and *Lenient Mode*.  In Strict Mode, both `FATAL_ERROR`s and `NON_FATAL_ERROR`s are reported simply as `FATAL_ERROR`s, and any error will cause the entire request to fail.  In Lenient Mode, `FATAL_ERROR`s and `NON_FATAL_ERROR`s are reported as such, and only `FATAL_ERROR`s will cause a request to fail.  All requests will be processed in Strict Mode by default.  To activate Lenient Mode, append the parameter `validation=lenient` to your request URLs.  ### Dates and times * We always use milliseconds since epoch (a.k.a. Unix time) for timestamps (e.g., review creation times, webhook update times). * We always use ISO 8601 without timezone for local date times (e.g., Event start time, Event end time). Event times are always interpreted in the local timezone of their associated locations. * Dates are transmitted as strings: `YYYY-MM-DD`.  ## Account ID In keeping with RESTful design principles, every URL in API v2 has an account ID prefix. This prefix helps to ensure that you have unique URLs for all resources.  In addition to specifying resources by explicit account ID, the following two macros are defined: * **`me`** - refers to the account that owns the API key sent with the request * **`all`** - refers to the account that owns the API key sent with the request, as well as all sub-accounts (recursively)  **IMPORTANT:** The **`me`** macro is supported in all API methods.  The **`all`** macro will only be supported in certain URLs. Currently, it can only be used in Analytics and Reviews endpoints.  ### Examples This URL refers to an analytics report for all locations in account 123. <pre>https://api.yext.com/v2/accounts/<b>123</b>/analytics/reports?api_key=456&v=20160822</pre>  This URL refers to an analytics report for all locations in the account that owns API key 456. <pre>https://api.yext.com/v2/accounts/<b>me</b>/analytics/reports?<b>api_key=456</b>&v=20160822</pre>  This URL refers to an analytics report for all locations in the account that owns API key 456, as well as all locations from any of its child accounts. <pre>https://api.yext.com/v2/accounts/<b>all</b>/analytics/reports?<b>api_key=456</b>&v=20160822</pre>  ## Actor Headers  To attribute changes to a particular user, all `PUT`, `POST`, and `DELETE` requests may be passed with the following headers.  **NOTE:** If you choose to provide actor headers, and we are unable to authenticate the request using the values you provide, the request will result in an error and fail.  * Attribute activity to customer user via username     * Header: `Yext-Username`     * Value: Customer user’s username * Attribute activity to customer user via Yext user ID     * Header: `Yext-User-Id`     * Value: Customer user’s Yext user ID  Changes will be logged as follows:  * App with no designated actor     * History Entry \"Updated By\" Value: `App [App ID] - ‘[App Name]’`     * Example: `App 432 - ‘Hello World App’` * App with customer user actor     * History Entry \"Updated By\" Value: `[user name] ([user email]) (App [App ID] - ‘[App Name]’)`     * Example: `Jordan Smith (jsmith@example.com) (App 432 - ‘Hello World App’)`  ## Response Format * **`meta`**     * Response metadata * **`meta.uuid`**     * Unique ID for this request / response * **`meta.errors[]`**     * List of errors and warnings * **`meta.errors[].code`**     * Code that uniquely identifies the error or warning * **`meta.errors[].type`**     * One of:         * `FATAL_ERROR`         * `NON_FATAL_ERROR`         * `WARNING`     * See \"Errors and Warnings\" above for details. * **`meta.errors[].message`**     * An explanation of the issue * **`response`**     * The main content (body) of the response  Example: <pre><code> {     \"meta\": {         \"uuid\": \"bb0c7e19-4dc3-4891-bfa5-8593b1f124ad\",         \"errors\": [             {                 \"code\": ...error code...,                 \"type\": ...error, fatal error, non fatal error, or warning...,                 \"message\": ...explanation of the issue...             }         ]     },     \"response\": {         ...results...     } } </code></pre>  ## Status Codes * `200 OK`    * Either there are no errors or warnings, or the only issues are of type `WARNING`. * `207 Multi-Status`     * There are errors of type `itemError` or `fieldError` (but none of type `requestError`). * `400 Bad Request`     * A parameter is invalid, or a required parameter is missing. This includes the case where no API key is provided and the case where a resource ID is specified incorrectly in a path.     * This status is if any of the response errors are of type `requestError`. * `401 Unauthorized`     * The API key provided is invalid. * `403 Forbidden`     * The requested information cannot be viewed by the acting user. * `404 Not Found`     * The endpoint does not exist. * `405 Method Not Allowed`     * The request is using a method that is not allowed (e.g., `POST` with a `GET`-only endpoint). * `409 Conflict`     * The request could not be completed in its current state.     * Use the information included in the response to modify the request and retry. * `429 Too Many Requests`     * You have exceeded your rate limit / quota. * `500 Internal Server Error`     * Yext’s servers are not operating as expected. The request is likely valid but should be resent later. * `504 Timeout`     * Yext’s servers took too long to handle this request, and it timed out.  ## Quotas and Rate Limits Default quotas and rate limits are as follows.  * **Knowledge API** *(includes Analytics, PowerListings®, Knowledge Manager, Reviews, Social, and User endpoints)*: 5,000 requests per hour * **Administrative API**: 1,000 requests per hour * **Live API**: 100,000 requests per hour  Hourly quotas are calculated from the beginning of the hour (minute zero, `:00`), not on a rolling basis past 60 minutes.  **NOTE:** Webhook requests do not count towards an account’s quota.  For the most current and accurate rate-limit usage information for a particular request type, check the **`Rate-Limit-Remaining`** and **`Rate-Limit-Limit`** HTTP headers of your API responses.  If you are currently over your limit, our API will return a `429` error, and the response object returned by our API will be empty. We will also include a **`Rate-Limit-Reset`** header in the response, which indicates when you will have additional quota.  ## Client- vs. Yext-assigned IDs You can set the ID for the following objects when you create them. If you do not provide an ID, Yext will generate one for you.  * Account * User * Location * Bio List * Menu * Product List * Event List * Bio List Item * Menu Item * Product List Item * Event List Item  ## Logging All API requests are logged. API logs can be found in your Developer Console and are stored for 90 days.
 *
 * OpenAPI spec version: 2.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
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
 * @category    Class
 * @description A Custom Field validation object, describing validation rules when a Custom Field value is set or updated.
 * @package     Yext\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class CustomValidation implements ArrayAccess
{
    const DISCRIMINATOR = null;

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
        'min_char_length' => 'int',
        'max_char_length' => 'int',
        'min_item_count' => 'int',
        'max_item_count' => 'int',
        'min_value' => 'float',
        'max_value' => 'float',
        'min_date' => 'string',
        'max_date' => 'string',
        'aspect_ratio' => 'string',
        'min_width' => 'int',
        'min_height' => 'int'
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
        'min_char_length' => 'minCharLength',
        'max_char_length' => 'maxCharLength',
        'min_item_count' => 'minItemCount',
        'max_item_count' => 'maxItemCount',
        'min_value' => 'minValue',
        'max_value' => 'maxValue',
        'min_date' => 'minDate',
        'max_date' => 'maxDate',
        'aspect_ratio' => 'aspectRatio',
        'min_width' => 'minWidth',
        'min_height' => 'minHeight'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'min_char_length' => 'setMinCharLength',
        'max_char_length' => 'setMaxCharLength',
        'min_item_count' => 'setMinItemCount',
        'max_item_count' => 'setMaxItemCount',
        'min_value' => 'setMinValue',
        'max_value' => 'setMaxValue',
        'min_date' => 'setMinDate',
        'max_date' => 'setMaxDate',
        'aspect_ratio' => 'setAspectRatio',
        'min_width' => 'setMinWidth',
        'min_height' => 'setMinHeight'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'min_char_length' => 'getMinCharLength',
        'max_char_length' => 'getMaxCharLength',
        'min_item_count' => 'getMinItemCount',
        'max_item_count' => 'getMaxItemCount',
        'min_value' => 'getMinValue',
        'max_value' => 'getMaxValue',
        'min_date' => 'getMinDate',
        'max_date' => 'getMaxDate',
        'aspect_ratio' => 'getAspectRatio',
        'min_width' => 'getMinWidth',
        'min_height' => 'getMinHeight'
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
        $this->container['min_char_length'] = isset($data['min_char_length']) ? $data['min_char_length'] : null;
        $this->container['max_char_length'] = isset($data['max_char_length']) ? $data['max_char_length'] : null;
        $this->container['min_item_count'] = isset($data['min_item_count']) ? $data['min_item_count'] : null;
        $this->container['max_item_count'] = isset($data['max_item_count']) ? $data['max_item_count'] : null;
        $this->container['min_value'] = isset($data['min_value']) ? $data['min_value'] : null;
        $this->container['max_value'] = isset($data['max_value']) ? $data['max_value'] : null;
        $this->container['min_date'] = isset($data['min_date']) ? $data['min_date'] : null;
        $this->container['max_date'] = isset($data['max_date']) ? $data['max_date'] : null;
        $this->container['aspect_ratio'] = isset($data['aspect_ratio']) ? $data['aspect_ratio'] : null;
        $this->container['min_width'] = isset($data['min_width']) ? $data['min_width'] : null;
        $this->container['min_height'] = isset($data['min_height']) ? $data['min_height'] : null;
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
        if (!in_array($this->container['aspect_ratio'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'aspect_ratio', must be one of 'UNCONSTRAINED', '1:1', '4:3', '3:2', '5:3', '16:9', '3:1', '2:3', '5:7', '4:5', '4:1'.";
        }

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        $allowed_values = ["UNCONSTRAINED", "1:1", "4:3", "3:2", "5:3", "16:9", "3:1", "2:3", "5:7", "4:5", "4:1"];
        if (!in_array($this->container['aspect_ratio'], $allowed_values)) {
            return false;
        }
        return true;
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


