<?php
/**
 * PowerListingsApi
 * PHP version 5
 *
 * @category Class
 * @package  Yext\Client
 * @author   Swagger Codegen team
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

namespace Yext\Client\Api;

use \Yext\Client\ApiClient;
use \Yext\Client\ApiException;
use \Yext\Client\Configuration;
use \Yext\Client\ObjectSerializer;

/**
 * PowerListingsApi Class Doc Comment
 *
 * @category Class
 * @package  Yext\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PowerListingsApi
{
    /**
     * API Client
     *
     * @var \Yext\Client\ApiClient instance of the ApiClient
     */
    protected $apiClient;

    /**
     * Constructor
     *
     * @param \Yext\Client\ApiClient|null $apiClient The api client to use
     */
    public function __construct(\Yext\Client\ApiClient $apiClient = null)
    {
        if ($apiClient === null) {
            $apiClient = new ApiClient();
        }

        $this->apiClient = $apiClient;
    }

    /**
     * Get API client
     *
     * @return \Yext\Client\ApiClient get the API client
     */
    public function getApiClient()
    {
        return $this->apiClient;
    }

    /**
     * Set the API client
     *
     * @param \Yext\Client\ApiClient $apiClient set the API client
     *
     * @return PowerListingsApi
     */
    public function setApiClient(\Yext\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createDuplicate
     *
     * Duplicates: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $url URL of the Duplicate listing (required)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createDuplicate($account_id, $v, $url, $location_ids = null, $publisher_ids = null)
    {
        list($response) = $this->createDuplicateWithHttpInfo($account_id, $v, $url, $location_ids, $publisher_ids);
        return $response;
    }

    /**
     * Operation createDuplicateWithHttpInfo
     *
     * Duplicates: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $url URL of the Duplicate listing (required)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createDuplicateWithHttpInfo($account_id, $v, $url, $location_ids = null, $publisher_ids = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createDuplicate');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createDuplicate');
        }
        // verify the required parameter 'url' is set
        if ($url === null) {
            throw new \InvalidArgumentException('Missing the required parameter $url when calling createDuplicate');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/duplicates";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // query params
        if (is_array($location_ids)) {
            $location_ids = $this->apiClient->getSerializer()->serializeCollection($location_ids, 'csv', true);
        }
        if ($location_ids !== null) {
            $queryParams['locationIds'] = $this->apiClient->getSerializer()->toQueryValue($location_ids);
        }
        // query params
        if (is_array($publisher_ids)) {
            $publisher_ids = $this->apiClient->getSerializer()->serializeCollection($publisher_ids, 'csv', true);
        }
        if ($publisher_ids !== null) {
            $queryParams['publisherIds'] = $this->apiClient->getSerializer()->toQueryValue($publisher_ids);
        }
        // query params
        if ($url !== null) {
            $queryParams['url'] = $this->apiClient->getSerializer()->toQueryValue($url);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'POST',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\IdResponse',
                '/accounts/{accountId}/powerlistings/duplicates'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\IdResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\IdResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation deleteDuplicate
     *
     * Duplicates: Delete
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $duplicate_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteDuplicate($account_id, $v, $duplicate_id)
    {
        list($response) = $this->deleteDuplicateWithHttpInfo($account_id, $v, $duplicate_id);
        return $response;
    }

    /**
     * Operation deleteDuplicateWithHttpInfo
     *
     * Duplicates: Delete
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $duplicate_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteDuplicateWithHttpInfo($account_id, $v, $duplicate_id)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteDuplicate');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteDuplicate');
        }
        // verify the required parameter 'duplicate_id' is set
        if ($duplicate_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $duplicate_id when calling deleteDuplicate');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/duplicates/{duplicateId}";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // path params
        if ($duplicate_id !== null) {
            $resourcePath = str_replace(
                "{" . "duplicateId" . "}",
                $this->apiClient->getSerializer()->toPathValue($duplicate_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'DELETE',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\ErrorResponse',
                '/accounts/{accountId}/powerlistings/duplicates/{duplicateId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ErrorResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation getPublisherSuggestion
     *
     * Publisher Suggestions: Get
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $suggestion_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\PublisherSuggestionResponse
     */
    public function getPublisherSuggestion($account_id, $v, $suggestion_id)
    {
        list($response) = $this->getPublisherSuggestionWithHttpInfo($account_id, $v, $suggestion_id);
        return $response;
    }

    /**
     * Operation getPublisherSuggestionWithHttpInfo
     *
     * Publisher Suggestions: Get
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $suggestion_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\PublisherSuggestionResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getPublisherSuggestionWithHttpInfo($account_id, $v, $suggestion_id)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getPublisherSuggestion');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getPublisherSuggestion');
        }
        // verify the required parameter 'suggestion_id' is set
        if ($suggestion_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $suggestion_id when calling getPublisherSuggestion');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/publishersuggestions/{suggestionId}";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // path params
        if ($suggestion_id !== null) {
            $resourcePath = str_replace(
                "{" . "suggestionId" . "}",
                $this->apiClient->getSerializer()->toPathValue($suggestion_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\PublisherSuggestionResponse',
                '/accounts/{accountId}/powerlistings/publishersuggestions/{suggestionId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\PublisherSuggestionResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\PublisherSuggestionResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation listDuplicates
     *
     * Duplicates: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string[] $statuses When specified, only Duplicates with the provided statuses will be returned  **Example:** POSSIBLE_DUPLICATE,SUPPRESSION_REQUESTED (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\DuplicatesResponse
     */
    public function listDuplicates($account_id, $v, $limit = null, $offset = null, $location_ids = null, $publisher_ids = null, $statuses = null)
    {
        list($response) = $this->listDuplicatesWithHttpInfo($account_id, $v, $limit, $offset, $location_ids, $publisher_ids, $statuses);
        return $response;
    }

    /**
     * Operation listDuplicatesWithHttpInfo
     *
     * Duplicates: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string[] $statuses When specified, only Duplicates with the provided statuses will be returned  **Example:** POSSIBLE_DUPLICATE,SUPPRESSION_REQUESTED (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\DuplicatesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listDuplicatesWithHttpInfo($account_id, $v, $limit = null, $offset = null, $location_ids = null, $publisher_ids = null, $statuses = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling listDuplicates');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling listDuplicates');
        }
        if (!is_null($limit) && ($limit > 50)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling PowerListingsApi.listDuplicates, must be smaller than or equal to 50.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/duplicates";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = $this->apiClient->getSerializer()->toQueryValue($offset);
        }
        // query params
        if (is_array($location_ids)) {
            $location_ids = $this->apiClient->getSerializer()->serializeCollection($location_ids, 'csv', true);
        }
        if ($location_ids !== null) {
            $queryParams['locationIds'] = $this->apiClient->getSerializer()->toQueryValue($location_ids);
        }
        // query params
        if (is_array($publisher_ids)) {
            $publisher_ids = $this->apiClient->getSerializer()->serializeCollection($publisher_ids, 'csv', true);
        }
        if ($publisher_ids !== null) {
            $queryParams['publisherIds'] = $this->apiClient->getSerializer()->toQueryValue($publisher_ids);
        }
        // query params
        if (is_array($statuses)) {
            $statuses = $this->apiClient->getSerializer()->serializeCollection($statuses, 'csv', true);
        }
        if ($statuses !== null) {
            $queryParams['statuses'] = $this->apiClient->getSerializer()->toQueryValue($statuses);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\DuplicatesResponse',
                '/accounts/{accountId}/powerlistings/duplicates'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\DuplicatesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\DuplicatesResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation listListings
     *
     * Listings: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string $language One of the language codes that we support: - cs - Czech - da - Danish - nl - Dutch - en - English - en_GB - English (UK) - fi - Finnish - fr - French (France) - de - German (Germany) - hu - Hungarian - it - Italian - ja - Japanese - no - Norwegian - pt - Portuguese (Portugal) - sk - Slovak - es - Spanish (Spain) - sv - Swedish - tr - Turkish - zh_Hans - Chinese (Simplified) - zh_Hant - Chinese (Traditional) (optional, default to en)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ListingsResponse
     */
    public function listListings($account_id, $v, $limit = null, $offset = null, $location_ids = null, $publisher_ids = null, $language = null)
    {
        list($response) = $this->listListingsWithHttpInfo($account_id, $v, $limit, $offset, $location_ids, $publisher_ids, $language);
        return $response;
    }

    /**
     * Operation listListingsWithHttpInfo
     *
     * Listings: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string $language One of the language codes that we support: - cs - Czech - da - Danish - nl - Dutch - en - English - en_GB - English (UK) - fi - Finnish - fr - French (France) - de - German (Germany) - hu - Hungarian - it - Italian - ja - Japanese - no - Norwegian - pt - Portuguese (Portugal) - sk - Slovak - es - Spanish (Spain) - sv - Swedish - tr - Turkish - zh_Hans - Chinese (Simplified) - zh_Hant - Chinese (Traditional) (optional, default to en)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ListingsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listListingsWithHttpInfo($account_id, $v, $limit = null, $offset = null, $location_ids = null, $publisher_ids = null, $language = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling listListings');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling listListings');
        }
        if (!is_null($limit) && ($limit > 100)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling PowerListingsApi.listListings, must be smaller than or equal to 100.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/listings";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = $this->apiClient->getSerializer()->toQueryValue($offset);
        }
        // query params
        if (is_array($location_ids)) {
            $location_ids = $this->apiClient->getSerializer()->serializeCollection($location_ids, 'csv', true);
        }
        if ($location_ids !== null) {
            $queryParams['locationIds'] = $this->apiClient->getSerializer()->toQueryValue($location_ids);
        }
        // query params
        if (is_array($publisher_ids)) {
            $publisher_ids = $this->apiClient->getSerializer()->serializeCollection($publisher_ids, 'csv', true);
        }
        if ($publisher_ids !== null) {
            $queryParams['publisherIds'] = $this->apiClient->getSerializer()->toQueryValue($publisher_ids);
        }
        // query params
        if ($language !== null) {
            $queryParams['language'] = $this->apiClient->getSerializer()->toQueryValue($language);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\ListingsResponse',
                '/accounts/{accountId}/powerlistings/listings'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ListingsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ListingsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation listPublisherSuggestions
     *
     * Publisher Suggestions: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string[] $statuses When specified, only Publisher Suggestions with the provided statuses will be returned  **Example:** WAITING_ON_CUSTOMER,EXPIRED (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\PublisherSuggestionsResponse
     */
    public function listPublisherSuggestions($account_id, $v, $limit = null, $offset = null, $location_ids = null, $publisher_ids = null, $statuses = null)
    {
        list($response) = $this->listPublisherSuggestionsWithHttpInfo($account_id, $v, $limit, $offset, $location_ids, $publisher_ids, $statuses);
        return $response;
    }

    /**
     * Operation listPublisherSuggestionsWithHttpInfo
     *
     * Publisher Suggestions: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string[] $statuses When specified, only Publisher Suggestions with the provided statuses will be returned  **Example:** WAITING_ON_CUSTOMER,EXPIRED (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\PublisherSuggestionsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listPublisherSuggestionsWithHttpInfo($account_id, $v, $limit = null, $offset = null, $location_ids = null, $publisher_ids = null, $statuses = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling listPublisherSuggestions');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling listPublisherSuggestions');
        }
        if (!is_null($limit) && ($limit > 50)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling PowerListingsApi.listPublisherSuggestions, must be smaller than or equal to 50.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/publishersuggestions";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
        }
        // query params
        if ($offset !== null) {
            $queryParams['offset'] = $this->apiClient->getSerializer()->toQueryValue($offset);
        }
        // query params
        if (is_array($location_ids)) {
            $location_ids = $this->apiClient->getSerializer()->serializeCollection($location_ids, 'csv', true);
        }
        if ($location_ids !== null) {
            $queryParams['locationIds'] = $this->apiClient->getSerializer()->toQueryValue($location_ids);
        }
        // query params
        if (is_array($publisher_ids)) {
            $publisher_ids = $this->apiClient->getSerializer()->serializeCollection($publisher_ids, 'csv', true);
        }
        if ($publisher_ids !== null) {
            $queryParams['publisherIds'] = $this->apiClient->getSerializer()->toQueryValue($publisher_ids);
        }
        // query params
        if (is_array($statuses)) {
            $statuses = $this->apiClient->getSerializer()->serializeCollection($statuses, 'csv', true);
        }
        if ($statuses !== null) {
            $queryParams['statuses'] = $this->apiClient->getSerializer()->toQueryValue($statuses);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\PublisherSuggestionsResponse',
                '/accounts/{accountId}/powerlistings/publishersuggestions'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\PublisherSuggestionsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\PublisherSuggestionsResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation listPublishers
     *
     * Publishers: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\PublishersResponse
     */
    public function listPublishers($account_id, $v)
    {
        list($response) = $this->listPublishersWithHttpInfo($account_id, $v);
        return $response;
    }

    /**
     * Operation listPublishersWithHttpInfo
     *
     * Publishers: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\PublishersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listPublishersWithHttpInfo($account_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling listPublishers');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling listPublishers');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/publishers";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\PublishersResponse',
                '/accounts/{accountId}/powerlistings/publishers'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\PublishersResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\PublishersResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation optInListings
     *
     * Listings: Opt In
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function optInListings($account_id, $v, $location_ids = null, $publisher_ids = null)
    {
        list($response) = $this->optInListingsWithHttpInfo($account_id, $v, $location_ids, $publisher_ids);
        return $response;
    }

    /**
     * Operation optInListingsWithHttpInfo
     *
     * Listings: Opt In
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function optInListingsWithHttpInfo($account_id, $v, $location_ids = null, $publisher_ids = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling optInListings');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling optInListings');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/listings/optin";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // query params
        if (is_array($location_ids)) {
            $location_ids = $this->apiClient->getSerializer()->serializeCollection($location_ids, 'csv', true);
        }
        if ($location_ids !== null) {
            $queryParams['locationIds'] = $this->apiClient->getSerializer()->toQueryValue($location_ids);
        }
        // query params
        if (is_array($publisher_ids)) {
            $publisher_ids = $this->apiClient->getSerializer()->serializeCollection($publisher_ids, 'csv', true);
        }
        if ($publisher_ids !== null) {
            $queryParams['publisherIds'] = $this->apiClient->getSerializer()->toQueryValue($publisher_ids);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'PUT',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\ErrorResponse',
                '/accounts/{accountId}/powerlistings/listings/optin'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ErrorResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation optOutListings
     *
     * Listings: Opt Out
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function optOutListings($account_id, $v, $location_ids = null, $publisher_ids = null)
    {
        list($response) = $this->optOutListingsWithHttpInfo($account_id, $v, $location_ids, $publisher_ids);
        return $response;
    }

    /**
     * Operation optOutListingsWithHttpInfo
     *
     * Listings: Opt Out
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings® subscription.  **Example:** loc123,loc456,loc789 (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function optOutListingsWithHttpInfo($account_id, $v, $location_ids = null, $publisher_ids = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling optOutListings');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling optOutListings');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/listings/optout";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // query params
        if (is_array($location_ids)) {
            $location_ids = $this->apiClient->getSerializer()->serializeCollection($location_ids, 'csv', true);
        }
        if ($location_ids !== null) {
            $queryParams['locationIds'] = $this->apiClient->getSerializer()->toQueryValue($location_ids);
        }
        // query params
        if (is_array($publisher_ids)) {
            $publisher_ids = $this->apiClient->getSerializer()->serializeCollection($publisher_ids, 'csv', true);
        }
        if ($publisher_ids !== null) {
            $queryParams['publisherIds'] = $this->apiClient->getSerializer()->toQueryValue($publisher_ids);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'PUT',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\ErrorResponse',
                '/accounts/{accountId}/powerlistings/listings/optout'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ErrorResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation suppressDuplicate
     *
     * Duplicates: Suppress
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $duplicate_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function suppressDuplicate($account_id, $v, $duplicate_id)
    {
        list($response) = $this->suppressDuplicateWithHttpInfo($account_id, $v, $duplicate_id);
        return $response;
    }

    /**
     * Operation suppressDuplicateWithHttpInfo
     *
     * Duplicates: Suppress
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $duplicate_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function suppressDuplicateWithHttpInfo($account_id, $v, $duplicate_id)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling suppressDuplicate');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling suppressDuplicate');
        }
        // verify the required parameter 'duplicate_id' is set
        if ($duplicate_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $duplicate_id when calling suppressDuplicate');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/duplicates/{duplicateId}";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // path params
        if ($duplicate_id !== null) {
            $resourcePath = str_replace(
                "{" . "duplicateId" . "}",
                $this->apiClient->getSerializer()->toPathValue($duplicate_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'PUT',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\ErrorResponse',
                '/accounts/{accountId}/powerlistings/duplicates/{duplicateId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ErrorResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }

    /**
     * Operation updatePublisherSuggestion
     *
     * Publisher Suggestions: Update
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $suggestion_id  (required)
     * @param string $status The status of the Publisher Suggestion (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function updatePublisherSuggestion($account_id, $v, $suggestion_id, $status)
    {
        list($response) = $this->updatePublisherSuggestionWithHttpInfo($account_id, $v, $suggestion_id, $status);
        return $response;
    }

    /**
     * Operation updatePublisherSuggestionWithHttpInfo
     *
     * Publisher Suggestions: Update
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $suggestion_id  (required)
     * @param string $status The status of the Publisher Suggestion (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updatePublisherSuggestionWithHttpInfo($account_id, $v, $suggestion_id, $status)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updatePublisherSuggestion');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updatePublisherSuggestion');
        }
        // verify the required parameter 'suggestion_id' is set
        if ($suggestion_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $suggestion_id when calling updatePublisherSuggestion');
        }
        // verify the required parameter 'status' is set
        if ($status === null) {
            throw new \InvalidArgumentException('Missing the required parameter $status when calling updatePublisherSuggestion');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/powerlistings/publishersuggestions/{suggestionId}";
        $httpBody = '';
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        $_header_accept = $this->apiClient->selectHeaderAccept(['application/json']);
        if (!is_null($_header_accept)) {
            $headerParams['Accept'] = $_header_accept;
        }
        $headerParams['Content-Type'] = $this->apiClient->selectHeaderContentType(['application/json']);

        // query params
        if ($v !== null) {
            $queryParams['v'] = $this->apiClient->getSerializer()->toQueryValue($v);
        }
        // query params
        if ($status !== null) {
            $queryParams['status'] = $this->apiClient->getSerializer()->toQueryValue($status);
        }
        // path params
        if ($account_id !== null) {
            $resourcePath = str_replace(
                "{" . "accountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($account_id),
                $resourcePath
            );
        }
        // path params
        if ($suggestion_id !== null) {
            $resourcePath = str_replace(
                "{" . "suggestionId" . "}",
                $this->apiClient->getSerializer()->toPathValue($suggestion_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        
        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present
        } elseif (count($formParams) > 0) {
            $httpBody = $formParams; // for HTTP post (form)
        }
        // this endpoint requires API key authentication
        $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
        if (strlen($apiKey) !== 0) {
            $queryParams['api_key'] = $apiKey;
        }
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'PUT',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\ErrorResponse',
                '/accounts/{accountId}/powerlistings/publishersuggestions/{suggestionId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ErrorResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 0:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }
}
