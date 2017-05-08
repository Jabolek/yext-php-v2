<?php
/**
 * AddRequest
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
 * # Policies and Conventions  This section gives you the basic information you need to use our APIs.  ## API Availability  We currently offer three APIs: * **Knowledge API** * **Live API** * **Administrative API**  Each API is designed for a particular set of users.  To determine which APIs are available to users like you, see the \"Overview\" page in the Docs section of this site.  ## Authentication All requests must be authenticated using an app’s API key.  <pre>GET https://api.yext.com/v2/accounts/[accountId]/locations?<b>api_key=API_KEY</b>&v=YYYYMMDD</pre>  The API key should be kept secret.  ## Versioning All requests must be versioned using the **`v`** parameter.  <pre>GET https://api.yext.com/v2/accounts/[accountId]/locations?api_key=API_KEY&<b>v=YYYYMMDD</b></pre>  The **`v`** parameter (a date in `YYYYMMDD` format) is designed to give you the freedom to adapt to Yext API changes on your own schedule. When you pass this parameter, any backward-incompatiable changes we made to the API after the specified date will not affect the behavior of the request or the content of the response. You will still benefit from any bug fixes or backward-compatible changes we may have made after the date you've specified.  **NOTE:** Yext has the ability to make changes that affect previous versions of the API, if necessary.  ## Serialization API v2 only accepts data in JSON format.  ## Content-Type Headers For all requests that include a request body, the `Content-Type` header must be included and set to `application/json`.  ## PUT Requests Generally, all `PUT` operations behave as true RESTful `PUT`s, in which entire objects are overwritten with the provided content.  However, certain endpoints used to work with large, frequently-changing object models may have different semantics to prevent the accidental removal of content (e.g., Locations: Update lets you omit fields you don’t wish to change).  ## Errors and Warnings There are three kinds of issues that can be reported for a given request:  * **`FATAL_ERROR`**     * An issue caused the entire request to be rejected. * **`NON_FATAL_ERROR`**     * An item is rejected, but other items present in the request are accepted (e.g., one invalid Product List item).     * A field is rejected, but the item otherwise is accepted (e.g., invalid website URL in a Location). * **`WARNING`**     * The request did not adhere to our best practices or recommendations, but the data was accepted anyway (e.g., data was sent that may cause some listings to become unavailable, a deprecated API was used, or we changed the format of a field's content to meet our requirements).  **For a complete list of error codes and their meanings, see the \"Error Messages\" page in the Support section of this site.**  ## Validation Modes  API v2 will support two request validation modes: *Strict Mode* and *Lenient Mode*.  In Strict Mode, both `FATAL_ERROR`s and `NON_FATAL_ERROR`s are reported simply as `FATAL_ERROR`s, and any error will cause the entire request to fail.  In Lenient Mode, `FATAL_ERROR`s and `NON_FATAL_ERROR`s are reported as such, and only `FATAL_ERROR`s will cause a request to fail.  All requests will be processed in Strict Mode by default.  To activate Lenient Mode, append the parameter `validation=lenient` to your request URLs.  ### Dates and times * We always use milliseconds since epoch (a.k.a. Unix time) for timestamps (e.g., review creation times, webhook update times). * We always use ISO 8601 without timezone for local date times (e.g., Event start time, Event end time). Event times are always interpreted in the local timezone of their associated locations. * Dates are transmitted as strings: `YYYY-MM-DD`.  ## Account ID In keeping with RESTful design principles, every URL in API v2 has an account ID prefix. This prefix helps to ensure that you have unique URLs for all resources.  In addition to specifying resources by explicit account ID, the following two macros are defined: * **`me`** - refers to the account that owns the API key sent with the request * **`all`** - refers to the account that owns the API key sent with the request, as well as all sub-accounts (recursively)  **IMPORTANT:** The **`me`** macro is supported in all API methods.  The **`all`** macro will only be supported in certain URLs. Currently, it can only be used in Analytics and Reviews endpoints.  ### Examples This URL refers to an analytics report for all locations in account 123. <pre>https://api.yext.com/v2/accounts/<b>123</b>/analytics/reports?api_key=456&v=20160822</pre>  This URL refers to an analytics report for all locations in the account that owns API key 456. <pre>https://api.yext.com/v2/accounts/<b>me</b>/analytics/reports?<b>api_key=456</b>&v=20160822</pre>  This URL refers to an analytics report for all locations in the account that owns API key 456, as well as all locations from any of its child accounts. <pre>https://api.yext.com/v2/accounts/<b>all</b>/analytics/reports?<b>api_key=456</b>&v=20160822</pre>  ## Actor Headers  To attribute changes to a particular user, all `PUT`, `POST`, and `DELETE` requests may be passed with the following headers.  **NOTE:** If you choose to provide actor headers, and we are unable to authenticate the request using the values you provide, the request will result in an error and fail.  * Attribute activity to customer user via username     * Header: `Yext-Username`     * Value: Customer user’s username * Attribute activity to customer user via Yext user ID     * Header: `Yext-User-Id`     * Value: Customer user’s Yext user ID  Changes will be logged as follows:  * App with no designated actor     * History Entry \"Updated By\" Value: `App [App ID] - ‘[App Name]’`     * Example: `App 432 - ‘Hello World App’` * App with customer user actor     * History Entry \"Updated By\" Value: `[user name] ([user email]) (App [App ID] - ‘[App Name]’)`     * Example: `Jordan Smith (jsmith@example.com) (App 432 - ‘Hello World App’)`  ## Response Format * **`meta`**     * Response metadata * **`meta.uuid`**     * Unique ID for this request / response * **`meta.errors[]`**     * List of errors and warnings * **`meta.errors[].code`**     * Code that uniquely identifies the error or warning * **`meta.errors[].type`**     * One of:         * `FATAL_ERROR`         * `NON_FATAL_ERROR`         * `WARNING`     * See \"Errors and Warnings\" above for details. * **`meta.errors[].message`**     * An explanation of the issue * **`response`**     * The main content (body) of the response  Example: <pre><code> {     \"meta\": {         \"uuid\": \"bb0c7e19-4dc3-4891-bfa5-8593b1f124ad\",         \"errors\": [             {                 \"code\": ...error code...,                 \"type\": ...error, fatal error, non fatal error, or warning...,                 \"message\": ...explanation of the issue...             }         ]     },     \"response\": {         ...results...     } } </code></pre>  ## Status Codes * `200 OK`    * Either there are no errors or warnings, or the only issues are of type `WARNING`. * `207 Multi-Status`     * There are errors of type `itemError` or `fieldError` (but none of type `requestError`). * `400 Bad Request`     * A parameter is invalid, or a required parameter is missing. This includes the case where no API key is provided and the case where a resource ID is specified incorrectly in a path.     * This status is if any of the response errors are of type `requestError`. * `401 Unauthorized`     * The API key provided is invalid. * `403 Forbidden`     * The requested information cannot be viewed by the acting user. * `404 Not Found`     * The endpoint does not exist. * `405 Method Not Allowed`     * The request is using a method that is not allowed (e.g., `POST` with a `GET`-only endpoint). * `409 Conflict`     * The request could not be completed in its current state.     * Use the information included in the response to modify the request and retry. * `429 Too Many Requests`     * You have exceeded your rate limit / quota. * `500 Internal Server Error`     * Yext’s servers are not operating as expected. The request is likely valid but should be resent later. * `504 Timeout`     * Yext’s servers took too long to handle this request, and it timed out.  ## Quotas and Rate Limits Default quotas and rate limits are as follows.  * **Knowledge API** *(includes Analytics, PowerListings®, Knowledge Manager, Reviews, Social, and User endpoints)*: 5,000 requests per hour * **Administrative API**: 1,000 requests per hour * **Live API**: 100,000 requests per hour  **NOTE:** Webhook requests do not count towards an account’s quota.  For the most current and accurate rate-limit usage information for a particular request type, check the **`Rate-Limit-Remaining`** and **`Rate-Limit-Limit`** HTTP headers of your API responses.  If you are currently over your limit, our API will return a `429` error, and the response object returned by our API will be empty. We will also include a **`Rate-Limit-Reset`** header in the response, which indicates when you will have additional quota.  ## Client- vs. Yext-assigned IDs You can set the ID for the following objects when you create them. If you do not provide an ID, Yext will generate one for you.  * Account * User * Location * Bio List * Menu * Product List * Event List * Bio List Item * Menu Item * Product List Item * Event List Item  ## Logging All API requests are logged. API logs can be found in your Developer Console and are stored for 90 days.
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
 * AddRequest Class Doc Comment
 *
 * @category    Class
 * @package     Yext\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class AddRequest implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'AddRequest';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
        'location_mode' => 'string',
        'existing_location_id' => 'string',
        'new_location_id' => 'string',
        'new_location_account_id' => 'string',
        'new_account_parent_account_id' => 'string',
        'skus' => 'string[]',
        'agreement_id' => 'int',
        'status' => 'string',
        'date_submitted' => '\DateTime',
        'date_completed' => '\DateTime',
        'submitted_by' => 'string',
        'status_detail' => 'string'
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
        'location_mode' => 'locationMode',
        'existing_location_id' => 'existingLocationId',
        'new_location_id' => 'newLocationId',
        'new_location_account_id' => 'newLocationAccountId',
        'new_account_parent_account_id' => 'newAccountParentAccountId',
        'skus' => 'skus',
        'agreement_id' => 'agreementId',
        'status' => 'status',
        'date_submitted' => 'dateSubmitted',
        'date_completed' => 'dateCompleted',
        'submitted_by' => 'submittedBy',
        'status_detail' => 'statusDetail'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'location_mode' => 'setLocationMode',
        'existing_location_id' => 'setExistingLocationId',
        'new_location_id' => 'setNewLocationId',
        'new_location_account_id' => 'setNewLocationAccountId',
        'new_account_parent_account_id' => 'setNewAccountParentAccountId',
        'skus' => 'setSkus',
        'agreement_id' => 'setAgreementId',
        'status' => 'setStatus',
        'date_submitted' => 'setDateSubmitted',
        'date_completed' => 'setDateCompleted',
        'submitted_by' => 'setSubmittedBy',
        'status_detail' => 'setStatusDetail'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'location_mode' => 'getLocationMode',
        'existing_location_id' => 'getExistingLocationId',
        'new_location_id' => 'getNewLocationId',
        'new_location_account_id' => 'getNewLocationAccountId',
        'new_account_parent_account_id' => 'getNewAccountParentAccountId',
        'skus' => 'getSkus',
        'agreement_id' => 'getAgreementId',
        'status' => 'getStatus',
        'date_submitted' => 'getDateSubmitted',
        'date_completed' => 'getDateCompleted',
        'submitted_by' => 'getSubmittedBy',
        'status_detail' => 'getStatusDetail'
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

    const LOCATION_MODE_EXISTING = 'EXISTING';
    const LOCATION_MODE_NEW = 'NEW';
    const STATUS_SUBMITTED = 'SUBMITTED';
    const STATUS_PROCESSING = 'PROCESSING';
    const STATUS_COMPLETE = 'COMPLETE';
    const STATUS_CANCELED = 'CANCELED';
    const STATUS_REVIEW = 'REVIEW';
    const STATUS_FAILED = 'FAILED';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getLocationModeAllowableValues()
    {
        return [
            self::LOCATION_MODE_EXISTING,
            self::LOCATION_MODE_NEW,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_SUBMITTED,
            self::STATUS_PROCESSING,
            self::STATUS_COMPLETE,
            self::STATUS_CANCELED,
            self::STATUS_REVIEW,
            self::STATUS_FAILED,
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
        $this->container['location_mode'] = isset($data['location_mode']) ? $data['location_mode'] : null;
        $this->container['existing_location_id'] = isset($data['existing_location_id']) ? $data['existing_location_id'] : null;
        $this->container['new_location_id'] = isset($data['new_location_id']) ? $data['new_location_id'] : null;
        $this->container['new_location_account_id'] = isset($data['new_location_account_id']) ? $data['new_location_account_id'] : null;
        $this->container['new_account_parent_account_id'] = isset($data['new_account_parent_account_id']) ? $data['new_account_parent_account_id'] : null;
        $this->container['skus'] = isset($data['skus']) ? $data['skus'] : null;
        $this->container['agreement_id'] = isset($data['agreement_id']) ? $data['agreement_id'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['date_submitted'] = isset($data['date_submitted']) ? $data['date_submitted'] : null;
        $this->container['date_completed'] = isset($data['date_completed']) ? $data['date_completed'] : null;
        $this->container['submitted_by'] = isset($data['submitted_by']) ? $data['submitted_by'] : null;
        $this->container['status_detail'] = isset($data['status_detail']) ? $data['status_detail'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        $allowed_values = ["EXISTING", "NEW"];
        if (!in_array($this->container['location_mode'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'location_mode', must be one of 'EXISTING', 'NEW'.";
        }

        if ($this->container['skus'] === null) {
            $invalid_properties[] = "'skus' can't be null";
        }
        $allowed_values = ["SUBMITTED", "PROCESSING", "COMPLETE", "CANCELED", "REVIEW", "FAILED"];
        if (!in_array($this->container['status'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'status', must be one of 'SUBMITTED', 'PROCESSING', 'COMPLETE', 'CANCELED', 'REVIEW', 'FAILED'.";
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

        $allowed_values = ["EXISTING", "NEW"];
        if (!in_array($this->container['location_mode'], $allowed_values)) {
            return false;
        }
        if ($this->container['skus'] === null) {
            return false;
        }
        $allowed_values = ["SUBMITTED", "PROCESSING", "COMPLETE", "CANCELED", "REVIEW", "FAILED"];
        if (!in_array($this->container['status'], $allowed_values)) {
            return false;
        }
        return true;
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
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets location_mode
     * @return string
     */
    public function getLocationMode()
    {
        return $this->container['location_mode'];
    }

    /**
     * Sets location_mode
     * @param string $location_mode Whether the request is to add service for an existing location or to create a new location and add service to it. You can specify this explicitly, or otherwise it is inferred from whether you supply existingLocationID or newLocationID (you can't suppply both.)
     * @return $this
     */
    public function setLocationMode($location_mode)
    {
        $allowed_values = array('EXISTING', 'NEW');
        if (!is_null($location_mode) && (!in_array($location_mode, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'location_mode', must be one of 'EXISTING', 'NEW'");
        }
        $this->container['location_mode'] = $location_mode;

        return $this;
    }

    /**
     * Gets existing_location_id
     * @return string
     */
    public function getExistingLocationId()
    {
        return $this->container['existing_location_id'];
    }

    /**
     * Sets existing_location_id
     * @param string $existing_location_id If the add request is for a location that you have already added to Yext, supply its ID. The location must already exist in your account (or, if you use the Partner Portal, any of your sub-accounts). You must set either this field or *newLocationId*, but not both.
     * @return $this
     */
    public function setExistingLocationId($existing_location_id)
    {
        $this->container['existing_location_id'] = $existing_location_id;

        return $this;
    }

    /**
     * Gets new_location_id
     * @return string
     */
    public function getNewLocationId()
    {
        return $this->container['new_location_id'];
    }

    /**
     * Sets new_location_id
     * @param string $new_location_id If the add request is for a location that needs to be added to Yext, supply its ID in this field. The location must not exist in your account or any sub-accounts or the request will fail. You must set either this field or *existingLocationId*, but not both.
     * @return $this
     */
    public function setNewLocationId($new_location_id)
    {
        $this->container['new_location_id'] = $new_location_id;

        return $this;
    }

    /**
     * Gets new_location_account_id
     * @return string
     */
    public function getNewLocationAccountId()
    {
        return $this->container['new_location_account_id'];
    }

    /**
     * Sets new_location_account_id
     * @param string $new_location_account_id If the add request is for a location that needs to be added to Yext and you are in Partner Portal mode, supply your ID for identifying the customer here. The new location will be placed in the sub-account with this ID, first creating it if necessary.
     * @return $this
     */
    public function setNewLocationAccountId($new_location_account_id)
    {
        $this->container['new_location_account_id'] = $new_location_account_id;

        return $this;
    }

    /**
     * Gets new_account_parent_account_id
     * @return string
     */
    public function getNewAccountParentAccountId()
    {
        return $this->container['new_account_parent_account_id'];
    }

    /**
     * Sets new_account_parent_account_id
     * @param string $new_account_parent_account_id *(Advanced field)* If you have a multi-layer account structure and want the new account created for this request to be under one of your sub-accounts, rather than your main account, specify that sub-account here. If you supply this ID, it must refer to an account that already exists.
     * @return $this
     */
    public function setNewAccountParentAccountId($new_account_parent_account_id)
    {
        $this->container['new_account_parent_account_id'] = $new_account_parent_account_id;

        return $this;
    }

    /**
     * Gets skus
     * @return string[]
     */
    public function getSkus()
    {
        return $this->container['skus'];
    }

    /**
     * Sets skus
     * @param string[] $skus List of SKUs that you would like to sign the location up for, from among those listed in the *availableServices* endpoint.
     * @return $this
     */
    public function setSkus($skus)
    {
        $this->container['skus'] = $skus;

        return $this;
    }

    /**
     * Gets agreement_id
     * @return int
     */
    public function getAgreementId()
    {
        return $this->container['agreement_id'];
    }

    /**
     * Sets agreement_id
     * @param int $agreement_id *(Advanced field)* The Agreement ID of the agreement that services will be added under. This is set automatically by Yext when you create the add request. (You can specify it yourself, but should not do so unless you have intentionally set up multiple active agreements with Yext, since this could cause your integration to break when you renew or upgrade your agreement.)
     * @return $this
     */
    public function setAgreementId($agreement_id)
    {
        $this->container['agreement_id'] = $agreement_id;

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
     * @param string $status The current status of the add request
     * @return $this
     */
    public function setStatus($status)
    {
        $allowed_values = array('SUBMITTED', 'PROCESSING', 'COMPLETE', 'CANCELED', 'REVIEW', 'FAILED');
        if (!is_null($status) && (!in_array($status, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'status', must be one of 'SUBMITTED', 'PROCESSING', 'COMPLETE', 'CANCELED', 'REVIEW', 'FAILED'");
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets date_submitted
     * @return \DateTime
     */
    public function getDateSubmitted()
    {
        return $this->container['date_submitted'];
    }

    /**
     * Sets date_submitted
     * @param \DateTime $date_submitted
     * @return $this
     */
    public function setDateSubmitted($date_submitted)
    {
        $this->container['date_submitted'] = $date_submitted;

        return $this;
    }

    /**
     * Gets date_completed
     * @return \DateTime
     */
    public function getDateCompleted()
    {
        return $this->container['date_completed'];
    }

    /**
     * Sets date_completed
     * @param \DateTime $date_completed
     * @return $this
     */
    public function setDateCompleted($date_completed)
    {
        $this->container['date_completed'] = $date_completed;

        return $this;
    }

    /**
     * Gets submitted_by
     * @return string
     */
    public function getSubmittedBy()
    {
        return $this->container['submitted_by'];
    }

    /**
     * Sets submitted_by
     * @param string $submitted_by
     * @return $this
     */
    public function setSubmittedBy($submitted_by)
    {
        $this->container['submitted_by'] = $submitted_by;

        return $this;
    }

    /**
     * Gets status_detail
     * @return string
     */
    public function getStatusDetail()
    {
        return $this->container['status_detail'];
    }

    /**
     * Sets status_detail
     * @param string $status_detail Results from processing.
     * @return $this
     */
    public function setStatusDetail($status_detail)
    {
        $this->container['status_detail'] = $status_detail;

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


