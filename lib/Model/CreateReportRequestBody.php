<?php
/**
 * CreateReportRequestBody
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
 * CreateReportRequestBody Class Doc Comment
 *
 * @category    Class
 * @package     Yext\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class CreateReportRequestBody implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'CreateReportRequestBody';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'metrics' => 'string[]',
        'dimensions' => 'string[]',
        'filters' => '\Yext\Client\Model\AnalyticsFilter'
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
        'metrics' => 'metrics',
        'dimensions' => 'dimensions',
        'filters' => 'filters'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'metrics' => 'setMetrics',
        'dimensions' => 'setDimensions',
        'filters' => 'setFilters'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'metrics' => 'getMetrics',
        'dimensions' => 'getDimensions',
        'filters' => 'getFilters'
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
        $this->container['metrics'] = isset($data['metrics']) ? $data['metrics'] : null;
        $this->container['dimensions'] = isset($data['dimensions']) ? $data['dimensions'] : null;
        $this->container['filters'] = isset($data['filters']) ? $data['filters'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        if ($this->container['metrics'] === null) {
            $invalid_properties[] = "'metrics' can't be null";
        }
        if ($this->container['dimensions'] === null) {
            $invalid_properties[] = "'dimensions' can't be null";
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

        if ($this->container['metrics'] === null) {
            return false;
        }
        if ($this->container['dimensions'] === null) {
            return false;
        }
        return true;
    }


    /**
     * Gets metrics
     * @return string[]
     */
    public function getMetrics()
    {
        return $this->container['metrics'];
    }

    /**
     * Sets metrics
     * @param string[] $metrics The kinds of data the report should include. Specify up to 10 values.  * **`PROFILE_VIEWS`**: the number of times your listings were viewed. Does not include listings on Yelp, Facebook, Bing, or Google. * **`SEARCHES`**: the number of times your listings were included in search results. Does not include search results on Yelp, Facebook, Bing, or Google. * **`POWERLISTINGS_LIVE`**: the total number of your listings that were live * **`FEATURED_MESSAGE_CLICKS`**: the number of times consumers clicked on your Featured Messsage. Does not include Featured Messages on Yelp, Facebook, Bing, or Google. * **`YELP_PAGE_VIEWS`**: number of times your listings on Yelp (\"pages\") were viewed * **`BING_SEARCHES`**: the number of times your listings were included in Bing search results. Because Bing sends data for full weeks rather than individual days, **`dimensions`** cannot contain `DAYS`, `MONTHS`, or `MONTHS_RETAIL` if `BING_SEARCHES` is in **`metrics`**. Also, reports with `BING_SEARCHES` have different reporting maximum dates than reports with other metrics. * **`FACEBOOK_LIKES`**: the total number of consumers who have \"liked\" your Page * **`FACEBOOK_TALKING_ABOUT`**: the number of unique consumers who had an interaction with your Page. For an interaction to be included in this total, it must result in a story being posted to the newsfeeds of those consumers' friends. Examples of these interactions include, but are not limited to, sharing a post on your Page, liking your Page, or tagging your location in a photo. * **`FACEBOOK_WERE_HERE`**: the total number of consumers who have checked into your business on Facebook, along with the people tagged as being with them when checking in * **`FOURSQUARE_DAILY_CHECKINS`**: the number of consumers who checked into your business on Foursquare on a given date * **`INSTAGRAM_POSTS`**: the number of times consumers posted Instagram content geotagged at your business * **`GOOGLE_SEARCH_QUERIES`**: the number of times your listings appeared in search results on either Google Search or Google Maps * **`GOOGLE_SEARCH_VIEWS`**: the number of times your listings were viewed on Google Search * **`GOOGLE_MAP_VIEWS`**: the number of times your listings were viewed on Google Maps * **`GOOGLE_CUSTOMER_ACTIONS`**: the number of times consumers called your business, got driving directions to your business, or visited your website via the links in your Google listings * **`GOOGLE_PHONE_CALLS`**: the number of times consumers called your business by clicking your phone number in your Google listings during the past 90 days. You must use the `GOOGLE_PHONE_CALL_HOURS` dimension with this metric. * **`AVERAGE_RATING`**: the cumulative average of the ratings your business has received * **`NEW_REVIEWS`**: the number of new reviews your business has received * **`STOREPAGES_SESSIONS`**:  the number of unique visitors (sessions) to your Store Pages. * **`STOREPAGES_PAGEVIEWS`**:  the number of page views on your Store Pages. * **`STOREPAGES_DRIVINGDIRECTIONS`**:  the number of times someone clicked for directions on your Store Pages. * **`STOREPAGES_PHONECALLS`**:  the number of times someone clicked to make a phone call from your Store Pages. * **`STOREPAGES_CALLTOACTIONCLICKS`**:  the number of times someone clicked a call to action on your Store Pages. * **`STOREPAGES_CLICKSTOWEBSITE`**:  the number of times someone clicked to go to your website from your Store Pages. * **`STOREPAGES_EVENT_eventtype`**:  the number of times the Store Pages custom event occurred. * **`PROFILE_UPDATES`**: Count of updates to your Yext profile. * **`PUBLISHER_SUGGESTIONS`**: Count of all publisher suggestions. * **`SOCIAL_ACTIVITIES`**: Count of all new social posts. * **`DUPLICATES_SUPPRESSED`**: Count of all duplicates suppressed. * **`DUPLICATES_DETECTED`**: Count of all duplicates detected. * **`LISTINGS_LIVE`**: Count of new listings live. * **`IST_SEARCH_REQUESTS`**: The number of search requests that were successfully analyzed. * **`IST_AVERAGE_LOCAL_PACK_POSITION`**: The average position of the local pack when it appears in a search engine results page. * **`IST_AVERAGE_LOCAL_PACK_NUMBER_OF_RESULTS`**: The average number of results in the local pack when it appears in a search engine results page. * **`IST_LOCAL_PACK_EXISTED`**: The percentage of times a local pack showed up in search results. * **`IST_LOCAL_PACK_PRESENCE`**: The percentage of times your business appears in a local pack when one was shown. * **`IST_KNOWLEDGE_CARD_EXISTED`**: The percentage of times a knowledge card showed up in search results. * **`IST_MATCHES_PER_SEARCH`**: The total number of matches on the first page of the search engine results. * **`IST_AVERAGE_FIRST_ORGANIC_MATCH_POSITION`**: The average position of the first match in the organic results in the search engine results page if one exists. * **`IST_AVERAGE_FIRST_LOCAL_PACK_MATCH_POSITION`**: The average position of the first match in the local pack in the search engine results page if one exists. * **`IST_AVERAGE_FIRST_MATCH_POSITION`**: The average position of the first match in either the local pack or organic results in the search engine results page if one exists. * **`IST_ORGANIC_SHARE_OF_SEARCH`**: The share of search for all organic matches in the search engine results page. * **`IST_LOCAL_PACK_SHARE_OF_SEARCH`**: The share of search for all local pack matches in the search engine results page. * **`IST_SHARE_OF_INTELLIGENT_SEARCH`**: The share of search for all matches in the search engine results page.
     * @return $this
     */
    public function setMetrics($metrics)
    {
        $this->container['metrics'] = $metrics;

        return $this;
    }

    /**
     * Gets dimensions
     * @return string[]
     */
    public function getDimensions()
    {
        return $this->container['dimensions'];
    }

    /**
     * Sets dimensions
     * @param string[] $dimensions Determines how the data will be grouped. Specify up to 3 values. <br><br> **NOTES:** <br> You can only use one time-based dimension (e.g., `DAYS`, `WEEKS`) per report. <br> You can only use one location-based dimenion (e.g., `FOLDER_IDS`, `LOCATION_NAMES`) per report. <br><br> * **`ACCOUNT_IDS`** * **`LOCATION_IDS`** * **`FOLDER_IDS`** * **`LOCATION_NAMES`** * **`FOLDER_NAMES`** * **`DAYS`** * **`WEEKS`** * **`MONTHS`**: refers to the Gregorian calendar (January, February, etc.) * **`MONTHS_RETAIL`**: refers to the 4-5-4 merchandising calendar * **`PLATFORM`**: groups data by the platform on which the action measured in **`metrics`** was conducted (e.g., Desktop, Mobile) * **`FOURSQUARE_GENDER`**: groups checkins by users' sexes (`male` or `female`). Can only be used with the `FOURSQUARE_DAILY_CHECKINS` metric. * **`FOURSQUARE_AGE`**: groups checkins by the users' ages (`13-17`, `18-24`, `25-34`, `35-44`, `45-54`, `55+`). Can only be used with the `FOURSQUARE_DAILY_CHECKINS` metric. * **`FOURSQUARE_TIME`**: groups checkins by their times (`morning`: 7 AM - 10:59 AM, `noon`: 11 AM - 1:59 PM, `afternoon`: 2 PM - 5:59 PM, `evening`: 6 PM - 8:59 PM, `night`: 9 PM - 6:59 AM). Can only be used with the `FOURSQUARE_DAILY_CHECKINS` metric. * **`SEARCH_QUERY`**: groups searches according to the search criteria used. Can only be used with the `SEARCHES` metric. * **`GOOGLE_ACTION_TYPE`**: the type of action consumers took through your Google listings (Phone Calls, Get Directions, or Website Clicks). Can only be used with the `GOOGLE_CUSTOMER_ACTIONS` metric. * **`GOOGLE_QUERY_TYPE`**: groups search criteria based on whether they contained your brand name (branded) or not (unbranded). Can only be used with the `GOOGLE_SEARCH_QUERIES` metric. * **`GOOGLE_PHONE_CALL_HOURS`**: can only be used with the `GOOGLE_PHONE_CALLS` metric * **`RATINGS`**: can only be used with the `AVERAGE_RATING` and `NEW_REVIEWS` metrics * **`FREQUENT_WORDS`**: the words that most frequently appear in your reviews. Can only be used with the `AVERAGE_RATING` and `NEW_REVIEWS` metrics. * **`PARTNERS`**: the sites your reviews appear on. Can only be used with the `AVERAGE_RATING` and `NEW_REVIEWS` metrics. * **`STOREPAGES_PAGE_TYPE`**: the page types for your Store Pages. Can only be used with Store Pages metrics. * **`STOREPAGES_PAGE_URL`**: the urls people visited on your Store Pages. Can only be used with Store Pages metrics. * **`STOREPAGES_DIRECTORY`**: the directories of your Store Pages. Can only be used with Store Pages metrics. * **`PUBLISHER_SUGGESTION_TYPE`**: the type of the publisher suggestion (can only be used with the `PUBLISHER_SUGGESTIONS` metric). * **`FIELD_NAME`**: the name of the field being updated in your profile (can only be used with the `PROFILE_UPDATES` metric). * **`LISTINGS_LIVE_TYPE`**: The type of of listings live, either be `Claimed` or `Created` (can only be used with `LISTINGS_LIVE` metric). * **`IST_QUERY_TEMPLATE`**: The query template used to create search requests. Can only be used with Intelligent Search Tracker metrics. * **`IST_KEYWORD`**: The keyword used to create search requests. Can only be used with Intelligent Search Tracker metrics. * **`IST_SEARCH_ENGINE`**: The search engine used for the Intelligent Search Tracker. Can only be used with Intelligent Search Tracker metrics. * **`IST_COMPETITOR`**: Competitors monitored by the Intelligent Search Tracker. Can only be used with Intelligent Search Tracker metrics. * **`IST_MATCH_POSITION`**: The local pack or organic position of the search result. Can only be used with Intelligent Search Tracker metrics. * **`IST_SEARCH_RESULT_TYPE`**: One of Organic, Local Pack or Knowledge Card. Can only be used with Intelligent Search Tracker metrics. * **`IST_MATCH_TYPE`**: One of Local Map Pack, Listings, Pages and Corporate Website. Can only be used with Intelligent Search Tracker metrics.
     * @return $this
     */
    public function setDimensions($dimensions)
    {
        $this->container['dimensions'] = $dimensions;

        return $this;
    }

    /**
     * Gets filters
     * @return \Yext\Client\Model\AnalyticsFilter
     */
    public function getFilters()
    {
        return $this->container['filters'];
    }

    /**
     * Sets filters
     * @param \Yext\Client\Model\AnalyticsFilter $filters
     * @return $this
     */
    public function setFilters($filters)
    {
        $this->container['filters'] = $filters;

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


