# ExistingLocationAddRequest

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**existing_location_id** | **string** | ID of the location to add service for. It must already be in your account (or, if you use the Partner Portal, any of your sub-accounts). | 
**existing_location_account_id** | **string** | *(Partner Portal mode only)* If the *existingLocationId* you specified is not unique among your sub-accounts, use this to specify which account the existing location is in. | [optional] 
**skus** | **string[]** | List of SKUs that you would like to sign the location up for, from among those listed in the *availableServices* endpoint. | 
**agreement_id** | **int** | *(Advanced field)* The Agreement ID of the agreement that services will be added under. This is set automatically by Yext when you create the add request. (You can specify it yourself, but should not do so unless you have intentionally set up multiple active agreements with Yext, since this could cause your integration to break when you renew or upgrade your agreement.) | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


