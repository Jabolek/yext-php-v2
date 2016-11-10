<?php
/**
 * ReviewsApi
 * PHP version 5
 *
 * @category Class
 * @package  Yext\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Yext API
 *
 * 
 *
 * OpenAPI spec version: 2.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
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
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
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
            $apiClient->getConfig()->setHost('https://api.yext.com/v2');
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
     * Comments: Create
     *
     * @param string $account_id  (required)
     * @param int $review_id ID of this Review. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $content Content of the new comment. (optional)
     * @param string $visibility  (optional, default to PRIVATE)
     * @param int $parent_id If this Comment is in response to another comment, use this field to specify the ID of the parent Comment. (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function createComment($account_id, $review_id, $v, $content = null, $visibility = null, $parent_id = null)
    {
        list($response) = $this->createCommentWithHttpInfo($account_id, $review_id, $v, $content, $visibility, $parent_id);
        return $response;
    }

    /**
     * Operation createCommentWithHttpInfo
     *
     * Comments: Create
     *
     * @param string $account_id  (required)
     * @param int $review_id ID of this Review. (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $content Content of the new comment. (optional)
     * @param string $visibility  (optional, default to PRIVATE)
     * @param int $parent_id If this Comment is in response to another comment, use this field to specify the ID of the parent Comment. (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createCommentWithHttpInfo($account_id, $review_id, $v, $content = null, $visibility = null, $parent_id = null)
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
        // query params
        if ($content !== null) {
            $queryParams['content'] = $this->apiClient->getSerializer()->toQueryValue($content);
        }
        // query params
        if ($visibility !== null) {
            $queryParams['visibility'] = $this->apiClient->getSerializer()->toQueryValue($visibility);
        }
        // query params
        if ($parent_id !== null) {
            $queryParams['parentId'] = $this->apiClient->getSerializer()->toQueryValue($parent_id);
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
                default:
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
     * @param \Yext\Client\Model\ReviewInvitation[] $reviews  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\CreateReviewInvitationResponse[]
     */
    public function createReviewInvites($account_id, $reviews)
    {
        list($response) = $this->createReviewInvitesWithHttpInfo($account_id, $reviews);
        return $response;
    }

    /**
     * Operation createReviewInvitesWithHttpInfo
     *
     * Review Invitations: Create
     *
     * @param string $account_id  (required)
     * @param \Yext\Client\Model\ReviewInvitation[] $reviews  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\CreateReviewInvitationResponse[], HTTP status code, HTTP response headers (array of strings)
     */
    public function createReviewInvitesWithHttpInfo($account_id, $reviews)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createReviewInvites');
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
                '\Yext\Client\Model\CreateReviewInvitationResponse[]',
                '/accounts/{accountId}/reviewinvites'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\CreateReviewInvitationResponse[]', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\CreateReviewInvitationResponse[]', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
                default:
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
     * Reviews: Get
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
     * Reviews: Get
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
                default:
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
     * @param int $limit Number of results to return. (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids When provided, only reviews for the requested locations will be returned.  By default, reviews will be returned for all locations subscribed to Review Monitoring.  **Example:** loc123,loc456,loc789 (optional)
     * @param string $folder_id When provided, only reviews for locations in the given folder and its subfolders will be included in the results. (optional)
     * @param string[] $countries When present, only reviews for locations in the given countries will be returned. Countries are denoted by ISO 3166 2-letter country codes. (optional)
     * @param string[] $location_labels When present, only reviews for location with the provided labels will be returned. (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string $review_content When specified, only reviews that include the provided content will be returned. (optional)
     * @param double $min_rating When specified, only reviews with the provided minimum rating or higher will be returned. (optional)
     * @param double $max_rating  (optional)
     * @param \DateTime $min_publisher_date When specified, only reviews with a publisher date on or after the given date will be returned. (optional)
     * @param \DateTime $max_publisher_date When specified, only reviews with a publisher date on or before the given date will be returned. (optional)
     * @param \DateTime $min_last_yext_update_date When specified, only reviews with a last Yext update date on or after the given date will be returned. (optional)
     * @param \DateTime $max_last_yext_update_date When specified, only reviews with a last Yext update date on or before the given date will be returned. (optional)
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
     * @param int $limit Number of results to return. (optional, default to 100)
     * @param int $offset Number of results to skip. Used to page through results. (optional, default to 0)
     * @param string[] $location_ids When provided, only reviews for the requested locations will be returned.  By default, reviews will be returned for all locations subscribed to Review Monitoring.  **Example:** loc123,loc456,loc789 (optional)
     * @param string $folder_id When provided, only reviews for locations in the given folder and its subfolders will be included in the results. (optional)
     * @param string[] $countries When present, only reviews for locations in the given countries will be returned. Countries are denoted by ISO 3166 2-letter country codes. (optional)
     * @param string[] $location_labels When present, only reviews for location with the provided labels will be returned. (optional)
     * @param string[] $publisher_ids List of publisher IDs. If no IDs are specified, defaults to all publishers subscribed by account.  **Example:** MAPQUEST,YELP (optional)
     * @param string $review_content When specified, only reviews that include the provided content will be returned. (optional)
     * @param double $min_rating When specified, only reviews with the provided minimum rating or higher will be returned. (optional)
     * @param double $max_rating  (optional)
     * @param \DateTime $min_publisher_date When specified, only reviews with a publisher date on or after the given date will be returned. (optional)
     * @param \DateTime $max_publisher_date When specified, only reviews with a publisher date on or before the given date will be returned. (optional)
     * @param \DateTime $min_last_yext_update_date When specified, only reviews with a last Yext update date on or after the given date will be returned. (optional)
     * @param \DateTime $max_last_yext_update_date When specified, only reviews with a last Yext update date on or before the given date will be returned. (optional)
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
        if (!is_null($limit) && ($limit > 100.0)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ReviewsApi.listReviews, must be smaller than or equal to 100.0.');
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
            $publisher_ids = $this->apiClient->getSerializer()->serializeCollection($publisher_ids, 'multi', true);
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
                default:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\ErrorResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }

            throw $e;
        }
    }
}
