# NewLocationAddRequest

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**new_location_id** | **string** | Your ID for the location to be added. | 
**new_location_account_id** | **string** | *(Partner Portal mode)* Partner Portal mode, supply your ID for the account that the new location should be created in. If this is your main account or an existing sub-account, the location will be placed there. Otherwise, a new account will be created. | [optional] 
**new_account_parent_account_id** | **string** | *(Partner Portal mode, advanced use only)* If you have a multi-layer account structure and want the new account created for this request to be under one of your sub-accounts, rather than directly under your main account, specify that sub-account here. | [optional] 
**skus** | **string[]** | List of SKUs that you would like to sign the location up for, from among those listed in the *availableServices* endpoint. | 
**agreement_id** | **int** | *(Advanced field)* The Agreement ID of the agreement that services will be added under. This is set automatically by Yext when you create the add request. (You can specify it yourself, but should not do so unless you have intentionally set up multiple active agreements with Yext, since this could cause your integration to break when you renew or upgrade your agreement.) | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


