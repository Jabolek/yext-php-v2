<?php
/**
 * SocialSpringSummer2017Api
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
 * SocialSpringSummer2017Api Class Doc Comment
 *
 * @category Class
 * @package  Yext\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class SocialSpringSummer2017Api
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
     * @return SocialSpringSummer2017Api
     */
    public function setApiClient(\Yext\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createComment
     *
     * Comments: Create
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $parent_id The ID of the Comment this Comment is replying to.  **Example** 123 (required)
     * @param string $message The message included in the Comment, if any.  **Example** “Hello, World!” (optional)
     * @param string $photo_url The URL of the photo included in the Comment, if any.  **Example** “https://…” (optional)
     * @param string $link_url The URL of the link included in the Comment, if any.  **Example** “https://…” (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createComment($account_id, $post_id, $v, $parent_id, $message = null, $photo_url = null, $link_url = null)
    {
        list($response) = $this->createCommentWithHttpInfo($account_id, $post_id, $v, $parent_id, $message, $photo_url, $link_url);
        return $response;
    }

    /**
     * Operation createCommentWithHttpInfo
     *
     * Comments: Create
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $parent_id The ID of the Comment this Comment is replying to.  **Example** 123 (required)
     * @param string $message The message included in the Comment, if any.  **Example** “Hello, World!” (optional)
     * @param string $photo_url The URL of the photo included in the Comment, if any.  **Example** “https://…” (optional)
     * @param string $link_url The URL of the link included in the Comment, if any.  **Example** “https://…” (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createCommentWithHttpInfo($account_id, $post_id, $v, $parent_id, $message = null, $photo_url = null, $link_url = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createComment');
        }
        // verify the required parameter 'post_id' is set
        if ($post_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $post_id when calling createComment');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createComment');
        }
        // verify the required parameter 'parent_id' is set
        if ($parent_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $parent_id when calling createComment');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/posts/{postId}/comments";
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
        if ($parent_id !== null) {
            $queryParams['parentId'] = $this->apiClient->getSerializer()->toQueryValue($parent_id);
        }
        // query params
        if ($message !== null) {
            $queryParams['message'] = $this->apiClient->getSerializer()->toQueryValue($message);
        }
        // query params
        if ($photo_url !== null) {
            $queryParams['photoUrl'] = $this->apiClient->getSerializer()->toQueryValue($photo_url);
        }
        // query params
        if ($link_url !== null) {
            $queryParams['linkUrl'] = $this->apiClient->getSerializer()->toQueryValue($link_url);
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
        if ($post_id !== null) {
            $resourcePath = str_replace(
                "{" . "postId" . "}",
                $this->apiClient->getSerializer()->toPathValue($post_id),
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
                '/accounts/{accountId}/posts/{postId}/comments'
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
     * Operation createPosts
     *
     * Posts: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string[] $location_ids List of Location IDs for this Post (required)
     * @param string[] $publisher_ids List of Publisher IDs for this Post (required)
     * @param string $message The message included in the Post, if any.  **Example** \&quot;Hello, World!\&quot; (required)
     * @param string $photo_url The URL of the photo included in the Post, if any.  **Example** \&quot;https://...\&quot; (optional)
     * @param string $link_url The URL of the link included in the Post, if any.  **Example** \&quot;https://...\&quot; (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createPosts($account_id, $v, $location_ids, $publisher_ids, $message, $photo_url = null, $link_url = null)
    {
        list($response) = $this->createPostsWithHttpInfo($account_id, $v, $location_ids, $publisher_ids, $message, $photo_url, $link_url);
        return $response;
    }

    /**
     * Operation createPostsWithHttpInfo
     *
     * Posts: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string[] $location_ids List of Location IDs for this Post (required)
     * @param string[] $publisher_ids List of Publisher IDs for this Post (required)
     * @param string $message The message included in the Post, if any.  **Example** \&quot;Hello, World!\&quot; (required)
     * @param string $photo_url The URL of the photo included in the Post, if any.  **Example** \&quot;https://...\&quot; (optional)
     * @param string $link_url The URL of the link included in the Post, if any.  **Example** \&quot;https://...\&quot; (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createPostsWithHttpInfo($account_id, $v, $location_ids, $publisher_ids, $message, $photo_url = null, $link_url = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createPosts');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createPosts');
        }
        // verify the required parameter 'location_ids' is set
        if ($location_ids === null) {
            throw new \InvalidArgumentException('Missing the required parameter $location_ids when calling createPosts');
        }
        // verify the required parameter 'publisher_ids' is set
        if ($publisher_ids === null) {
            throw new \InvalidArgumentException('Missing the required parameter $publisher_ids when calling createPosts');
        }
        // verify the required parameter 'message' is set
        if ($message === null) {
            throw new \InvalidArgumentException('Missing the required parameter $message when calling createPosts');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/posts";
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
        if ($message !== null) {
            $queryParams['message'] = $this->apiClient->getSerializer()->toQueryValue($message);
        }
        // query params
        if ($photo_url !== null) {
            $queryParams['photoUrl'] = $this->apiClient->getSerializer()->toQueryValue($photo_url);
        }
        // query params
        if ($link_url !== null) {
            $queryParams['linkUrl'] = $this->apiClient->getSerializer()->toQueryValue($link_url);
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
                '/accounts/{accountId}/posts'
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
     * Operation deleteComment
     *
     * Comments: delete
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $comment_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteComment($account_id, $post_id, $comment_id, $v)
    {
        list($response) = $this->deleteCommentWithHttpInfo($account_id, $post_id, $comment_id, $v);
        return $response;
    }

    /**
     * Operation deleteCommentWithHttpInfo
     *
     * Comments: delete
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $comment_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteCommentWithHttpInfo($account_id, $post_id, $comment_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteComment');
        }
        // verify the required parameter 'post_id' is set
        if ($post_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $post_id when calling deleteComment');
        }
        // verify the required parameter 'comment_id' is set
        if ($comment_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $comment_id when calling deleteComment');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteComment');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/posts/{postId}/comments/{commentId}";
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
        if ($post_id !== null) {
            $resourcePath = str_replace(
                "{" . "postId" . "}",
                $this->apiClient->getSerializer()->toPathValue($post_id),
                $resourcePath
            );
        }
        // path params
        if ($comment_id !== null) {
            $resourcePath = str_replace(
                "{" . "commentId" . "}",
                $this->apiClient->getSerializer()->toPathValue($comment_id),
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
                '/accounts/{accountId}/posts/{postId}/comments/{commentId}'
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
     * Operation deletePost
     *
     * Posts: Delete
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deletePost($account_id, $post_id, $v)
    {
        list($response) = $this->deletePostWithHttpInfo($account_id, $post_id, $v);
        return $response;
    }

    /**
     * Operation deletePostWithHttpInfo
     *
     * Posts: Delete
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deletePostWithHttpInfo($account_id, $post_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deletePost');
        }
        // verify the required parameter 'post_id' is set
        if ($post_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $post_id when calling deletePost');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deletePost');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/posts/{postId}";
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
        if ($post_id !== null) {
            $resourcePath = str_replace(
                "{" . "postId" . "}",
                $this->apiClient->getSerializer()->toPathValue($post_id),
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
                '/accounts/{accountId}/posts/{postId}'
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
     * Operation getComments
     *
     * Comments: List
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return, up to 100. Default 100.  **Example** 20 (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string $type Determines which type of Comments are returned (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\SocialCommentsResponse
     */
    public function getComments($account_id, $post_id, $v, $limit = null, $offset = null, $type = null)
    {
        list($response) = $this->getCommentsWithHttpInfo($account_id, $post_id, $v, $limit, $offset, $type);
        return $response;
    }

    /**
     * Operation getCommentsWithHttpInfo
     *
     * Comments: List
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return, up to 100. Default 100.  **Example** 20 (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string $type Determines which type of Comments are returned (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\SocialCommentsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getCommentsWithHttpInfo($account_id, $post_id, $v, $limit = null, $offset = null, $type = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getComments');
        }
        // verify the required parameter 'post_id' is set
        if ($post_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $post_id when calling getComments');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getComments');
        }
        if (!is_null($limit) && ($limit > 100)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling SocialSpringSummer2017Api.getComments, must be smaller than or equal to 100.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/posts/{postId}/comments";
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
        if ($type !== null) {
            $queryParams['type'] = $this->apiClient->getSerializer()->toQueryValue($type);
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
        if ($post_id !== null) {
            $resourcePath = str_replace(
                "{" . "postId" . "}",
                $this->apiClient->getSerializer()->toPathValue($post_id),
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
                '\Yext\Client\Model\SocialCommentsResponse',
                '/accounts/{accountId}/posts/{postId}/comments'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\SocialCommentsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\SocialCommentsResponse', $e->getResponseHeaders());
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
     * Operation getLinkedAccount
     *
     * Linked Accounts: Get
     *
     * @param string $account_id  (required)
     * @param string $linked_account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\LinkedAccountResponse
     */
    public function getLinkedAccount($account_id, $linked_account_id, $v)
    {
        list($response) = $this->getLinkedAccountWithHttpInfo($account_id, $linked_account_id, $v);
        return $response;
    }

    /**
     * Operation getLinkedAccountWithHttpInfo
     *
     * Linked Accounts: Get
     *
     * @param string $account_id  (required)
     * @param string $linked_account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\LinkedAccountResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinkedAccountWithHttpInfo($account_id, $linked_account_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getLinkedAccount');
        }
        // verify the required parameter 'linked_account_id' is set
        if ($linked_account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $linked_account_id when calling getLinkedAccount');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getLinkedAccount');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/linkedaccounts/{linkedAccountId}";
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
        if ($linked_account_id !== null) {
            $resourcePath = str_replace(
                "{" . "linkedAccountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($linked_account_id),
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
                '\Yext\Client\Model\LinkedAccountResponse',
                '/accounts/{accountId}/linkedaccounts/{linkedAccountId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\LinkedAccountResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\LinkedAccountResponse', $e->getResponseHeaders());
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
     * Operation getLinkedAccounts
     *
     * Linked Accounts: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return, up to 100. Default 100.  **Example** 20 (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings subscription.  **Example** 123, 456, 789 (optional)
     * @param string[] $publisher_ids Defaults to all publishers subscribed by account  **Example** FACEBOOK, FOURSQUARE (optional)
     * @param string $status Used to filter for Linked Accounts with a particular status. (optional, default to ALL)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\LinkedAccountsResponse
     */
    public function getLinkedAccounts($account_id, $v, $limit = null, $offset = null, $location_ids = null, $publisher_ids = null, $status = null)
    {
        list($response) = $this->getLinkedAccountsWithHttpInfo($account_id, $v, $limit, $offset, $location_ids, $publisher_ids, $status);
        return $response;
    }

    /**
     * Operation getLinkedAccountsWithHttpInfo
     *
     * Linked Accounts: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return, up to 100. Default 100.  **Example** 20 (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids Defaults to all account locations with a PowerListings subscription.  **Example** 123, 456, 789 (optional)
     * @param string[] $publisher_ids Defaults to all publishers subscribed by account  **Example** FACEBOOK, FOURSQUARE (optional)
     * @param string $status Used to filter for Linked Accounts with a particular status. (optional, default to ALL)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\LinkedAccountsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getLinkedAccountsWithHttpInfo($account_id, $v, $limit = null, $offset = null, $location_ids = null, $publisher_ids = null, $status = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getLinkedAccounts');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getLinkedAccounts');
        }
        if (!is_null($limit) && ($limit > 100)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling SocialSpringSummer2017Api.getLinkedAccounts, must be smaller than or equal to 100.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/linkedaccounts";
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
                '\Yext\Client\Model\LinkedAccountsResponse',
                '/accounts/{accountId}/linkedaccounts'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\LinkedAccountsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\LinkedAccountsResponse', $e->getResponseHeaders());
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
     * Operation getPosts
     *
     * Posts: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return, up to 100. Default 100.  **Example** 20 (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids When provided, only Posts that involve the requested locations will be returned.  By defaults, Posts will be returned for all locations subscribed to Social Posting.  **Example** 123, 456, 789 (optional)
     * @param string $folder_id When provided, only Posts for locations in the given folder and its subfolders will be included in the results.  **Example** 123 (optional)
     * @param string[] $countries Array of 3166 Alpha-2 country codes. When present, only Posts for locations in the given countries will be returned.  **Example** [&#39;US&#39;, &#39;CA&#39;] (optional)
     * @param string[] $location_labels Array of location labels. When present, only Posts for location with the provided labels will be returned.  **Example** [&#39;pilot stores&#39;] (optional)
     * @param string[] $publisher_ids Defaults to all publishers subscribed by account  **Example** FACEBOOK, FOURSQUARE (optional)
     * @param string[] $keywords When provided, only Posts that mention the given keywords will be returned. Posts will be returned if the original post or any comments contain this string.  **Example** [&#39;pizza&#39;] (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\SocialPostsResponse
     */
    public function getPosts($account_id, $v, $limit = null, $offset = null, $location_ids = null, $folder_id = null, $countries = null, $location_labels = null, $publisher_ids = null, $keywords = null)
    {
        list($response) = $this->getPostsWithHttpInfo($account_id, $v, $limit, $offset, $location_ids, $folder_id, $countries, $location_labels, $publisher_ids, $keywords);
        return $response;
    }

    /**
     * Operation getPostsWithHttpInfo
     *
     * Posts: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return, up to 100. Default 100.  **Example** 20 (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids When provided, only Posts that involve the requested locations will be returned.  By defaults, Posts will be returned for all locations subscribed to Social Posting.  **Example** 123, 456, 789 (optional)
     * @param string $folder_id When provided, only Posts for locations in the given folder and its subfolders will be included in the results.  **Example** 123 (optional)
     * @param string[] $countries Array of 3166 Alpha-2 country codes. When present, only Posts for locations in the given countries will be returned.  **Example** [&#39;US&#39;, &#39;CA&#39;] (optional)
     * @param string[] $location_labels Array of location labels. When present, only Posts for location with the provided labels will be returned.  **Example** [&#39;pilot stores&#39;] (optional)
     * @param string[] $publisher_ids Defaults to all publishers subscribed by account  **Example** FACEBOOK, FOURSQUARE (optional)
     * @param string[] $keywords When provided, only Posts that mention the given keywords will be returned. Posts will be returned if the original post or any comments contain this string.  **Example** [&#39;pizza&#39;] (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\SocialPostsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getPostsWithHttpInfo($account_id, $v, $limit = null, $offset = null, $location_ids = null, $folder_id = null, $countries = null, $location_labels = null, $publisher_ids = null, $keywords = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getPosts');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getPosts');
        }
        if (!is_null($limit) && ($limit > 100)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling SocialSpringSummer2017Api.getPosts, must be smaller than or equal to 100.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/posts";
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
        if ($folder_id !== null) {
            $queryParams['folderId'] = $this->apiClient->getSerializer()->toQueryValue($folder_id);
        }
        // query params
        if (is_array($countries)) {
            $countries = $this->apiClient->getSerializer()->serializeCollection($countries, 'csv', true);
        }
        if ($countries !== null) {
            $queryParams['countries'] = $this->apiClient->getSerializer()->toQueryValue($countries);
        }
        // query params
        if (is_array($location_labels)) {
            $location_labels = $this->apiClient->getSerializer()->serializeCollection($location_labels, 'csv', true);
        }
        if ($location_labels !== null) {
            $queryParams['locationLabels'] = $this->apiClient->getSerializer()->toQueryValue($location_labels);
        }
        // query params
        if (is_array($publisher_ids)) {
            $publisher_ids = $this->apiClient->getSerializer()->serializeCollection($publisher_ids, 'csv', true);
        }
        if ($publisher_ids !== null) {
            $queryParams['publisherIds'] = $this->apiClient->getSerializer()->toQueryValue($publisher_ids);
        }
        // query params
        if (is_array($keywords)) {
            $keywords = $this->apiClient->getSerializer()->serializeCollection($keywords, 'csv', true);
        }
        if ($keywords !== null) {
            $queryParams['keywords'] = $this->apiClient->getSerializer()->toQueryValue($keywords);
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
                '\Yext\Client\Model\SocialPostsResponse',
                '/accounts/{accountId}/posts'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\SocialPostsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\SocialPostsResponse', $e->getResponseHeaders());
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
     * Operation updateComment
     *
     * Comments: Update
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $comment_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\PostEntry $comment  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function updateComment($account_id, $post_id, $comment_id, $v, $comment)
    {
        list($response) = $this->updateCommentWithHttpInfo($account_id, $post_id, $comment_id, $v, $comment);
        return $response;
    }

    /**
     * Operation updateCommentWithHttpInfo
     *
     * Comments: Update
     *
     * @param string $account_id  (required)
     * @param string $post_id  (required)
     * @param string $comment_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\PostEntry $comment  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateCommentWithHttpInfo($account_id, $post_id, $comment_id, $v, $comment)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateComment');
        }
        // verify the required parameter 'post_id' is set
        if ($post_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $post_id when calling updateComment');
        }
        // verify the required parameter 'comment_id' is set
        if ($comment_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $comment_id when calling updateComment');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateComment');
        }
        // verify the required parameter 'comment' is set
        if ($comment === null) {
            throw new \InvalidArgumentException('Missing the required parameter $comment when calling updateComment');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/posts/{postId}/comments/{commentId}";
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
        if ($post_id !== null) {
            $resourcePath = str_replace(
                "{" . "postId" . "}",
                $this->apiClient->getSerializer()->toPathValue($post_id),
                $resourcePath
            );
        }
        // path params
        if ($comment_id !== null) {
            $resourcePath = str_replace(
                "{" . "commentId" . "}",
                $this->apiClient->getSerializer()->toPathValue($comment_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($comment)) {
            $_tempBody = $comment;
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
                '/accounts/{accountId}/posts/{postId}/comments/{commentId}'
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
     * Operation updateLinkedAccount
     *
     * Linked Accounts: Update
     *
     * @param string $account_id  (required)
     * @param string $linked_account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string[] $assign_location_ids Array of Location IDs to be assigned to this Linked Account.  Use this field to assign this Linked Account to Locations without affecting any other assigned Locations. (optional)
     * @param string[] $unassign_location_ids Array of Location IDs to be unassigned from this Linked Account.  Use this field to unassign this Linked Account from Locations without affecting any other assigned Locations. (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function updateLinkedAccount($account_id, $linked_account_id, $v, $assign_location_ids = null, $unassign_location_ids = null)
    {
        list($response) = $this->updateLinkedAccountWithHttpInfo($account_id, $linked_account_id, $v, $assign_location_ids, $unassign_location_ids);
        return $response;
    }

    /**
     * Operation updateLinkedAccountWithHttpInfo
     *
     * Linked Accounts: Update
     *
     * @param string $account_id  (required)
     * @param string $linked_account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string[] $assign_location_ids Array of Location IDs to be assigned to this Linked Account.  Use this field to assign this Linked Account to Locations without affecting any other assigned Locations. (optional)
     * @param string[] $unassign_location_ids Array of Location IDs to be unassigned from this Linked Account.  Use this field to unassign this Linked Account from Locations without affecting any other assigned Locations. (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateLinkedAccountWithHttpInfo($account_id, $linked_account_id, $v, $assign_location_ids = null, $unassign_location_ids = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateLinkedAccount');
        }
        // verify the required parameter 'linked_account_id' is set
        if ($linked_account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $linked_account_id when calling updateLinkedAccount');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateLinkedAccount');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/linkedaccounts/{linkedAccountId}";
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
        if (is_array($assign_location_ids)) {
            $assign_location_ids = $this->apiClient->getSerializer()->serializeCollection($assign_location_ids, 'csv', true);
        }
        if ($assign_location_ids !== null) {
            $queryParams['assignLocationIds'] = $this->apiClient->getSerializer()->toQueryValue($assign_location_ids);
        }
        // query params
        if (is_array($unassign_location_ids)) {
            $unassign_location_ids = $this->apiClient->getSerializer()->serializeCollection($unassign_location_ids, 'csv', true);
        }
        if ($unassign_location_ids !== null) {
            $queryParams['unassignLocationIds'] = $this->apiClient->getSerializer()->toQueryValue($unassign_location_ids);
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
        if ($linked_account_id !== null) {
            $resourcePath = str_replace(
                "{" . "linkedAccountId" . "}",
                $this->apiClient->getSerializer()->toPathValue($linked_account_id),
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
                '/accounts/{accountId}/linkedaccounts/{linkedAccountId}'
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
