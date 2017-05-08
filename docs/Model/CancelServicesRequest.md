# CancelServicesRequest

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**location_id** | **string** |  | 
**agreement_id** | **int** | The ID of the agreement under which you want services canceled. You do not need to supply this except in advanced scenarios. | [optional] 
**skus** | **string[]** | List of SKUs that you would like to cancel on the location. The location must have active services for all provided SKUs. If you do not provide a list of SKUs, all active services for the location will be canceled. | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


