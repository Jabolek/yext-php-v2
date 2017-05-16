<?php
/**
 * ReviewGenerationSettings
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
 * ReviewGenerationSettings Class Doc Comment
 *
 * @category    Class
 * @package     Yext\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class ReviewGenerationSettings implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'ReviewGenerationSettings';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'site_distribution' => 'map[string,object]',
        'algorithm_configuration' => 'string[]',
        'balancing_optimization' => 'string',
        'max_emails_per_day' => 'int',
        'max_texts_per_month' => 'int',
        'max_texts_per_day' => 'int',
        'max_contact_frequency' => 'int',
        'review_quarantine_days' => 'int',
        'privacy_policy_override' => 'string'
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
        'site_distribution' => 'siteDistribution',
        'algorithm_configuration' => 'algorithmConfiguration',
        'balancing_optimization' => 'balancingOptimization',
        'max_emails_per_day' => 'maxEmailsPerDay',
        'max_texts_per_month' => 'maxTextsPerMonth',
        'max_texts_per_day' => 'maxTextsPerDay',
        'max_contact_frequency' => 'maxContactFrequency',
        'review_quarantine_days' => 'reviewQuarantineDays',
        'privacy_policy_override' => 'privacyPolicyOverride'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'site_distribution' => 'setSiteDistribution',
        'algorithm_configuration' => 'setAlgorithmConfiguration',
        'balancing_optimization' => 'setBalancingOptimization',
        'max_emails_per_day' => 'setMaxEmailsPerDay',
        'max_texts_per_month' => 'setMaxTextsPerMonth',
        'max_texts_per_day' => 'setMaxTextsPerDay',
        'max_contact_frequency' => 'setMaxContactFrequency',
        'review_quarantine_days' => 'setReviewQuarantineDays',
        'privacy_policy_override' => 'setPrivacyPolicyOverride'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'site_distribution' => 'getSiteDistribution',
        'algorithm_configuration' => 'getAlgorithmConfiguration',
        'balancing_optimization' => 'getBalancingOptimization',
        'max_emails_per_day' => 'getMaxEmailsPerDay',
        'max_texts_per_month' => 'getMaxTextsPerMonth',
        'max_texts_per_day' => 'getMaxTextsPerDay',
        'max_contact_frequency' => 'getMaxContactFrequency',
        'review_quarantine_days' => 'getReviewQuarantineDays',
        'privacy_policy_override' => 'getPrivacyPolicyOverride'
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
        $this->container['site_distribution'] = isset($data['site_distribution']) ? $data['site_distribution'] : null;
        $this->container['algorithm_configuration'] = isset($data['algorithm_configuration']) ? $data['algorithm_configuration'] : null;
        $this->container['balancing_optimization'] = isset($data['balancing_optimization']) ? $data['balancing_optimization'] : null;
        $this->container['max_emails_per_day'] = isset($data['max_emails_per_day']) ? $data['max_emails_per_day'] : null;
        $this->container['max_texts_per_month'] = isset($data['max_texts_per_month']) ? $data['max_texts_per_month'] : null;
        $this->container['max_texts_per_day'] = isset($data['max_texts_per_day']) ? $data['max_texts_per_day'] : null;
        $this->container['max_contact_frequency'] = isset($data['max_contact_frequency']) ? $data['max_contact_frequency'] : null;
        $this->container['review_quarantine_days'] = isset($data['review_quarantine_days']) ? $data['review_quarantine_days'] : null;
        $this->container['privacy_policy_override'] = isset($data['privacy_policy_override']) ? $data['privacy_policy_override'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        if (!is_null($this->container['max_emails_per_day']) && ($this->container['max_emails_per_day'] > 200)) {
            $invalid_properties[] = "invalid value for 'max_emails_per_day', must be smaller than or equal to 200.";
        }

        if (!is_null($this->container['max_emails_per_day']) && ($this->container['max_emails_per_day'] < 0)) {
            $invalid_properties[] = "invalid value for 'max_emails_per_day', must be bigger than or equal to 0.";
        }

        if (!is_null($this->container['max_texts_per_month']) && ($this->container['max_texts_per_month'] < 1)) {
            $invalid_properties[] = "invalid value for 'max_texts_per_month', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['max_texts_per_day']) && ($this->container['max_texts_per_day'] > 20)) {
            $invalid_properties[] = "invalid value for 'max_texts_per_day', must be smaller than or equal to 20.";
        }

        if (!is_null($this->container['max_texts_per_day']) && ($this->container['max_texts_per_day'] < 1)) {
            $invalid_properties[] = "invalid value for 'max_texts_per_day', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['review_quarantine_days']) && ($this->container['review_quarantine_days'] > 7)) {
            $invalid_properties[] = "invalid value for 'review_quarantine_days', must be smaller than or equal to 7.";
        }

        if (!is_null($this->container['review_quarantine_days']) && ($this->container['review_quarantine_days'] < 0)) {
            $invalid_properties[] = "invalid value for 'review_quarantine_days', must be bigger than or equal to 0.";
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

        if ($this->container['max_emails_per_day'] > 200) {
            return false;
        }
        if ($this->container['max_emails_per_day'] < 0) {
            return false;
        }
        if ($this->container['max_texts_per_month'] < 1) {
            return false;
        }
        if ($this->container['max_texts_per_day'] > 20) {
            return false;
        }
        if ($this->container['max_texts_per_day'] < 1) {
            return false;
        }
        if ($this->container['review_quarantine_days'] > 7) {
            return false;
        }
        if ($this->container['review_quarantine_days'] < 0) {
            return false;
        }
        return true;
    }


    /**
     * Gets site_distribution
     * @return map[string,object]
     */
    public function getSiteDistribution()
    {
        return $this->container['site_distribution'];
    }

    /**
     * Sets site_distribution
     * @param map[string,object] $site_distribution A list of third-party sites to generate reviews on. Sites may also be weighted, resulting in certain sites generating more reviews than others. The balancing algorithm will attempt to achieve Weight/(Sum of All Weights)% of review count on each specified site.  Can contain a maximum of 10 sites. Including 0 sites is also acceptable.  Each site in the request must have a corresponding weight.  Valid weights are integers 1-9  NOTE: Retrieve site **`id`**s via the Publishers: List endpoint. Valid sites will have `REVIEW MONITORING` listed in **`features`**.
     * @return $this
     */
    public function setSiteDistribution($site_distribution)
    {
        $this->container['site_distribution'] = $site_distribution;

        return $this;
    }

    /**
     * Gets algorithm_configuration
     * @return string[]
     */
    public function getAlgorithmConfiguration()
    {
        return $this->container['algorithm_configuration'];
    }

    /**
     * Sets algorithm_configuration
     * @param string[] $algorithm_configuration Specifies one or more algorithms to address problems with your reviews. If more than one algorithm is specifed, the algorithms are applied in the order they are listed.  Must include at least one of the following:  * **`WEBSITE`**: Generate more first-party reviews when a 1-star review is visible on the first page (i.e., within the last five reviews). * **`RATING`**: Focus on selected sites that have a rating significantly below the location's average. * **`RECENCY`**: Ensure each selected site has one review within the last month.
     * @return $this
     */
    public function setAlgorithmConfiguration($algorithm_configuration)
    {
        $this->container['algorithm_configuration'] = $algorithm_configuration;

        return $this;
    }

    /**
     * Gets balancing_optimization
     * @return string
     */
    public function getBalancingOptimization()
    {
        return $this->container['balancing_optimization'];
    }

    /**
     * Sets balancing_optimization
     * @param string $balancing_optimization Sets optimization settings for the balancing algorithm.  Must include one of the following:  * **`DISTRIBUTION`**: The balancing algorithm will prefer following the weighting distribution specified in **`siteDistribution`**, even if users will be sent to sites they are not logged in to as a result. * **`MORE_REVIEWS`**: The balancing algorithm will attempt to generate as many reviews as possible by sending users to sites they are logged in to, even if the distribution will be less closely followed as a result.
     * @return $this
     */
    public function setBalancingOptimization($balancing_optimization)
    {
        $this->container['balancing_optimization'] = $balancing_optimization;

        return $this;
    }

    /**
     * Gets max_emails_per_day
     * @return int
     */
    public function getMaxEmailsPerDay()
    {
        return $this->container['max_emails_per_day'];
    }

    /**
     * Sets max_emails_per_day
     * @param int $max_emails_per_day Enables review invitations by email and indicates the maximum number of email invites our system will send on a per-location, per-day basis.  Must contain an integer value between 0 and 200. If 0 or null, review invitations by email will be disabled.
     * @return $this
     */
    public function setMaxEmailsPerDay($max_emails_per_day)
    {

        if (!is_null($max_emails_per_day) && ($max_emails_per_day > 200)) {
            throw new \InvalidArgumentException('invalid value for $max_emails_per_day when calling ReviewGenerationSettings., must be smaller than or equal to 200.');
        }
        if (!is_null($max_emails_per_day) && ($max_emails_per_day < 0)) {
            throw new \InvalidArgumentException('invalid value for $max_emails_per_day when calling ReviewGenerationSettings., must be bigger than or equal to 0.');
        }

        $this->container['max_emails_per_day'] = $max_emails_per_day;

        return $this;
    }

    /**
     * Gets max_texts_per_month
     * @return int
     */
    public function getMaxTextsPerMonth()
    {
        return $this->container['max_texts_per_month'];
    }

    /**
     * Sets max_texts_per_month
     * @param int $max_texts_per_month Indicates the maximum number of text invites our system will send on a per-location, per-month basis.
     * @return $this
     */
    public function setMaxTextsPerMonth($max_texts_per_month)
    {

        if (!is_null($max_texts_per_month) && ($max_texts_per_month < 1)) {
            throw new \InvalidArgumentException('invalid value for $max_texts_per_month when calling ReviewGenerationSettings., must be bigger than or equal to 1.');
        }

        $this->container['max_texts_per_month'] = $max_texts_per_month;

        return $this;
    }

    /**
     * Gets max_texts_per_day
     * @return int
     */
    public function getMaxTextsPerDay()
    {
        return $this->container['max_texts_per_day'];
    }

    /**
     * Sets max_texts_per_day
     * @param int $max_texts_per_day Enables review invitations by text and indicates the maximum number of text invites our system will send on a per-location, per-day basis. We will send a maximum of 20 text invites per location per day.  If null, review invitations by text will be disabled.
     * @return $this
     */
    public function setMaxTextsPerDay($max_texts_per_day)
    {

        if (!is_null($max_texts_per_day) && ($max_texts_per_day > 20)) {
            throw new \InvalidArgumentException('invalid value for $max_texts_per_day when calling ReviewGenerationSettings., must be smaller than or equal to 20.');
        }
        if (!is_null($max_texts_per_day) && ($max_texts_per_day < 1)) {
            throw new \InvalidArgumentException('invalid value for $max_texts_per_day when calling ReviewGenerationSettings., must be bigger than or equal to 1.');
        }

        $this->container['max_texts_per_day'] = $max_texts_per_day;

        return $this;
    }

    /**
     * Gets max_contact_frequency
     * @return int
     */
    public function getMaxContactFrequency()
    {
        return $this->container['max_contact_frequency'];
    }

    /**
     * Sets max_contact_frequency
     * @param int $max_contact_frequency Indicates the minimum number of days that must pass before a given contact can be sent another review invitation. This setting will prevent you from contacting the same person repeatedly in a short time period.  If null, no maximum contact frequency will be enforced.
     * @return $this
     */
    public function setMaxContactFrequency($max_contact_frequency)
    {
        $this->container['max_contact_frequency'] = $max_contact_frequency;

        return $this;
    }

    /**
     * Gets review_quarantine_days
     * @return int
     */
    public function getReviewQuarantineDays()
    {
        return $this->container['review_quarantine_days'];
    }

    /**
     * Sets review_quarantine_days
     * @param int $review_quarantine_days Prevents first-party reviews from immediately showing up on your website or wherever else you show your reviews. During this quarantine period, you may respond to reviews, increasing the likelihood that your customers will revise or remove their negative reviews.
     * @return $this
     */
    public function setReviewQuarantineDays($review_quarantine_days)
    {

        if (!is_null($review_quarantine_days) && ($review_quarantine_days > 7)) {
            throw new \InvalidArgumentException('invalid value for $review_quarantine_days when calling ReviewGenerationSettings., must be smaller than or equal to 7.');
        }
        if (!is_null($review_quarantine_days) && ($review_quarantine_days < 0)) {
            throw new \InvalidArgumentException('invalid value for $review_quarantine_days when calling ReviewGenerationSettings., must be bigger than or equal to 0.');
        }

        $this->container['review_quarantine_days'] = $review_quarantine_days;

        return $this;
    }

    /**
     * Gets privacy_policy_override
     * @return string
     */
    public function getPrivacyPolicyOverride()
    {
        return $this->container['privacy_policy_override'];
    }

    /**
     * Sets privacy_policy_override
     * @param string $privacy_policy_override Review-collection pages contain a link to the Yext privacy policy by default. This field lets you replace that link with a link to your own privacy policy.  Update request must contain a URL or null. If null, the Yext privacy policy link will be used.
     * @return $this
     */
    public function setPrivacyPolicyOverride($privacy_policy_override)
    {
        $this->container['privacy_policy_override'] = $privacy_policy_override;

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


