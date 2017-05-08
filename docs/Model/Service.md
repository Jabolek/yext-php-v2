# Service

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** | Yext ID for the service. This is useful only to get service detail with the &#x60;GET&#x60; endpoint. | [optional] 
**location_id** | **string** |  | [optional] 
**location_account_id** | **string** | *(Partner Portal mode only)* The account that the location receiving service is in. | [optional] 
**agreement_id** | **int** | The ID of your agreement with Yext under which this service is being delivered. This is important to you only in advanced scenarios where you have set up multiple active agreements with Yext. | [optional] 
**sku** | **string** |  | [optional] 
**service_description** | **string** |  | [optional] 
**started** | [**\DateTime**](Date.md) |  | [optional] 
**stopped** | [**\DateTime**](Date.md) |  | [optional] 
**stop_on_date** | [**\DateTime**](Date.md) | Future date on which the service should be stopped if it&#39;s still active when that date arrives. | [optional] 
**status** | **string** |  | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


