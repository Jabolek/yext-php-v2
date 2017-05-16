<?php
/**
 * AnalyticsFilter
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
 * AnalyticsFilter Class Doc Comment
 *
 * @category    Class
 * @package     Yext\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class AnalyticsFilter implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'AnalyticsFilter';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'start_date' => '\DateTime',
        'end_date' => '\DateTime',
        'location_ids' => 'string[]',
        'folder_id' => 'int',
        'countries' => 'string[]',
        'location_labels' => 'string[]',
        'platforms' => 'string[]',
        'google_action_type' => 'string[]',
        'google_query_type' => 'string[]',
        'hours' => 'float[]',
        'ratings' => 'int[]',
        'frequent_words' => 'string[]',
        'partners' => 'float[]',
        'page_types' => 'string[]',
        'listings_live_type' => 'string',
        'publisher_suggestion_type' => 'string[]',
        'query_template' => 'string[]',
        'search_engine' => 'string[]',
        'keyword' => 'string[]',
        'competitor' => 'string[]',
        'match_position' => 'string[]',
        'search_result_type' => 'string[]',
        'match_type' => 'string[]',
        'min_search_frequency' => 'double',
        'max_search_frequency' => 'double',
        'search_term' => 'string',
        'search_type' => 'string',
        'foursquare_checkin_type' => 'string',
        'foursquare_checkin_age' => 'string',
        'foursquare_checkin_gender' => 'string',
        'foursquare_checkin_time_of_day' => 'string',
        'instagram_content_type' => 'string'
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
        'start_date' => 'startDate',
        'end_date' => 'endDate',
        'location_ids' => 'locationIds',
        'folder_id' => 'folderId',
        'countries' => 'countries',
        'location_labels' => 'locationLabels',
        'platforms' => 'platforms',
        'google_action_type' => 'googleActionType',
        'google_query_type' => 'googleQueryType',
        'hours' => 'hours',
        'ratings' => 'ratings',
        'frequent_words' => 'frequentWords',
        'partners' => 'partners',
        'page_types' => 'pageTypes',
        'listings_live_type' => 'listingsLiveType',
        'publisher_suggestion_type' => 'publisherSuggestionType',
        'query_template' => 'queryTemplate',
        'search_engine' => 'searchEngine',
        'keyword' => 'keyword',
        'competitor' => 'competitor',
        'match_position' => 'matchPosition',
        'search_result_type' => 'searchResultType',
        'match_type' => 'matchType',
        'min_search_frequency' => 'minSearchFrequency',
        'max_search_frequency' => 'maxSearchFrequency',
        'search_term' => 'searchTerm',
        'search_type' => 'searchType',
        'foursquare_checkin_type' => 'foursquareCheckinType',
        'foursquare_checkin_age' => 'foursquareCheckinAge',
        'foursquare_checkin_gender' => 'foursquareCheckinGender',
        'foursquare_checkin_time_of_day' => 'foursquareCheckinTimeOfDay',
        'instagram_content_type' => 'instagramContentType'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'start_date' => 'setStartDate',
        'end_date' => 'setEndDate',
        'location_ids' => 'setLocationIds',
        'folder_id' => 'setFolderId',
        'countries' => 'setCountries',
        'location_labels' => 'setLocationLabels',
        'platforms' => 'setPlatforms',
        'google_action_type' => 'setGoogleActionType',
        'google_query_type' => 'setGoogleQueryType',
        'hours' => 'setHours',
        'ratings' => 'setRatings',
        'frequent_words' => 'setFrequentWords',
        'partners' => 'setPartners',
        'page_types' => 'setPageTypes',
        'listings_live_type' => 'setListingsLiveType',
        'publisher_suggestion_type' => 'setPublisherSuggestionType',
        'query_template' => 'setQueryTemplate',
        'search_engine' => 'setSearchEngine',
        'keyword' => 'setKeyword',
        'competitor' => 'setCompetitor',
        'match_position' => 'setMatchPosition',
        'search_result_type' => 'setSearchResultType',
        'match_type' => 'setMatchType',
        'min_search_frequency' => 'setMinSearchFrequency',
        'max_search_frequency' => 'setMaxSearchFrequency',
        'search_term' => 'setSearchTerm',
        'search_type' => 'setSearchType',
        'foursquare_checkin_type' => 'setFoursquareCheckinType',
        'foursquare_checkin_age' => 'setFoursquareCheckinAge',
        'foursquare_checkin_gender' => 'setFoursquareCheckinGender',
        'foursquare_checkin_time_of_day' => 'setFoursquareCheckinTimeOfDay',
        'instagram_content_type' => 'setInstagramContentType'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'start_date' => 'getStartDate',
        'end_date' => 'getEndDate',
        'location_ids' => 'getLocationIds',
        'folder_id' => 'getFolderId',
        'countries' => 'getCountries',
        'location_labels' => 'getLocationLabels',
        'platforms' => 'getPlatforms',
        'google_action_type' => 'getGoogleActionType',
        'google_query_type' => 'getGoogleQueryType',
        'hours' => 'getHours',
        'ratings' => 'getRatings',
        'frequent_words' => 'getFrequentWords',
        'partners' => 'getPartners',
        'page_types' => 'getPageTypes',
        'listings_live_type' => 'getListingsLiveType',
        'publisher_suggestion_type' => 'getPublisherSuggestionType',
        'query_template' => 'getQueryTemplate',
        'search_engine' => 'getSearchEngine',
        'keyword' => 'getKeyword',
        'competitor' => 'getCompetitor',
        'match_position' => 'getMatchPosition',
        'search_result_type' => 'getSearchResultType',
        'match_type' => 'getMatchType',
        'min_search_frequency' => 'getMinSearchFrequency',
        'max_search_frequency' => 'getMaxSearchFrequency',
        'search_term' => 'getSearchTerm',
        'search_type' => 'getSearchType',
        'foursquare_checkin_type' => 'getFoursquareCheckinType',
        'foursquare_checkin_age' => 'getFoursquareCheckinAge',
        'foursquare_checkin_gender' => 'getFoursquareCheckinGender',
        'foursquare_checkin_time_of_day' => 'getFoursquareCheckinTimeOfDay',
        'instagram_content_type' => 'getInstagramContentType'
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

    const GOOGLE_ACTION_TYPE_DRIVING_DIRECTIONS = 'ACTION_DRIVING_DIRECTIONS';
    const GOOGLE_ACTION_TYPE_PHONE = 'ACTION_PHONE';
    const GOOGLE_ACTION_TYPE_WEBSITE = 'ACTION_WEBSITE';
    const GOOGLE_QUERY_TYPE_DIRECT = 'QUERIES_DIRECT';
    const GOOGLE_QUERY_TYPE_INDIRECT = 'QUERIES_INDIRECT';
    const PAGE_TYPES_STORE = 'STORE';
    const PAGE_TYPES_DIRECTORY = 'DIRECTORY';
    const PAGE_TYPES_SEARCH = 'SEARCH';
    const LISTINGS_LIVE_TYPE_CLAIMED = 'CLAIMED';
    const LISTINGS_LIVE_TYPE_CREATED = 'CREATED';
    const PUBLISHER_SUGGESTION_TYPE_ACCEPTED = 'ACCEPTED';
    const PUBLISHER_SUGGESTION_TYPE_REJECTED = 'REJECTED';
    const PUBLISHER_SUGGESTION_TYPE_NEW = 'NEW';
    const QUERY_TEMPLATE_KEYWORD = 'KEYWORD';
    const QUERY_TEMPLATE_KEYWORD_CITY = 'KEYWORD_CITY';
    const QUERY_TEMPLATE_KEYWORD_CITY_STATE = 'KEYWORD_CITY_STATE';
    const QUERY_TEMPLATE_KEYWORD_IN_CITY = 'KEYWORD_IN_CITY';
    const QUERY_TEMPLATE_KEYWORD_NEAR_ME = 'KEYWORD_NEAR_ME';
    const QUERY_TEMPLATE_KEYWORD_ZIP = 'KEYWORD_ZIP';
    const SEARCH_ENGINE_GOOGLE_DESKTOP = 'GOOGLE_DESKTOP';
    const SEARCH_ENGINE_GOOGLE_MOBILE = 'GOOGLE_MOBILE';
    const SEARCH_ENGINE_BING_DESKTOP = 'BING_DESKTOP';
    const SEARCH_ENGINE_YAHOO_DESKTOP = 'YAHOO_DESKTOP';
    const MATCH_POSITION_ONE = 'ONE';
    const MATCH_POSITION_TWO = 'TWO';
    const MATCH_POSITION_THREE = 'THREE';
    const MATCH_POSITION_FOUR = 'FOUR';
    const MATCH_POSITION_FIVE = 'FIVE';
    const MATCH_POSITION_SIX_TO_TEN = 'SIX_TO_TEN';
    const MATCH_POSITION_ELEVEN_TO_FIFTEEN = 'ELEVEN_TO_FIFTEEN';
    const SEARCH_RESULT_TYPE_ORGANIC_RESULT = 'ORGANIC_RESULT';
    const SEARCH_RESULT_TYPE_LOCAL_PACK_RESULT = 'LOCAL_PACK_RESULT';
    const SEARCH_RESULT_TYPE_KNOWLEDGE_CARD_RESULT = 'KNOWLEDGE_CARD_RESULT';
    const MATCH_TYPE_LOCATION_PAGES = 'LOCATION_PAGES';
    const MATCH_TYPE_CORPORATE_WEBSITE = 'CORPORATE_WEBSITE';
    const MATCH_TYPE_LISTINGS = 'LISTINGS';
    const MATCH_TYPE_NO_MATCH = 'NO_MATCH';
    const MATCH_TYPE_LOCAL_PACK = 'LOCAL_PACK';
    const MATCH_TYPE_COMPETITOR = 'COMPETITOR';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getGoogleActionTypeAllowableValues()
    {
        return [
            self::GOOGLE_ACTION_TYPE_DRIVING_DIRECTIONS,
            self::GOOGLE_ACTION_TYPE_PHONE,
            self::GOOGLE_ACTION_TYPE_WEBSITE,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getGoogleQueryTypeAllowableValues()
    {
        return [
            self::GOOGLE_QUERY_TYPE_DIRECT,
            self::GOOGLE_QUERY_TYPE_INDIRECT,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getPageTypesAllowableValues()
    {
        return [
            self::PAGE_TYPES_STORE,
            self::PAGE_TYPES_DIRECTORY,
            self::PAGE_TYPES_SEARCH,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getListingsLiveTypeAllowableValues()
    {
        return [
            self::LISTINGS_LIVE_TYPE_CLAIMED,
            self::LISTINGS_LIVE_TYPE_CREATED,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getPublisherSuggestionTypeAllowableValues()
    {
        return [
            self::PUBLISHER_SUGGESTION_TYPE_ACCEPTED,
            self::PUBLISHER_SUGGESTION_TYPE_REJECTED,
            self::PUBLISHER_SUGGESTION_TYPE_NEW,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getQueryTemplateAllowableValues()
    {
        return [
            self::QUERY_TEMPLATE_KEYWORD,
            self::QUERY_TEMPLATE_KEYWORD_CITY,
            self::QUERY_TEMPLATE_KEYWORD_CITY_STATE,
            self::QUERY_TEMPLATE_KEYWORD_IN_CITY,
            self::QUERY_TEMPLATE_KEYWORD_NEAR_ME,
            self::QUERY_TEMPLATE_KEYWORD_ZIP,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getSearchEngineAllowableValues()
    {
        return [
            self::SEARCH_ENGINE_GOOGLE_DESKTOP,
            self::SEARCH_ENGINE_GOOGLE_MOBILE,
            self::SEARCH_ENGINE_BING_DESKTOP,
            self::SEARCH_ENGINE_YAHOO_DESKTOP,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getMatchPositionAllowableValues()
    {
        return [
            self::MATCH_POSITION_ONE,
            self::MATCH_POSITION_TWO,
            self::MATCH_POSITION_THREE,
            self::MATCH_POSITION_FOUR,
            self::MATCH_POSITION_FIVE,
            self::MATCH_POSITION_SIX_TO_TEN,
            self::MATCH_POSITION_ELEVEN_TO_FIFTEEN,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getSearchResultTypeAllowableValues()
    {
        return [
            self::SEARCH_RESULT_TYPE_ORGANIC_RESULT,
            self::SEARCH_RESULT_TYPE_LOCAL_PACK_RESULT,
            self::SEARCH_RESULT_TYPE_KNOWLEDGE_CARD_RESULT,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getMatchTypeAllowableValues()
    {
        return [
            self::MATCH_TYPE_LOCATION_PAGES,
            self::MATCH_TYPE_CORPORATE_WEBSITE,
            self::MATCH_TYPE_LISTINGS,
            self::MATCH_TYPE_NO_MATCH,
            self::MATCH_TYPE_LOCAL_PACK,
            self::MATCH_TYPE_COMPETITOR,
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
        $this->container['start_date'] = isset($data['start_date']) ? $data['start_date'] : null;
        $this->container['end_date'] = isset($data['end_date']) ? $data['end_date'] : null;
        $this->container['location_ids'] = isset($data['location_ids']) ? $data['location_ids'] : null;
        $this->container['folder_id'] = isset($data['folder_id']) ? $data['folder_id'] : null;
        $this->container['countries'] = isset($data['countries']) ? $data['countries'] : null;
        $this->container['location_labels'] = isset($data['location_labels']) ? $data['location_labels'] : null;
        $this->container['platforms'] = isset($data['platforms']) ? $data['platforms'] : null;
        $this->container['google_action_type'] = isset($data['google_action_type']) ? $data['google_action_type'] : null;
        $this->container['google_query_type'] = isset($data['google_query_type']) ? $data['google_query_type'] : null;
        $this->container['hours'] = isset($data['hours']) ? $data['hours'] : null;
        $this->container['ratings'] = isset($data['ratings']) ? $data['ratings'] : null;
        $this->container['frequent_words'] = isset($data['frequent_words']) ? $data['frequent_words'] : null;
        $this->container['partners'] = isset($data['partners']) ? $data['partners'] : null;
        $this->container['page_types'] = isset($data['page_types']) ? $data['page_types'] : null;
        $this->container['listings_live_type'] = isset($data['listings_live_type']) ? $data['listings_live_type'] : null;
        $this->container['publisher_suggestion_type'] = isset($data['publisher_suggestion_type']) ? $data['publisher_suggestion_type'] : null;
        $this->container['query_template'] = isset($data['query_template']) ? $data['query_template'] : null;
        $this->container['search_engine'] = isset($data['search_engine']) ? $data['search_engine'] : null;
        $this->container['keyword'] = isset($data['keyword']) ? $data['keyword'] : null;
        $this->container['competitor'] = isset($data['competitor']) ? $data['competitor'] : null;
        $this->container['match_position'] = isset($data['match_position']) ? $data['match_position'] : null;
        $this->container['search_result_type'] = isset($data['search_result_type']) ? $data['search_result_type'] : null;
        $this->container['match_type'] = isset($data['match_type']) ? $data['match_type'] : null;
        $this->container['min_search_frequency'] = isset($data['min_search_frequency']) ? $data['min_search_frequency'] : null;
        $this->container['max_search_frequency'] = isset($data['max_search_frequency']) ? $data['max_search_frequency'] : null;
        $this->container['search_term'] = isset($data['search_term']) ? $data['search_term'] : null;
        $this->container['search_type'] = isset($data['search_type']) ? $data['search_type'] : null;
        $this->container['foursquare_checkin_type'] = isset($data['foursquare_checkin_type']) ? $data['foursquare_checkin_type'] : null;
        $this->container['foursquare_checkin_age'] = isset($data['foursquare_checkin_age']) ? $data['foursquare_checkin_age'] : null;
        $this->container['foursquare_checkin_gender'] = isset($data['foursquare_checkin_gender']) ? $data['foursquare_checkin_gender'] : null;
        $this->container['foursquare_checkin_time_of_day'] = isset($data['foursquare_checkin_time_of_day']) ? $data['foursquare_checkin_time_of_day'] : null;
        $this->container['instagram_content_type'] = isset($data['instagram_content_type']) ? $data['instagram_content_type'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        $allowed_values = ["CLAIMED", "CREATED"];
        if (!in_array($this->container['listings_live_type'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'listings_live_type', must be one of 'CLAIMED', 'CREATED'.";
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

        $allowed_values = ["CLAIMED", "CREATED"];
        if (!in_array($this->container['listings_live_type'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets start_date
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date
     * @param \DateTime $start_date The inclusive start date for the report data.  Defaults to 90 days before the end date. Must be before the date given in `endDate`. E.g. ‘2016-08-22’ NOTE: If `WEEKS`, `MONTHS`, or `MONTHS_RETAIL` is in dimensions, startDate must coincide with the beginning and end of a week or month, depending on the dimension chosen.
     * @return $this
     */
    public function setStartDate($start_date)
    {
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date
     * @param \DateTime $end_date The exclusive end date for the report data.  Defaults to the lowest common denominator of the relevant maximum reporting dates. Must be after the date given in `startDate`. E.g. ‘2016-08-30’ NOTE: If `WEEKS`, `MONTHS`, or `MONTHS_RETAIL` is in dimensions, endDate must coincide with the beginning and end of a week or month, depending on the dimension chosen.
     * @return $this
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets location_ids
     * @return string[]
     */
    public function getLocationIds()
    {
        return $this->container['location_ids'];
    }

    /**
     * Sets location_ids
     * @param string[] $location_ids Array of locationIds
     * @return $this
     */
    public function setLocationIds($location_ids)
    {
        $this->container['location_ids'] = $location_ids;

        return $this;
    }

    /**
     * Gets folder_id
     * @return int
     */
    public function getFolderId()
    {
        return $this->container['folder_id'];
    }

    /**
     * Sets folder_id
     * @param int $folder_id Specifies the folder whose locations and subfolders should be included in the results. Default is 0 (root folder). Cannot be used when `ACCOUNT_ID` is in dimensions.
     * @return $this
     */
    public function setFolderId($folder_id)
    {
        $this->container['folder_id'] = $folder_id;

        return $this;
    }

    /**
     * Gets countries
     * @return string[]
     */
    public function getCountries()
    {
        return $this->container['countries'];
    }

    /**
     * Sets countries
     * @param string[] $countries Array of 3166 Alpha-2 country codes.
     * @return $this
     */
    public function setCountries($countries)
    {
        $this->container['countries'] = $countries;

        return $this;
    }

    /**
     * Gets location_labels
     * @return string[]
     */
    public function getLocationLabels()
    {
        return $this->container['location_labels'];
    }

    /**
     * Sets location_labels
     * @param string[] $location_labels Array of location labels
     * @return $this
     */
    public function setLocationLabels($location_labels)
    {
        $this->container['location_labels'] = $location_labels;

        return $this;
    }

    /**
     * Gets platforms
     * @return string[]
     */
    public function getPlatforms()
    {
        return $this->container['platforms'];
    }

    /**
     * Sets platforms
     * @param string[] $platforms Array of platform IDs.
     * @return $this
     */
    public function setPlatforms($platforms)
    {
        $this->container['platforms'] = $platforms;

        return $this;
    }

    /**
     * Gets google_action_type
     * @return string[]
     */
    public function getGoogleActionType()
    {
        return $this->container['google_action_type'];
    }

    /**
     * Sets google_action_type
     * @param string[] $google_action_type Specifies the type of customer actions to be included in the report. Can only be used with the `GOOGLE_CUSTOMER_ACTIONS` metric.
     * @return $this
     */
    public function setGoogleActionType($google_action_type)
    {
        $allowed_values = array('ACTION_DRIVING_DIRECTIONS', 'ACTION_PHONE', 'ACTION_WEBSITE');
        if (!is_null($google_action_type) && (array_diff($google_action_type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'google_action_type', must be one of 'ACTION_DRIVING_DIRECTIONS', 'ACTION_PHONE', 'ACTION_WEBSITE'");
        }
        $this->container['google_action_type'] = $google_action_type;

        return $this;
    }

    /**
     * Gets google_query_type
     * @return string[]
     */
    public function getGoogleQueryType()
    {
        return $this->container['google_query_type'];
    }

    /**
     * Sets google_query_type
     * @param string[] $google_query_type Specifies the type of queries to be included in the report. Can only be used with the `GOOGLE_SEARCHES` metric.
     * @return $this
     */
    public function setGoogleQueryType($google_query_type)
    {
        $allowed_values = array('QUERIES_DIRECT', 'QUERIES_INDIRECT');
        if (!is_null($google_query_type) && (array_diff($google_query_type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'google_query_type', must be one of 'QUERIES_DIRECT', 'QUERIES_INDIRECT'");
        }
        $this->container['google_query_type'] = $google_query_type;

        return $this;
    }

    /**
     * Gets hours
     * @return float[]
     */
    public function getHours()
    {
        return $this->container['hours'];
    }

    /**
     * Sets hours
     * @param float[] $hours Specifies the hour(s) of day that should be included in the report. Can only, and must be used with the `GOOGLE_PHONE_CALLS` metric.
     * @return $this
     */
    public function setHours($hours)
    {
        $this->container['hours'] = $hours;

        return $this;
    }

    /**
     * Gets ratings
     * @return int[]
     */
    public function getRatings()
    {
        return $this->container['ratings'];
    }

    /**
     * Sets ratings
     * @param int[] $ratings Specifies the ratings to be included in the report. Can only be used with Reviews metrics.
     * @return $this
     */
    public function setRatings($ratings)
    {
        $this->container['ratings'] = $ratings;

        return $this;
    }

    /**
     * Gets frequent_words
     * @return string[]
     */
    public function getFrequentWords()
    {
        return $this->container['frequent_words'];
    }

    /**
     * Sets frequent_words
     * @param string[] $frequent_words Specifies the words that should be included in the report. Can only be used with Reviews metrics.
     * @return $this
     */
    public function setFrequentWords($frequent_words)
    {
        $this->container['frequent_words'] = $frequent_words;

        return $this;
    }

    /**
     * Gets partners
     * @return float[]
     */
    public function getPartners()
    {
        return $this->container['partners'];
    }

    /**
     * Sets partners
     * @param float[] $partners Specifies the partners that should be included in the report. Can only be used with Reviews metrics.
     * @return $this
     */
    public function setPartners($partners)
    {
        $this->container['partners'] = $partners;

        return $this;
    }

    /**
     * Gets page_types
     * @return string[]
     */
    public function getPageTypes()
    {
        return $this->container['page_types'];
    }

    /**
     * Sets page_types
     * @param string[] $page_types Specifies the Pages page types that should be included in the report. Can only be used with Store Pages metrics
     * @return $this
     */
    public function setPageTypes($page_types)
    {
        $allowed_values = array('STORE', 'DIRECTORY', 'SEARCH');
        if (!is_null($page_types) && (array_diff($page_types, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'page_types', must be one of 'STORE', 'DIRECTORY', 'SEARCH'");
        }
        $this->container['page_types'] = $page_types;

        return $this;
    }

    /**
     * Gets listings_live_type
     * @return string
     */
    public function getListingsLiveType()
    {
        return $this->container['listings_live_type'];
    }

    /**
     * Sets listings_live_type
     * @param string $listings_live_type Specifies the type of listings live that should be included in the report. Can only be used with `LISTINGS_LIVE` metric.
     * @return $this
     */
    public function setListingsLiveType($listings_live_type)
    {
        $allowed_values = array('CLAIMED', 'CREATED');
        if (!is_null($listings_live_type) && (!in_array($listings_live_type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'listings_live_type', must be one of 'CLAIMED', 'CREATED'");
        }
        $this->container['listings_live_type'] = $listings_live_type;

        return $this;
    }

    /**
     * Gets publisher_suggestion_type
     * @return string[]
     */
    public function getPublisherSuggestionType()
    {
        return $this->container['publisher_suggestion_type'];
    }

    /**
     * Sets publisher_suggestion_type
     * @param string[] $publisher_suggestion_type Specifies the types of publisher suggestions that should be included in the report. Can only be used with `PUBLISHER_SUGGESTIONS` metric.
     * @return $this
     */
    public function setPublisherSuggestionType($publisher_suggestion_type)
    {
        $allowed_values = array('ACCEPTED', 'REJECTED', 'NEW');
        if (!is_null($publisher_suggestion_type) && (array_diff($publisher_suggestion_type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'publisher_suggestion_type', must be one of 'ACCEPTED', 'REJECTED', 'NEW'");
        }
        $this->container['publisher_suggestion_type'] = $publisher_suggestion_type;

        return $this;
    }

    /**
     * Gets query_template
     * @return string[]
     */
    public function getQueryTemplate()
    {
        return $this->container['query_template'];
    }

    /**
     * Sets query_template
     * @param string[] $query_template The query template used to create search requests. Can only be used with Intelligent Search Tracker metrics.
     * @return $this
     */
    public function setQueryTemplate($query_template)
    {
        $allowed_values = array('KEYWORD', 'KEYWORD_CITY', 'KEYWORD_CITY_STATE', 'KEYWORD_IN_CITY', 'KEYWORD_NEAR_ME', 'KEYWORD_ZIP');
        if (!is_null($query_template) && (array_diff($query_template, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'query_template', must be one of 'KEYWORD', 'KEYWORD_CITY', 'KEYWORD_CITY_STATE', 'KEYWORD_IN_CITY', 'KEYWORD_NEAR_ME', 'KEYWORD_ZIP'");
        }
        $this->container['query_template'] = $query_template;

        return $this;
    }

    /**
     * Gets search_engine
     * @return string[]
     */
    public function getSearchEngine()
    {
        return $this->container['search_engine'];
    }

    /**
     * Sets search_engine
     * @param string[] $search_engine The search engine used for the Intelligent Search Tracker. Can only be used with Intelligent Search Tracker metrics.
     * @return $this
     */
    public function setSearchEngine($search_engine)
    {
        $allowed_values = array('GOOGLE_DESKTOP', 'GOOGLE_MOBILE', 'BING_DESKTOP', 'YAHOO_DESKTOP');
        if (!is_null($search_engine) && (array_diff($search_engine, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'search_engine', must be one of 'GOOGLE_DESKTOP', 'GOOGLE_MOBILE', 'BING_DESKTOP', 'YAHOO_DESKTOP'");
        }
        $this->container['search_engine'] = $search_engine;

        return $this;
    }

    /**
     * Gets keyword
     * @return string[]
     */
    public function getKeyword()
    {
        return $this->container['keyword'];
    }

    /**
     * Sets keyword
     * @param string[] $keyword The keyword used to create search requests. Can only be used with Intelligent Search Tracker metrics.
     * @return $this
     */
    public function setKeyword($keyword)
    {
        $this->container['keyword'] = $keyword;

        return $this;
    }

    /**
     * Gets competitor
     * @return string[]
     */
    public function getCompetitor()
    {
        return $this->container['competitor'];
    }

    /**
     * Sets competitor
     * @param string[] $competitor Competitors monitored by the Intelligent Search Tracker. Can only be used with Intelligent Search Tracker metrics.
     * @return $this
     */
    public function setCompetitor($competitor)
    {
        $this->container['competitor'] = $competitor;

        return $this;
    }

    /**
     * Gets match_position
     * @return string[]
     */
    public function getMatchPosition()
    {
        return $this->container['match_position'];
    }

    /**
     * Sets match_position
     * @param string[] $match_position The local pack or organic position of the search result. Can only be used with Intelligent Search Tracker metrics.
     * @return $this
     */
    public function setMatchPosition($match_position)
    {
        $allowed_values = array('ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX_TO_TEN', 'ELEVEN_TO_FIFTEEN');
        if (!is_null($match_position) && (array_diff($match_position, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'match_position', must be one of 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX_TO_TEN', 'ELEVEN_TO_FIFTEEN'");
        }
        $this->container['match_position'] = $match_position;

        return $this;
    }

    /**
     * Gets search_result_type
     * @return string[]
     */
    public function getSearchResultType()
    {
        return $this->container['search_result_type'];
    }

    /**
     * Sets search_result_type
     * @param string[] $search_result_type One of Organic, Local Pack or Knowledge Card. Can only be used with Intelligent Search Tracker metrics.
     * @return $this
     */
    public function setSearchResultType($search_result_type)
    {
        $allowed_values = array('ORGANIC_RESULT', 'LOCAL_PACK_RESULT', 'KNOWLEDGE_CARD_RESULT');
        if (!is_null($search_result_type) && (array_diff($search_result_type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'search_result_type', must be one of 'ORGANIC_RESULT', 'LOCAL_PACK_RESULT', 'KNOWLEDGE_CARD_RESULT'");
        }
        $this->container['search_result_type'] = $search_result_type;

        return $this;
    }

    /**
     * Gets match_type
     * @return string[]
     */
    public function getMatchType()
    {
        return $this->container['match_type'];
    }

    /**
     * Sets match_type
     * @param string[] $match_type One of Local Map Pack, Listings, Pages and Corporate Website. Can only be used with Intelligent Search Tracker metrics.
     * @return $this
     */
    public function setMatchType($match_type)
    {
        $allowed_values = array('LOCATION_PAGES', 'CORPORATE_WEBSITE', 'LISTINGS', 'NO_MATCH', 'LOCAL_PACK', 'COMPETITOR');
        if (!is_null($match_type) && (array_diff($match_type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'match_type', must be one of 'LOCATION_PAGES', 'CORPORATE_WEBSITE', 'LISTINGS', 'NO_MATCH', 'LOCAL_PACK', 'COMPETITOR'");
        }
        $this->container['match_type'] = $match_type;

        return $this;
    }

    /**
     * Gets min_search_frequency
     * @return double
     */
    public function getMinSearchFrequency()
    {
        return $this->container['min_search_frequency'];
    }

    /**
     * Sets min_search_frequency
     * @param double $min_search_frequency
     * @return $this
     */
    public function setMinSearchFrequency($min_search_frequency)
    {
        $this->container['min_search_frequency'] = $min_search_frequency;

        return $this;
    }

    /**
     * Gets max_search_frequency
     * @return double
     */
    public function getMaxSearchFrequency()
    {
        return $this->container['max_search_frequency'];
    }

    /**
     * Sets max_search_frequency
     * @param double $max_search_frequency
     * @return $this
     */
    public function setMaxSearchFrequency($max_search_frequency)
    {
        $this->container['max_search_frequency'] = $max_search_frequency;

        return $this;
    }

    /**
     * Gets search_term
     * @return string
     */
    public function getSearchTerm()
    {
        return $this->container['search_term'];
    }

    /**
     * Sets search_term
     * @param string $search_term
     * @return $this
     */
    public function setSearchTerm($search_term)
    {
        $this->container['search_term'] = $search_term;

        return $this;
    }

    /**
     * Gets search_type
     * @return string
     */
    public function getSearchType()
    {
        return $this->container['search_type'];
    }

    /**
     * Sets search_type
     * @param string $search_type
     * @return $this
     */
    public function setSearchType($search_type)
    {
        $this->container['search_type'] = $search_type;

        return $this;
    }

    /**
     * Gets foursquare_checkin_type
     * @return string
     */
    public function getFoursquareCheckinType()
    {
        return $this->container['foursquare_checkin_type'];
    }

    /**
     * Sets foursquare_checkin_type
     * @param string $foursquare_checkin_type
     * @return $this
     */
    public function setFoursquareCheckinType($foursquare_checkin_type)
    {
        $this->container['foursquare_checkin_type'] = $foursquare_checkin_type;

        return $this;
    }

    /**
     * Gets foursquare_checkin_age
     * @return string
     */
    public function getFoursquareCheckinAge()
    {
        return $this->container['foursquare_checkin_age'];
    }

    /**
     * Sets foursquare_checkin_age
     * @param string $foursquare_checkin_age
     * @return $this
     */
    public function setFoursquareCheckinAge($foursquare_checkin_age)
    {
        $this->container['foursquare_checkin_age'] = $foursquare_checkin_age;

        return $this;
    }

    /**
     * Gets foursquare_checkin_gender
     * @return string
     */
    public function getFoursquareCheckinGender()
    {
        return $this->container['foursquare_checkin_gender'];
    }

    /**
     * Sets foursquare_checkin_gender
     * @param string $foursquare_checkin_gender
     * @return $this
     */
    public function setFoursquareCheckinGender($foursquare_checkin_gender)
    {
        $this->container['foursquare_checkin_gender'] = $foursquare_checkin_gender;

        return $this;
    }

    /**
     * Gets foursquare_checkin_time_of_day
     * @return string
     */
    public function getFoursquareCheckinTimeOfDay()
    {
        return $this->container['foursquare_checkin_time_of_day'];
    }

    /**
     * Sets foursquare_checkin_time_of_day
     * @param string $foursquare_checkin_time_of_day
     * @return $this
     */
    public function setFoursquareCheckinTimeOfDay($foursquare_checkin_time_of_day)
    {
        $this->container['foursquare_checkin_time_of_day'] = $foursquare_checkin_time_of_day;

        return $this;
    }

    /**
     * Gets instagram_content_type
     * @return string
     */
    public function getInstagramContentType()
    {
        return $this->container['instagram_content_type'];
    }

    /**
     * Sets instagram_content_type
     * @param string $instagram_content_type
     * @return $this
     */
    public function setInstagramContentType($instagram_content_type)
    {
        $this->container['instagram_content_type'] = $instagram_content_type;

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


