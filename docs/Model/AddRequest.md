# AddRequest

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**id** | **int** |  | [optional] 
**location_mode** | **string** | Whether the request is to add service for an existing location or to create a new location and add service to it. You can specify this explicitly, or otherwise it is inferred from whether you supply existingLocationID or newLocationID (you can&#39;t suppply both.) | [optional] 
**existing_location_id** | **string** | If the add request is for a location that you have already added to Yext, supply its ID. The location must already exist in your account (or, if you use the Partner Portal, any of your sub-accounts). You must set either this field or *newLocationId*, but not both. | [optional] 
**new_location_id** | **string** | If the add request is for a location that needs to be added to Yext, supply its ID in this field. The location must not exist in your account or any sub-accounts or the request will fail. You must set either this field or *existingLocationId*, but not both. | [optional] 
**new_location_account_id** | **string** | If the add request is for a location that needs to be added to Yext and you are in Partner Portal mode, supply your ID for identifying the customer here. The new location will be placed in the sub-account with this ID, first creating it if necessary. | [optional] 
**new_account_parent_account_id** | **string** | *(Advanced field)* If you have a multi-layer account structure and want the new account created for this request to be under one of your sub-accounts, rather than your main account, specify that sub-account here. If you supply this ID, it must refer to an account that already exists. | [optional] 
**skus** | **string[]** | List of SKUs that you would like to sign the location up for, from among those listed in the *availableServices* endpoint. | 
**agreement_id** | **int** | *(Advanced field)* The Agreement ID of the agreement that services will be added under. This is set automatically by Yext when you create the add request. (You can specify it yourself, but should not do so unless you have intentionally set up multiple active agreements with Yext, since this could cause your integration to break when you renew or upgrade your agreement.) | [optional] 
**status** | **string** | The current status of the add request | [optional] 
**date_submitted** | [**\DateTime**](Date.md) |  | [optional] 
**date_completed** | [**\DateTime**](Date.md) |  | [optional] 
**submitted_by** | **string** |  | [optional] 
**status_detail** | **string** | Results from processing. | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


