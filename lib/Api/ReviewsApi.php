<?php
/**
 * ReviewsApi
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
 * ReviewsApi Class Doc Comment
 *
 * @category Class
 * @package  Yext\Client
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ReviewsApi
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
     * @return ReviewsApi
     */
    public function setApiClient(\Yext\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createComment
     *
     * Comment: Create
     *
     * @param string $account_id  (required)
     * @param int $review_id ID of this Review. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\ReviewComment $comment_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function createComment($account_id, $review_id, $v, $comment_request)
    {
        list($response) = $this->createCommentWithHttpInfo($account_id, $review_id, $v, $comment_request);
        return $response;
    }

    /**
     * Operation createCommentWithHttpInfo
     *
     * Comment: Create
     *
     * @param string $account_id  (required)
     * @param int $review_id ID of this Review. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\ReviewComment $comment_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createCommentWithHttpInfo($account_id, $review_id, $v, $comment_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createComment');
        }
        // verify the required parameter 'review_id' is set
        if ($review_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $review_id when calling createComment');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createComment');
        }
        // verify the required parameter 'comment_request' is set
        if ($comment_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $comment_request when calling createComment');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/reviews/{reviewId}/comments";
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
        if ($review_id !== null) {
            $resourcePath = str_replace(
                "{" . "reviewId" . "}",
                $this->apiClient->getSerializer()->toPathValue($review_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($comment_request)) {
            $_tempBody = $comment_request;
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
                '\Yext\Client\Model\ErrorResponse',
                '/accounts/{accountId}/reviews/{reviewId}/comments'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ErrorResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
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

    /**
     * Operation createReview
     *
     * Reviews: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Review $review_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createReview($account_id, $v, $review_request)
    {
        list($response) = $this->createReviewWithHttpInfo($account_id, $v, $review_request);
        return $response;
    }

    /**
     * Operation createReviewWithHttpInfo
     *
     * Reviews: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Review $review_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createReviewWithHttpInfo($account_id, $v, $review_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createReview');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createReview');
        }
        // verify the required parameter 'review_request' is set
        if ($review_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $review_request when calling createReview');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/reviews";
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
        if (isset($review_request)) {
            $_tempBody = $review_request;
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
                '/accounts/{accountId}/reviews'
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
     * Operation createReviewInvites
     *
     * Review Invitations: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\ReviewInvitation[] $reviews  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\CreateReviewInvitationsResponse
     */
    public function createReviewInvites($account_id, $v, $reviews)
    {
        list($response) = $this->createReviewInvitesWithHttpInfo($account_id, $v, $reviews);
        return $response;
    }

    /**
     * Operation createReviewInvitesWithHttpInfo
     *
     * Review Invitations: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\ReviewInvitation[] $reviews  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\CreateReviewInvitationsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createReviewInvitesWithHttpInfo($account_id, $v, $reviews)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createReviewInvites');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createReviewInvites');
        }
        // verify the required parameter 'reviews' is set
        if ($reviews === null) {
            throw new \InvalidArgumentException('Missing the required parameter $reviews when calling createReviewInvites');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/reviewinvites";
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
        if (isset($reviews)) {
            $_tempBody = $reviews;
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
                '\Yext\Client\Model\CreateReviewInvitationsResponse',
                '/accounts/{accountId}/reviewinvites'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\CreateReviewInvitationsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\CreateReviewInvitationsResponse', $e->getResponseHeaders());
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
     * Operation getReview
     *
     * Review: Get
     *
     * @param string $account_id  (required)
     * @param int $review_id ID of this Review. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ReviewResponse
     */
    public function getReview($account_id, $review_id, $v)
    {
        list($response) = $this->getReviewWithHttpInfo($account_id, $review_id, $v);
        return $response;
    }

    /**
     * Operation getReviewWithHttpInfo
     *
     * Review: Get
     *
     * @param string $account_id  (required)
     * @param int $review_id ID of this Review. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ReviewResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getReviewWithHttpInfo($account_id, $review_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getReview');
        }
        // verify the required parameter 'review_id' is set
        if ($review_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $review_id when calling getReview');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getReview');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/reviews/{reviewId}";
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
        if ($review_id !== null) {
            $resourcePath = str_replace(
                "{" . "reviewId" . "}",
                $this->apiClient->getSerializer()->toPathValue($review_id),
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
                '\Yext\Client\Model\ReviewResponse',
                '/accounts/{accountId}/reviews/{reviewId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ReviewResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ReviewResponse', $e->getResponseHeaders());
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
     * Operation getReviewGenerationSettings
     *
     * Review Generation Settings: Get
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ReviewGenerationSettingsResponse
     */
    public function getReviewGenerationSettings($account_id, $v)
    {
        list($response) = $this->getReviewGenerationSettingsWithHttpInfo($account_id, $v);
        return $response;
    }

    /**
     * Operation getReviewGenerationSettingsWithHttpInfo
     *
     * Review Generation Settings: Get
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ReviewGenerationSettingsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getReviewGenerationSettingsWithHttpInfo($account_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getReviewGenerationSettings');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getReviewGenerationSettings');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/reviews/settings/generation";
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
                '\Yext\Client\Model\ReviewGenerationSettingsResponse',
                '/accounts/{accountId}/reviews/settings/generation'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ReviewGenerationSettingsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ReviewGenerationSettingsResponse', $e->getResponseHeaders());
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
     * Operation listReviews
     *
     * Reviews: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids When provided, only reviews for the requested locations will be returned.  By default, reviews will be returned for all locations subscribed to Review Monitoring.  **Example:** loc123,loc456,loc789 (optional)
     * @param string $folder_id When provided, only reviews for locations in the given folder and its subfolders will be included in the results. (optional)
     * @param string[] $countries When present, only reviews for locations in the given countries will be returned. Countries are denoted by ISO 3166 2-letter country codes. (optional)
     * @param string[] $location_labels When present, only reviews for location with the provided labels will be returned. (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string $review_content When specified, only reviews that include the provided content will be returned. (optional)
     * @param double $min_rating When specified, only reviews with the provided minimum rating or higher will be returned. (optional)
     * @param double $max_rating When specified, only reviews with the provided maximum rating or lower will be returned. (optional)
     * @param \DateTime $min_publisher_date (&#x60;YYYY-MM-DD&#x60; format) When specified, only reviews with a publisher date on or after the given date will be returned. (optional)
     * @param \DateTime $max_publisher_date (&#x60;YYYY-MM-DD&#x60; format) When specified, only reviews with a publisher date on or before the given date will be returned. (optional)
     * @param \DateTime $min_last_yext_update_date (&#x60;YYYY-MM-DD&#x60; format) When specified, only reviews with a last Yext update date on or after the given date will be returned. (optional)
     * @param \DateTime $max_last_yext_update_date (&#x60;YYYY-MM-DD&#x60; format) When specified, only reviews with a last Yext update date on or before the given date will be returned. (optional)
     * @param string $awaiting_response When specified, only reviews that are awaiting an owner reply on the given objects will be returned.  For example, when &#x60;awaitingResponse&#x3D;COMMENT&#x60;, reviews will only be returned if they have at least one comment that has not been responded to by the owner. (optional)
     * @param int $min_non_owner_comments When specified, only reviews that have at least the provided number of non-owner comments will be returned. (optional)
     * @param string $reviewer_name When specified, only reviews whose authorName contains the provided string will be returned. (optional)
     * @param string $reviewer_email When specified, only reviews whose authorEmail matches the provided email address will be returned. (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ReviewsResponse
     */
    public function listReviews($account_id, $v, $limit = null, $offset = null, $location_ids = null, $folder_id = null, $countries = null, $location_labels = null, $publisher_ids = null, $review_content = null, $min_rating = null, $max_rating = null, $min_publisher_date = null, $max_publisher_date = null, $min_last_yext_update_date = null, $max_last_yext_update_date = null, $awaiting_response = null, $min_non_owner_comments = null, $reviewer_name = null, $reviewer_email = null)
    {
        list($response) = $this->listReviewsWithHttpInfo($account_id, $v, $limit, $offset, $location_ids, $folder_id, $countries, $location_labels, $publisher_ids, $review_content, $min_rating, $max_rating, $min_publisher_date, $max_publisher_date, $min_last_yext_update_date, $max_last_yext_update_date, $awaiting_response, $min_non_owner_comments, $reviewer_name, $reviewer_email);
        return $response;
    }

    /**
     * Operation listReviewsWithHttpInfo
     *
     * Reviews: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids When provided, only reviews for the requested locations will be returned.  By default, reviews will be returned for all locations subscribed to Review Monitoring.  **Example:** loc123,loc456,loc789 (optional)
     * @param string $folder_id When provided, only reviews for locations in the given folder and its subfolders will be included in the results. (optional)
     * @param string[] $countries When present, only reviews for locations in the given countries will be returned. Countries are denoted by ISO 3166 2-letter country codes. (optional)
     * @param string[] $location_labels When present, only reviews for location with the provided labels will be returned. (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string $review_content When specified, only reviews that include the provided content will be returned. (optional)
     * @param double $min_rating When specified, only reviews with the provided minimum rating or higher will be returned. (optional)
     * @param double $max_rating When specified, only reviews with the provided maximum rating or lower will be returned. (optional)
     * @param \DateTime $min_publisher_date (&#x60;YYYY-MM-DD&#x60; format) When specified, only reviews with a publisher date on or after the given date will be returned. (optional)
     * @param \DateTime $max_publisher_date (&#x60;YYYY-MM-DD&#x60; format) When specified, only reviews with a publisher date on or before the given date will be returned. (optional)
     * @param \DateTime $min_last_yext_update_date (&#x60;YYYY-MM-DD&#x60; format) When specified, only reviews with a last Yext update date on or after the given date will be returned. (optional)
     * @param \DateTime $max_last_yext_update_date (&#x60;YYYY-MM-DD&#x60; format) When specified, only reviews with a last Yext update date on or before the given date will be returned. (optional)
     * @param string $awaiting_response When specified, only reviews that are awaiting an owner reply on the given objects will be returned.  For example, when &#x60;awaitingResponse&#x3D;COMMENT&#x60;, reviews will only be returned if they have at least one comment that has not been responded to by the owner. (optional)
     * @param int $min_non_owner_comments When specified, only reviews that have at least the provided number of non-owner comments will be returned. (optional)
     * @param string $reviewer_name When specified, only reviews whose authorName contains the provided string will be returned. (optional)
     * @param string $reviewer_email When specified, only reviews whose authorEmail matches the provided email address will be returned. (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ReviewsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function listReviewsWithHttpInfo($account_id, $v, $limit = null, $offset = null, $location_ids = null, $folder_id = null, $countries = null, $location_labels = null, $publisher_ids = null, $review_content = null, $min_rating = null, $max_rating = null, $min_publisher_date = null, $max_publisher_date = null, $min_last_yext_update_date = null, $max_last_yext_update_date = null, $awaiting_response = null, $min_non_owner_comments = null, $reviewer_name = null, $reviewer_email = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling listReviews');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling listReviews');
        }
        if (!is_null($limit) && ($limit > 100)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ReviewsApi.listReviews, must be smaller than or equal to 100.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/reviews";
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
        if ($review_content !== null) {
            $queryParams['reviewContent'] = $this->apiClient->getSerializer()->toQueryValue($review_content);
        }
        // query params
        if ($min_rating !== null) {
            $queryParams['minRating'] = $this->apiClient->getSerializer()->toQueryValue($min_rating);
        }
        // query params
        if ($max_rating !== null) {
            $queryParams['maxRating'] = $this->apiClient->getSerializer()->toQueryValue($max_rating);
        }
        // query params
        if ($min_publisher_date !== null) {
            $queryParams['minPublisherDate'] = $this->apiClient->getSerializer()->toQueryValue($min_publisher_date);
        }
        // query params
        if ($max_publisher_date !== null) {
            $queryParams['maxPublisherDate'] = $this->apiClient->getSerializer()->toQueryValue($max_publisher_date);
        }
        // query params
        if ($min_last_yext_update_date !== null) {
            $queryParams['minLastYextUpdateDate'] = $this->apiClient->getSerializer()->toQueryValue($min_last_yext_update_date);
        }
        // query params
        if ($max_last_yext_update_date !== null) {
            $queryParams['maxLastYextUpdateDate'] = $this->apiClient->getSerializer()->toQueryValue($max_last_yext_update_date);
        }
        // query params
        if ($awaiting_response !== null) {
            $queryParams['awaitingResponse'] = $this->apiClient->getSerializer()->toQueryValue($awaiting_response);
        }
        // query params
        if ($min_non_owner_comments !== null) {
            $queryParams['minNonOwnerComments'] = $this->apiClient->getSerializer()->toQueryValue($min_non_owner_comments);
        }
        // query params
        if ($reviewer_name !== null) {
            $queryParams['reviewerName'] = $this->apiClient->getSerializer()->toQueryValue($reviewer_name);
        }
        // query params
        if ($reviewer_email !== null) {
            $queryParams['reviewerEmail'] = $this->apiClient->getSerializer()->toQueryValue($reviewer_email);
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
                '\Yext\Client\Model\ReviewsResponse',
                '/accounts/{accountId}/reviews'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ReviewsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ReviewsResponse', $e->getResponseHeaders());
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
     * Operation updateReview
     *
     * Review: Update
     *
     * @param string $account_id  (required)
     * @param int $review_id ID of this Review. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Review $review_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function updateReview($account_id, $review_id, $v, $review_request)
    {
        list($response) = $this->updateReviewWithHttpInfo($account_id, $review_id, $v, $review_request);
        return $response;
    }

    /**
     * Operation updateReviewWithHttpInfo
     *
     * Review: Update
     *
     * @param string $account_id  (required)
     * @param int $review_id ID of this Review. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\Review $review_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateReviewWithHttpInfo($account_id, $review_id, $v, $review_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateReview');
        }
        // verify the required parameter 'review_id' is set
        if ($review_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $review_id when calling updateReview');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateReview');
        }
        // verify the required parameter 'review_request' is set
        if ($review_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $review_request when calling updateReview');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/reviews/{reviewId}";
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
        if ($review_id !== null) {
            $resourcePath = str_replace(
                "{" . "reviewId" . "}",
                $this->apiClient->getSerializer()->toPathValue($review_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($review_request)) {
            $_tempBody = $review_request;
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
                '/accounts/{accountId}/reviews/{reviewId}'
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
     * Operation updateReviewGenerationSettings
     *
     * Review Generation Settings: Update
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\ReviewGenerationSettings $review_generation_settings_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ReviewGenerationSettingsResponse
     */
    public function updateReviewGenerationSettings($account_id, $v, $review_generation_settings_request)
    {
        list($response) = $this->updateReviewGenerationSettingsWithHttpInfo($account_id, $v, $review_generation_settings_request);
        return $response;
    }

    /**
     * Operation updateReviewGenerationSettingsWithHttpInfo
     *
     * Review Generation Settings: Update
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\ReviewGenerationSettings $review_generation_settings_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ReviewGenerationSettingsResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateReviewGenerationSettingsWithHttpInfo($account_id, $v, $review_generation_settings_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateReviewGenerationSettings');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateReviewGenerationSettings');
        }
        // verify the required parameter 'review_generation_settings_request' is set
        if ($review_generation_settings_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $review_generation_settings_request when calling updateReviewGenerationSettings');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/reviews/settings/generation";
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
        if (isset($review_generation_settings_request)) {
            $_tempBody = $review_generation_settings_request;
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
                '\Yext\Client\Model\ReviewGenerationSettingsResponse',
                '/accounts/{accountId}/reviews/settings/generation'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ReviewGenerationSettingsResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ReviewGenerationSettingsResponse', $e->getResponseHeaders());
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
