# Yext\Client\KnowledgeManagerApi

All URIs are relative to *https://api.yext.com/v2*

Method | HTTP request | Description
------------- | ------------- | -------------
[**createBio**](KnowledgeManagerApi.md#createBio) | **POST** /accounts/{accountId}/bios | Bios: Create
[**createCustomField**](KnowledgeManagerApi.md#createCustomField) | **POST** /accounts/{accountId}/customfields | Custom Fields: Create
[**createEvent**](KnowledgeManagerApi.md#createEvent) | **POST** /accounts/{accountId}/events | Events: Create
[**createLocation**](KnowledgeManagerApi.md#createLocation) | **POST** /accounts/{accountId}/locations | Locations: Create
[**createMenu**](KnowledgeManagerApi.md#createMenu) | **POST** /accounts/{accountId}/menus | Menus: Create
[**createProduct**](KnowledgeManagerApi.md#createProduct) | **POST** /accounts/{accountId}/products | Products: Create
[**deleteBioList**](KnowledgeManagerApi.md#deleteBioList) | **DELETE** /accounts/{accountId}/bios/{listId} | Bios: Delete
[**deleteCustomField**](KnowledgeManagerApi.md#deleteCustomField) | **DELETE** /accounts/{accountId}/customFields/{customFieldId} | Custom Fields: Delete
[**deleteEventList**](KnowledgeManagerApi.md#deleteEventList) | **DELETE** /accounts/{accountId}/events/{listId} | Events: Delete
[**deleteLanguageProfile**](KnowledgeManagerApi.md#deleteLanguageProfile) | **DELETE** /accounts/{accountId}/locations/{locationId}/profiles/{language_code} | Language Profiles: Delete
[**deleteMenuList**](KnowledgeManagerApi.md#deleteMenuList) | **DELETE** /accounts/{accountId}/menus/{listId} | Menus: Delete
[**deleteProductList**](KnowledgeManagerApi.md#deleteProductList) | **DELETE** /accounts/{accountId}/products/{listId} | Products: Delete
[**getBio**](KnowledgeManagerApi.md#getBio) | **GET** /accounts/{accountId}/bios/{listId} | Bios: Get
[**getBios**](KnowledgeManagerApi.md#getBios) | **GET** /accounts/{accountId}/bios | Bios: List
[**getBusinessCategories**](KnowledgeManagerApi.md#getBusinessCategories) | **GET** /categories | Categories: List
[**getCustomField**](KnowledgeManagerApi.md#getCustomField) | **GET** /accounts/{accountId}/customFields/{customFieldId} | Custom Fields: Get
[**getCustomFields**](KnowledgeManagerApi.md#getCustomFields) | **GET** /accounts/{accountId}/customfields | Custom Fields: List
[**getEvent**](KnowledgeManagerApi.md#getEvent) | **GET** /accounts/{accountId}/events/{listId} | Events: Get
[**getEvents**](KnowledgeManagerApi.md#getEvents) | **GET** /accounts/{accountId}/events | Events: List
[**getGoogleKeywords**](KnowledgeManagerApi.md#getGoogleKeywords) | **GET** /googlefields | Google Fields: List
[**getLanguageProfile**](KnowledgeManagerApi.md#getLanguageProfile) | **GET** /accounts/{accountId}/locations/{locationId}/profiles/{language_code} | Language Profiles: Get
[**getLanguageProfiles**](KnowledgeManagerApi.md#getLanguageProfiles) | **GET** /accounts/{accountId}/locations/{locationId}/profiles | Language Profiles: List
[**getLocation**](KnowledgeManagerApi.md#getLocation) | **GET** /accounts/{accountId}/locations/{locationId} | Locations: Get
[**getLocationFolders**](KnowledgeManagerApi.md#getLocationFolders) | **GET** /accounts/{accountId}/folders | Folders: List
[**getLocations**](KnowledgeManagerApi.md#getLocations) | **GET** /accounts/{accountId}/locations | Locations: List
[**getMenu**](KnowledgeManagerApi.md#getMenu) | **GET** /accounts/{accountId}/menus/{listId} | Menus: Get
[**getMenus**](KnowledgeManagerApi.md#getMenus) | **GET** /accounts/{accountId}/menus | Menus: List
[**getProduct**](KnowledgeManagerApi.md#getProduct) | **GET** /accounts/{accountId}/products/{listId} | Products: Get
[**getProducts**](KnowledgeManagerApi.md#getProducts) | **GET** /accounts/{accountId}/products | Products: List
[**searchLocations**](KnowledgeManagerApi.md#searchLocations) | **GET** /accounts/{accountId}/locationsearch | Locations: Search
[**updateBio**](KnowledgeManagerApi.md#updateBio) | **PUT** /accounts/{accountId}/bios/{listId} | Bios: Update
[**updateCustomField**](KnowledgeManagerApi.md#updateCustomField) | **PUT** /accounts/{accountId}/customFields/{customFieldId} | Custom Fields: Update
[**updateEvent**](KnowledgeManagerApi.md#updateEvent) | **PUT** /accounts/{accountId}/events/{listId} | Events: Update
[**updateLocation**](KnowledgeManagerApi.md#updateLocation) | **PUT** /accounts/{accountId}/locations/{locationId} | Locations: Update
[**updateMenu**](KnowledgeManagerApi.md#updateMenu) | **PUT** /accounts/{accountId}/menus/{listId} | Menus: Update
[**updateProduct**](KnowledgeManagerApi.md#updateProduct) | **PUT** /accounts/{accountId}/products/{listId} | Products: Update
[**upsertLanguageProfile**](KnowledgeManagerApi.md#upsertLanguageProfile) | **PUT** /accounts/{accountId}/locations/{locationId}/profiles/{language_code} | Language Profiles: Upsert


# **createBio**
> \Yext\Client\Model\IdResponse createBio($account_id, $v, $body)

Bios: Create

Create new Bio List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\Bio(); // \Yext\Client\Model\Bio | 

try {
    $result = $api_instance->createBio($account_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->createBio: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\Bio**](../Model/\Yext\Client\Model\Bio.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createCustomField**
> \Yext\Client\Model\IdResponse createCustomField($v, $account_id, $body)

Custom Fields: Create

Creates a new Custom Field in an Account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$account_id = "account_id_example"; // string | 
$body = new \Yext\Client\Model\CustomField(); // \Yext\Client\Model\CustomField | 

try {
    $result = $api_instance->createCustomField($v, $account_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->createCustomField: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **account_id** | **string**|  |
 **body** | [**\Yext\Client\Model\CustomField**](../Model/\Yext\Client\Model\CustomField.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createEvent**
> \Yext\Client\Model\IdResponse createEvent($account_id, $v, $body)

Events: Create

Create a new Event List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\Event(); // \Yext\Client\Model\Event | 

try {
    $result = $api_instance->createEvent($account_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->createEvent: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\Event**](../Model/\Yext\Client\Model\Event.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createLocation**
> \Yext\Client\Model\IdResponse createLocation($account_id, $v, $location_request)

Locations: Create

Create a new Location.    ## Required fields * **`id`** * **`locationName`** * **`address`** * **`city`** * **`state`** * **`zip`** * **`countryCode`** * **`phone`** * **`categoryIds`** * **`featuredMessage`**   ## Optional fields that trigger warnings Submitting invalid values for certain optional fields will not trigger an error response. Instead, the success response will contain warning messages explaining why the invalid optional values were not stored in the system. The fields that generate warning messages are: <br><br> * **`paymentOptions`** * **`logo`** * **`photos`** * **`twitterHandle`** * **`facebookPageUrl`** * **`languages`**

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$location_request = new \Yext\Client\Model\Location(); // \Yext\Client\Model\Location | 

try {
    $result = $api_instance->createLocation($account_id, $v, $location_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->createLocation: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **location_request** | [**\Yext\Client\Model\Location**](../Model/\Yext\Client\Model\Location.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createMenu**
> \Yext\Client\Model\IdResponse createMenu($account_id, $v, $body)

Menus: Create

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\Menu(); // \Yext\Client\Model\Menu | 

try {
    $result = $api_instance->createMenu($account_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->createMenu: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\Menu**](../Model/\Yext\Client\Model\Menu.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **createProduct**
> \Yext\Client\Model\IdResponse createProduct($account_id, $v, $body)

Products: Create

Create a new Product List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\Product(); // \Yext\Client\Model\Product | 

try {
    $result = $api_instance->createProduct($account_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->createProduct: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\Product**](../Model/\Yext\Client\Model\Product.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteBioList**
> \Yext\Client\Model\ErrorResponse deleteBioList($account_id, $list_id, $v)

Bios: Delete

Delete an existing Bios List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->deleteBioList($account_id, $list_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->deleteBioList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\ErrorResponse**](../Model/ErrorResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteCustomField**
> \Yext\Client\Model\ErrorResponse deleteCustomField($v, $account_id, $custom_field_id)

Custom Fields: Delete

Deletes a Custom Field in an Account.  The Custom Field will be removed from all locations, and all content entered in the Custom Field will be deleted permanently.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$account_id = "account_id_example"; // string | 
$custom_field_id = "custom_field_id_example"; // string | 

try {
    $result = $api_instance->deleteCustomField($v, $account_id, $custom_field_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->deleteCustomField: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **account_id** | **string**|  |
 **custom_field_id** | **string**|  |

### Return type

[**\Yext\Client\Model\ErrorResponse**](../Model/ErrorResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteEventList**
> \Yext\Client\Model\ErrorResponse deleteEventList($account_id, $list_id, $v)

Events: Delete

Delete an existing Event List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->deleteEventList($account_id, $list_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->deleteEventList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\ErrorResponse**](../Model/ErrorResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteLanguageProfile**
> \Yext\Client\Model\ErrorResponse deleteLanguageProfile($account_id, $location_id, $language_code, $v)

Language Profiles: Delete

Remove a Language Profile from a location.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$location_id = "location_id_example"; // string | 
$language_code = "language_code_example"; // string | Locale code.
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->deleteLanguageProfile($account_id, $location_id, $language_code, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->deleteLanguageProfile: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **location_id** | **string**|  |
 **language_code** | **string**| Locale code. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\ErrorResponse**](../Model/ErrorResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteMenuList**
> \Yext\Client\Model\ErrorResponse deleteMenuList($account_id, $list_id, $v)

Menus: Delete

Delete an existing Menu.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->deleteMenuList($account_id, $list_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->deleteMenuList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\ErrorResponse**](../Model/ErrorResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **deleteProductList**
> \Yext\Client\Model\ErrorResponse deleteProductList($account_id, $list_id, $v)

Products: Delete

Delete an existing Products List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->deleteProductList($account_id, $list_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->deleteProductList: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\ErrorResponse**](../Model/ErrorResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getBio**
> \Yext\Client\Model\BioListResponse getBio($account_id, $list_id, $v)

Bios: Get

Retrieve a specific Bios List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->getBio($account_id, $list_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getBio: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\BioListResponse**](../Model/BioListResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getBios**
> \Yext\Client\Model\BioListsResponse getBios($account_id, $v, $limit, $offset)

Bios: List

Retrieve all Bio Lists for an account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$limit = 10; // int | Number of results to return.
$offset = 0; // int | Number of results to return.

try {
    $result = $api_instance->getBios($account_id, $v, $limit, $offset);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getBios: ', $e->getMessage(), PHP_EOL;
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

[**\Yext\Client\Model\BioListsResponse**](../Model/BioListsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getBusinessCategories**
> \Yext\Client\Model\BusinessCategoriesResponse getBusinessCategories($v, $language, $country)

Categories: List

Get available Categories.  All Locations are required to have an associated Category to assist with organization and search. Yext provides a hierarchy of business categories for this purpose, exposed by this API.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$language = "en"; // string | Only categories that apply to this language will be returned.  **Example:** en
$country = "US"; // string | Only categories that apply in this country will be returned.  **Example:** US

try {
    $result = $api_instance->getBusinessCategories($v, $language, $country);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getBusinessCategories: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **language** | **string**| Only categories that apply to this language will be returned.  **Example:** en | [optional] [default to en]
 **country** | **string**| Only categories that apply in this country will be returned.  **Example:** US | [optional] [default to US]

### Return type

[**\Yext\Client\Model\BusinessCategoriesResponse**](../Model/BusinessCategoriesResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCustomField**
> \Yext\Client\Model\CustomFieldResponse getCustomField($v, $account_id, $custom_field_id)

Custom Fields: Get

Gets a specific Custom Field in an Account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$account_id = "account_id_example"; // string | 
$custom_field_id = "custom_field_id_example"; // string | 

try {
    $result = $api_instance->getCustomField($v, $account_id, $custom_field_id);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getCustomField: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **account_id** | **string**|  |
 **custom_field_id** | **string**|  |

### Return type

[**\Yext\Client\Model\CustomFieldResponse**](../Model/CustomFieldResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getCustomFields**
> \Yext\Client\Model\CustomFieldsResponse getCustomFields($v, $account_id, $offset, $limit)

Custom Fields: List

Returns a list of Custom Fields in an Account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$account_id = "account_id_example"; // string | 
$offset = 0; // int | Number of results to return.
$limit = 100; // int | Number of results to return.

try {
    $result = $api_instance->getCustomFields($v, $account_id, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getCustomFields: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **account_id** | **string**|  |
 **offset** | **int**| Number of results to return. | [optional] [default to 0]
 **limit** | **int**| Number of results to return. | [optional] [default to 100]

### Return type

[**\Yext\Client\Model\CustomFieldsResponse**](../Model/CustomFieldsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEvent**
> \Yext\Client\Model\EventListResponse getEvent($account_id, $list_id, $v)

Events: Get

Retrieve a specific Event List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->getEvent($account_id, $list_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getEvent: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\EventListResponse**](../Model/EventListResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getEvents**
> \Yext\Client\Model\EventListsResponse getEvents($account_id, $v, $limit, $offset)

Events: List

Retrieve all Event Lists for an account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$limit = 10; // int | Number of results to return.
$offset = 0; // int | Number of results to return.

try {
    $result = $api_instance->getEvents($account_id, $v, $limit, $offset);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getEvents: ', $e->getMessage(), PHP_EOL;
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

[**\Yext\Client\Model\EventListsResponse**](../Model/EventListsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getGoogleKeywords**
> \Yext\Client\Model\GoogleFieldsResponse getGoogleKeywords($v)

Google Fields: List

Use the Google Fields endpoint to retrieve a complete list of Google's location attributes for each business category. This list includes attributes that may not apply to all Locations in an account. The set of attributes available to a Location depends on its primary business category. You can view and edit the attributes of Locations in the googleAttributes Location field.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->getGoogleKeywords($v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getGoogleKeywords: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\GoogleFieldsResponse**](../Model/GoogleFieldsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getLanguageProfile**
> \Yext\Client\Model\LocationResponse getLanguageProfile($account_id, $location_id, $language_code, $v, $resolve_placeholders)

Language Profiles: Get

Gets the the requested Language Profile for a given Location.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$location_id = "location_id_example"; // string | 
$language_code = "language_code_example"; // string | Locale code.
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$resolve_placeholders = false; // bool | Optional parameter to resolve all embedded fields in a Location object response. - `false` (default): Location object returns placeholder labels, e.g. \"Your [[CITY]] store\" - `true`: Location object returns placeholder values, e.g. \"Your Fairfax store\"

try {
    $result = $api_instance->getLanguageProfile($account_id, $location_id, $language_code, $v, $resolve_placeholders);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getLanguageProfile: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **location_id** | **string**|  |
 **language_code** | **string**| Locale code. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **resolve_placeholders** | **bool**| Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; | [optional] [default to false]

### Return type

[**\Yext\Client\Model\LocationResponse**](../Model/LocationResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getLanguageProfiles**
> \Yext\Client\Model\LanguageProfilesResponse getLanguageProfiles($account_id, $location_id, $v, $resolve_placeholders)

Language Profiles: List

Get Language Profiles for a Location.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$location_id = "location_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$resolve_placeholders = false; // bool | Optional parameter to resolve all embedded fields in a Location object response. - `false` (default): Location object returns placeholder labels, e.g. \"Your [[CITY]] store\" - `true`: Location object returns placeholder values, e.g. \"Your Fairfax store\"

try {
    $result = $api_instance->getLanguageProfiles($account_id, $location_id, $v, $resolve_placeholders);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getLanguageProfiles: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **location_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **resolve_placeholders** | **bool**| Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; | [optional] [default to false]

### Return type

[**\Yext\Client\Model\LanguageProfilesResponse**](../Model/LanguageProfilesResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getLocation**
> \Yext\Client\Model\LocationResponse getLocation($account_id, $location_id, $v, $resolve_placeholders)

Locations: Get

Gets the primary profile for a single Location.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$location_id = "location_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$resolve_placeholders = false; // bool | Optional parameter to resolve all embedded fields in a Location object response. - `false` (default): Location object returns placeholder labels, e.g. \"Your [[CITY]] store\" - `true`: Location object returns placeholder values, e.g. \"Your Fairfax store\"

try {
    $result = $api_instance->getLocation($account_id, $location_id, $v, $resolve_placeholders);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getLocation: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **location_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **resolve_placeholders** | **bool**| Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; | [optional] [default to false]

### Return type

[**\Yext\Client\Model\LocationResponse**](../Model/LocationResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getLocationFolders**
> \Yext\Client\Model\FoldersResponse getLocationFolders($account_id, $v, $offset, $limit)

Folders: List

Returns a list of Location Folders in an Account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$offset = 0; // int | Number of results to return.
$limit = 100; // int | Number of results to return.

try {
    $result = $api_instance->getLocationFolders($account_id, $v, $offset, $limit);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getLocationFolders: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **offset** | **int**| Number of results to return. | [optional] [default to 0]
 **limit** | **int**| Number of results to return. | [optional] [default to 100]

### Return type

[**\Yext\Client\Model\FoldersResponse**](../Model/FoldersResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getLocations**
> \Yext\Client\Model\LocationsResponse getLocations($account_id, $v, $limit, $offset, $resolve_placeholders)

Locations: List

Get multiple Locations (primary profiles only).

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$limit = 10; // int | Number of results to return.
$offset = 0; // int | Number of results to return.
$resolve_placeholders = false; // bool | Optional parameter to resolve all embedded fields in a Location object response. - `false` (default): Location object returns placeholder labels, e.g. \"Your [[CITY]] store\" - `true`: Location object returns placeholder values, e.g. \"Your Fairfax store\"

try {
    $result = $api_instance->getLocations($account_id, $v, $limit, $offset, $resolve_placeholders);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getLocations: ', $e->getMessage(), PHP_EOL;
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
 **resolve_placeholders** | **bool**| Optional parameter to resolve all embedded fields in a Location object response. - &#x60;false&#x60; (default): Location object returns placeholder labels, e.g. \&quot;Your [[CITY]] store\&quot; - &#x60;true&#x60;: Location object returns placeholder values, e.g. \&quot;Your Fairfax store\&quot; | [optional] [default to false]

### Return type

[**\Yext\Client\Model\LocationsResponse**](../Model/LocationsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getMenu**
> \Yext\Client\Model\MenuListResponse getMenu($account_id, $list_id, $v)

Menus: Get

Retrieve a specific Menu.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->getMenu($account_id, $list_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getMenu: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\MenuListResponse**](../Model/MenuListResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getMenus**
> \Yext\Client\Model\MenuListsResponse getMenus($account_id, $v, $limit, $offset)

Menus: List

Retrieve all Menus for an account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$limit = 10; // int | Number of results to return.
$offset = 0; // int | Number of results to return.

try {
    $result = $api_instance->getMenus($account_id, $v, $limit, $offset);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getMenus: ', $e->getMessage(), PHP_EOL;
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

[**\Yext\Client\Model\MenuListsResponse**](../Model/MenuListsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getProduct**
> \Yext\Client\Model\ProductListResponse getProduct($account_id, $list_id, $v)

Products: Get

Retrieve a specific Product List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.

try {
    $result = $api_instance->getProduct($account_id, $list_id, $v);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getProduct: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]

### Return type

[**\Yext\Client\Model\ProductListResponse**](../Model/ProductListResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **getProducts**
> \Yext\Client\Model\ProductListsResponse getProducts($account_id, $v, $limit, $offset)

Products: List

Retrieve all Product Lists for an account.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$limit = 10; // int | Number of results to return.
$offset = 0; // int | Number of results to return.

try {
    $result = $api_instance->getProducts($account_id, $v, $limit, $offset);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->getProducts: ', $e->getMessage(), PHP_EOL;
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

[**\Yext\Client\Model\ProductListsResponse**](../Model/ProductListsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **searchLocations**
> \Yext\Client\Model\LocationsResponse searchLocations($account_id, $v, $limit, $offset, $filters)

Locations: Search

Get multiple Locations (primary profiles only) that match provided filters.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$limit = 10; // int | Number of results to return.
$offset = 0; // int | Number of results to skip. Used to page through results.
$filters = "filters_example"; // string | A set of filters that is applied to the set of locations that would otherwise be returned. Should be provided as a URL-encoded string containing a JSON object. The JSON object will be an array with one or more filter objects defined. All filter objects will apply as an intersection (i.e. AND). Field names reference Location fields, as well as custom fields using the format custom###, where ### is the custom field’s ID.  The filter types are the following. Note there may be multiple available specifications for a given filter type:  <table style=\"width:100%\">   <tr>     <th>Filter Type</th>     <th>Syntax</th>     <th>Description</th>   </tr>   <tr>     <td>Full</td>     <td>fieldName: {contains: $search}</td>     <td>$search is the search string</td>   </tr>   <tr>     <td>Text</td>     <td>fieldName: {$type: [$search,...]}</td>     <td>$type is one of [contains,doesNotContain,startsWith,equalTo], $search is an array of search strings, combined with OR</td>   </tr>   <tr>     <td>Text</td>     <td>fieldName: $type</td>     <td>$type is one of [empty,notEmpty]</td>   </tr>   <tr>     <td>Number</td>     <td>fieldName: {$type: $value}</td>     <td>$type is one of [eq,lt,gt,le,ge], $value is the numeric value</td>   </tr>   <tr>     <td>Number</td>     <td>fieldName: {$type: [$value1, $value2]}</td>     <td>$type is one of [between], $value1 and $value2 are numeric values</td>   </tr>   <tr>     <td>Date</td>     <td>fieldName: {$type: $value}</td>     <td>$type is one of [eq,lt,gt,le,ge], $value is a string of \"YYYY-MM-DD” formatted date</td>   </tr>   <tr>     <td>Date</td>     <td>fieldName: $type</td>     <td>$type is one of [empty,notEmpty]</td>   </tr>   <tr>     <td>Date</td>     <td>fieldName: {$type: [$value1, $value2]}</td>     <td>$type is one of [between], $value1 and $value2 are strings of \"YYYY-MM-DD” formatted date</td>   </tr>   <tr>     <td>Categories</td>     <td>fieldName: {$type: [$id,...]}</td>     <td>$type is one of [includes,notIncludes], $id is an array of numeric category IDs, combined with OR</td>   </tr>   <tr>     <td>Categories</td>     <td>fieldName: $type</td>     <td>$type is one of [none]</td>   </tr>   <tr>     <td>Assets</td>     <td>fieldName: {$type: [$id,...]}</td>     <td>$type is one of [includes,notIncludes], $id is an array of numeric category IDs, combined with OR</td>   </tr>   <tr>     <td>Assets</td>     <td>fieldName: $type</td>     <td>$type is one of [none]</td>   </tr>   <tr>     <td>Country</td>     <td>fieldName: {$type: [$country,...]}</td>     <td>$type is one of [includes,notIncludes], $country is an array of country code strings, combined with OR</td>   </tr>   <tr>     <td>PrimaryLanguage</td>     <td>fieldName: {$type: [$language,...]}</td>     <td>$type is one of [is,isNot], $language is an array of language code strings, combined with OR</td>   </tr>   <tr>     <td>AlternateLanguage</td>     <td>fieldName: {$type: [$language,...]}</td>     <td>$type is one of [is,isNot], $language is an array of language code strings, combined with OR</td>   </tr>   <tr>     <td>StringSingle</td>     <td>fieldName: {$type: [$string,...]}</td>     <td>$type is one of [is,isNot], $string is an array of strings, combined with OR</td>   </tr>   <tr>     <td>StringList</td>     <td>fieldName: {$type: [$string,...]}</td>     <td>$type is one of [includes,notIncludes], $string is an array of strings, combined with OR</td>   </tr>   <tr>     <td>LocationType</td>     <td>fieldName: {$type: [$id,...]}</td>     <td>$type is one of [is,isNot], $id is an array of location type IDs, combined with OR</td>   </tr>   <tr>     <td>Bool</td>     <td>fieldName: $type</td>     <td>$type is one of [true,false]</td>   </tr>   <tr>     <td>Option</td>     <td>fieldName: {$type: $id}</td>     <td>$type is one of [is,isNot], $id is an option ID (For single option custom fields)</td>   </tr>   <tr>     <td>Option</td>     <td>fieldName: {$type: [$id,...]}</td>     <td>$type is one of [includes,notIncludes], $string is an array of strings, combined with OR (For multi option custom fields)</td>   </tr>   <tr>     <td>IdList</td>     <td>fieldName: {$type: [$id,...]}</td>     <td>$type is one of [includes,notIncludes], $id is an array of IDs, combined with OR</td>   </tr> </table>  The following fields can be specified in the request (Field name/Filter Type/Example(s)):  <table style=\"width:100%\">   <tr>     <th>Field Name</th>     <th>Filter Type</th>     <th>Example(s)</th>   </tr>   <tr>     <td>location</td>     <td>Full</td>     <td>\"location”: {\"contains”: \"Atlanta”}</td>   </tr>   <tr>     <td>name</td>     <td>Text</td>     <td>\"name”: {\"startsWith”: [\"Guitar”]}, \"name”: {\"contains”: [\"A”,”B”]}</td>   </tr>   <tr>     <td>address</td>     <td>Text</td>     <td>\"address”: {\"startsWith”: [\"South”]}</td>   </tr>   <tr>     <td>address2</td>     <td>Text</td>     <td>\"address2”: {\"contains”: [\"Suite”]}</td>   </tr>   <tr>     <td>city</td>     <td>Text</td>     <td>\"city”: {\"contains”: [\"Atlanta”]}</td>   </tr>   <tr>     <td>state</td>     <td>Text</td>     <td>\"state”: {\"contains”: [\"AK”,”VA”]}</td>   </tr>   <tr>     <td>zip</td>     <td>Text</td>     <td>\"zip”: {\"contains”: [\"M5K 7QB”]}</td>   </tr>   <tr>     <td>phones</td>     <td>Text</td>     <td>\"phones”: {\"startsWith”: [\"703”,”571”]}</td>   </tr>   <tr>     <td>specialOffer</td>     <td>Text</td>     <td>\"specialOffer”: \"notEmpty”</td>   </tr>   <tr>     <td>emails</td>     <td>Text</td>     <td>\"emails”: {\"doesNotContain”: [\"@yext.com”]}</td>   </tr>   <tr>     <td>website</td>     <td>Text</td>     <td>\"website”: {\"equalTo”: [\"https://www.yext.com/”]}</td>   </tr>   <tr>     <td>categories</td>     <td>Categories</td>     <td>\"categories”: {\"includes”: [23,755,34]}</td>   </tr>   <tr>     <td>closed</td>     <td>Bool</td>     <td>\"closed”: true</td>   </tr>   <tr>     <td>storeId</td>     <td>Text</td>     <td>\"storeId”: {\"equalTo”: [\"MCD0001”]}</td>   </tr>   <tr>     <td>countryCode</td>     <td>Country</td>     <td>\"countryCode”: {\"notIncludes”: [\"US”]}</td>   </tr>   <tr>     <td>products</td>     <td>Text</td>     <td>\"products”: {\"startsWith”: [\"Burger”,”Fries”]}</td>   </tr>   <tr>     <td>services</td>     <td>Text</td>     <td>\"services”: {\"contains”: [\"Manicures”]}</td>   </tr>   <tr>     <td>specialties</td>     <td>Text</td>     <td>\"services”: \"notEmpty”</td>   </tr>   <tr>     <td>associations</td>     <td>Text</td>     <td>\"associations”: \"empty”</td>   </tr>   <tr>     <td>brands</td>     <td>Text</td>     <td>\"brands”: {\"equalTo”: [\"North Face”]}</td>   </tr>   <tr>     <td>languages</td>     <td>Text</td>     <td>\"languages”: {\"equalTo”: [\"English”,”Spanish”]}</td>   </tr>   <tr>     <td>keywords</td>     <td>Text</td>     <td>\"keywords”: {\"startsWith”: [\"Franchise”]}</td>   </tr>   <tr>     <td>menuIds</td>     <td>IdList</td>     <td>\"menuIds”: {\"includes”: [23,755,34]}</td>   </tr>   <tr>     <td>productListIds</td>     <td>IdList</td>     <td>\"productListIds”: {\"notIncludes”: [2]}</td>   </tr>   <tr>     <td>calendarIds</td>     <td>IdList</td>     <td>\"calendarIds”: {\"notIncludes”: [34]}</td>   </tr>   <tr>     <td>bioIds</td>     <td>IdList</td>     <td>\"bioIds”: {\"includes”: [23,34]}</td>   </tr>   <tr>     <td>custom###</td>     <td>Text, Number, Date, Bool, or Option</td>     <td>\"custom123”: {\"equalTo”: [\"asdf”]}</td>   </tr>   <tr>     <td>folder</td>     <td>int64</td>     <td>\"folder”: 123</td>   </tr>   <tr>     <td>primary_language</td>     <td>PrimaryLanguage</td>     <td>\"primary_language”: {\"is”: \"fr_CA”}</td>   </tr> </table>

try {
    $result = $api_instance->searchLocations($account_id, $v, $limit, $offset, $filters);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->searchLocations: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **limit** | **int**| Number of results to return. | [optional] [default to 10]
 **offset** | **int**| Number of results to skip. Used to page through results. | [optional] [default to 0]
 **filters** | **string**| A set of filters that is applied to the set of locations that would otherwise be returned. Should be provided as a URL-encoded string containing a JSON object. The JSON object will be an array with one or more filter objects defined. All filter objects will apply as an intersection (i.e. AND). Field names reference Location fields, as well as custom fields using the format custom###, where ### is the custom field’s ID.  The filter types are the following. Note there may be multiple available specifications for a given filter type:  &lt;table style&#x3D;\&quot;width:100%\&quot;&gt;   &lt;tr&gt;     &lt;th&gt;Filter Type&lt;/th&gt;     &lt;th&gt;Syntax&lt;/th&gt;     &lt;th&gt;Description&lt;/th&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Full&lt;/td&gt;     &lt;td&gt;fieldName: {contains: $search}&lt;/td&gt;     &lt;td&gt;$search is the search string&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$search,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [contains,doesNotContain,startsWith,equalTo], $search is an array of search strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [empty,notEmpty]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Number&lt;/td&gt;     &lt;td&gt;fieldName: {$type: $value}&lt;/td&gt;     &lt;td&gt;$type is one of [eq,lt,gt,le,ge], $value is the numeric value&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Number&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$value1, $value2]}&lt;/td&gt;     &lt;td&gt;$type is one of [between], $value1 and $value2 are numeric values&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Date&lt;/td&gt;     &lt;td&gt;fieldName: {$type: $value}&lt;/td&gt;     &lt;td&gt;$type is one of [eq,lt,gt,le,ge], $value is a string of \&quot;YYYY-MM-DD” formatted date&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Date&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [empty,notEmpty]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Date&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$value1, $value2]}&lt;/td&gt;     &lt;td&gt;$type is one of [between], $value1 and $value2 are strings of \&quot;YYYY-MM-DD” formatted date&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Categories&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $id is an array of numeric category IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Categories&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [none]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Assets&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $id is an array of numeric category IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Assets&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [none]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Country&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$country,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $country is an array of country code strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;PrimaryLanguage&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$language,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $language is an array of language code strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;AlternateLanguage&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$language,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $language is an array of language code strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;StringSingle&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$string,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $string is an array of strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;StringList&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$string,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $string is an array of strings, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;LocationType&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $id is an array of location type IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Bool&lt;/td&gt;     &lt;td&gt;fieldName: $type&lt;/td&gt;     &lt;td&gt;$type is one of [true,false]&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Option&lt;/td&gt;     &lt;td&gt;fieldName: {$type: $id}&lt;/td&gt;     &lt;td&gt;$type is one of [is,isNot], $id is an option ID (For single option custom fields)&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;Option&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $string is an array of strings, combined with OR (For multi option custom fields)&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;fieldName: {$type: [$id,...]}&lt;/td&gt;     &lt;td&gt;$type is one of [includes,notIncludes], $id is an array of IDs, combined with OR&lt;/td&gt;   &lt;/tr&gt; &lt;/table&gt;  The following fields can be specified in the request (Field name/Filter Type/Example(s)):  &lt;table style&#x3D;\&quot;width:100%\&quot;&gt;   &lt;tr&gt;     &lt;th&gt;Field Name&lt;/th&gt;     &lt;th&gt;Filter Type&lt;/th&gt;     &lt;th&gt;Example(s)&lt;/th&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;location&lt;/td&gt;     &lt;td&gt;Full&lt;/td&gt;     &lt;td&gt;\&quot;location”: {\&quot;contains”: \&quot;Atlanta”}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;name&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;name”: {\&quot;startsWith”: [\&quot;Guitar”]}, \&quot;name”: {\&quot;contains”: [\&quot;A”,”B”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;address&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;address”: {\&quot;startsWith”: [\&quot;South”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;address2&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;address2”: {\&quot;contains”: [\&quot;Suite”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;city&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;city”: {\&quot;contains”: [\&quot;Atlanta”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;state&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;state”: {\&quot;contains”: [\&quot;AK”,”VA”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;zip&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;zip”: {\&quot;contains”: [\&quot;M5K 7QB”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;phones&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;phones”: {\&quot;startsWith”: [\&quot;703”,”571”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;specialOffer&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;specialOffer”: \&quot;notEmpty”&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;emails&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;emails”: {\&quot;doesNotContain”: [\&quot;@yext.com”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;website&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;website”: {\&quot;equalTo”: [\&quot;https://www.yext.com/”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;categories&lt;/td&gt;     &lt;td&gt;Categories&lt;/td&gt;     &lt;td&gt;\&quot;categories”: {\&quot;includes”: [23,755,34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;closed&lt;/td&gt;     &lt;td&gt;Bool&lt;/td&gt;     &lt;td&gt;\&quot;closed”: true&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;storeId&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;storeId”: {\&quot;equalTo”: [\&quot;MCD0001”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;countryCode&lt;/td&gt;     &lt;td&gt;Country&lt;/td&gt;     &lt;td&gt;\&quot;countryCode”: {\&quot;notIncludes”: [\&quot;US”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;products&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;products”: {\&quot;startsWith”: [\&quot;Burger”,”Fries”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;services&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;services”: {\&quot;contains”: [\&quot;Manicures”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;specialties&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;services”: \&quot;notEmpty”&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;associations&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;associations”: \&quot;empty”&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;brands&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;brands”: {\&quot;equalTo”: [\&quot;North Face”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;languages&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;languages”: {\&quot;equalTo”: [\&quot;English”,”Spanish”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;keywords&lt;/td&gt;     &lt;td&gt;Text&lt;/td&gt;     &lt;td&gt;\&quot;keywords”: {\&quot;startsWith”: [\&quot;Franchise”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;menuIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;menuIds”: {\&quot;includes”: [23,755,34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;productListIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;productListIds”: {\&quot;notIncludes”: [2]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;calendarIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;calendarIds”: {\&quot;notIncludes”: [34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;bioIds&lt;/td&gt;     &lt;td&gt;IdList&lt;/td&gt;     &lt;td&gt;\&quot;bioIds”: {\&quot;includes”: [23,34]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;custom###&lt;/td&gt;     &lt;td&gt;Text, Number, Date, Bool, or Option&lt;/td&gt;     &lt;td&gt;\&quot;custom123”: {\&quot;equalTo”: [\&quot;asdf”]}&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;folder&lt;/td&gt;     &lt;td&gt;int64&lt;/td&gt;     &lt;td&gt;\&quot;folder”: 123&lt;/td&gt;   &lt;/tr&gt;   &lt;tr&gt;     &lt;td&gt;primary_language&lt;/td&gt;     &lt;td&gt;PrimaryLanguage&lt;/td&gt;     &lt;td&gt;\&quot;primary_language”: {\&quot;is”: \&quot;fr_CA”}&lt;/td&gt;   &lt;/tr&gt; &lt;/table&gt; | [optional]

### Return type

[**\Yext\Client\Model\LocationsResponse**](../Model/LocationsResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateBio**
> \Yext\Client\Model\BioListResponse updateBio($account_id, $list_id, $v, $body)

Bios: Update

Update an existing Bios List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\Bio(); // \Yext\Client\Model\Bio | 

try {
    $result = $api_instance->updateBio($account_id, $list_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->updateBio: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\Bio**](../Model/\Yext\Client\Model\Bio.md)|  |

### Return type

[**\Yext\Client\Model\BioListResponse**](../Model/BioListResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateCustomField**
> \Yext\Client\Model\IdResponse updateCustomField($v, $account_id, $custom_field_id, $body)

Custom Fields: Update

Updates a single Custom Field in an Account.  Note that the only updatable values in an existing Custom Field are its name, group, description, alternate language behavior, as well as available options if its `type` is `SINGLE_OPTION` or `MULTI_OPTION`.  * If options are modified, every location with that option selected will have the new value.  * If options are deleted, all locations with that option will no longer have that option selected.  * If the deleted options are the only options selected for a location, the location will no longer have a value set for that Custom Field.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$account_id = "account_id_example"; // string | 
$custom_field_id = "custom_field_id_example"; // string | 
$body = new \Yext\Client\Model\CustomFieldUpdate(); // \Yext\Client\Model\CustomFieldUpdate | 

try {
    $result = $api_instance->updateCustomField($v, $account_id, $custom_field_id, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->updateCustomField: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **account_id** | **string**|  |
 **custom_field_id** | **string**|  |
 **body** | [**\Yext\Client\Model\CustomFieldUpdate**](../Model/\Yext\Client\Model\CustomFieldUpdate.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateEvent**
> \Yext\Client\Model\EventListResponse updateEvent($account_id, $list_id, $v, $body)

Events: Update

Update an existing Event List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\Event(); // \Yext\Client\Model\Event | 

try {
    $result = $api_instance->updateEvent($account_id, $list_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->updateEvent: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\Event**](../Model/\Yext\Client\Model\Event.md)|  |

### Return type

[**\Yext\Client\Model\EventListResponse**](../Model/EventListResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateLocation**
> \Yext\Client\Model\IdResponse updateLocation($account_id, $location_id, $v, $location_request)

Locations: Update

Updates the primary profile for a Location.  **NOTE:** Despite using the PUT method, Locations: Update only updates supplied fields. Omitted fields are not modified.  **NOTE:** The Location's primary profile language can be changed by calling this endpoint with a different, but unused, language code.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$location_id = "location_id_example"; // string | 
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$location_request = new \Yext\Client\Model\Location(); // \Yext\Client\Model\Location | 

try {
    $result = $api_instance->updateLocation($account_id, $location_id, $v, $location_request);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->updateLocation: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **location_id** | **string**|  |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **location_request** | [**\Yext\Client\Model\Location**](../Model/\Yext\Client\Model\Location.md)|  |

### Return type

[**\Yext\Client\Model\IdResponse**](../Model/IdResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateMenu**
> \Yext\Client\Model\MenuListResponse updateMenu($account_id, $list_id, $v, $body)

Menus: Update

Update an existing Menu.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\Menu(); // \Yext\Client\Model\Menu | 

try {
    $result = $api_instance->updateMenu($account_id, $list_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->updateMenu: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\Menu**](../Model/\Yext\Client\Model\Menu.md)|  |

### Return type

[**\Yext\Client\Model\MenuListResponse**](../Model/MenuListResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **updateProduct**
> \Yext\Client\Model\ProductListResponse updateProduct($account_id, $list_id, $v, $body)

Products: Update

Update an existing Product List.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$list_id = "list_id_example"; // string | ID of this List.
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\Product(); // \Yext\Client\Model\Product | 

try {
    $result = $api_instance->updateProduct($account_id, $list_id, $v, $body);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->updateProduct: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **list_id** | **string**| ID of this List. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\Product**](../Model/\Yext\Client\Model\Product.md)|  |

### Return type

[**\Yext\Client\Model\ProductListResponse**](../Model/ProductListResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

# **upsertLanguageProfile**
> \Yext\Client\Model\ErrorResponse upsertLanguageProfile($account_id, $location_id, $language_code, $v, $body, $primary)

Language Profiles: Upsert

Creates and / or sets the fields for a Language Profile  **NOTE:** You can change a Language Profile’s language by supplying a different (but unused) language code.

### Example
```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: api_key
Yext\Client\Configuration::getDefaultConfiguration()->setApiKey('api_key', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Yext\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('api_key', 'Bearer');

$api_instance = new Yext\Client\Api\KnowledgeManagerApi();
$account_id = "account_id_example"; // string | 
$location_id = "location_id_example"; // string | 
$language_code = "language_code_example"; // string | Locale code.
$v = "20161012"; // string | A date in `YYYYMMDD` format.
$body = new \Yext\Client\Model\Location(); // \Yext\Client\Model\Location | 
$primary = true; // bool | When present and set to true, the specified profile will become the location’s primary Language Profile.

try {
    $result = $api_instance->upsertLanguageProfile($account_id, $location_id, $language_code, $v, $body, $primary);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling KnowledgeManagerApi->upsertLanguageProfile: ', $e->getMessage(), PHP_EOL;
}
?>
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **account_id** | **string**|  |
 **location_id** | **string**|  |
 **language_code** | **string**| Locale code. |
 **v** | **string**| A date in &#x60;YYYYMMDD&#x60; format. | [default to 20161012]
 **body** | [**\Yext\Client\Model\Location**](../Model/\Yext\Client\Model\Location.md)|  |
 **primary** | **bool**| When present and set to true, the specified profile will become the location’s primary Language Profile. | [optional]

### Return type

[**\Yext\Client\Model\ErrorResponse**](../Model/ErrorResponse.md)

### Authorization

[api_key](../../README.md#api_key)

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

