<?php
/**
 * Listing
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
 * Listing Class Doc Comment
 *
 * @category    Class
 * @package     Yext\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Listing implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Listing';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'string',
        'location_id' => 'string',
        'publisher_id' => 'string',
        'status' => 'string',
        'additional_status' => 'string',
        'listing_url' => 'string',
        'login_url' => 'string',
        'screenshot_url' => 'string',
        'status_details' => '\Yext\Client\Model\ListingStatusDetail[]',
        'alternate_brands' => '\Yext\Client\Model\ListingAlternateBrands[]'
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
        'id' => 'id',
        'location_id' => 'locationId',
        'publisher_id' => 'publisherId',
        'status' => 'status',
        'additional_status' => 'additionalStatus',
        'listing_url' => 'listingUrl',
        'login_url' => 'loginUrl',
        'screenshot_url' => 'screenshotUrl',
        'status_details' => 'statusDetails',
        'alternate_brands' => 'alternateBrands'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'location_id' => 'setLocationId',
        'publisher_id' => 'setPublisherId',
        'status' => 'setStatus',
        'additional_status' => 'setAdditionalStatus',
        'listing_url' => 'setListingUrl',
        'login_url' => 'setLoginUrl',
        'screenshot_url' => 'setScreenshotUrl',
        'status_details' => 'setStatusDetails',
        'alternate_brands' => 'setAlternateBrands'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'location_id' => 'getLocationId',
        'publisher_id' => 'getPublisherId',
        'status' => 'getStatus',
        'additional_status' => 'getAdditionalStatus',
        'listing_url' => 'getListingUrl',
        'login_url' => 'getLoginUrl',
        'screenshot_url' => 'getScreenshotUrl',
        'status_details' => 'getStatusDetails',
        'alternate_brands' => 'getAlternateBrands'
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

    const STATUS_WAITING_ON_YEXT = 'WAITING_ON_YEXT';
    const STATUS_WAITING_ON_CUSTOMER = 'WAITING_ON_CUSTOMER';
    const STATUS_WAITING_ON_PUBLISHER = 'WAITING_ON_PUBLISHER';
    const STATUS_LIVE = 'LIVE';
    const STATUS_UNAVAILABLE = 'UNAVAILABLE';
    const STATUS_OPTED_OUT = 'OPTED_OUT';
    const ADDITIONAL_STATUS_CONNECTED = 'CONNECTED';
    const ADDITIONAL_STATUS_NOT_CONNECTED = 'NOT_CONNECTED';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_WAITING_ON_YEXT,
            self::STATUS_WAITING_ON_CUSTOMER,
            self::STATUS_WAITING_ON_PUBLISHER,
            self::STATUS_LIVE,
            self::STATUS_UNAVAILABLE,
            self::STATUS_OPTED_OUT,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getAdditionalStatusAllowableValues()
    {
        return [
            self::ADDITIONAL_STATUS_CONNECTED,
            self::ADDITIONAL_STATUS_NOT_CONNECTED,
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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['location_id'] = isset($data['location_id']) ? $data['location_id'] : null;
        $this->container['publisher_id'] = isset($data['publisher_id']) ? $data['publisher_id'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['additional_status'] = isset($data['additional_status']) ? $data['additional_status'] : null;
        $this->container['listing_url'] = isset($data['listing_url']) ? $data['listing_url'] : null;
        $this->container['login_url'] = isset($data['login_url']) ? $data['login_url'] : null;
        $this->container['screenshot_url'] = isset($data['screenshot_url']) ? $data['screenshot_url'] : null;
        $this->container['status_details'] = isset($data['status_details']) ? $data['status_details'] : null;
        $this->container['alternate_brands'] = isset($data['alternate_brands']) ? $data['alternate_brands'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        $allowed_values = ["WAITING_ON_YEXT", "WAITING_ON_CUSTOMER", "WAITING_ON_PUBLISHER", "LIVE", "UNAVAILABLE", "OPTED_OUT"];
        if (!in_array($this->container['status'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'status', must be one of 'WAITING_ON_YEXT', 'WAITING_ON_CUSTOMER', 'WAITING_ON_PUBLISHER', 'LIVE', 'UNAVAILABLE', 'OPTED_OUT'.";
        }

        $allowed_values = ["CONNECTED", "NOT_CONNECTED"];
        if (!in_array($this->container['additional_status'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'additional_status', must be one of 'CONNECTED', 'NOT_CONNECTED'.";
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

        $allowed_values = ["WAITING_ON_YEXT", "WAITING_ON_CUSTOMER", "WAITING_ON_PUBLISHER", "LIVE", "UNAVAILABLE", "OPTED_OUT"];
        if (!in_array($this->container['status'], $allowed_values)) {
            return false;
        }
        $allowed_values = ["CONNECTED", "NOT_CONNECTED"];
        if (!in_array($this->container['additional_status'], $allowed_values)) {
            return false;
        }
        return true;
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
     * @param string $id ID of this listing
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets location_id
     * @return string
     */
    public function getLocationId()
    {
        return $this->container['location_id'];
    }

    /**
     * Sets location_id
     * @param string $location_id ID of the location associated with this listing
     * @return $this
     */
    public function setLocationId($location_id)
    {
        $this->container['location_id'] = $location_id;

        return $this;
    }

    /**
     * Gets publisher_id
     * @return string
     */
    public function getPublisherId()
    {
        return $this->container['publisher_id'];
    }

    /**
     * Sets publisher_id
     * @param string $publisher_id ID of publisher associated with this listing
     * @return $this
     */
    public function setPublisherId($publisher_id)
    {
        $this->container['publisher_id'] = $publisher_id;

        return $this;
    }

    /**
     * Gets status
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $allowed_values = array('WAITING_ON_YEXT', 'WAITING_ON_CUSTOMER', 'WAITING_ON_PUBLISHER', 'LIVE', 'UNAVAILABLE', 'OPTED_OUT');
        if (!is_null($status) && (!in_array($status, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'status', must be one of 'WAITING_ON_YEXT', 'WAITING_ON_CUSTOMER', 'WAITING_ON_PUBLISHER', 'LIVE', 'UNAVAILABLE', 'OPTED_OUT'");
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets additional_status
     * @return string
     */
    public function getAdditionalStatus()
    {
        return $this->container['additional_status'];
    }

    /**
     * Sets additional_status
     * @param string $additional_status
     * @return $this
     */
    public function setAdditionalStatus($additional_status)
    {
        $allowed_values = array('CONNECTED', 'NOT_CONNECTED');
        if (!is_null($additional_status) && (!in_array($additional_status, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'additional_status', must be one of 'CONNECTED', 'NOT_CONNECTED'");
        }
        $this->container['additional_status'] = $additional_status;

        return $this;
    }

    /**
     * Gets listing_url
     * @return string
     */
    public function getListingUrl()
    {
        return $this->container['listing_url'];
    }

    /**
     * Sets listing_url
     * @param string $listing_url Listing URL
     * @return $this
     */
    public function setListingUrl($listing_url)
    {
        $this->container['listing_url'] = $listing_url;

        return $this;
    }

    /**
     * Gets login_url
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->container['login_url'];
    }

    /**
     * Sets login_url
     * @param string $login_url URL where the user can log in to the publisher to manage this listing at that publisher (only returned for Google My Business)
     * @return $this
     */
    public function setLoginUrl($login_url)
    {
        $this->container['login_url'] = $login_url;

        return $this;
    }

    /**
     * Gets screenshot_url
     * @return string
     */
    public function getScreenshotUrl()
    {
        return $this->container['screenshot_url'];
    }

    /**
     * Sets screenshot_url
     * @param string $screenshot_url URL of a screenshot of the profile page that includes the Featured Message
     * @return $this
     */
    public function setScreenshotUrl($screenshot_url)
    {
        $this->container['screenshot_url'] = $screenshot_url;

        return $this;
    }

    /**
     * Gets status_details
     * @return \Yext\Client\Model\ListingStatusDetail[]
     */
    public function getStatusDetails()
    {
        return $this->container['status_details'];
    }

    /**
     * Sets status_details
     * @param \Yext\Client\Model\ListingStatusDetail[] $status_details List of warnings, or reasons why the listing is unavailable
     * @return $this
     */
    public function setStatusDetails($status_details)
    {
        $this->container['status_details'] = $status_details;

        return $this;
    }

    /**
     * Gets alternate_brands
     * @return \Yext\Client\Model\ListingAlternateBrands[]
     */
    public function getAlternateBrands()
    {
        return $this->container['alternate_brands'];
    }

    /**
     * Sets alternate_brands
     * @param \Yext\Client\Model\ListingAlternateBrands[] $alternate_brands List of Publisher's alternate brands where the listing is syndicated (only present if **v** is \"20170420\" or later)
     * @return $this
     */
    public function setAlternateBrands($alternate_brands)
    {
        $this->container['alternate_brands'] = $alternate_brands;

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


