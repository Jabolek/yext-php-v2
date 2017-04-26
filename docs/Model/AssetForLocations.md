# AssetForLocations

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**label_ids** | **string[]** | The list of **external** label IDs.  **Optional - can only be set if mappingType &#x3D; &#x60;&#x60;FOLDER&#x60;&#x60; or &#x60;&#x60;ALL_LOCATIONS&#x60;&#x60;.** | [optional] 
**mapping_type** | **string** | The type of asset to location mapping:  * &#x60;&#x60;NO_LOCATIONS&#x60;&#x60;: Not available to any location. * &#x60;&#x60;ALL_LOCATIONS&#x60;&#x60;: Available to all locations. * &#x60;&#x60;FOLDER&#x60;&#x60;: Available to all locations in a specified folder. * &#x60;&#x60;LOCATIONS&#x60;&#x60;: Available to a list of locations. | 
**location_ids** | **string[]** | The list of **external** location IDs which this asset can be used for.  **Optional - can only be set if mappingType &#x3D; &#x60;&#x60;LOCATIONS&#x60;&#x60;.** | [optional] 
**folder_id** | **string** | The **external** folder ID for locations which this asset can be used for.  **Optional - can only be set if mappingType &#x3D; &#x60;&#x60;FOLDER&#x60;&#x60;.** | [optional] 
**label_operator** | **string** | The operator on the list of label IDs - whether the list is any of (&#x60;&#x60;OR&#x60;&#x60;) or all of (&#x60;&#x60;AND&#x60;&#x60;).  **Optional - can only be set if mappingType &#x3D; &#x60;&#x60;FOLDER&#x60;&#x60; or &#x60;&#x60;ALL_LOCATIONS&#x60;&#x60;.** | [optional] 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


