# Asset

## Properties
Name | Type | Description | Notes
------------ | ------------- | ------------- | -------------
**video_url** | **string** | URL to the YouTube video.  **Required - when asset type is &#x60;&#x60;VIDEO&#x60;&#x60;. Must be a valid URL to a YouTube video. Cannot be updated once created.** | [optional] 
**description** | **string** | Asset description. | [optional] 
**for_locations** | [**\Yext\Client\Model\AssetForLocations**](AssetForLocations.md) |  | 
**clickthrough_url** | **string** | Clickthrough URL.  **Optional - only valid when asset type is &#x60;&#x60;PHOTO&#x60;&#x60;.** | [optional] 
**labels** | **string[]** | List of text labels to apply to this Asset. | [optional] 
**photo_url** | **string** | URL to the photo asset.  **Required - when asset type is &#x60;&#x60;PHOTO&#x60;&#x60;. Must be a valid URL to a photo asset. Cannot be updated once created.** | [optional] 
**details** | **string** | Details text.  **Optional - only valid when asset type is &#x60;&#x60;PHOTO&#x60;&#x60;.** | [optional] 
**alternate_text** | **string** | Alternate text for accessibility purposes.  **Optional - only valid when asset type is &#x60;&#x60;PHOTO&#x60;&#x60;.** | [optional] 
**type** | **string** | Asset type. | 
**id** | **string** | Primary key. Unique alphanumeric (Latin-1) ID assigned by the Yext. | [optional] 
**contents** | [**\Yext\Client\Model\AssetTextContent[]**](AssetTextContent.md) |  | [optional] 
**name** | **string** | Asset name. | 

[[Back to Model list]](../README.md#documentation-for-models) [[Back to API list]](../README.md#documentation-for-api-endpoints) [[Back to README]](../README.md)


