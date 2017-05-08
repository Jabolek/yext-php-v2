# Yext\Client\AdministrativeApi

All URIs are relative to *https://api.yext.com/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**cancelServices**](AdministrativeApi.md#cancelServices) | **POST** /accounts/{accountId}/cancelservices | Services: Cancel
[**createExistingLocationAddRequest**](AdministrativeApi.md#createExistingLocationAddRequest) | **POST** /accounts/{accountId}/existinglocationaddrequests | Add Requests: Create (Existing Location)
[**createNewLocationAddRequest**](AdministrativeApi.md#createNewLocationAddRequest) | **POST** /accounts/{accountId}/newlocationaddrequests | Add Requests: Create (New Location)
[**getAccount**](AdministrativeApi.md#getAccount) | **GET** /accounts/{accountId} | Accounts: Get
[**getAddRequest**](AdministrativeApi.md#getAddRequest) | **GET** /accounts/{accountId}/addrequests/{addRequestId} | Add Requests: Get
[**listAccounts**](AdministrativeApi.md#listAccounts) | **GET** /accounts | Accounts: List
[**listAddRequests**](AdministrativeApi.md#listAddRequests) | **GET** /accounts/{accountId}/addrequests | Add Requests: List
[**listAvailableServices**](AdministrativeApi.md#listAvailableServices) | **GET** /accounts/{accountId}/availableservices | Available Services: List
[**listServices**](AdministrativeApi.md#listServices) | **GET** /accounts/{accountId}/services | Services: List


# **cancelServices**
> \Yext\Client\Model\CancelServicesResponse cancelServices($account_id, $v, $body)

Services: Cancel

Cancel one or more active services

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\AdministrativeApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\CancelServicesRequest(); // \Yext\Client\Model\CancelServicesRequest | 

try {
    $result = $api_instance->cancelServices($account_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdministrativeApi->cancelServices: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\CancelServicesRequest**](../Model/\Yext\Client\Model\CancelServicesRequest.md)|  |

### Return type

[**\Yext\Client\Model\CancelServicesResponse**](../Model/CancelServicesResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createExistingLocationAddRequest**
> \Yext\Client\Model\AddRequestResponse createExistingLocationAddRequest($account_id, $v, $body)

Add Requests: Create (Existing Location)

Request that one or more available services be added to an existing location

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\AdministrativeApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\ExistingLocationAddRequest(); // \Yext\Client\Model\ExistingLocationAddRequest | 

try {
    $result = $api_instance->createExistingLocationAddRequest($account_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdministrativeApi->createExistingLocationAddRequest: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\ExistingLocationAddRequest**](../Model/\Yext\Client\Model\ExistingLocationAddRequest.md)|  |

### Return type

[**\Yext\Client\Model\AddRequestResponse**](../Model/AddRequestResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createNewLocationAddRequest**
> \Yext\Client\Model\AddRequestResponse createNewLocationAddRequest($account_id, $v, $body)

Add Requests: Create (New Location)

Request that a new location be added and services added to it. The location is created only if the request succeeds.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\AdministrativeApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\NewLocationAddRequest(); // \Yext\Client\Model\NewLocationAddRequest | 

try {
    $result = $api_instance->createNewLocationAddRequest($account_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdministrativeApi->createNewLocationAddRequest: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\NewLocationAddRequest**](../Model/\Yext\Client\Model\NewLocationAddRequest.md)|  |

### Return type

[**\Yext\Client\Model\AddRequestResponse**](../Model/AddRequestResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAccount**
> \Yext\Client\Model\AccountResponse getAccount($account_id, $v)

Accounts: Get

Get details for an account

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\AdministrativeApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->getAccount($account_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdministrativeApi->getAccount: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\AccountResponse**](../Model/AccountResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getAddRequest**
> \Yext\Client\Model\AddRequestResponse getAddRequest($account_id, $add_request_id, $v)

Add Requests: Get

Get status information about an add request previously created  Possible statuses:   * SUBMITTED - The request has been submitted for processing. Updated status should be available soon, usually within seconds.   * PROCESSING - The request is currently being processed. Updated status should be available soon, usually within seconds.   * COMPLETE - The request was successfully processed and service was added. You can verify this by retrieving services for the location.   * CANCELED - The request was purposefully canceled by Yext and was not processed. Details are available in the *results* field.   * REVIEW - The request is being reviewed by Yext, most likely because this location may be a duplicate of another location already     receiving this service through Yext. Once the review is complete, *status* will be updated to either CANCELED or COMPLETE.   * FAILED - Processing the request failed due to a technical issue. Details may be available in the *statusDetail* field. No changes were made to your account, so you can     try the request again.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\AdministrativeApi();
$account_id = "account_id_example"; // string | 
$add_request_id = 56; // int | addRequestId returned from a previous call to *Add requests: Create* or retrieved from *Add Requests: List*
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->getAddRequest($account_id, $add_request_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdministrativeApi->getAddRequest: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **add_request_id** | **int**| addRequestId returned from a previous call to *Add requests: Create* or retrieved from *Add Requests: List* |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\AddRequestResponse**](../Model/AddRequestResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listAccounts**
> \Yext\Client\Model\AccountsResponse listAccounts($v, $name, $limit, $offset)

Accounts: List

List all accounts that you have access to. Unless you are in Partner Portal mode, this will only be your own account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\AdministrativeApi();
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$name = "name_example"; // string | Returns only accounts whose name contains the provided string
$limit = 100; // int | 
$offset = 0; // int | Number of results to return.

try {
    $result = $api_instance->listAccounts($v, $name, $limit, $offset);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdministrativeApi->listAccounts: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **name** | **string**| Returns only accounts whose name contains the provided string | [optional]
 **limit** | **int**|  | [optional] [default to 100]
 **offset** | **int**| Number of results to return. | [optional] [default to 0]

### Return type

[**\Yext\Client\Model\AccountsResponse**](../Model/AccountsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listAddRequests**
> \Yext\Client\Model\AddRequestsResponse listAddRequests($account_id, $v, $status, $submitted_after, $submitted_before, $updated_after, $updated_before, $sku, $agreement_id, $location_id, $limit, $offset)

Add Requests: List

Get all of the add requests in the account. The response includes both New Location Add Requests and Existing Location Add Requests.  Possible `status` values for each add request:   * SUBMITTED - The request has been submitted for processing. Updated status should be available soon, usually within seconds.   * PROCESSING - The request is currently being processed. Updated status should be available soon, usually within seconds.   * COMPLETE - The request was successfully processed and service was added. You can verify this by retrieving services for the location.   * CANCELED - The request was purposefully canceled by Yext and was not processed. Details are available in the *results* field.   * REVIEW - The request is being reviewed by Yext, most likely because this location may be a duplicate of another location already     receiving this service through Yext. Once the review is complete, *status* will be updated to either CANCELED or COMPLETE.   * FAILED - Processing the request failed due to a technical issue. Details may be available in the *statusDetail* field. No changes were made to your account, so you can     try the request again.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\AdministrativeApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$status = "status_example"; // string | Filters the list to add requests in a specific status.
$submitted_after = new \DateTime(); // \DateTime | (`YYYY-MM-DDThh-mm-ss` format)
$submitted_before = new \DateTime(); // \DateTime | (`YYYY-MM-DDThh-mm-ss` format)
$updated_after = new \DateTime(); // \DateTime | (`YYYY-MM-DDThh-mm-ss` format)
$updated_before = new \DateTime(); // \DateTime | (`YYYY-MM-DDThh-mm-ss` format)
$sku = "sku_example"; // string | 
$agreement_id = 56; // int | 
$location_id = "location_id_example"; // string | 
$limit = 20; // int | 
$offset = 0; // int | Number of results to return.

try {
    $result = $api_instance->listAddRequests($account_id, $v, $status, $submitted_after, $submitted_before, $updated_after, $updated_before, $sku, $agreement_id, $location_id, $limit, $offset);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdministrativeApi->listAddRequests: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **status** | **string**| Filters the list to add requests in a specific status. | [optional]
 **submitted_after** | **\DateTime**| (&#x60;YYYY-MM-DDThh-mm-ss&#x60; format) | [optional]
 **submitted_before** | **\DateTime**| (&#x60;YYYY-MM-DDThh-mm-ss&#x60; format) | [optional]
 **updated_after** | **\DateTime**| (&#x60;YYYY-MM-DDThh-mm-ss&#x60; format) | [optional]
 **updated_before** | **\DateTime**| (&#x60;YYYY-MM-DDThh-mm-ss&#x60; format) | [optional]
 **sku** | **string**|  | [optional]
 **agreement_id** | **int**|  | [optional]
 **location_id** | **string**|  | [optional]
 **limit** | **int**|  | [optional] [default to 20]
 **offset** | **int**| Number of results to return. | [optional] [default to 0]

### Return type

[**\Yext\Client\Model\AddRequestsResponse**](../Model/AddRequestsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listAvailableServices**
> \Yext\Client\Model\AvailableServiceResponse listAvailableServices($account_id, $v)

Available Services: List

Return list of services available to you under your agreements

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\AdministrativeApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->listAvailableServices($account_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdministrativeApi->listAvailableServices: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\AvailableServiceResponse**](../Model/AvailableServiceResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **listServices**
> \Yext\Client\Model\ServicesResponse listServices($account_id, $v, $sku, $location_id, $location_account_id, $status, $agreement_id, $limit, $offset)

Services: List

Get all of the services provisioned through this account. (Note that if you have added services to sub-accounts, they will be returned from this endpoint on your main account, not through the services endpoint for the sub-account.)

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\AdministrativeApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$sku = "sku_example"; // string | 
$location_id = "location_id_example"; // string | 
$location_account_id = "location_account_id_example"; // string | *(Portal Mode only)* Filters on the account that the location receiving service is in.
$status = "status_example"; // string | Status of the service. By default, returns only Active services, not All services.
$agreement_id = 56; // int | 
$limit = 20; // int | 
$offset = 0; // int | Number of results to return.

try {
    $result = $api_instance->listServices($account_id, $v, $sku, $location_id, $location_account_id, $status, $agreement_id, $limit, $offset);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling AdministrativeApi->listServices: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **sku** | **string**|  | [optional]
 **location_id** | **string**|  | [optional]
 **location_account_id** | **string**| *(Portal Mode only)* Filters on the account that the location receiving service is in. | [optional]
 **status** | **string**| Status of the service. By default, returns only Active services, not All services. | [optional]
 **agreement_id** | **int**|  | [optional]
 **limit** | **int**|  | [optional] [default to 20]
 **offset** | **int**| Number of results to return. | [optional] [default to 0]

### Return type

[**\Yext\Client\Model\ServicesResponse**](../Model/ServicesResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

