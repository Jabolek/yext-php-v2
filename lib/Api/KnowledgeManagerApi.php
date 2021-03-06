<?php
/**
 * KnowledgeManagerApi
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
 * KnowledgeManagerApi Class Doc Comment
 *
 * @category Class
 * @package  Yext\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class KnowledgeManagerApi
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
     * @return KnowledgeManagerApi
     */
    public function setApiClient(\Yext\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createAsset
     *
     * Assets: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Asset $asset_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createAsset($account_id, $v, $asset_request)
    {
        list($response) = $this->createAssetWithHttpInfo($account_id, $v, $asset_request);
        return $response;
    }

    /**
     * Operation createAssetWithHttpInfo
     *
     * Assets: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Asset $asset_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createAssetWithHttpInfo($account_id, $v, $asset_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createAsset');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createAsset');
        }
        // verify the required parameter 'asset_request' is set
        if ($asset_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $asset_request when calling createAsset');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/assets";
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

        // body params
        $_tempBody = null;
        if (isset($asset_request)) {
            $_tempBody = $asset_request;
        }

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
                '/accounts/{accountId}/assets'
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
     * Operation createBio
     *
     * Bios: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Bio $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createBio($account_id, $v, $body)
    {
        list($response) = $this->createBioWithHttpInfo($account_id, $v, $body);
        return $response;
    }

    /**
     * Operation createBioWithHttpInfo
     *
     * Bios: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Bio $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createBioWithHttpInfo($account_id, $v, $body)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createBio');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createBio');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling createBio');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/bios";
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

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '/accounts/{accountId}/bios'
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
     * Operation createCustomField
     *
     * Custom Fields: Create
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param \Yext\Client\Model\CustomField $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createCustomField($v, $account_id, $body)
    {
        list($response) = $this->createCustomFieldWithHttpInfo($v, $account_id, $body);
        return $response;
    }

    /**
     * Operation createCustomFieldWithHttpInfo
     *
     * Custom Fields: Create
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param \Yext\Client\Model\CustomField $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createCustomFieldWithHttpInfo($v, $account_id, $body)
    {
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createCustomField');
        }
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createCustomField');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling createCustomField');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/customfields";
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

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '/accounts/{accountId}/customfields'
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
     * Operation createEvent
     *
     * Events: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Event $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createEvent($account_id, $v, $body)
    {
        list($response) = $this->createEventWithHttpInfo($account_id, $v, $body);
        return $response;
    }

    /**
     * Operation createEventWithHttpInfo
     *
     * Events: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Event $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createEventWithHttpInfo($account_id, $v, $body)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createEvent');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createEvent');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling createEvent');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/events";
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

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '/accounts/{accountId}/events'
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
     * Operation createLocation
     *
     * Locations: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Location $location_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createLocation($account_id, $v, $location_request)
    {
        list($response) = $this->createLocationWithHttpInfo($account_id, $v, $location_request);
        return $response;
    }

    /**
     * Operation createLocationWithHttpInfo
     *
     * Locations: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Location $location_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createLocationWithHttpInfo($account_id, $v, $location_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createLocation');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createLocation');
        }
        // verify the required parameter 'location_request' is set
        if ($location_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_request when calling createLocation');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/locations";
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

        // body params
        $_tempBody = null;
        if (isset($location_request)) {
            $_tempBody = $location_request;
        }

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
                '/accounts/{accountId}/locations'
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
     * Operation createMenu
     *
     * Menus: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Menu $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createMenu($account_id, $v, $body)
    {
        list($response) = $this->createMenuWithHttpInfo($account_id, $v, $body);
        return $response;
    }

    /**
     * Operation createMenuWithHttpInfo
     *
     * Menus: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Menu $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createMenuWithHttpInfo($account_id, $v, $body)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createMenu');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createMenu');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling createMenu');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/menus";
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

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '/accounts/{accountId}/menus'
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
     * Operation createProduct
     *
     * Products: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Product $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createProduct($account_id, $v, $body)
    {
        list($response) = $this->createProductWithHttpInfo($account_id, $v, $body);
        return $response;
    }

    /**
     * Operation createProductWithHttpInfo
     *
     * Products: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Product $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createProductWithHttpInfo($account_id, $v, $body)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createProduct');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createProduct');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling createProduct');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/products";
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

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '/accounts/{accountId}/products'
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
     * Operation deleteAsset
     *
     * Assets: Delete
     *
     * @param string $account_id  (required)
     * @param string $asset_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteAsset($account_id, $asset_id, $v)
    {
        list($response) = $this->deleteAssetWithHttpInfo($account_id, $asset_id, $v);
        return $response;
    }

    /**
     * Operation deleteAssetWithHttpInfo
     *
     * Assets: Delete
     *
     * @param string $account_id  (required)
     * @param string $asset_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteAssetWithHttpInfo($account_id, $asset_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteAsset');
        }
        // verify the required parameter 'asset_id' is set
        if ($asset_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $asset_id when calling deleteAsset');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteAsset');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/assets/{assetId}";
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
        if ($asset_id !== null) {
            $resourcePath = str_replace(
                "{" . "assetId" . "}",
                $this->apiClient->getSerializer()->toPathValue($asset_id),
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
                '/accounts/{accountId}/assets/{assetId}'
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
     * Operation deleteBioList
     *
     * Bios: Delete
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteBioList($account_id, $list_id, $v)
    {
        list($response) = $this->deleteBioListWithHttpInfo($account_id, $list_id, $v);
        return $response;
    }

    /**
     * Operation deleteBioListWithHttpInfo
     *
     * Bios: Delete
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteBioListWithHttpInfo($account_id, $list_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteBioList');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling deleteBioList');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteBioList');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/bios/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
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
                '/accounts/{accountId}/bios/{listId}'
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
     * Operation deleteCustomField
     *
     * Custom Fields: Delete
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param string $custom_field_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteCustomField($v, $account_id, $custom_field_id)
    {
        list($response) = $this->deleteCustomFieldWithHttpInfo($v, $account_id, $custom_field_id);
        return $response;
    }

    /**
     * Operation deleteCustomFieldWithHttpInfo
     *
     * Custom Fields: Delete
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param string $custom_field_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteCustomFieldWithHttpInfo($v, $account_id, $custom_field_id)
    {
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteCustomField');
        }
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteCustomField');
        }
        // verify the required parameter 'custom_field_id' is set
        if ($custom_field_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $custom_field_id when calling deleteCustomField');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/customfields/{customFieldId}";
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
        if ($custom_field_id !== null) {
            $resourcePath = str_replace(
                "{" . "customFieldId" . "}",
                $this->apiClient->getSerializer()->toPathValue($custom_field_id),
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
                '/accounts/{accountId}/customfields/{customFieldId}'
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
     * Operation deleteEventList
     *
     * Events: Delete
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteEventList($account_id, $list_id, $v)
    {
        list($response) = $this->deleteEventListWithHttpInfo($account_id, $list_id, $v);
        return $response;
    }

    /**
     * Operation deleteEventListWithHttpInfo
     *
     * Events: Delete
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteEventListWithHttpInfo($account_id, $list_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteEventList');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling deleteEventList');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteEventList');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/events/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
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
                '/accounts/{accountId}/events/{listId}'
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
     * Operation deleteLanguageProfile
     *
     * Language Profiles: Delete
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $language_code Locale code. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteLanguageProfile($account_id, $location_id, $language_code, $v)
    {
        list($response) = $this->deleteLanguageProfileWithHttpInfo($account_id, $location_id, $language_code, $v);
        return $response;
    }

    /**
     * Operation deleteLanguageProfileWithHttpInfo
     *
     * Language Profiles: Delete
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $language_code Locale code. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteLanguageProfileWithHttpInfo($account_id, $location_id, $language_code, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteLanguageProfile');
        }
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling deleteLanguageProfile');
        }
        // verify the required parameter 'language_code' is set
        if ($language_code === null) {
            throw new \InvalidArgumentException('Missing the required parameter $language_code when calling deleteLanguageProfile');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteLanguageProfile');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/locations/{locationId}/profiles/{language_code}";
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
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "locationId" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }
        // path params
        if ($language_code !== null) {
            $resourcePath = str_replace(
                "{" . "language_code" . "}",
                $this->apiClient->getSerializer()->toPathValue($language_code),
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
                '/accounts/{accountId}/locations/{locationId}/profiles/{language_code}'
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
     * Operation deleteMenuList
     *
     * Menus: Delete
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteMenuList($account_id, $list_id, $v)
    {
        list($response) = $this->deleteMenuListWithHttpInfo($account_id, $list_id, $v);
        return $response;
    }

    /**
     * Operation deleteMenuListWithHttpInfo
     *
     * Menus: Delete
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteMenuListWithHttpInfo($account_id, $list_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteMenuList');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling deleteMenuList');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteMenuList');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/menus/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
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
                '/accounts/{accountId}/menus/{listId}'
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
     * Operation deleteProductList
     *
     * Products: Delete
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteProductList($account_id, $list_id, $v)
    {
        list($response) = $this->deleteProductListWithHttpInfo($account_id, $list_id, $v);
        return $response;
    }

    /**
     * Operation deleteProductListWithHttpInfo
     *
     * Products: Delete
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteProductListWithHttpInfo($account_id, $list_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteProductList');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling deleteProductList');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteProductList');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/products/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
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
                '/accounts/{accountId}/products/{listId}'
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
     * Operation getAsset
     *
     * Assets: Get
     *
     * @param string $account_id  (required)
     * @param string $asset_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\AssetResponse
     */
    public function getAsset($account_id, $asset_id, $v)
    {
        list($response) = $this->getAssetWithHttpInfo($account_id, $asset_id, $v);
        return $response;
    }

    /**
     * Operation getAssetWithHttpInfo
     *
     * Assets: Get
     *
     * @param string $account_id  (required)
     * @param string $asset_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\AssetResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getAssetWithHttpInfo($account_id, $asset_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getAsset');
        }
        // verify the required parameter 'asset_id' is set
        if ($asset_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $asset_id when calling getAsset');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getAsset');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/assets/{assetId}";
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
        if ($asset_id !== null) {
            $resourcePath = str_replace(
                "{" . "assetId" . "}",
                $this->apiClient->getSerializer()->toPathValue($asset_id),
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
                '\Yext\Client\Model\AssetResponse',
                '/accounts/{accountId}/assets/{assetId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\AssetResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\AssetResponse', $e->getResponseHeaders());
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
     * Operation getBio
     *
     * Bios: Get
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\BioListResponse
     */
    public function getBio($account_id, $list_id, $v)
    {
        list($response) = $this->getBioWithHttpInfo($account_id, $list_id, $v);
        return $response;
    }

    /**
     * Operation getBioWithHttpInfo
     *
     * Bios: Get
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\BioListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getBioWithHttpInfo($account_id, $list_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getBio');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling getBio');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getBio');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/bios/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
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
                '\Yext\Client\Model\BioListResponse',
                '/accounts/{accountId}/bios/{listId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\BioListResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\BioListResponse', $e->getResponseHeaders());
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
     * Operation getBios
     *
     * Bios: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\BioListsResponse
     */
    public function getBios($account_id, $v, $limit = null, $offset = null)
    {
        list($response) = $this->getBiosWithHttpInfo($account_id, $v, $limit, $offset);
        return $response;
    }

    /**
     * Operation getBiosWithHttpInfo
     *
     * Bios: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\BioListsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getBiosWithHttpInfo($account_id, $v, $limit = null, $offset = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getBios');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getBios');
        }
        if (!is_null($limit) && ($limit > 50)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling KnowledgeManagerApi.getBios, must be smaller than or equal to 50.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/bios";
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
                '\Yext\Client\Model\BioListsResponse',
                '/accounts/{accountId}/bios'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\BioListsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\BioListsResponse', $e->getResponseHeaders());
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
     * Operation getBusinessCategories
     *
     * Categories: List
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $language Only categories that apply to this language will be returned.  **Example:** en (optional, default to en)
     * @param string $country Only categories that apply in this country will be returned.  **Example:** US (optional, default to US)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\BusinessCategoriesResponse
     */
    public function getBusinessCategories($v, $language = null, $country = null)
    {
        list($response) = $this->getBusinessCategoriesWithHttpInfo($v, $language, $country);
        return $response;
    }

    /**
     * Operation getBusinessCategoriesWithHttpInfo
     *
     * Categories: List
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $language Only categories that apply to this language will be returned.  **Example:** en (optional, default to en)
     * @param string $country Only categories that apply in this country will be returned.  **Example:** US (optional, default to US)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\BusinessCategoriesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getBusinessCategoriesWithHttpInfo($v, $language = null, $country = null)
    {
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getBusinessCategories');
        }
        // parse inputs
        $resourcePath = "/categories";
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
        if ($language !== null) {
            $queryParams['language'] = $this->apiClient->getSerializer()->toQueryValue($language);
        }
        // query params
        if ($country !== null) {
            $queryParams['country'] = $this->apiClient->getSerializer()->toQueryValue($country);
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
                '\Yext\Client\Model\BusinessCategoriesResponse',
                '/categories'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\BusinessCategoriesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\BusinessCategoriesResponse', $e->getResponseHeaders());
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
     * Operation getCustomField
     *
     * Custom Fields: Get
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param string $custom_field_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\CustomFieldResponse
     */
    public function getCustomField($v, $account_id, $custom_field_id)
    {
        list($response) = $this->getCustomFieldWithHttpInfo($v, $account_id, $custom_field_id);
        return $response;
    }

    /**
     * Operation getCustomFieldWithHttpInfo
     *
     * Custom Fields: Get
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param string $custom_field_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\CustomFieldResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getCustomFieldWithHttpInfo($v, $account_id, $custom_field_id)
    {
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getCustomField');
        }
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getCustomField');
        }
        // verify the required parameter 'custom_field_id' is set
        if ($custom_field_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $custom_field_id when calling getCustomField');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/customfields/{customFieldId}";
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
        if ($custom_field_id !== null) {
            $resourcePath = str_replace(
                "{" . "customFieldId" . "}",
                $this->apiClient->getSerializer()->toPathValue($custom_field_id),
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
                '\Yext\Client\Model\CustomFieldResponse',
                '/accounts/{accountId}/customfields/{customFieldId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\CustomFieldResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\CustomFieldResponse', $e->getResponseHeaders());
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
     * Operation getCustomFields
     *
     * Custom Fields: List
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param int $limit Number of results to return. (optional, default to 100)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\CustomFieldsResponse
     */
    public function getCustomFields($v, $account_id, $offset = null, $limit = null)
    {
        list($response) = $this->getCustomFieldsWithHttpInfo($v, $account_id, $offset, $limit);
        return $response;
    }

    /**
     * Operation getCustomFieldsWithHttpInfo
     *
     * Custom Fields: List
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param int $limit Number of results to return. (optional, default to 100)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\CustomFieldsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getCustomFieldsWithHttpInfo($v, $account_id, $offset = null, $limit = null)
    {
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getCustomFields');
        }
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getCustomFields');
        }
        if (!is_null($limit) && ($limit > 1000)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling KnowledgeManagerApi.getCustomFields, must be smaller than or equal to 1000.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/customfields";
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
        if ($offset !== null) {
            $queryParams['offset'] = $this->apiClient->getSerializer()->toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
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
                '\Yext\Client\Model\CustomFieldsResponse',
                '/accounts/{accountId}/customfields'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\CustomFieldsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\CustomFieldsResponse', $e->getResponseHeaders());
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
     * Operation getEvent
     *
     * Events: Get
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\EventListResponse
     */
    public function getEvent($account_id, $list_id, $v)
    {
        list($response) = $this->getEventWithHttpInfo($account_id, $list_id, $v);
        return $response;
    }

    /**
     * Operation getEventWithHttpInfo
     *
     * Events: Get
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\EventListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getEventWithHttpInfo($account_id, $list_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getEvent');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling getEvent');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getEvent');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/events/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
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
                '\Yext\Client\Model\EventListResponse',
                '/accounts/{accountId}/events/{listId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\EventListResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\EventListResponse', $e->getResponseHeaders());
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
     * Operation getEvents
     *
     * Events: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\EventListsResponse
     */
    public function getEvents($account_id, $v, $limit = null, $offset = null)
    {
        list($response) = $this->getEventsWithHttpInfo($account_id, $v, $limit, $offset);
        return $response;
    }

    /**
     * Operation getEventsWithHttpInfo
     *
     * Events: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\EventListsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getEventsWithHttpInfo($account_id, $v, $limit = null, $offset = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getEvents');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getEvents');
        }
        if (!is_null($limit) && ($limit > 50)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling KnowledgeManagerApi.getEvents, must be smaller than or equal to 50.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/events";
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
                '\Yext\Client\Model\EventListsResponse',
                '/accounts/{accountId}/events'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\EventListsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\EventListsResponse', $e->getResponseHeaders());
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
     * Operation getGoogleKeywords
     *
     * Google Fields: List
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\GoogleFieldsResponse
     */
    public function getGoogleKeywords($v)
    {
        list($response) = $this->getGoogleKeywordsWithHttpInfo($v);
        return $response;
    }

    /**
     * Operation getGoogleKeywordsWithHttpInfo
     *
     * Google Fields: List
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\GoogleFieldsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getGoogleKeywordsWithHttpInfo($v)
    {
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getGoogleKeywords');
        }
        // parse inputs
        $resourcePath = "/googlefields";
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
                '\Yext\Client\Model\GoogleFieldsResponse',
                '/googlefields'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\GoogleFieldsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\GoogleFieldsResponse', $e->getResponseHeaders());
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
     * Operation getLanguageProfile
     *
     * Language Profiles: Get
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $language_code Locale code. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param bool $resolve_placeholders Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; (optional, default to false)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\LocationResponse
     */
    public function getLanguageProfile($account_id, $location_id, $language_code, $v, $resolve_placeholders = null)
    {
        list($response) = $this->getLanguageProfileWithHttpInfo($account_id, $location_id, $language_code, $v, $resolve_placeholders);
        return $response;
    }

    /**
     * Operation getLanguageProfileWithHttpInfo
     *
     * Language Profiles: Get
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $language_code Locale code. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param bool $resolve_placeholders Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; (optional, default to false)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\LocationResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLanguageProfileWithHttpInfo($account_id, $location_id, $language_code, $v, $resolve_placeholders = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getLanguageProfile');
        }
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling getLanguageProfile');
        }
        // verify the required parameter 'language_code' is set
        if ($language_code === null) {
            throw new \InvalidArgumentException('Missing the required parameter $language_code when calling getLanguageProfile');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getLanguageProfile');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/locations/{locationId}/profiles/{language_code}";
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
        if ($resolve_placeholders !== null) {
            $queryParams['resolvePlaceholders'] = $this->apiClient->getSerializer()->toQueryValue($resolve_placeholders);
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
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "locationId" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }
        // path params
        if ($language_code !== null) {
            $resourcePath = str_replace(
                "{" . "language_code" . "}",
                $this->apiClient->getSerializer()->toPathValue($language_code),
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
                '\Yext\Client\Model\LocationResponse',
                '/accounts/{accountId}/locations/{locationId}/profiles/{language_code}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\LocationResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\LocationResponse', $e->getResponseHeaders());
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
     * Operation getLanguageProfiles
     *
     * Language Profiles: List
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param bool $resolve_placeholders Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; (optional, default to false)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\LanguageProfilesResponse
     */
    public function getLanguageProfiles($account_id, $location_id, $v, $resolve_placeholders = null)
    {
        list($response) = $this->getLanguageProfilesWithHttpInfo($account_id, $location_id, $v, $resolve_placeholders);
        return $response;
    }

    /**
     * Operation getLanguageProfilesWithHttpInfo
     *
     * Language Profiles: List
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param bool $resolve_placeholders Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; (optional, default to false)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\LanguageProfilesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLanguageProfilesWithHttpInfo($account_id, $location_id, $v, $resolve_placeholders = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getLanguageProfiles');
        }
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling getLanguageProfiles');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getLanguageProfiles');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/locations/{locationId}/profiles";
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
        if ($resolve_placeholders !== null) {
            $queryParams['resolvePlaceholders'] = $this->apiClient->getSerializer()->toQueryValue($resolve_placeholders);
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
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "locationId" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
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
                '\Yext\Client\Model\LanguageProfilesResponse',
                '/accounts/{accountId}/locations/{locationId}/profiles'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\LanguageProfilesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\LanguageProfilesResponse', $e->getResponseHeaders());
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
     * Operation getLocation
     *
     * Locations: Get
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param bool $resolve_placeholders Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; (optional, default to false)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\LocationResponse
     */
    public function getLocation($account_id, $location_id, $v, $resolve_placeholders = null)
    {
        list($response) = $this->getLocationWithHttpInfo($account_id, $location_id, $v, $resolve_placeholders);
        return $response;
    }

    /**
     * Operation getLocationWithHttpInfo
     *
     * Locations: Get
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param bool $resolve_placeholders Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; (optional, default to false)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\LocationResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLocationWithHttpInfo($account_id, $location_id, $v, $resolve_placeholders = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getLocation');
        }
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling getLocation');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getLocation');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/locations/{locationId}";
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
        if ($resolve_placeholders !== null) {
            $queryParams['resolvePlaceholders'] = $this->apiClient->getSerializer()->toQueryValue($resolve_placeholders);
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
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "locationId" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
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
                '\Yext\Client\Model\LocationResponse',
                '/accounts/{accountId}/locations/{locationId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\LocationResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\LocationResponse', $e->getResponseHeaders());
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
     * Operation getLocationFolders
     *
     * Folders: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param int $limit Number of results to return. (optional, default to 100)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\FoldersResponse
     */
    public function getLocationFolders($account_id, $v, $offset = null, $limit = null)
    {
        list($response) = $this->getLocationFoldersWithHttpInfo($account_id, $v, $offset, $limit);
        return $response;
    }

    /**
     * Operation getLocationFoldersWithHttpInfo
     *
     * Folders: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param int $limit Number of results to return. (optional, default to 100)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\FoldersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLocationFoldersWithHttpInfo($account_id, $v, $offset = null, $limit = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getLocationFolders');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getLocationFolders');
        }
        if (!is_null($limit) && ($limit > 1000)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling KnowledgeManagerApi.getLocationFolders, must be smaller than or equal to 1000.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/folders";
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
        if ($offset !== null) {
            $queryParams['offset'] = $this->apiClient->getSerializer()->toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
        }
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
                '\Yext\Client\Model\FoldersResponse',
                '/accounts/{accountId}/folders'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\FoldersResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\FoldersResponse', $e->getResponseHeaders());
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
     * Operation getLocations
     *
     * Locations: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param bool $resolve_placeholders Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; (optional, default to false)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\LocationsResponse
     */
    public function getLocations($account_id, $v, $limit = null, $offset = null, $resolve_placeholders = null)
    {
        list($response) = $this->getLocationsWithHttpInfo($account_id, $v, $limit, $offset, $resolve_placeholders);
        return $response;
    }

    /**
     * Operation getLocationsWithHttpInfo
     *
     * Locations: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param bool $resolve_placeholders Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; (optional, default to false)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\LocationsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLocationsWithHttpInfo($account_id, $v, $limit = null, $offset = null, $resolve_placeholders = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getLocations');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getLocations');
        }
        if (!is_null($limit) && ($limit > 50)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling KnowledgeManagerApi.getLocations, must be smaller than or equal to 50.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/locations";
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
        if ($resolve_placeholders !== null) {
            $queryParams['resolvePlaceholders'] = $this->apiClient->getSerializer()->toQueryValue($resolve_placeholders);
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
        $accessToken = $this->apiClient->getConfig()->getAccessToken();
        if($accessToken){
            $queryParams['access_token'] = $accessToken;
        } else {
            $apiKey = $this->apiClient->getApiKeyWithPrefix('api_key');
            if (strlen($apiKey) !== 0) {
                $queryParams['api_key'] = $apiKey;
            }
        }
        
        // make the API Call
        try {
            list($response, $statusCode, $httpHeader) = $this->apiClient->callApi(
                $resourcePath,
                'GET',
                $queryParams,
                $httpBody,
                $headerParams,
                '\Yext\Client\Model\LocationsResponse',
                '/accounts/{accountId}/locations'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\LocationsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\LocationsResponse', $e->getResponseHeaders());
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
     * Operation getMenu
     *
     * Menus: Get
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\MenuListResponse
     */
    public function getMenu($account_id, $list_id, $v)
    {
        list($response) = $this->getMenuWithHttpInfo($account_id, $list_id, $v);
        return $response;
    }

    /**
     * Operation getMenuWithHttpInfo
     *
     * Menus: Get
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\MenuListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getMenuWithHttpInfo($account_id, $list_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getMenu');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling getMenu');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getMenu');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/menus/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
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
                '\Yext\Client\Model\MenuListResponse',
                '/accounts/{accountId}/menus/{listId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\MenuListResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\MenuListResponse', $e->getResponseHeaders());
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
     * Operation getMenus
     *
     * Menus: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\MenuListsResponse
     */
    public function getMenus($account_id, $v, $limit = null, $offset = null)
    {
        list($response) = $this->getMenusWithHttpInfo($account_id, $v, $limit, $offset);
        return $response;
    }

    /**
     * Operation getMenusWithHttpInfo
     *
     * Menus: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\MenuListsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getMenusWithHttpInfo($account_id, $v, $limit = null, $offset = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getMenus');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getMenus');
        }
        if (!is_null($limit) && ($limit > 50)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling KnowledgeManagerApi.getMenus, must be smaller than or equal to 50.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/menus";
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
                '\Yext\Client\Model\MenuListsResponse',
                '/accounts/{accountId}/menus'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\MenuListsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\MenuListsResponse', $e->getResponseHeaders());
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
     * Operation getProduct
     *
     * Products: Get
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ProductListResponse
     */
    public function getProduct($account_id, $list_id, $v)
    {
        list($response) = $this->getProductWithHttpInfo($account_id, $list_id, $v);
        return $response;
    }

    /**
     * Operation getProductWithHttpInfo
     *
     * Products: Get
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ProductListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getProductWithHttpInfo($account_id, $list_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getProduct');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling getProduct');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getProduct');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/products/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
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
                '\Yext\Client\Model\ProductListResponse',
                '/accounts/{accountId}/products/{listId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ProductListResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ProductListResponse', $e->getResponseHeaders());
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
     * Operation getProducts
     *
     * Products: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ProductListsResponse
     */
    public function getProducts($account_id, $v, $limit = null, $offset = null)
    {
        list($response) = $this->getProductsWithHttpInfo($account_id, $v, $limit, $offset);
        return $response;
    }

    /**
     * Operation getProductsWithHttpInfo
     *
     * Products: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ProductListsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getProductsWithHttpInfo($account_id, $v, $limit = null, $offset = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getProducts');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getProducts');
        }
        if (!is_null($limit) && ($limit > 50)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling KnowledgeManagerApi.getProducts, must be smaller than or equal to 50.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/products";
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
                '\Yext\Client\Model\ProductListsResponse',
                '/accounts/{accountId}/products'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ProductListsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ProductListsResponse', $e->getResponseHeaders());
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
     * Operation listAssets
     *
     * Assets: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param int $limit Number of results to return. (optional, default to 100)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\AssetsResponse
     */
    public function listAssets($account_id, $v, $offset = null, $limit = null)
    {
        list($response) = $this->listAssetsWithHttpInfo($account_id, $v, $offset, $limit);
        return $response;
    }

    /**
     * Operation listAssetsWithHttpInfo
     *
     * Assets: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param int $limit Number of results to return. (optional, default to 100)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\AssetsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listAssetsWithHttpInfo($account_id, $v, $offset = null, $limit = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling listAssets');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling listAssets');
        }
        if (!is_null($limit) && ($limit > 1000)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling KnowledgeManagerApi.listAssets, must be smaller than or equal to 1000.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/assets";
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
        if ($offset !== null) {
            $queryParams['offset'] = $this->apiClient->getSerializer()->toQueryValue($offset);
        }
        // query params
        if ($limit !== null) {
            $queryParams['limit'] = $this->apiClient->getSerializer()->toQueryValue($limit);
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
                '\Yext\Client\Model\AssetsResponse',
                '/accounts/{accountId}/assets'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\AssetsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\AssetsResponse', $e->getResponseHeaders());
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
     * Operation searchLocations
     *
     * Locations: Search
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string $filters A set of filters that is applied to the set of locations that would otherwise be returned. Should be provided as a URL-encoded string containing a JSON object. The JSON object will be an array with one or more filter objects defined. All filter objects will apply as an intersection (i.e. AND). Field names reference Location fields, as well as custom fields using the format custom###, where ### is the custom field’s ID.  The filter types are the following. Note there may be multiple available specifications for a given filter type:  &lt;table style&#x3D;\&quot;width:100%\&quot;&gt;   &lt;tr&gt;     &lt;th&gt;Filter Type&lt;/th&gt;     &lt;th&gt;Syntax&lt;/th&gt;     &lt;th&gt;Description&lt;/th&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Full&lt;/td&gt;     &lt;td&gt;fieldName: {contains: $search}&lt;/td&gt;     &lt;td&gt;$search is the search string&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$search,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [contains,doesNotContain,startsWith,equalTo], $search is an array of search strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [empty,notEmpty]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Number&lt;/td&gt;     &lt;td&gt;fieldName: {$type: $value}&lt;/td&gt;     &lt;td&gt;$type is one of [eq,lt,gt,le,ge], $value is the numeric value&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Number&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$value1, $value2]}&lt;/td&gt;     &lt;td&gt;$type is one of [between], $value1 and $value2 are numeric values&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Date&lt;/td&gt;     &lt;td&gt;fieldName: {$type: $value}&lt;/td&gt;     &lt;td&gt;$type is one of [eq,lt,gt,le,ge], $value is a string of \&quot;YYYY-MM-DD” formatted date&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Date&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [empty,notEmpty]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Date&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$value1, $value2]}&lt;/td&gt;     &lt;td&gt;$type is one of [between], $value1 and $value2 are strings of \&quot;YYYY-MM-DD” formatted date&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Categories&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $id is an array of numeric category IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Categories&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [none]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Assets&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $id is an array of numeric category IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Assets&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [none]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Country&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$country,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $country is an array of country code strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;PrimaryLanguage&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$language,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $language is an array of language code strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;AlternateLanguage&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$language,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $language is an array of language code strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;StringSingle&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$string,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $string is an array of strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;StringList&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$string,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $string is an array of strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;LocationType&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $id is an array of location type IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Bool&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [true,false]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Option&lt;/td&gt;     &lt;td&gt;fieldName: {$type: $id}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $id is an option ID (For single option custom fields)&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Option&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $string is an array of strings, combined with OR (For multi option custom fields)&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $id is an array of IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt; &lt;/table&gt;  The following fields can be specified in the request (Field name/Filter Type/Example(s)):  &lt;table style&#x3D;\&quot;width:100%\&quot;&gt;   &lt;tr&gt;     &lt;th&gt;Field Name&lt;/th&gt;     &lt;th&gt;Filter Type&lt;/th&gt;     &lt;th&gt;Example(s)&lt;/th&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;location&lt;/td&gt;     &lt;td&gt;Full&lt;/td&gt;     &lt;td&gt;\&quot;location”: {\&quot;contains”: \&quot;Atlanta”}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;name&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;name”: {\&quot;startsWith”: [\&quot;Guitar”]}, \&quot;name”: {\&quot;contains”: [\&quot;A”,”B”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;address&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;address”: {\&quot;startsWith”: [\&quot;South”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;address2&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;address2”: {\&quot;contains”: [\&quot;Suite”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;city&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;city”: {\&quot;contains”: [\&quot;Atlanta”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;state&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;state”: {\&quot;contains”: [\&quot;AK”,”VA”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;zip&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;zip”: {\&quot;contains”: [\&quot;M5K 7QB”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;phones&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;phones”: {\&quot;startsWith”: [\&quot;703”,”571”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;specialOffer&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;specialOffer”: \&quot;notEmpty”&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;emails&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;emails”: {\&quot;doesNotContain”: [\&quot;@yext.com”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;website&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;website”: {\&quot;equalTo”: [\&quot;https://www.yext.com/”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;categories&lt;/td&gt;     &lt;td&gt;Categories&lt;/td&gt;     &lt;td&gt;\&quot;categories”: {\&quot;includes”: [23,755,34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;closed&lt;/td&gt;     &lt;td&gt;Bool&lt;/td&gt;     &lt;td&gt;\&quot;closed”: true&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;storeId&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;storeId”: {\&quot;equalTo”: [\&quot;MCD0001”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;countryCode&lt;/td&gt;     &lt;td&gt;Country&lt;/td&gt;     &lt;td&gt;\&quot;countryCode”: {\&quot;notIncludes”: [\&quot;US”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;products&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;products”: {\&quot;startsWith”: [\&quot;Burger”,”Fries”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;services&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;services”: {\&quot;contains”: [\&quot;Manicures”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;specialties&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;services”: \&quot;notEmpty”&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;associations&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;associations”: \&quot;empty”&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;brands&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;brands”: {\&quot;equalTo”: [\&quot;North Face”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;languages&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;languages”: {\&quot;equalTo”: [\&quot;English”,”Spanish”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;keywords&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;keywords”: {\&quot;startsWith”: [\&quot;Franchise”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;menuIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;menuIds”: {\&quot;includes”: [23,755,34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;productListIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;productListIds”: {\&quot;notIncludes”: [2]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;calendarIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;calendarIds”: {\&quot;notIncludes”: [34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;bioIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;bioIds”: {\&quot;includes”: [23,34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;custom###&lt;/td&gt;     &lt;td&gt;Text, Number, Date, Bool, or Option&lt;/td&gt;     &lt;td&gt;\&quot;custom123”: {\&quot;equalTo”: [\&quot;asdf”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;folder&lt;/td&gt;     &lt;td&gt;int64&lt;/td&gt;     &lt;td&gt;\&quot;folder”: 123&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;primary_language&lt;/td&gt;     &lt;td&gt;PrimaryLanguage&lt;/td&gt;     &lt;td&gt;\&quot;primary_language”: {\&quot;is”: \&quot;fr_CA”}&lt;/td&gt;   &lt;/tr&gt; &lt;/table&gt; (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\LocationsResponse
     */
    public function searchLocations($account_id, $v, $limit = null, $offset = null, $filters = null)
    {
        list($response) = $this->searchLocationsWithHttpInfo($account_id, $v, $limit, $offset, $filters);
        return $response;
    }

    /**
     * Operation searchLocationsWithHttpInfo
     *
     * Locations: Search
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string $filters A set of filters that is applied to the set of locations that would otherwise be returned. Should be provided as a URL-encoded string containing a JSON object. The JSON object will be an array with one or more filter objects defined. All filter objects will apply as an intersection (i.e. AND). Field names reference Location fields, as well as custom fields using the format custom###, where ### is the custom field’s ID.  The filter types are the following. Note there may be multiple available specifications for a given filter type:  &lt;table style&#x3D;\&quot;width:100%\&quot;&gt;   &lt;tr&gt;     &lt;th&gt;Filter Type&lt;/th&gt;     &lt;th&gt;Syntax&lt;/th&gt;     &lt;th&gt;Description&lt;/th&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Full&lt;/td&gt;     &lt;td&gt;fieldName: {contains: $search}&lt;/td&gt;     &lt;td&gt;$search is the search string&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$search,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [contains,doesNotContain,startsWith,equalTo], $search is an array of search strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [empty,notEmpty]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Number&lt;/td&gt;     &lt;td&gt;fieldName: {$type: $value}&lt;/td&gt;     &lt;td&gt;$type is one of [eq,lt,gt,le,ge], $value is the numeric value&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Number&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$value1, $value2]}&lt;/td&gt;     &lt;td&gt;$type is one of [between], $value1 and $value2 are numeric values&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Date&lt;/td&gt;     &lt;td&gt;fieldName: {$type: $value}&lt;/td&gt;     &lt;td&gt;$type is one of [eq,lt,gt,le,ge], $value is a string of \&quot;YYYY-MM-DD” formatted date&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Date&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [empty,notEmpty]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Date&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$value1, $value2]}&lt;/td&gt;     &lt;td&gt;$type is one of [between], $value1 and $value2 are strings of \&quot;YYYY-MM-DD” formatted date&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Categories&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $id is an array of numeric category IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Categories&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [none]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Assets&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $id is an array of numeric category IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Assets&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [none]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Country&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$country,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $country is an array of country code strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;PrimaryLanguage&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$language,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $language is an array of language code strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;AlternateLanguage&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$language,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $language is an array of language code strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;StringSingle&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$string,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $string is an array of strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;StringList&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$string,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $string is an array of strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;LocationType&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $id is an array of location type IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Bool&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [true,false]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Option&lt;/td&gt;     &lt;td&gt;fieldName: {$type: $id}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $id is an option ID (For single option custom fields)&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Option&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $string is an array of strings, combined with OR (For multi option custom fields)&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $id is an array of IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt; &lt;/table&gt;  The following fields can be specified in the request (Field name/Filter Type/Example(s)):  &lt;table style&#x3D;\&quot;width:100%\&quot;&gt;   &lt;tr&gt;     &lt;th&gt;Field Name&lt;/th&gt;     &lt;th&gt;Filter Type&lt;/th&gt;     &lt;th&gt;Example(s)&lt;/th&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;location&lt;/td&gt;     &lt;td&gt;Full&lt;/td&gt;     &lt;td&gt;\&quot;location”: {\&quot;contains”: \&quot;Atlanta”}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;name&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;name”: {\&quot;startsWith”: [\&quot;Guitar”]}, \&quot;name”: {\&quot;contains”: [\&quot;A”,”B”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;address&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;address”: {\&quot;startsWith”: [\&quot;South”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;address2&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;address2”: {\&quot;contains”: [\&quot;Suite”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;city&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;city”: {\&quot;contains”: [\&quot;Atlanta”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;state&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;state”: {\&quot;contains”: [\&quot;AK”,”VA”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;zip&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;zip”: {\&quot;contains”: [\&quot;M5K 7QB”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;phones&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;phones”: {\&quot;startsWith”: [\&quot;703”,”571”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;specialOffer&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;specialOffer”: \&quot;notEmpty”&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;emails&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;emails”: {\&quot;doesNotContain”: [\&quot;@yext.com”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;website&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;website”: {\&quot;equalTo”: [\&quot;https://www.yext.com/”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;categories&lt;/td&gt;     &lt;td&gt;Categories&lt;/td&gt;     &lt;td&gt;\&quot;categories”: {\&quot;includes”: [23,755,34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;closed&lt;/td&gt;     &lt;td&gt;Bool&lt;/td&gt;     &lt;td&gt;\&quot;closed”: true&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;storeId&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;storeId”: {\&quot;equalTo”: [\&quot;MCD0001”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;countryCode&lt;/td&gt;     &lt;td&gt;Country&lt;/td&gt;     &lt;td&gt;\&quot;countryCode”: {\&quot;notIncludes”: [\&quot;US”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;products&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;products”: {\&quot;startsWith”: [\&quot;Burger”,”Fries”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;services&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;services”: {\&quot;contains”: [\&quot;Manicures”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;specialties&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;services”: \&quot;notEmpty”&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;associations&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;associations”: \&quot;empty”&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;brands&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;brands”: {\&quot;equalTo”: [\&quot;North Face”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;languages&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;languages”: {\&quot;equalTo”: [\&quot;English”,”Spanish”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;keywords&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;keywords”: {\&quot;startsWith”: [\&quot;Franchise”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;menuIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;menuIds”: {\&quot;includes”: [23,755,34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;productListIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;productListIds”: {\&quot;notIncludes”: [2]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;calendarIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;calendarIds”: {\&quot;notIncludes”: [34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;bioIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;bioIds”: {\&quot;includes”: [23,34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;custom###&lt;/td&gt;     &lt;td&gt;Text, Number, Date, Bool, or Option&lt;/td&gt;     &lt;td&gt;\&quot;custom123”: {\&quot;equalTo”: [\&quot;asdf”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;folder&lt;/td&gt;     &lt;td&gt;int64&lt;/td&gt;     &lt;td&gt;\&quot;folder”: 123&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;primary_language&lt;/td&gt;     &lt;td&gt;PrimaryLanguage&lt;/td&gt;     &lt;td&gt;\&quot;primary_language”: {\&quot;is”: \&quot;fr_CA”}&lt;/td&gt;   &lt;/tr&gt; &lt;/table&gt; (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\LocationsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function searchLocationsWithHttpInfo($account_id, $v, $limit = null, $offset = null, $filters = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling searchLocations');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling searchLocations');
        }
        if (!is_null($limit) && ($limit > 50)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling KnowledgeManagerApi.searchLocations, must be smaller than or equal to 50.');
        }

        if (!is_null($offset) && ($offset > 9950)) {
            throw new \InvalidArgumentException('invalid value for "$offset" when calling KnowledgeManagerApi.searchLocations, must be smaller than or equal to 9950.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/locationsearch";
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
        if ($filters !== null) {
            $queryParams['filters'] = $this->apiClient->getSerializer()->toQueryValue($filters);
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
                '\Yext\Client\Model\LocationsResponse',
                '/accounts/{accountId}/locationsearch'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\LocationsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\LocationsResponse', $e->getResponseHeaders());
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
     * Operation updateAsset
     *
     * Assets: Update
     *
     * @param string $account_id  (required)
     * @param string $asset_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Asset $asset_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function updateAsset($account_id, $asset_id, $v, $asset_request)
    {
        list($response) = $this->updateAssetWithHttpInfo($account_id, $asset_id, $v, $asset_request);
        return $response;
    }

    /**
     * Operation updateAssetWithHttpInfo
     *
     * Assets: Update
     *
     * @param string $account_id  (required)
     * @param string $asset_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Asset $asset_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateAssetWithHttpInfo($account_id, $asset_id, $v, $asset_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateAsset');
        }
        // verify the required parameter 'asset_id' is set
        if ($asset_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $asset_id when calling updateAsset');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateAsset');
        }
        // verify the required parameter 'asset_request' is set
        if ($asset_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $asset_request when calling updateAsset');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/assets/{assetId}";
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
        if ($asset_id !== null) {
            $resourcePath = str_replace(
                "{" . "assetId" . "}",
                $this->apiClient->getSerializer()->toPathValue($asset_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($asset_request)) {
            $_tempBody = $asset_request;
        }

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
                '\Yext\Client\Model\IdResponse',
                '/accounts/{accountId}/assets/{assetId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\IdResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
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
     * Operation updateBio
     *
     * Bios: Update
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Bio $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\BioListResponse
     */
    public function updateBio($account_id, $list_id, $v, $body)
    {
        list($response) = $this->updateBioWithHttpInfo($account_id, $list_id, $v, $body);
        return $response;
    }

    /**
     * Operation updateBioWithHttpInfo
     *
     * Bios: Update
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Bio $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\BioListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateBioWithHttpInfo($account_id, $list_id, $v, $body)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateBio');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling updateBio');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateBio');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling updateBio');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/bios/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '\Yext\Client\Model\BioListResponse',
                '/accounts/{accountId}/bios/{listId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\BioListResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\BioListResponse', $e->getResponseHeaders());
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
     * Operation updateCustomField
     *
     * Custom Fields: Update
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param string $custom_field_id  (required)
     * @param \Yext\Client\Model\CustomFieldUpdate $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function updateCustomField($v, $account_id, $custom_field_id, $body)
    {
        list($response) = $this->updateCustomFieldWithHttpInfo($v, $account_id, $custom_field_id, $body);
        return $response;
    }

    /**
     * Operation updateCustomFieldWithHttpInfo
     *
     * Custom Fields: Update
     *
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $account_id  (required)
     * @param string $custom_field_id  (required)
     * @param \Yext\Client\Model\CustomFieldUpdate $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateCustomFieldWithHttpInfo($v, $account_id, $custom_field_id, $body)
    {
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateCustomField');
        }
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateCustomField');
        }
        // verify the required parameter 'custom_field_id' is set
        if ($custom_field_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $custom_field_id when calling updateCustomField');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling updateCustomField');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/customfields/{customFieldId}";
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
        if ($custom_field_id !== null) {
            $resourcePath = str_replace(
                "{" . "customFieldId" . "}",
                $this->apiClient->getSerializer()->toPathValue($custom_field_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '\Yext\Client\Model\IdResponse',
                '/accounts/{accountId}/customfields/{customFieldId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\IdResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
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
     * Operation updateEvent
     *
     * Events: Update
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Event $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\EventListResponse
     */
    public function updateEvent($account_id, $list_id, $v, $body)
    {
        list($response) = $this->updateEventWithHttpInfo($account_id, $list_id, $v, $body);
        return $response;
    }

    /**
     * Operation updateEventWithHttpInfo
     *
     * Events: Update
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Event $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\EventListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateEventWithHttpInfo($account_id, $list_id, $v, $body)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateEvent');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling updateEvent');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateEvent');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling updateEvent');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/events/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '\Yext\Client\Model\EventListResponse',
                '/accounts/{accountId}/events/{listId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\EventListResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\EventListResponse', $e->getResponseHeaders());
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
     * Operation updateLocation
     *
     * Locations: Update
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Location $location_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function updateLocation($account_id, $location_id, $v, $location_request)
    {
        list($response) = $this->updateLocationWithHttpInfo($account_id, $location_id, $v, $location_request);
        return $response;
    }

    /**
     * Operation updateLocationWithHttpInfo
     *
     * Locations: Update
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Location $location_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateLocationWithHttpInfo($account_id, $location_id, $v, $location_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateLocation');
        }
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling updateLocation');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateLocation');
        }
        // verify the required parameter 'location_request' is set
        if ($location_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_request when calling updateLocation');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/locations/{locationId}";
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
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "locationId" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($location_request)) {
            $_tempBody = $location_request;
        }

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
                '\Yext\Client\Model\IdResponse',
                '/accounts/{accountId}/locations/{locationId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\IdResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
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
     * Operation updateMenu
     *
     * Menus: Update
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Menu $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\MenuListResponse
     */
    public function updateMenu($account_id, $list_id, $v, $body)
    {
        list($response) = $this->updateMenuWithHttpInfo($account_id, $list_id, $v, $body);
        return $response;
    }

    /**
     * Operation updateMenuWithHttpInfo
     *
     * Menus: Update
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Menu $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\MenuListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateMenuWithHttpInfo($account_id, $list_id, $v, $body)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateMenu');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling updateMenu');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateMenu');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling updateMenu');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/menus/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '\Yext\Client\Model\MenuListResponse',
                '/accounts/{accountId}/menus/{listId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\MenuListResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\MenuListResponse', $e->getResponseHeaders());
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
     * Operation updateProduct
     *
     * Products: Update
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Product $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ProductListResponse
     */
    public function updateProduct($account_id, $list_id, $v, $body)
    {
        list($response) = $this->updateProductWithHttpInfo($account_id, $list_id, $v, $body);
        return $response;
    }

    /**
     * Operation updateProductWithHttpInfo
     *
     * Products: Update
     *
     * @param string $account_id  (required)
     * @param string $list_id ID of this List. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Product $body  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ProductListResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateProductWithHttpInfo($account_id, $list_id, $v, $body)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateProduct');
        }
        // verify the required parameter 'list_id' is set
        if ($list_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $list_id when calling updateProduct');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateProduct');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling updateProduct');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/products/{listId}";
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
        if ($list_id !== null) {
            $resourcePath = str_replace(
                "{" . "listId" . "}",
                $this->apiClient->getSerializer()->toPathValue($list_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '\Yext\Client\Model\ProductListResponse',
                '/accounts/{accountId}/products/{listId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ProductListResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ProductListResponse', $e->getResponseHeaders());
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
     * Operation upsertLanguageProfile
     *
     * Language Profiles: Upsert
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $language_code Locale code. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Location $body  (required)
     * @param bool $primary When present and set to true, the specified profile will become the location’s primary Language Profile. (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function upsertLanguageProfile($account_id, $location_id, $language_code, $v, $body, $primary = null)
    {
        list($response) = $this->upsertLanguageProfileWithHttpInfo($account_id, $location_id, $language_code, $v, $body, $primary);
        return $response;
    }

    /**
     * Operation upsertLanguageProfileWithHttpInfo
     *
     * Language Profiles: Upsert
     *
     * @param string $account_id  (required)
     * @param string $location_id  (required)
     * @param string $language_code Locale code. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Location $body  (required)
     * @param bool $primary When present and set to true, the specified profile will become the location’s primary Language Profile. (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function upsertLanguageProfileWithHttpInfo($account_id, $location_id, $language_code, $v, $body, $primary = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling upsertLanguageProfile');
        }
        // verify the required parameter 'location_id' is set
        if ($location_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_id when calling upsertLanguageProfile');
        }
        // verify the required parameter 'language_code' is set
        if ($language_code === null) {
            throw new \InvalidArgumentException('Missing the required parameter $language_code when calling upsertLanguageProfile');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling upsertLanguageProfile');
        }
        // verify the required parameter 'body' is set
        if ($body === null) {
            throw new \InvalidArgumentException('Missing the required parameter $body when calling upsertLanguageProfile');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/locations/{locationId}/profiles/{language_code}";
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
        if ($primary !== null) {
            $queryParams['primary'] = $this->apiClient->getSerializer()->toQueryValue($primary);
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
        if ($location_id !== null) {
            $resourcePath = str_replace(
                "{" . "locationId" . "}",
                $this->apiClient->getSerializer()->toPathValue($location_id),
                $resourcePath
            );
        }
        // path params
        if ($language_code !== null) {
            $resourcePath = str_replace(
                "{" . "language_code" . "}",
                $this->apiClient->getSerializer()->toPathValue($language_code),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($body)) {
            $_tempBody = $body;
        }

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
                '/accounts/{accountId}/locations/{locationId}/profiles/{language_code}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ErrorResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                case 201:
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
