<?php
/**
 * UserApi
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
 * UserApi Class Doc Comment
 *
 * @category Class
 * @package  Yext\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class UserApi
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
     * @return UserApi
     */
    public function setApiClient(\Yext\Client\ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
        return $this;
    }

    /**
     * Operation createUser
     *
     * Users: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\CreateUserRequest $create_user_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function createUser($account_id, $v, $create_user_request)
    {
        list($response) = $this->createUserWithHttpInfo($account_id, $v, $create_user_request);
        return $response;
    }

    /**
     * Operation createUserWithHttpInfo
     *
     * Users: Create
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param \Yext\Client\Model\CreateUserRequest $create_user_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function createUserWithHttpInfo($account_id, $v, $create_user_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling createUser');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling createUser');
        }
        // verify the required parameter 'create_user_request' is set
        if ($create_user_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $create_user_request when calling createUser');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/users";
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
        if (isset($create_user_request)) {
            $_tempBody = $create_user_request;
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
                '/accounts/{accountId}/users'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\IdResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 201:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\IdResponse', $e->getResponseHeaders());
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
     * Operation deleteUser
     *
     * Users: Delete
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $user_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function deleteUser($account_id, $v, $user_id)
    {
        list($response) = $this->deleteUserWithHttpInfo($account_id, $v, $user_id);
        return $response;
    }

    /**
     * Operation deleteUserWithHttpInfo
     *
     * Users: Delete
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $user_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function deleteUserWithHttpInfo($account_id, $v, $user_id)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling deleteUser');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling deleteUser');
        }
        // verify the required parameter 'user_id' is set
        if ($user_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $user_id when calling deleteUser');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/users/{userId}";
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
        if ($user_id !== null) {
            $resourcePath = str_replace(
                "{" . "userId" . "}",
                $this->apiClient->getSerializer()->toPathValue($user_id),
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
                '/accounts/{accountId}/users/{userId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ErrorResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
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
     * Operation getRoles
     *
     * Roles: Get
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\RolesResponse
     */
    public function getRoles($account_id, $v)
    {
        list($response) = $this->getRolesWithHttpInfo($account_id, $v);
        return $response;
    }

    /**
     * Operation getRolesWithHttpInfo
     *
     * Roles: Get
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\RolesResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getRolesWithHttpInfo($account_id, $v)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getRoles');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getRoles');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/roles";
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
                '\Yext\Client\Model\RolesResponse',
                '/accounts/{accountId}/roles'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\RolesResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\RolesResponse', $e->getResponseHeaders());
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
     * Operation getUser
     *
     * Users: Get
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $user_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\UserResponse
     */
    public function getUser($account_id, $v, $user_id)
    {
        list($response) = $this->getUserWithHttpInfo($account_id, $v, $user_id);
        return $response;
    }

    /**
     * Operation getUserWithHttpInfo
     *
     * Users: Get
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $user_id  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\UserResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUserWithHttpInfo($account_id, $v, $user_id)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getUser');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getUser');
        }
        // verify the required parameter 'user_id' is set
        if ($user_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $user_id when calling getUser');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/users/{userId}";
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
        if ($user_id !== null) {
            $resourcePath = str_replace(
                "{" . "userId" . "}",
                $this->apiClient->getSerializer()->toPathValue($user_id),
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
                '\Yext\Client\Model\UserResponse',
                '/accounts/{accountId}/users/{userId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\UserResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\UserResponse', $e->getResponseHeaders());
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
     * Operation getUsers
     *
     * Users: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to return. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\UsersResponse
     */
    public function getUsers($account_id, $v, $limit = null, $offset = null)
    {
        list($response) = $this->getUsersWithHttpInfo($account_id, $v, $limit, $offset);
        return $response;
    }

    /**
     * Operation getUsersWithHttpInfo
     *
     * Users: List
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param int $limit Number of results to return. (optional, default to 10)
     * @param int $offset Number of results to return. (optional, default to 0)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\UsersResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function getUsersWithHttpInfo($account_id, $v, $limit = null, $offset = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling getUsers');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling getUsers');
        }
        if (!is_null($limit) && ($limit > 50.0)) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling UserApi.getUsers, must be smaller than or equal to 50.0.');
        }

        // parse inputs
        $resourcePath = "/accounts/{accountId}/users";
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
                '\Yext\Client\Model\UsersResponse',
                '/accounts/{accountId}/users'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\UsersResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\UsersResponse', $e->getResponseHeaders());
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
     * Operation updateUser
     *
     * Users: Update
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $user_id  (required)
     * @param \Yext\Client\Model\User $update_user_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\IdResponse
     */
    public function updateUser($account_id, $v, $user_id, $update_user_request)
    {
        list($response) = $this->updateUserWithHttpInfo($account_id, $v, $user_id, $update_user_request);
        return $response;
    }

    /**
     * Operation updateUserWithHttpInfo
     *
     * Users: Update
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $user_id  (required)
     * @param \Yext\Client\Model\User $update_user_request  (required)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\IdResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateUserWithHttpInfo($account_id, $v, $user_id, $update_user_request)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateUser');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateUser');
        }
        // verify the required parameter 'user_id' is set
        if ($user_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $user_id when calling updateUser');
        }
        // verify the required parameter 'update_user_request' is set
        if ($update_user_request === null) {
            throw new \InvalidArgumentException('Missing the required parameter $update_user_request when calling updateUser');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/users/{userId}";
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
        if ($user_id !== null) {
            $resourcePath = str_replace(
                "{" . "userId" . "}",
                $this->apiClient->getSerializer()->toPathValue($user_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($update_user_request)) {
            $_tempBody = $update_user_request;
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
                '/accounts/{accountId}/users/{userId}'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\IdResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = $this->apiClient->getSerializer()->deserialize($e->getResponseBody(), '\Yext\Client\Model\IdResponse', $e->getResponseHeaders());
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
     * Operation updateUserPassword
     *
     * Users: Update Password
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $user_id  (required)
     * @param \Yext\Client\Model\UpdatePasswordRequest $update_password_request  (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return \Yext\Client\Model\ErrorResponse
     */
    public function updateUserPassword($account_id, $v, $user_id, $update_password_request = null)
    {
        list($response) = $this->updateUserPasswordWithHttpInfo($account_id, $v, $user_id, $update_password_request);
        return $response;
    }

    /**
     * Operation updateUserPasswordWithHttpInfo
     *
     * Users: Update Password
     *
     * @param string $account_id  (required)
     * @param string $v A date in &#x60;YYYYMMDD&#x60; format. (required)
     * @param string $user_id  (required)
     * @param \Yext\Client\Model\UpdatePasswordRequest $update_password_request  (optional)
     * @throws \Yext\Client\ApiException on non-2xx response
     * @return array of \Yext\Client\Model\ErrorResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function updateUserPasswordWithHttpInfo($account_id, $v, $user_id, $update_password_request = null)
    {
        // verify the required parameter 'account_id' is set
        if ($account_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $account_id when calling updateUserPassword');
        }
        // verify the required parameter 'v' is set
        if ($v === null) {
            throw new \InvalidArgumentException('Missing the required parameter $v when calling updateUserPassword');
        }
        // verify the required parameter 'user_id' is set
        if ($user_id === null) {
            throw new \InvalidArgumentException('Missing the required parameter $user_id when calling updateUserPassword');
        }
        // parse inputs
        $resourcePath = "/accounts/{accountId}/users/{userId}/password";
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
        if ($user_id !== null) {
            $resourcePath = str_replace(
                "{" . "userId" . "}",
                $this->apiClient->getSerializer()->toPathValue($user_id),
                $resourcePath
            );
        }
        // default format to json
        $resourcePath = str_replace("{format}", "json", $resourcePath);

        // body params
        $_tempBody = null;
        if (isset($update_password_request)) {
            $_tempBody = $update_password_request;
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
                '/accounts/{accountId}/users/{userId}/password'
            );

            return [$this->apiClient->getSerializer()->deserialize($response, '\Yext\Client\Model\ErrorResponse', $httpHeader), $statusCode, $httpHeader];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
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
}
