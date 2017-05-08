# AvailableService

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**sku** | **string** |  | [optional] 
**agreement_id** | **int** | The ID for the agreement that this service is offered under. This is important only if you have multiple active agreements with Yext, and otherwise can be ignored. | [optional] 
**minimum_usage** | **int** | The minimum amount of time a service has to be active before it can be canceled. In the units specified by *minimumUsageUnit*. | [optional] 
**minimum_usage_unit** | **string** |  | [optional] 
**add_on_to** | **string[]** | List of SKUs that this is an add-on to. When adding this service for a location by creating an *addRequest*, you must either supply one of these SKUs along with this one, or the location must already have one of these services. | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


