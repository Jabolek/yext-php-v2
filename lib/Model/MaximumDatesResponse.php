<?php
/**
 * MaximumDatesResponse
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
 * MaximumDatesResponse Class Doc Comment
 *
 * @category    Class
 * @package     Yext\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class MaximumDatesResponse implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'MaximumDatesResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'meta' => '\Yext\Client\Model\ResponseMeta',
        'response' => '\Yext\Client\Model\MaximumDatesResponseResponse'
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
        'meta' => 'meta',
        'response' => 'response'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'meta' => 'setMeta',
        'response' => 'setResponse'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'meta' => 'getMeta',
        'response' => 'getResponse'
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
        $this->container['meta'] = isset($data['meta']) ? $data['meta'] : null;
        $this->container['response'] = isset($data['response']) ? $data['response'] : null;
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
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        return true;
    }


    /**
     * Gets meta
     * @return \Yext\Client\Model\ResponseMeta
     */
    public function getMeta()
    {
        return $this->container['meta'];
    }

    /**
     * Sets meta
     * @param \Yext\Client\Model\ResponseMeta $meta
     * @return $this
     */
    public function setMeta($meta)
    {
        $this->container['meta'] = $meta;

        return $this;
    }

    /**
     * Gets response
     * @return \Yext\Client\Model\MaximumDatesResponseResponse
     */
    public function getResponse()
    {
        return $this->container['response'];
    }

    /**
     * Sets response
     * @param \Yext\Client\Model\MaximumDatesResponseResponse $response
     * @return $this
     */
    public function setResponse($response)
    {
        $this->container['response'] = $response;

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


