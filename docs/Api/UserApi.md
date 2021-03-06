# Yext\Client\UserApi

All URIs are relative to *https://api.yext.com/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createUser**](UserApi.md#createUser) | **POST** /accounts/{accountId}/users | Users: Create
[**deleteUser**](UserApi.md#deleteUser) | **DELETE** /accounts/{accountId}/users/{userId} | Users: Delete
[**getRoles**](UserApi.md#getRoles) | **GET** /accounts/{accountId}/roles | Roles: Get
[**getUser**](UserApi.md#getUser) | **GET** /accounts/{accountId}/users/{userId} | Users: Get
[**getUsers**](UserApi.md#getUsers) | **GET** /accounts/{accountId}/users | Users: List
[**updateUser**](UserApi.md#updateUser) | **PUT** /accounts/{accountId}/users/{userId} | Users: Update
[**updateUserPassword**](UserApi.md#updateUserPassword) | **PUT** /accounts/{accountId}/users/{userId}/password | Users: Update Password


# **createUser**
> \Yext\Client\Model\IdResponse createUser($account_id, $v, $create_user_request)

Users: Create

Create a new User

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\UserApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$create_user_request = new \Yext\Client\Model\CreateUserRequest(); // \Yext\Client\Model\CreateUserRequest | 

try {
    $result = $api_instance->createUser($account_id, $v, $create_user_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->createUser: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **create_user_request** | [**\Yext\Client\Model\CreateUserRequest**](../Model/\Yext\Client\Model\CreateUserRequest.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteUser**
> \Yext\Client\Model\ErrorResponse deleteUser($account_id, $v, $user_id)

Users: Delete

Deletes an existing User.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\UserApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$user_id = "user_id_example"; // string | 

try {
    $result = $api_instance->deleteUser($account_id, $v, $user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->deleteUser: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **user_id** | **string**|  |

### Return type

[**\Yext\Client\Model\ErrorResponse**](../Model/ErrorResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getRoles**
> \Yext\Client\Model\RolesResponse getRoles($account_id, $v)

Roles: Get

Retrieves a list of the roles that users can have within a customer’s account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\UserApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->getRoles($account_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->getRoles: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\RolesResponse**](../Model/RolesResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getUser**
> \Yext\Client\Model\UserResponse getUser($account_id, $v, $user_id)

Users: Get

Retrieves details of a specific User.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\UserApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$user_id = "user_id_example"; // string | 

try {
    $result = $api_instance->getUser($account_id, $v, $user_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->getUser: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **user_id** | **string**|  |

### Return type

[**\Yext\Client\Model\UserResponse**](../Model/UserResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getUsers**
> \Yext\Client\Model\UsersResponse getUsers($account_id, $v, $limit, $offset)

Users: List

Lists all Users in an account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\UserApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$limit = 10; // int | Number of results to return.
$offset = 0; // int | Number of results to return.

try {
    $result = $api_instance->getUsers($account_id, $v, $limit, $offset);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->getUsers: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **limit** | **int**| Number of results to return. | [optional] [default to 10]
 **offset** | **int**| Number of results to return. | [optional] [default to 0]

### Return type

[**\Yext\Client\Model\UsersResponse**](../Model/UsersResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateUser**
> \Yext\Client\Model\IdResponse updateUser($account_id, $v, $user_id, $update_user_request)

Users: Update

Updates an existing User.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\UserApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$user_id = "user_id_example"; // string | 
$update_user_request = new \Yext\Client\Model\User(); // \Yext\Client\Model\User | 

try {
    $result = $api_instance->updateUser($account_id, $v, $user_id, $update_user_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->updateUser: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **user_id** | **string**|  |
 **update_user_request** | [**\Yext\Client\Model\User**](../Model/\Yext\Client\Model\User.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateUserPassword**
> \Yext\Client\Model\ErrorResponse updateUserPassword($account_id, $v, $user_id, $update_password_request)

Users: Update Password

Updates a User's password.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\UserApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$user_id = "user_id_example"; // string | 
$update_password_request = new \Yext\Client\Model\UpdatePasswordRequest(); // \Yext\Client\Model\UpdatePasswordRequest | 

try {
    $result = $api_instance->updateUserPassword($account_id, $v, $user_id, $update_password_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling UserApi->updateUserPassword: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **user_id** | **string**|  |
 **update_password_request** | [**\Yext\Client\Model\UpdatePasswordRequest**](../Model/\Yext\Client\Model\UpdatePasswordRequest.md)|  | [optional]

### Return type

[**\Yext\Client\Model\ErrorResponse**](../Model/ErrorResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

