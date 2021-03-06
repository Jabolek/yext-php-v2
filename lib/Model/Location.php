<?php
/**
 * Location
 *
 * PHP version 5
 *
 * @category Class
 * @package  Yext\Client
 * @author   Swaagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Yext API
 *
 * # Policies and Conventions  This section gives you the basic information you need to use our APIs.  ## API Availability  We currently offer three APIs: * **Knowledge API** * **Live API** * **Administrative API**  Each API is designed for a particular set of users.  To determine which APIs are available to users like you, see the \"Overview\" page in the Docs section of this site.  ## Authentication All requests must be authenticated using an app’s API key.  <pre>GET https://api.yext.com/v2/accounts/[accountId]/locations?<b>api_key=API_KEY</b>&v=YYYYMMDD</pre>  The API key should be kept secret.  ## Versioning All requests must be versioned using the **`v`** parameter.  <pre>GET https://api.yext.com/v2/accounts/[accountId]/locations?api_key=API_KEY&<b>v=YYYYMMDD</b></pre>  The **`v`** parameter (a date in `YYYYMMDD` format) is designed to give you the freedom to adapt to Yext API changes on your own schedule. When you pass this parameter, any backward-incompatiable changes we made to the API after the specified date will not affect the behavior of the request or the content of the response. You will still benefit from any bug fixes or backward-compatible changes we may have made after the date you've specified.  **NOTE:** Yext has the ability to make changes that affect previous versions of the API, if necessary.  ## Serialization API v2 only accepts data in JSON format.  ## Content-Type Headers For all requests that include a request body, the `Content-Type` header must be included and set to `application/json`.  ## PUT Requests Generally, all `PUT` operations behave as true RESTful `PUT`s, in which entire objects are overwritten with the provided content.  However, certain endpoints used to work with large, frequently-changing object models may have different semantics to prevent the accidental removal of content (e.g., Locations: Update lets you omit fields you don’t wish to change).  ## Errors and Warnings There are three kinds of issues that can be reported for a given request:  * **`FATAL_ERROR`**     * An issue caused the entire request to be rejected. * **`NON_FATAL_ERROR`**     * An item is rejected, but other items present in the request are accepted (e.g., one invalid Product List item).     * A field is rejected, but the item otherwise is accepted (e.g., invalid website URL in a Location). * **`WARNING`**     * The request did not adhere to our best practices or recommendations, but the data was accepted anyway (e.g., data was sent that may cause some listings to become unavailable, a deprecated API was used, or we changed the format of a field's content to meet our requirements).  **For a complete list of error codes and their meanings, see the \"Error Messages\" page in the Support section of this site.**  ## Validation Modes  API v2 will support two request validation modes: *Strict Mode* and *Lenient Mode*.  In Strict Mode, both `FATAL_ERROR`s and `NON_FATAL_ERROR`s are reported simply as `FATAL_ERROR`s, and any error will cause the entire request to fail.  In Lenient Mode, `FATAL_ERROR`s and `NON_FATAL_ERROR`s are reported as such, and only `FATAL_ERROR`s will cause a request to fail.  All requests will be processed in Strict Mode by default.  To activate Lenient Mode, append the parameter `validation=lenient` to your request URLs.  ### Dates and times * We always use milliseconds since epoch (a.k.a. Unix time) for timestamps (e.g., review creation times, webhook update times). * We always use ISO 8601 without timezone for local date times (e.g., Event start time, Event end time). Event times are always interpreted in the local timezone of their associated locations. * Dates are transmitted as strings: `YYYY-MM-DD`.  ## Account ID In keeping with RESTful design principles, every URL in API v2 has an account ID prefix. This prefix helps to ensure that you have unique URLs for all resources.  In addition to specifying resources by explicit account ID, the following two macros are defined: * **`me`** - refers to the account that owns the API key sent with the request * **`all`** - refers to the account that owns the API key sent with the request, as well as all sub-accounts (recursively)  **IMPORTANT:** The **`me`** macro is supported in all API methods.  The **`all`** macro will only be supported in certain URLs. Currently, it can only be used in Analytics and Reviews endpoints.  ### Examples This URL refers to an analytics report for all locations in account 123. <pre>https://api.yext.com/v2/accounts/<b>123</b>/analytics/reports?api_key=456&v=20160822</pre>  This URL refers to an analytics report for all locations in the account that owns API key 456. <pre>https://api.yext.com/v2/accounts/<b>me</b>/analytics/reports?<b>api_key=456</b>&v=20160822</pre>  This URL refers to an analytics report for all locations in the account that owns API key 456, as well as all locations from any of its child accounts. <pre>https://api.yext.com/v2/accounts/<b>all</b>/analytics/reports?<b>api_key=456</b>&v=20160822</pre>  ## Actor Headers  To attribute changes to a particular user, all `PUT`, `POST`, and `DELETE` requests may be passed with the following headers.  **NOTE:** If you choose to provide actor headers, and we are unable to authenticate the request using the values you provide, the request will result in an error and fail.  * Attribute activity to customer user via username     * Header: `Yext-Username`     * Value: Customer user’s username * Attribute activity to customer user via Yext user ID     * Header: `Yext-User-Id`     * Value: Customer user’s Yext user ID  Changes will be logged as follows:  * App with no designated actor     * History Entry \"Updated By\" Value: `App [App ID] - ‘[App Name]’`     * Example: `App 432 - ‘Hello World App’` * App with customer user actor     * History Entry \"Updated By\" Value: `[user name] ([user email]) (App [App ID] - ‘[App Name]’)`     * Example: `Jordan Smith (jsmith@example.com) (App 432 - ‘Hello World App’)`  ## Response Format * **`meta`**     * Response metadata * **`meta.uuid`**     * Unique ID for this request / response * **`meta.errors[]`**     * List of errors and warnings * **`meta.errors[].code`**     * Code that uniquely identifies the error or warning * **`meta.errors[].type`**     * One of:         * `FATAL_ERROR`         * `NON_FATAL_ERROR`         * `WARNING`     * See \"Errors and Warnings\" above for details. * **`meta.errors[].message`**     * An explanation of the issue * **`response`**     * The main content (body) of the response  Example: <pre><code> {     \"meta\": {         \"uuid\": \"bb0c7e19-4dc3-4891-bfa5-8593b1f124ad\",         \"errors\": [             {                 \"code\": ...error code...,                 \"type\": ...error, fatal error, non fatal error, or warning...,                 \"message\": ...explanation of the issue...             }         ]     },     \"response\": {         ...results...     } } </code></pre>  ## Status Codes * `200 OK`    * Either there are no errors or warnings, or the only issues are of type `WARNING`. * `207 Multi-Status`     * There are errors of type `itemError` or `fieldError` (but none of type `requestError`). * `400 Bad Request`     * A parameter is invalid, or a required parameter is missing. This includes the case where no API key is provided and the case where a resource ID is specified incorrectly in a path.     * This status is if any of the response errors are of type `requestError`. * `401 Unauthorized`     * The API key provided is invalid. * `403 Forbidden`     * The requested information cannot be viewed by the acting user. * `404 Not Found`     * The endpoint does not exist. * `405 Method Not Allowed`     * The request is using a method that is not allowed (e.g., `POST` with a `GET`-only endpoint). * `409 Conflict`     * The request could not be completed in its current state.     * Use the information included in the response to modify the request and retry. * `429 Too Many Requests`     * You have exceeded your rate limit / quota. * `500 Internal Server Error`     * Yext’s servers are not operating as expected. The request is likely valid but should be resent later. * `504 Timeout`     * Yext’s servers took too long to handle this request, and it timed out.  ## Quotas and Rate Limits Default quotas and rate limits are as follows.  * **Knowledge API** *(includes Analytics, PowerListings®, Knowledge Manager, Reviews, Social, and User endpoints)*: 5,000 requests per hour * **Administrative API**: 1,000 requests per hour * **Live API**: 100,000 requests per hour  Hourly quotas are calculated from the beginning of the hour (minute zero, `:00`), not on a rolling basis past 60 minutes.  **NOTE:** Webhook requests do not count towards an account’s quota.  For the most current and accurate rate-limit usage information for a particular request type, check the **`Rate-Limit-Remaining`** and **`Rate-Limit-Limit`** HTTP headers of your API responses.  If you are currently over your limit, our API will return a `429` error, and the response object returned by our API will be empty. We will also include a **`Rate-Limit-Reset`** header in the response, which indicates when you will have additional quota.  ## Client- vs. Yext-assigned IDs You can set the ID for the following objects when you create them. If you do not provide an ID, Yext will generate one for you.  * Account * User * Location * Bio List * Menu * Product List * Event List * Bio List Item * Menu Item * Product List Item * Event List Item  ## Logging All API requests are logged. API logs can be found in your Developer Console and are stored for 90 days.
 *
 * OpenAPI spec version: 2.0
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Yext\Client\Model;

use \ArrayAccess;

/**
 * Location Class Doc Comment
 *
 * @category    Class
 * @package     Yext\Client
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class Location implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'Location';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'string',
        'account_id' => 'string',
        'timestamp' => 'int',
        'location_type' => '\Yext\Client\Model\LocationType',
        'location_name' => 'string',
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'office_name' => 'string',
        'gender' => 'string',
        'npi' => 'string',
        'address' => 'string',
        'address2' => 'string',
        'suppress_address' => 'bool',
        'display_address' => 'string',
        'city' => 'string',
        'state' => 'string',
        'sublocality' => 'string',
        'zip' => 'string',
        'country_code' => 'string',
        'service_area' => '\Yext\Client\Model\LocationServiceArea',
        'phone' => 'string',
        'is_phone_tracked' => 'bool',
        'local_phone' => 'string',
        'alternate_phone' => 'string',
        'fax_phone' => 'string',
        'mobile_phone' => 'string',
        'toll_free_phone' => 'string',
        'tty_phone' => 'string',
        'category_ids' => 'string[]',
        'featured_message' => 'string',
        'featured_message_url' => 'string',
        'website_url' => 'string',
        'display_website_url' => 'string',
        'reservation_url' => 'string',
        'display_reservation_url' => 'string',
        'menu_url' => 'string',
        'display_menu_url' => 'string',
        'order_url' => 'string',
        'display_order_url' => 'string',
        'hours' => 'string',
        'additional_hours_text' => 'string',
        'holiday_hours' => '\Yext\Client\Model\LocationHolidayHours[]',
        'description' => 'string',
        'conditions_treated' => 'string[]',
        'certifications' => 'string[]',
        'education_list' => '\Yext\Client\Model\LocationEducationList[]',
        'degrees' => 'string[]',
        'admitting_hospitals' => 'string[]',
        'accepting_new_patients' => 'bool',
        'closed' => '\Yext\Client\Model\LocationClosed',
        'payment_options' => 'string[]',
        'insurance_accepted' => 'string[]',
        'logo' => '\Yext\Client\Model\LocationPhoto',
        'photos' => '\Yext\Client\Model\LocationPhoto[]',
        'headshot' => 'object',
        'video_urls' => 'string[]',
        'instagram_handle' => 'string',
        'twitter_handle' => 'string',
        'google_website_override' => 'string',
        'google_cover_photo' => 'object',
        'google_profile_photo' => 'object',
        'google_preferred_photo' => 'string',
        'google_attributes' => '\Yext\Client\Model\LocationGoogleAttributes[]',
        'facebook_page_url' => 'string',
        'facebook_cover_photo' => 'object',
        'facebook_profile_picture' => 'object',
        'uber_link_type' => 'string',
        'uber_link_text' => 'string',
        'uber_trip_branding_text' => 'string',
        'uber_trip_branding_url' => 'string',
        'uber_trip_branding_description' => 'string',
        'uber_client_id' => 'string',
        'uber_embed_code' => 'string',
        'uber_link' => 'string',
        'year_established' => 'string',
        'display_lat' => 'double',
        'display_lng' => 'double',
        'routable_lat' => 'double',
        'routable_lng' => 'double',
        'walkable_lat' => 'double',
        'walkable_lng' => 'double',
        'pickup_lat' => 'double',
        'pickup_lng' => 'double',
        'dropoff_lat' => 'double',
        'dropoff_lng' => 'double',
        'yext_display_lat' => 'double',
        'yext_display_lng' => 'double',
        'yext_routable_lat' => 'double',
        'yext_routable_lng' => 'double',
        'yext_walkable_lat' => 'double',
        'yext_walkable_lng' => 'double',
        'yext_pickup_lat' => 'double',
        'yext_pickup_lng' => 'double',
        'yext_dropoff_lat' => 'double',
        'yext_dropoff_lng' => 'double',
        'emails' => 'string[]',
        'specialties' => 'string[]',
        'associations' => 'string[]',
        'products' => 'string[]',
        'services' => 'string[]',
        'brands' => 'string[]',
        'language' => 'string',
        'languages' => 'string[]',
        'keywords' => 'string[]',
        'menus_label' => 'string',
        'menu_ids' => 'string[]',
        'bio_lists_label' => 'string',
        'bio_list_ids' => 'string[]',
        'product_lists_label' => 'string',
        'product_list_ids' => 'string[]',
        'event_lists_label' => 'string',
        'event_list_ids' => 'string[]',
        'folder_id' => 'string',
        'label_ids' => 'string[]',
        'custom_fields' => 'map[string,object]',
        'intelligent_search_tracking_enabled' => 'bool',
        'intelligent_search_tracking_frequency' => 'string',
        'location_keywords' => 'string[]',
        'custom_keywords' => 'string[]',
        'query_templates' => 'string[]',
        'alternate_names' => 'string[]',
        'alternate_websites' => 'string[]',
        'competitors' => '\Yext\Client\Model\LocationCompetitors[]',
        'tracking_sites' => 'string[]'
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'id' => 'id',
        'account_id' => 'accountId',
        'timestamp' => 'timestamp',
        'location_type' => 'locationType',
        'location_name' => 'locationName',
        'first_name' => 'firstName',
        'middle_name' => 'middleName',
        'last_name' => 'lastName',
        'office_name' => 'officeName',
        'gender' => 'gender',
        'npi' => 'npi',
        'address' => 'address',
        'address2' => 'address2',
        'suppress_address' => 'suppressAddress',
        'display_address' => 'displayAddress',
        'city' => 'city',
        'state' => 'state',
        'sublocality' => 'sublocality',
        'zip' => 'zip',
        'country_code' => 'countryCode',
        'service_area' => 'serviceArea',
        'phone' => 'phone',
        'is_phone_tracked' => 'isPhoneTracked',
        'local_phone' => 'localPhone',
        'alternate_phone' => 'alternatePhone',
        'fax_phone' => 'faxPhone',
        'mobile_phone' => 'mobilePhone',
        'toll_free_phone' => 'tollFreePhone',
        'tty_phone' => 'ttyPhone',
        'category_ids' => 'categoryIds',
        'featured_message' => 'featuredMessage',
        'featured_message_url' => 'featuredMessageUrl',
        'website_url' => 'websiteUrl',
        'display_website_url' => 'displayWebsiteUrl',
        'reservation_url' => 'reservationUrl',
        'display_reservation_url' => 'displayReservationUrl',
        'menu_url' => 'menuUrl',
        'display_menu_url' => 'displayMenuUrl',
        'order_url' => 'orderUrl',
        'display_order_url' => 'displayOrderUrl',
        'hours' => 'hours',
        'additional_hours_text' => 'additionalHoursText',
        'holiday_hours' => 'holidayHours',
        'description' => 'description',
        'conditions_treated' => 'conditionsTreated',
        'certifications' => 'certifications',
        'education_list' => 'educationList',
        'degrees' => 'degrees',
        'admitting_hospitals' => 'admittingHospitals',
        'accepting_new_patients' => 'acceptingNewPatients',
        'closed' => 'closed',
        'payment_options' => 'paymentOptions',
        'insurance_accepted' => 'insuranceAccepted',
        'logo' => 'logo',
        'photos' => 'photos',
        'headshot' => 'headshot',
        'video_urls' => 'videoUrls',
        'instagram_handle' => 'instagramHandle',
        'twitter_handle' => 'twitterHandle',
        'google_website_override' => 'googleWebsiteOverride',
        'google_cover_photo' => 'googleCoverPhoto',
        'google_profile_photo' => 'googleProfilePhoto',
        'google_preferred_photo' => 'googlePreferredPhoto',
        'google_attributes' => 'googleAttributes',
        'facebook_page_url' => 'facebookPageUrl',
        'facebook_cover_photo' => 'facebookCoverPhoto',
        'facebook_profile_picture' => 'facebookProfilePicture',
        'uber_link_type' => 'uberLinkType',
        'uber_link_text' => 'uberLinkText',
        'uber_trip_branding_text' => 'uberTripBrandingText',
        'uber_trip_branding_url' => 'uberTripBrandingUrl',
        'uber_trip_branding_description' => 'uberTripBrandingDescription',
        'uber_client_id' => 'uberClientId',
        'uber_embed_code' => 'uberEmbedCode',
        'uber_link' => 'uberLink',
        'year_established' => 'yearEstablished',
        'display_lat' => 'displayLat',
        'display_lng' => 'displayLng',
        'routable_lat' => 'routableLat',
        'routable_lng' => 'routableLng',
        'walkable_lat' => 'walkableLat',
        'walkable_lng' => 'walkableLng',
        'pickup_lat' => 'pickupLat',
        'pickup_lng' => 'pickupLng',
        'dropoff_lat' => 'dropoffLat',
        'dropoff_lng' => 'dropoffLng',
        'yext_display_lat' => 'yextDisplayLat',
        'yext_display_lng' => 'yextDisplayLng',
        'yext_routable_lat' => 'yextRoutableLat',
        'yext_routable_lng' => 'yextRoutableLng',
        'yext_walkable_lat' => 'yextWalkableLat',
        'yext_walkable_lng' => 'yextWalkableLng',
        'yext_pickup_lat' => 'yextPickupLat',
        'yext_pickup_lng' => 'yextPickupLng',
        'yext_dropoff_lat' => 'yextDropoffLat',
        'yext_dropoff_lng' => 'yextDropoffLng',
        'emails' => 'emails',
        'specialties' => 'specialties',
        'associations' => 'associations',
        'products' => 'products',
        'services' => 'services',
        'brands' => 'brands',
        'language' => 'language',
        'languages' => 'languages',
        'keywords' => 'keywords',
        'menus_label' => 'menusLabel',
        'menu_ids' => 'menuIds',
        'bio_lists_label' => 'bioListsLabel',
        'bio_list_ids' => 'bioListIds',
        'product_lists_label' => 'productListsLabel',
        'product_list_ids' => 'productListIds',
        'event_lists_label' => 'eventListsLabel',
        'event_list_ids' => 'eventListIds',
        'folder_id' => 'folderId',
        'label_ids' => 'labelIds',
        'custom_fields' => 'customFields',
        'intelligent_search_tracking_enabled' => 'intelligentSearchTrackingEnabled',
        'intelligent_search_tracking_frequency' => 'intelligentSearchTrackingFrequency',
        'location_keywords' => 'locationKeywords',
        'custom_keywords' => 'customKeywords',
        'query_templates' => 'queryTemplates',
        'alternate_names' => 'alternateNames',
        'alternate_websites' => 'alternateWebsites',
        'competitors' => 'competitors',
        'tracking_sites' => 'trackingSites'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
        'account_id' => 'setAccountId',
        'timestamp' => 'setTimestamp',
        'location_type' => 'setLocationType',
        'location_name' => 'setLocationName',
        'first_name' => 'setFirstName',
        'middle_name' => 'setMiddleName',
        'last_name' => 'setLastName',
        'office_name' => 'setOfficeName',
        'gender' => 'setGender',
        'npi' => 'setNpi',
        'address' => 'setAddress',
        'address2' => 'setAddress2',
        'suppress_address' => 'setSuppressAddress',
        'display_address' => 'setDisplayAddress',
        'city' => 'setCity',
        'state' => 'setState',
        'sublocality' => 'setSublocality',
        'zip' => 'setZip',
        'country_code' => 'setCountryCode',
        'service_area' => 'setServiceArea',
        'phone' => 'setPhone',
        'is_phone_tracked' => 'setIsPhoneTracked',
        'local_phone' => 'setLocalPhone',
        'alternate_phone' => 'setAlternatePhone',
        'fax_phone' => 'setFaxPhone',
        'mobile_phone' => 'setMobilePhone',
        'toll_free_phone' => 'setTollFreePhone',
        'tty_phone' => 'setTtyPhone',
        'category_ids' => 'setCategoryIds',
        'featured_message' => 'setFeaturedMessage',
        'featured_message_url' => 'setFeaturedMessageUrl',
        'website_url' => 'setWebsiteUrl',
        'display_website_url' => 'setDisplayWebsiteUrl',
        'reservation_url' => 'setReservationUrl',
        'display_reservation_url' => 'setDisplayReservationUrl',
        'menu_url' => 'setMenuUrl',
        'display_menu_url' => 'setDisplayMenuUrl',
        'order_url' => 'setOrderUrl',
        'display_order_url' => 'setDisplayOrderUrl',
        'hours' => 'setHours',
        'additional_hours_text' => 'setAdditionalHoursText',
        'holiday_hours' => 'setHolidayHours',
        'description' => 'setDescription',
        'conditions_treated' => 'setConditionsTreated',
        'certifications' => 'setCertifications',
        'education_list' => 'setEducationList',
        'degrees' => 'setDegrees',
        'admitting_hospitals' => 'setAdmittingHospitals',
        'accepting_new_patients' => 'setAcceptingNewPatients',
        'closed' => 'setClosed',
        'payment_options' => 'setPaymentOptions',
        'insurance_accepted' => 'setInsuranceAccepted',
        'logo' => 'setLogo',
        'photos' => 'setPhotos',
        'headshot' => 'setHeadshot',
        'video_urls' => 'setVideoUrls',
        'instagram_handle' => 'setInstagramHandle',
        'twitter_handle' => 'setTwitterHandle',
        'google_website_override' => 'setGoogleWebsiteOverride',
        'google_cover_photo' => 'setGoogleCoverPhoto',
        'google_profile_photo' => 'setGoogleProfilePhoto',
        'google_preferred_photo' => 'setGooglePreferredPhoto',
        'google_attributes' => 'setGoogleAttributes',
        'facebook_page_url' => 'setFacebookPageUrl',
        'facebook_cover_photo' => 'setFacebookCoverPhoto',
        'facebook_profile_picture' => 'setFacebookProfilePicture',
        'uber_link_type' => 'setUberLinkType',
        'uber_link_text' => 'setUberLinkText',
        'uber_trip_branding_text' => 'setUberTripBrandingText',
        'uber_trip_branding_url' => 'setUberTripBrandingUrl',
        'uber_trip_branding_description' => 'setUberTripBrandingDescription',
        'uber_client_id' => 'setUberClientId',
        'uber_embed_code' => 'setUberEmbedCode',
        'uber_link' => 'setUberLink',
        'year_established' => 'setYearEstablished',
        'display_lat' => 'setDisplayLat',
        'display_lng' => 'setDisplayLng',
        'routable_lat' => 'setRoutableLat',
        'routable_lng' => 'setRoutableLng',
        'walkable_lat' => 'setWalkableLat',
        'walkable_lng' => 'setWalkableLng',
        'pickup_lat' => 'setPickupLat',
        'pickup_lng' => 'setPickupLng',
        'dropoff_lat' => 'setDropoffLat',
        'dropoff_lng' => 'setDropoffLng',
        'yext_display_lat' => 'setYextDisplayLat',
        'yext_display_lng' => 'setYextDisplayLng',
        'yext_routable_lat' => 'setYextRoutableLat',
        'yext_routable_lng' => 'setYextRoutableLng',
        'yext_walkable_lat' => 'setYextWalkableLat',
        'yext_walkable_lng' => 'setYextWalkableLng',
        'yext_pickup_lat' => 'setYextPickupLat',
        'yext_pickup_lng' => 'setYextPickupLng',
        'yext_dropoff_lat' => 'setYextDropoffLat',
        'yext_dropoff_lng' => 'setYextDropoffLng',
        'emails' => 'setEmails',
        'specialties' => 'setSpecialties',
        'associations' => 'setAssociations',
        'products' => 'setProducts',
        'services' => 'setServices',
        'brands' => 'setBrands',
        'language' => 'setLanguage',
        'languages' => 'setLanguages',
        'keywords' => 'setKeywords',
        'menus_label' => 'setMenusLabel',
        'menu_ids' => 'setMenuIds',
        'bio_lists_label' => 'setBioListsLabel',
        'bio_list_ids' => 'setBioListIds',
        'product_lists_label' => 'setProductListsLabel',
        'product_list_ids' => 'setProductListIds',
        'event_lists_label' => 'setEventListsLabel',
        'event_list_ids' => 'setEventListIds',
        'folder_id' => 'setFolderId',
        'label_ids' => 'setLabelIds',
        'custom_fields' => 'setCustomFields',
        'intelligent_search_tracking_enabled' => 'setIntelligentSearchTrackingEnabled',
        'intelligent_search_tracking_frequency' => 'setIntelligentSearchTrackingFrequency',
        'location_keywords' => 'setLocationKeywords',
        'custom_keywords' => 'setCustomKeywords',
        'query_templates' => 'setQueryTemplates',
        'alternate_names' => 'setAlternateNames',
        'alternate_websites' => 'setAlternateWebsites',
        'competitors' => 'setCompetitors',
        'tracking_sites' => 'setTrackingSites'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
        'account_id' => 'getAccountId',
        'timestamp' => 'getTimestamp',
        'location_type' => 'getLocationType',
        'location_name' => 'getLocationName',
        'first_name' => 'getFirstName',
        'middle_name' => 'getMiddleName',
        'last_name' => 'getLastName',
        'office_name' => 'getOfficeName',
        'gender' => 'getGender',
        'npi' => 'getNpi',
        'address' => 'getAddress',
        'address2' => 'getAddress2',
        'suppress_address' => 'getSuppressAddress',
        'display_address' => 'getDisplayAddress',
        'city' => 'getCity',
        'state' => 'getState',
        'sublocality' => 'getSublocality',
        'zip' => 'getZip',
        'country_code' => 'getCountryCode',
        'service_area' => 'getServiceArea',
        'phone' => 'getPhone',
        'is_phone_tracked' => 'getIsPhoneTracked',
        'local_phone' => 'getLocalPhone',
        'alternate_phone' => 'getAlternatePhone',
        'fax_phone' => 'getFaxPhone',
        'mobile_phone' => 'getMobilePhone',
        'toll_free_phone' => 'getTollFreePhone',
        'tty_phone' => 'getTtyPhone',
        'category_ids' => 'getCategoryIds',
        'featured_message' => 'getFeaturedMessage',
        'featured_message_url' => 'getFeaturedMessageUrl',
        'website_url' => 'getWebsiteUrl',
        'display_website_url' => 'getDisplayWebsiteUrl',
        'reservation_url' => 'getReservationUrl',
        'display_reservation_url' => 'getDisplayReservationUrl',
        'menu_url' => 'getMenuUrl',
        'display_menu_url' => 'getDisplayMenuUrl',
        'order_url' => 'getOrderUrl',
        'display_order_url' => 'getDisplayOrderUrl',
        'hours' => 'getHours',
        'additional_hours_text' => 'getAdditionalHoursText',
        'holiday_hours' => 'getHolidayHours',
        'description' => 'getDescription',
        'conditions_treated' => 'getConditionsTreated',
        'certifications' => 'getCertifications',
        'education_list' => 'getEducationList',
        'degrees' => 'getDegrees',
        'admitting_hospitals' => 'getAdmittingHospitals',
        'accepting_new_patients' => 'getAcceptingNewPatients',
        'closed' => 'getClosed',
        'payment_options' => 'getPaymentOptions',
        'insurance_accepted' => 'getInsuranceAccepted',
        'logo' => 'getLogo',
        'photos' => 'getPhotos',
        'headshot' => 'getHeadshot',
        'video_urls' => 'getVideoUrls',
        'instagram_handle' => 'getInstagramHandle',
        'twitter_handle' => 'getTwitterHandle',
        'google_website_override' => 'getGoogleWebsiteOverride',
        'google_cover_photo' => 'getGoogleCoverPhoto',
        'google_profile_photo' => 'getGoogleProfilePhoto',
        'google_preferred_photo' => 'getGooglePreferredPhoto',
        'google_attributes' => 'getGoogleAttributes',
        'facebook_page_url' => 'getFacebookPageUrl',
        'facebook_cover_photo' => 'getFacebookCoverPhoto',
        'facebook_profile_picture' => 'getFacebookProfilePicture',
        'uber_link_type' => 'getUberLinkType',
        'uber_link_text' => 'getUberLinkText',
        'uber_trip_branding_text' => 'getUberTripBrandingText',
        'uber_trip_branding_url' => 'getUberTripBrandingUrl',
        'uber_trip_branding_description' => 'getUberTripBrandingDescription',
        'uber_client_id' => 'getUberClientId',
        'uber_embed_code' => 'getUberEmbedCode',
        'uber_link' => 'getUberLink',
        'year_established' => 'getYearEstablished',
        'display_lat' => 'getDisplayLat',
        'display_lng' => 'getDisplayLng',
        'routable_lat' => 'getRoutableLat',
        'routable_lng' => 'getRoutableLng',
        'walkable_lat' => 'getWalkableLat',
        'walkable_lng' => 'getWalkableLng',
        'pickup_lat' => 'getPickupLat',
        'pickup_lng' => 'getPickupLng',
        'dropoff_lat' => 'getDropoffLat',
        'dropoff_lng' => 'getDropoffLng',
        'yext_display_lat' => 'getYextDisplayLat',
        'yext_display_lng' => 'getYextDisplayLng',
        'yext_routable_lat' => 'getYextRoutableLat',
        'yext_routable_lng' => 'getYextRoutableLng',
        'yext_walkable_lat' => 'getYextWalkableLat',
        'yext_walkable_lng' => 'getYextWalkableLng',
        'yext_pickup_lat' => 'getYextPickupLat',
        'yext_pickup_lng' => 'getYextPickupLng',
        'yext_dropoff_lat' => 'getYextDropoffLat',
        'yext_dropoff_lng' => 'getYextDropoffLng',
        'emails' => 'getEmails',
        'specialties' => 'getSpecialties',
        'associations' => 'getAssociations',
        'products' => 'getProducts',
        'services' => 'getServices',
        'brands' => 'getBrands',
        'language' => 'getLanguage',
        'languages' => 'getLanguages',
        'keywords' => 'getKeywords',
        'menus_label' => 'getMenusLabel',
        'menu_ids' => 'getMenuIds',
        'bio_lists_label' => 'getBioListsLabel',
        'bio_list_ids' => 'getBioListIds',
        'product_lists_label' => 'getProductListsLabel',
        'product_list_ids' => 'getProductListIds',
        'event_lists_label' => 'getEventListsLabel',
        'event_list_ids' => 'getEventListIds',
        'folder_id' => 'getFolderId',
        'label_ids' => 'getLabelIds',
        'custom_fields' => 'getCustomFields',
        'intelligent_search_tracking_enabled' => 'getIntelligentSearchTrackingEnabled',
        'intelligent_search_tracking_frequency' => 'getIntelligentSearchTrackingFrequency',
        'location_keywords' => 'getLocationKeywords',
        'custom_keywords' => 'getCustomKeywords',
        'query_templates' => 'getQueryTemplates',
        'alternate_names' => 'getAlternateNames',
        'alternate_websites' => 'getAlternateWebsites',
        'competitors' => 'getCompetitors',
        'tracking_sites' => 'getTrackingSites'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    const GENDER_FEMALE = 'FEMALE';
    const GENDER_F = 'F';
    const GENDER_MALE = 'MALE';
    const GENDER_M = 'M';
    const GENDER_UNSPECIFIED = 'UNSPECIFIED';
    const UBER_LINK_TYPE_LINK = 'LINK';
    const UBER_LINK_TYPE_BUTTON = 'BUTTON';
    const INTELLIGENT_SEARCH_TRACKING_FREQUENCY_WEEKLY = 'WEEKLY';
    const INTELLIGENT_SEARCH_TRACKING_FREQUENCY_MONTHLY = 'MONTHLY';
    const INTELLIGENT_SEARCH_TRACKING_FREQUENCY_QUARTERLY = 'QUARTERLY';
    const LOCATION_KEYWORDS_NAME = 'NAME';
    const LOCATION_KEYWORDS_PRIMARY_CATEGORY = 'PRIMARY_CATEGORY';
    const QUERY_TEMPLATES_KEYWORD = 'KEYWORD';
    const QUERY_TEMPLATES_KEYWORD_ZIP = 'KEYWORD_ZIP';
    const QUERY_TEMPLATES_KEYWORD_CITY = 'KEYWORD_CITY';
    const QUERY_TEMPLATES_KEYWORD_IN_CITY = 'KEYWORD_IN_CITY';
    const QUERY_TEMPLATES_KEYWORD_NEAR_ME = 'KEYWORD_NEAR_ME';
    const QUERY_TEMPLATES_KEYWORD_CITY_STATE = 'KEYWORD_CITY_STATE';
    const TRACKING_SITES_GOOGLE_DESKTOP = 'GOOGLE_DESKTOP';
    const TRACKING_SITES_GOOGLE_MOBILE = 'GOOGLE_MOBILE';
    const TRACKING_SITES_BING_DESKTOP = 'BING_DESKTOP';
    const TRACKING_SITES_YAHOO_DESKTOP = 'YAHOO_DESKTOP';
    

    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getGenderAllowableValues()
    {
        return [
            self::GENDER_FEMALE,
            self::GENDER_F,
            self::GENDER_MALE,
            self::GENDER_M,
            self::GENDER_UNSPECIFIED,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getUberLinkTypeAllowableValues()
    {
        return [
            self::UBER_LINK_TYPE_LINK,
            self::UBER_LINK_TYPE_BUTTON,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getIntelligentSearchTrackingFrequencyAllowableValues()
    {
        return [
            self::INTELLIGENT_SEARCH_TRACKING_FREQUENCY_WEEKLY,
            self::INTELLIGENT_SEARCH_TRACKING_FREQUENCY_MONTHLY,
            self::INTELLIGENT_SEARCH_TRACKING_FREQUENCY_QUARTERLY,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getLocationKeywordsAllowableValues()
    {
        return [
            self::LOCATION_KEYWORDS_NAME,
            self::LOCATION_KEYWORDS_PRIMARY_CATEGORY,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getQueryTemplatesAllowableValues()
    {
        return [
            self::QUERY_TEMPLATES_KEYWORD,
            self::QUERY_TEMPLATES_KEYWORD_ZIP,
            self::QUERY_TEMPLATES_KEYWORD_CITY,
            self::QUERY_TEMPLATES_KEYWORD_IN_CITY,
            self::QUERY_TEMPLATES_KEYWORD_NEAR_ME,
            self::QUERY_TEMPLATES_KEYWORD_CITY_STATE,
        ];
    }
    
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public function getTrackingSitesAllowableValues()
    {
        return [
            self::TRACKING_SITES_GOOGLE_DESKTOP,
            self::TRACKING_SITES_GOOGLE_MOBILE,
            self::TRACKING_SITES_BING_DESKTOP,
            self::TRACKING_SITES_YAHOO_DESKTOP,
        ];
    }
    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['account_id'] = isset($data['account_id']) ? $data['account_id'] : null;
        $this->container['timestamp'] = isset($data['timestamp']) ? $data['timestamp'] : null;
        $this->container['location_type'] = isset($data['location_type']) ? $data['location_type'] : null;
        $this->container['location_name'] = isset($data['location_name']) ? $data['location_name'] : null;
        $this->container['first_name'] = isset($data['first_name']) ? $data['first_name'] : null;
        $this->container['middle_name'] = isset($data['middle_name']) ? $data['middle_name'] : null;
        $this->container['last_name'] = isset($data['last_name']) ? $data['last_name'] : null;
        $this->container['office_name'] = isset($data['office_name']) ? $data['office_name'] : null;
        $this->container['gender'] = isset($data['gender']) ? $data['gender'] : null;
        $this->container['npi'] = isset($data['npi']) ? $data['npi'] : null;
        $this->container['address'] = isset($data['address']) ? $data['address'] : null;
        $this->container['address2'] = isset($data['address2']) ? $data['address2'] : null;
        $this->container['suppress_address'] = isset($data['suppress_address']) ? $data['suppress_address'] : null;
        $this->container['display_address'] = isset($data['display_address']) ? $data['display_address'] : null;
        $this->container['city'] = isset($data['city']) ? $data['city'] : null;
        $this->container['state'] = isset($data['state']) ? $data['state'] : null;
        $this->container['sublocality'] = isset($data['sublocality']) ? $data['sublocality'] : null;
        $this->container['zip'] = isset($data['zip']) ? $data['zip'] : null;
        $this->container['country_code'] = isset($data['country_code']) ? $data['country_code'] : null;
        $this->container['service_area'] = isset($data['service_area']) ? $data['service_area'] : null;
        $this->container['phone'] = isset($data['phone']) ? $data['phone'] : null;
        $this->container['is_phone_tracked'] = isset($data['is_phone_tracked']) ? $data['is_phone_tracked'] : null;
        $this->container['local_phone'] = isset($data['local_phone']) ? $data['local_phone'] : null;
        $this->container['alternate_phone'] = isset($data['alternate_phone']) ? $data['alternate_phone'] : null;
        $this->container['fax_phone'] = isset($data['fax_phone']) ? $data['fax_phone'] : null;
        $this->container['mobile_phone'] = isset($data['mobile_phone']) ? $data['mobile_phone'] : null;
        $this->container['toll_free_phone'] = isset($data['toll_free_phone']) ? $data['toll_free_phone'] : null;
        $this->container['tty_phone'] = isset($data['tty_phone']) ? $data['tty_phone'] : null;
        $this->container['category_ids'] = isset($data['category_ids']) ? $data['category_ids'] : null;
        $this->container['featured_message'] = isset($data['featured_message']) ? $data['featured_message'] : null;
        $this->container['featured_message_url'] = isset($data['featured_message_url']) ? $data['featured_message_url'] : null;
        $this->container['website_url'] = isset($data['website_url']) ? $data['website_url'] : null;
        $this->container['display_website_url'] = isset($data['display_website_url']) ? $data['display_website_url'] : null;
        $this->container['reservation_url'] = isset($data['reservation_url']) ? $data['reservation_url'] : null;
        $this->container['display_reservation_url'] = isset($data['display_reservation_url']) ? $data['display_reservation_url'] : null;
        $this->container['menu_url'] = isset($data['menu_url']) ? $data['menu_url'] : null;
        $this->container['display_menu_url'] = isset($data['display_menu_url']) ? $data['display_menu_url'] : null;
        $this->container['order_url'] = isset($data['order_url']) ? $data['order_url'] : null;
        $this->container['display_order_url'] = isset($data['display_order_url']) ? $data['display_order_url'] : null;
        $this->container['hours'] = isset($data['hours']) ? $data['hours'] : null;
        $this->container['additional_hours_text'] = isset($data['additional_hours_text']) ? $data['additional_hours_text'] : null;
        $this->container['holiday_hours'] = isset($data['holiday_hours']) ? $data['holiday_hours'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['conditions_treated'] = isset($data['conditions_treated']) ? $data['conditions_treated'] : null;
        $this->container['certifications'] = isset($data['certifications']) ? $data['certifications'] : null;
        $this->container['education_list'] = isset($data['education_list']) ? $data['education_list'] : null;
        $this->container['degrees'] = isset($data['degrees']) ? $data['degrees'] : null;
        $this->container['admitting_hospitals'] = isset($data['admitting_hospitals']) ? $data['admitting_hospitals'] : null;
        $this->container['accepting_new_patients'] = isset($data['accepting_new_patients']) ? $data['accepting_new_patients'] : null;
        $this->container['closed'] = isset($data['closed']) ? $data['closed'] : null;
        $this->container['payment_options'] = isset($data['payment_options']) ? $data['payment_options'] : null;
        $this->container['insurance_accepted'] = isset($data['insurance_accepted']) ? $data['insurance_accepted'] : null;
        $this->container['logo'] = isset($data['logo']) ? $data['logo'] : null;
        $this->container['photos'] = isset($data['photos']) ? $data['photos'] : null;
        $this->container['headshot'] = isset($data['headshot']) ? $data['headshot'] : null;
        $this->container['video_urls'] = isset($data['video_urls']) ? $data['video_urls'] : null;
        $this->container['instagram_handle'] = isset($data['instagram_handle']) ? $data['instagram_handle'] : null;
        $this->container['twitter_handle'] = isset($data['twitter_handle']) ? $data['twitter_handle'] : null;
        $this->container['google_website_override'] = isset($data['google_website_override']) ? $data['google_website_override'] : null;
        $this->container['google_cover_photo'] = isset($data['google_cover_photo']) ? $data['google_cover_photo'] : null;
        $this->container['google_profile_photo'] = isset($data['google_profile_photo']) ? $data['google_profile_photo'] : null;
        $this->container['google_preferred_photo'] = isset($data['google_preferred_photo']) ? $data['google_preferred_photo'] : null;
        $this->container['google_attributes'] = isset($data['google_attributes']) ? $data['google_attributes'] : null;
        $this->container['facebook_page_url'] = isset($data['facebook_page_url']) ? $data['facebook_page_url'] : null;
        $this->container['facebook_cover_photo'] = isset($data['facebook_cover_photo']) ? $data['facebook_cover_photo'] : null;
        $this->container['facebook_profile_picture'] = isset($data['facebook_profile_picture']) ? $data['facebook_profile_picture'] : null;
        $this->container['uber_link_type'] = isset($data['uber_link_type']) ? $data['uber_link_type'] : null;
        $this->container['uber_link_text'] = isset($data['uber_link_text']) ? $data['uber_link_text'] : null;
        $this->container['uber_trip_branding_text'] = isset($data['uber_trip_branding_text']) ? $data['uber_trip_branding_text'] : null;
        $this->container['uber_trip_branding_url'] = isset($data['uber_trip_branding_url']) ? $data['uber_trip_branding_url'] : null;
        $this->container['uber_trip_branding_description'] = isset($data['uber_trip_branding_description']) ? $data['uber_trip_branding_description'] : null;
        $this->container['uber_client_id'] = isset($data['uber_client_id']) ? $data['uber_client_id'] : null;
        $this->container['uber_embed_code'] = isset($data['uber_embed_code']) ? $data['uber_embed_code'] : null;
        $this->container['uber_link'] = isset($data['uber_link']) ? $data['uber_link'] : null;
        $this->container['year_established'] = isset($data['year_established']) ? $data['year_established'] : null;
        $this->container['display_lat'] = isset($data['display_lat']) ? $data['display_lat'] : null;
        $this->container['display_lng'] = isset($data['display_lng']) ? $data['display_lng'] : null;
        $this->container['routable_lat'] = isset($data['routable_lat']) ? $data['routable_lat'] : null;
        $this->container['routable_lng'] = isset($data['routable_lng']) ? $data['routable_lng'] : null;
        $this->container['walkable_lat'] = isset($data['walkable_lat']) ? $data['walkable_lat'] : null;
        $this->container['walkable_lng'] = isset($data['walkable_lng']) ? $data['walkable_lng'] : null;
        $this->container['pickup_lat'] = isset($data['pickup_lat']) ? $data['pickup_lat'] : null;
        $this->container['pickup_lng'] = isset($data['pickup_lng']) ? $data['pickup_lng'] : null;
        $this->container['dropoff_lat'] = isset($data['dropoff_lat']) ? $data['dropoff_lat'] : null;
        $this->container['dropoff_lng'] = isset($data['dropoff_lng']) ? $data['dropoff_lng'] : null;
        $this->container['yext_display_lat'] = isset($data['yext_display_lat']) ? $data['yext_display_lat'] : null;
        $this->container['yext_display_lng'] = isset($data['yext_display_lng']) ? $data['yext_display_lng'] : null;
        $this->container['yext_routable_lat'] = isset($data['yext_routable_lat']) ? $data['yext_routable_lat'] : null;
        $this->container['yext_routable_lng'] = isset($data['yext_routable_lng']) ? $data['yext_routable_lng'] : null;
        $this->container['yext_walkable_lat'] = isset($data['yext_walkable_lat']) ? $data['yext_walkable_lat'] : null;
        $this->container['yext_walkable_lng'] = isset($data['yext_walkable_lng']) ? $data['yext_walkable_lng'] : null;
        $this->container['yext_pickup_lat'] = isset($data['yext_pickup_lat']) ? $data['yext_pickup_lat'] : null;
        $this->container['yext_pickup_lng'] = isset($data['yext_pickup_lng']) ? $data['yext_pickup_lng'] : null;
        $this->container['yext_dropoff_lat'] = isset($data['yext_dropoff_lat']) ? $data['yext_dropoff_lat'] : null;
        $this->container['yext_dropoff_lng'] = isset($data['yext_dropoff_lng']) ? $data['yext_dropoff_lng'] : null;
        $this->container['emails'] = isset($data['emails']) ? $data['emails'] : null;
        $this->container['specialties'] = isset($data['specialties']) ? $data['specialties'] : null;
        $this->container['associations'] = isset($data['associations']) ? $data['associations'] : null;
        $this->container['products'] = isset($data['products']) ? $data['products'] : null;
        $this->container['services'] = isset($data['services']) ? $data['services'] : null;
        $this->container['brands'] = isset($data['brands']) ? $data['brands'] : null;
        $this->container['language'] = isset($data['language']) ? $data['language'] : null;
        $this->container['languages'] = isset($data['languages']) ? $data['languages'] : null;
        $this->container['keywords'] = isset($data['keywords']) ? $data['keywords'] : null;
        $this->container['menus_label'] = isset($data['menus_label']) ? $data['menus_label'] : null;
        $this->container['menu_ids'] = isset($data['menu_ids']) ? $data['menu_ids'] : null;
        $this->container['bio_lists_label'] = isset($data['bio_lists_label']) ? $data['bio_lists_label'] : null;
        $this->container['bio_list_ids'] = isset($data['bio_list_ids']) ? $data['bio_list_ids'] : null;
        $this->container['product_lists_label'] = isset($data['product_lists_label']) ? $data['product_lists_label'] : null;
        $this->container['product_list_ids'] = isset($data['product_list_ids']) ? $data['product_list_ids'] : null;
        $this->container['event_lists_label'] = isset($data['event_lists_label']) ? $data['event_lists_label'] : null;
        $this->container['event_list_ids'] = isset($data['event_list_ids']) ? $data['event_list_ids'] : null;
        $this->container['folder_id'] = isset($data['folder_id']) ? $data['folder_id'] : null;
        $this->container['label_ids'] = isset($data['label_ids']) ? $data['label_ids'] : null;
        $this->container['custom_fields'] = isset($data['custom_fields']) ? $data['custom_fields'] : null;
        $this->container['intelligent_search_tracking_enabled'] = isset($data['intelligent_search_tracking_enabled']) ? $data['intelligent_search_tracking_enabled'] : null;
        $this->container['intelligent_search_tracking_frequency'] = isset($data['intelligent_search_tracking_frequency']) ? $data['intelligent_search_tracking_frequency'] : null;
        $this->container['location_keywords'] = isset($data['location_keywords']) ? $data['location_keywords'] : null;
        $this->container['custom_keywords'] = isset($data['custom_keywords']) ? $data['custom_keywords'] : null;
        $this->container['query_templates'] = isset($data['query_templates']) ? $data['query_templates'] : null;
        $this->container['alternate_names'] = isset($data['alternate_names']) ? $data['alternate_names'] : null;
        $this->container['alternate_websites'] = isset($data['alternate_websites']) ? $data['alternate_websites'] : null;
        $this->container['competitors'] = isset($data['competitors']) ? $data['competitors'] : null;
        $this->container['tracking_sites'] = isset($data['tracking_sites']) ? $data['tracking_sites'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        if (!is_null($this->container['id']) && (strlen($this->container['id']) > 50)) {
            $invalid_properties[] = "invalid value for 'id', the character length must be smaller than or equal to 50.";
        }

        if (!is_null($this->container['account_id']) && (strlen($this->container['account_id']) > 50)) {
            $invalid_properties[] = "invalid value for 'account_id', the character length must be smaller than or equal to 50.";
        }

        if (!is_null($this->container['location_name']) && (strlen($this->container['location_name']) > 100)) {
            $invalid_properties[] = "invalid value for 'location_name', the character length must be smaller than or equal to 100.";
        }

        $allowed_values = ["FEMALE", "F", "MALE", "M", "UNSPECIFIED"];
        if (!in_array($this->container['gender'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'gender', must be one of 'FEMALE', 'F', 'MALE', 'M', 'UNSPECIFIED'.";
        }

        if (!is_null($this->container['address']) && (strlen($this->container['address']) > 255)) {
            $invalid_properties[] = "invalid value for 'address', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['address2']) && (strlen($this->container['address2']) > 255)) {
            $invalid_properties[] = "invalid value for 'address2', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['display_address']) && (strlen($this->container['display_address']) > 255)) {
            $invalid_properties[] = "invalid value for 'display_address', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['city']) && (strlen($this->container['city']) > 80)) {
            $invalid_properties[] = "invalid value for 'city', the character length must be smaller than or equal to 80.";
        }

        if (!is_null($this->container['state']) && (strlen($this->container['state']) > 80)) {
            $invalid_properties[] = "invalid value for 'state', the character length must be smaller than or equal to 80.";
        }

        if (!is_null($this->container['sublocality']) && (strlen($this->container['sublocality']) > 255)) {
            $invalid_properties[] = "invalid value for 'sublocality', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['zip']) && (strlen($this->container['zip']) > 10)) {
            $invalid_properties[] = "invalid value for 'zip', the character length must be smaller than or equal to 10.";
        }

        if (!is_null($this->container['country_code']) && (strlen($this->container['country_code']) > 2)) {
            $invalid_properties[] = "invalid value for 'country_code', the character length must be smaller than or equal to 2.";
        }

        if (!is_null($this->container['featured_message']) && (strlen($this->container['featured_message']) > 50)) {
            $invalid_properties[] = "invalid value for 'featured_message', the character length must be smaller than or equal to 50.";
        }

        if (!is_null($this->container['featured_message_url']) && (strlen($this->container['featured_message_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'featured_message_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['website_url']) && (strlen($this->container['website_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'website_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['display_website_url']) && (strlen($this->container['display_website_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'display_website_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['reservation_url']) && (strlen($this->container['reservation_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'reservation_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['display_reservation_url']) && (strlen($this->container['display_reservation_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'display_reservation_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['menu_url']) && (strlen($this->container['menu_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'menu_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['display_menu_url']) && (strlen($this->container['display_menu_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'display_menu_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['order_url']) && (strlen($this->container['order_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'order_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['display_order_url']) && (strlen($this->container['display_order_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'display_order_url', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['hours']) && (strlen($this->container['hours']) > 255)) {
            $invalid_properties[] = "invalid value for 'hours', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['additional_hours_text']) && (strlen($this->container['additional_hours_text']) > 255)) {
            $invalid_properties[] = "invalid value for 'additional_hours_text', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['description']) && (strlen($this->container['description']) > 5000)) {
            $invalid_properties[] = "invalid value for 'description', the character length must be smaller than or equal to 5000.";
        }

        if (!is_null($this->container['twitter_handle']) && (strlen($this->container['twitter_handle']) > 15)) {
            $invalid_properties[] = "invalid value for 'twitter_handle', the character length must be smaller than or equal to 15.";
        }

        if (!is_null($this->container['google_website_override']) && (strlen($this->container['google_website_override']) > 255)) {
            $invalid_properties[] = "invalid value for 'google_website_override', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['facebook_page_url']) && (strlen($this->container['facebook_page_url']) > 255)) {
            $invalid_properties[] = "invalid value for 'facebook_page_url', the character length must be smaller than or equal to 255.";
        }

        $allowed_values = ["LINK", "BUTTON"];
        if (!in_array($this->container['uber_link_type'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'uber_link_type', must be one of 'LINK', 'BUTTON'.";
        }

        if (!is_null($this->container['uber_link_text']) && (strlen($this->container['uber_link_text']) > 100)) {
            $invalid_properties[] = "invalid value for 'uber_link_text', the character length must be smaller than or equal to 100.";
        }

        if (!is_null($this->container['uber_trip_branding_text']) && (strlen($this->container['uber_trip_branding_text']) > 28)) {
            $invalid_properties[] = "invalid value for 'uber_trip_branding_text', the character length must be smaller than or equal to 28.";
        }

        if (!is_null($this->container['uber_trip_branding_description']) && (strlen($this->container['uber_trip_branding_description']) > 150)) {
            $invalid_properties[] = "invalid value for 'uber_trip_branding_description', the character length must be smaller than or equal to 150.";
        }

        if (!is_null($this->container['year_established']) && (strlen($this->container['year_established']) > 4)) {
            $invalid_properties[] = "invalid value for 'year_established', the character length must be smaller than or equal to 4.";
        }

        if (!is_null($this->container['language']) && (strlen($this->container['language']) > 10)) {
            $invalid_properties[] = "invalid value for 'language', the character length must be smaller than or equal to 10.";
        }

        $allowed_values = ["WEEKLY", "MONTHLY", "QUARTERLY"];
        if (!in_array($this->container['intelligent_search_tracking_frequency'], $allowed_values)) {
            $invalid_properties[] = "invalid value for 'intelligent_search_tracking_frequency', must be one of 'WEEKLY', 'MONTHLY', 'QUARTERLY'.";
        }

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        if (strlen($this->container['id']) > 50) {
            return false;
        }
        if (strlen($this->container['account_id']) > 50) {
            return false;
        }
        if (strlen($this->container['location_name']) > 100) {
            return false;
        }
        $allowed_values = ["FEMALE", "F", "MALE", "M", "UNSPECIFIED"];
        if (!in_array($this->container['gender'], $allowed_values)) {
            return false;
        }
        if (strlen($this->container['address']) > 255) {
            return false;
        }
        if (strlen($this->container['address2']) > 255) {
            return false;
        }
        if (strlen($this->container['display_address']) > 255) {
            return false;
        }
        if (strlen($this->container['city']) > 80) {
            return false;
        }
        if (strlen($this->container['state']) > 80) {
            return false;
        }
        if (strlen($this->container['sublocality']) > 255) {
            return false;
        }
        if (strlen($this->container['zip']) > 10) {
            return false;
        }
        if (strlen($this->container['country_code']) > 2) {
            return false;
        }
        if (strlen($this->container['featured_message']) > 50) {
            return false;
        }
        if (strlen($this->container['featured_message_url']) > 255) {
            return false;
        }
        if (strlen($this->container['website_url']) > 255) {
            return false;
        }
        if (strlen($this->container['display_website_url']) > 255) {
            return false;
        }
        if (strlen($this->container['reservation_url']) > 255) {
            return false;
        }
        if (strlen($this->container['display_reservation_url']) > 255) {
            return false;
        }
        if (strlen($this->container['menu_url']) > 255) {
            return false;
        }
        if (strlen($this->container['display_menu_url']) > 255) {
            return false;
        }
        if (strlen($this->container['order_url']) > 255) {
            return false;
        }
        if (strlen($this->container['display_order_url']) > 255) {
            return false;
        }
        if (strlen($this->container['hours']) > 255) {
            return false;
        }
        if (strlen($this->container['additional_hours_text']) > 255) {
            return false;
        }
        if (strlen($this->container['description']) > 5000) {
            return false;
        }
        if (strlen($this->container['twitter_handle']) > 15) {
            return false;
        }
        if (strlen($this->container['google_website_override']) > 255) {
            return false;
        }
        if (strlen($this->container['facebook_page_url']) > 255) {
            return false;
        }
        $allowed_values = ["LINK", "BUTTON"];
        if (!in_array($this->container['uber_link_type'], $allowed_values)) {
            return false;
        }
        if (strlen($this->container['uber_link_text']) > 100) {
            return false;
        }
        if (strlen($this->container['uber_trip_branding_text']) > 28) {
            return false;
        }
        if (strlen($this->container['uber_trip_branding_description']) > 150) {
            return false;
        }
        if (strlen($this->container['year_established']) > 4) {
            return false;
        }
        if (strlen($this->container['language']) > 10) {
            return false;
        }
        $allowed_values = ["WEEKLY", "MONTHLY", "QUARTERLY"];
        if (!in_array($this->container['intelligent_search_tracking_frequency'], $allowed_values)) {
            return false;
        }
        return true;
    }


    /**
     * Gets id
     * @return string
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     * @param string $id Primary key. Unique alphanumeric (Latin-1) ID assigned by the Customer.
     * @return $this
     */
    public function setId($id)
    {
        if (!is_null($id) && (strlen($id) > 50)) {
            throw new \InvalidArgumentException('invalid length for $id when calling Location., must be smaller than or equal to 50.');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets account_id
     * @return string
     */
    public function getAccountId()
    {
        return $this->container['account_id'];
    }

    /**
     * Sets account_id
     * @param string $account_id Must refer to an **account.id** that already exists.
     * @return $this
     */
    public function setAccountId($account_id)
    {
        if (!is_null($account_id) && (strlen($account_id) > 50)) {
            throw new \InvalidArgumentException('invalid length for $account_id when calling Location., must be smaller than or equal to 50.');
        }

        $this->container['account_id'] = $account_id;

        return $this;
    }

    /**
     * Gets timestamp
     * @return int
     */
    public function getTimestamp()
    {
        return $this->container['timestamp'];
    }

    /**
     * Sets timestamp
     * @param int $timestamp The timestamp of the most recent change to this location record.  Will be ignored when the client is saving location data to Yext.  **NOTE:** The timestamp may change even if observable fields stay the same.
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->container['timestamp'] = $timestamp;

        return $this;
    }

    /**
     * Gets location_type
     * @return \Yext\Client\Model\LocationType
     */
    public function getLocationType()
    {
        return $this->container['location_type'];
    }

    /**
     * Sets location_type
     * @param \Yext\Client\Model\LocationType $location_type
     * @return $this
     */
    public function setLocationType($location_type)
    {
        $this->container['location_type'] = $location_type;

        return $this;
    }

    /**
     * Gets location_name
     * @return string
     */
    public function getLocationName()
    {
        return $this->container['location_name'];
    }

    /**
     * Sets location_name
     * @param string $location_name Cannot include: * inappropriate language * HTML markup or entities * a URL or domain name * a phone number * control characters ([\\x00-\\x1F\\x7F])  Should be in appropriate letter case (e.g., not in all capital letters)
     * @return $this
     */
    public function setLocationName($location_name)
    {
        if (!is_null($location_name) && (strlen($location_name) > 100)) {
            throw new \InvalidArgumentException('invalid length for $location_name when calling Location., must be smaller than or equal to 100.');
        }

        $this->container['location_name'] = $location_name;

        return $this;
    }

    /**
     * Gets first_name
     * @return string
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     * @param string $first_name The first name of the healthcare professional  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->container['first_name'] = $first_name;

        return $this;
    }

    /**
     * Gets middle_name
     * @return string
     */
    public function getMiddleName()
    {
        return $this->container['middle_name'];
    }

    /**
     * Sets middle_name
     * @param string $middle_name The middle name of the healthcare professional  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setMiddleName($middle_name)
    {
        $this->container['middle_name'] = $middle_name;

        return $this;
    }

    /**
     * Gets last_name
     * @return string
     */
    public function getLastName()
    {
        return $this->container['last_name'];
    }

    /**
     * Sets last_name
     * @param string $last_name The last name of the healthcare professional  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->container['last_name'] = $last_name;

        return $this;
    }

    /**
     * Gets office_name
     * @return string
     */
    public function getOfficeName()
    {
        return $this->container['office_name'];
    }

    /**
     * Sets office_name
     * @param string $office_name The name of the office where the healthcare professional works, if different from **locationName**  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setOfficeName($office_name)
    {
        $this->container['office_name'] = $office_name;

        return $this;
    }

    /**
     * Gets gender
     * @return string
     */
    public function getGender()
    {
        return $this->container['gender'];
    }

    /**
     * Sets gender
     * @param string $gender The gender of the healthcare professional  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setGender($gender)
    {
        $allowed_values = array('FEMALE', 'F', 'MALE', 'M', 'UNSPECIFIED');
        if (!is_null($gender) && (!in_array($gender, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'gender', must be one of 'FEMALE', 'F', 'MALE', 'M', 'UNSPECIFIED'");
        }
        $this->container['gender'] = $gender;

        return $this;
    }

    /**
     * Gets npi
     * @return string
     */
    public function getNpi()
    {
        return $this->container['npi'];
    }

    /**
     * Sets npi
     * @param string $npi The National Provider Identifier (NPI) of the healthcare provider  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL or HEALTHCARE_FACILITY.
     * @return $this
     */
    public function setNpi($npi)
    {
        $this->container['npi'] = $npi;

        return $this;
    }

    /**
     * Gets address
     * @return string
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     * @param string $address Must be a valid address  Cannot be a P.O. Box
     * @return $this
     */
    public function setAddress($address)
    {
        if (!is_null($address) && (strlen($address) > 255)) {
            throw new \InvalidArgumentException('invalid length for $address when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets address2
     * @return string
     */
    public function getAddress2()
    {
        return $this->container['address2'];
    }

    /**
     * Sets address2
     * @param string $address2 Cannot be a P.O. Box
     * @return $this
     */
    public function setAddress2($address2)
    {
        if (!is_null($address2) && (strlen($address2) > 255)) {
            throw new \InvalidArgumentException('invalid length for $address2 when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['address2'] = $address2;

        return $this;
    }

    /**
     * Gets suppress_address
     * @return bool
     */
    public function getSuppressAddress()
    {
        return $this->container['suppress_address'];
    }

    /**
     * Sets suppress_address
     * @param bool $suppress_address If true, do not show street address on listings. Defaults to false.
     * @return $this
     */
    public function setSuppressAddress($suppress_address)
    {
        $this->container['suppress_address'] = $suppress_address;

        return $this;
    }

    /**
     * Gets display_address
     * @return string
     */
    public function getDisplayAddress()
    {
        return $this->container['display_address'];
    }

    /**
     * Sets display_address
     * @param string $display_address Provides additional information to help consumers get to the location. This string appears along with the location's address (e.g., In Menlo Mall, 3rd Floor).  It may also be used in conjunction with a hidden address (i.e., when **suppressAddress** is true) to give consumers information about where the location is found (e.g., Servicing the New York area).  Cannot be a P.O. Box
     * @return $this
     */
    public function setDisplayAddress($display_address)
    {
        if (!is_null($display_address) && (strlen($display_address) > 255)) {
            throw new \InvalidArgumentException('invalid length for $display_address when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['display_address'] = $display_address;

        return $this;
    }

    /**
     * Gets city
     * @return string
     */
    public function getCity()
    {
        return $this->container['city'];
    }

    /**
     * Sets city
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        if (!is_null($city) && (strlen($city) > 80)) {
            throw new \InvalidArgumentException('invalid length for $city when calling Location., must be smaller than or equal to 80.');
        }

        $this->container['city'] = $city;

        return $this;
    }

    /**
     * Gets state
     * @return string
     */
    public function getState()
    {
        return $this->container['state'];
    }

    /**
     * Sets state
     * @param string $state For US locations, the two-character code of the location’s state, or DC for the District of Columbia For non-US locations, the name of the location’s province / region / state
     * @return $this
     */
    public function setState($state)
    {
        if (!is_null($state) && (strlen($state) > 80)) {
            throw new \InvalidArgumentException('invalid length for $state when calling Location., must be smaller than or equal to 80.');
        }

        $this->container['state'] = $state;

        return $this;
    }

    /**
     * Gets sublocality
     * @return string
     */
    public function getSublocality()
    {
        return $this->container['sublocality'];
    }

    /**
     * Sets sublocality
     * @param string $sublocality The name of the location's sublocality.
     * @return $this
     */
    public function setSublocality($sublocality)
    {
        if (!is_null($sublocality) && (strlen($sublocality) > 255)) {
            throw new \InvalidArgumentException('invalid length for $sublocality when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['sublocality'] = $sublocality;

        return $this;
    }

    /**
     * Gets zip
     * @return string
     */
    public function getZip()
    {
        return $this->container['zip'];
    }

    /**
     * Sets zip
     * @param string $zip The location's postal code. For US locations, this field contains the five- or nine-digit ZIP code (the hyphen is optional). Validations are only done on `zip` if `countryCode` is US.
     * @return $this
     */
    public function setZip($zip)
    {
        if (!is_null($zip) && (strlen($zip) > 10)) {
            throw new \InvalidArgumentException('invalid length for $zip when calling Location., must be smaller than or equal to 10.');
        }

        $this->container['zip'] = $zip;

        return $this;
    }

    /**
     * Gets country_code
     * @return string
     */
    public function getCountryCode()
    {
        return $this->container['country_code'];
    }

    /**
     * Sets country_code
     * @param string $country_code The country code (two-character ISO 3166-1) of the location's country. If omitted, US is used.
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        if (!is_null($country_code) && (strlen($country_code) > 2)) {
            throw new \InvalidArgumentException('invalid length for $country_code when calling Location., must be smaller than or equal to 2.');
        }

        $this->container['country_code'] = $country_code;

        return $this;
    }

    /**
     * Gets service_area
     * @return \Yext\Client\Model\LocationServiceArea
     */
    public function getServiceArea()
    {
        return $this->container['service_area'];
    }

    /**
     * Sets service_area
     * @param \Yext\Client\Model\LocationServiceArea $service_area
     * @return $this
     */
    public function setServiceArea($service_area)
    {
        $this->container['service_area'] = $service_area;

        return $this;
    }

    /**
     * Gets phone
     * @return string
     */
    public function getPhone()
    {
        return $this->container['phone'];
    }

    /**
     * Sets phone
     * @param string $phone Must be a valid phone number.
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets is_phone_tracked
     * @return bool
     */
    public function getIsPhoneTracked()
    {
        return $this->container['is_phone_tracked'];
    }

    /**
     * Sets is_phone_tracked
     * @param bool $is_phone_tracked Set to true if the number listed in **phone** is a tracked phone number.  **NOTE:** When updating **isPhoneTracked**, you must provide a value for **phone** in the same request.
     * @return $this
     */
    public function setIsPhoneTracked($is_phone_tracked)
    {
        $this->container['is_phone_tracked'] = $is_phone_tracked;

        return $this;
    }

    /**
     * Gets local_phone
     * @return string
     */
    public function getLocalPhone()
    {
        return $this->container['local_phone'];
    }

    /**
     * Sets local_phone
     * @param string $local_phone Must be a valid, non-toll-free phone number.  Required if: * **isPhoneTracked** is true and the non-tracked number is a toll-free number, **OR** * **isPhoneTracked** is false and **phone** is a toll-free number
     * @return $this
     */
    public function setLocalPhone($local_phone)
    {
        $this->container['local_phone'] = $local_phone;

        return $this;
    }

    /**
     * Gets alternate_phone
     * @return string
     */
    public function getAlternatePhone()
    {
        return $this->container['alternate_phone'];
    }

    /**
     * Sets alternate_phone
     * @param string $alternate_phone Must be a valid phone number, based on the country specified in `countryCode`. Phone numbers for US locations must contain 10 digits.
     * @return $this
     */
    public function setAlternatePhone($alternate_phone)
    {
        $this->container['alternate_phone'] = $alternate_phone;

        return $this;
    }

    /**
     * Gets fax_phone
     * @return string
     */
    public function getFaxPhone()
    {
        return $this->container['fax_phone'];
    }

    /**
     * Sets fax_phone
     * @param string $fax_phone Must be a valid phone number, based on the country specified in `countryCode`. Phone numbers for US locations must contain 10 digits.
     * @return $this
     */
    public function setFaxPhone($fax_phone)
    {
        $this->container['fax_phone'] = $fax_phone;

        return $this;
    }

    /**
     * Gets mobile_phone
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->container['mobile_phone'];
    }

    /**
     * Sets mobile_phone
     * @param string $mobile_phone Must be a valid phone number, based on the country specified in `countryCode`. Phone numbers for US locations must contain 10 digits.
     * @return $this
     */
    public function setMobilePhone($mobile_phone)
    {
        $this->container['mobile_phone'] = $mobile_phone;

        return $this;
    }

    /**
     * Gets toll_free_phone
     * @return string
     */
    public function getTollFreePhone()
    {
        return $this->container['toll_free_phone'];
    }

    /**
     * Sets toll_free_phone
     * @param string $toll_free_phone Must be a valid phone number, based on the country specified in `countryCode`. Phone numbers for US locations must contain 10 digits.
     * @return $this
     */
    public function setTollFreePhone($toll_free_phone)
    {
        $this->container['toll_free_phone'] = $toll_free_phone;

        return $this;
    }

    /**
     * Gets tty_phone
     * @return string
     */
    public function getTtyPhone()
    {
        return $this->container['tty_phone'];
    }

    /**
     * Sets tty_phone
     * @param string $tty_phone Must be a valid phone number, based on the country specified in `countryCode`. Phone numbers for US locations must contain 10 digits.
     * @return $this
     */
    public function setTtyPhone($tty_phone)
    {
        $this->container['tty_phone'] = $tty_phone;

        return $this;
    }

    /**
     * Gets category_ids
     * @return string[]
     */
    public function getCategoryIds()
    {
        return $this->container['category_ids'];
    }

    /**
     * Sets category_ids
     * @param string[] $category_ids Yext Category IDs. A Location must have at least one and at most 10 Categories.  IDs must be valid and selectable (i.e., cannot be parent categories).  **NOTE:** The list of category IDs that you send us must be comprehensive. For example, if you send us a list of IDs that does not include IDs that you sent in your last update, Yext considers the missing categories to be deleted, and we remove them from your listings.
     * @return $this
     */
    public function setCategoryIds($category_ids)
    {
        $this->container['category_ids'] = $category_ids;

        return $this;
    }

    /**
     * Gets featured_message
     * @return string
     */
    public function getFeaturedMessage()
    {
        return $this->container['featured_message'];
    }

    /**
     * Sets featured_message
     * @param string $featured_message The Featured Message. Default: Call today!  Cannot include: * inappropriate language * HTML markup * a URL or domain name * a phone number * control characters ([\\x00-\\x1F\\x7F]) * insufficient spacing  If you submit a Featured Message that contains profanity or more than 50 characters, it will be ignored. The success response will contain a warning message explaining why your Featured Message wasn't stored in the system.
     * @return $this
     */
    public function setFeaturedMessage($featured_message)
    {
        if (!is_null($featured_message) && (strlen($featured_message) > 50)) {
            throw new \InvalidArgumentException('invalid length for $featured_message when calling Location., must be smaller than or equal to 50.');
        }

        $this->container['featured_message'] = $featured_message;

        return $this;
    }

    /**
     * Gets featured_message_url
     * @return string
     */
    public function getFeaturedMessageUrl()
    {
        return $this->container['featured_message_url'];
    }

    /**
     * Sets featured_message_url
     * @param string $featured_message_url Valid URL to which the Featured Message is linked
     * @return $this
     */
    public function setFeaturedMessageUrl($featured_message_url)
    {
        if (!is_null($featured_message_url) && (strlen($featured_message_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $featured_message_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['featured_message_url'] = $featured_message_url;

        return $this;
    }

    /**
     * Gets website_url
     * @return string
     */
    public function getWebsiteUrl()
    {
        return $this->container['website_url'];
    }

    /**
     * Sets website_url
     * @param string $website_url The URL of the location's website. This URL will be shown on your listings unless you specify a value for `displayWebsiteUrl`.  Must be a valid URL and is required whenever `displayWebsiteUrl` is specified.
     * @return $this
     */
    public function setWebsiteUrl($website_url)
    {
        if (!is_null($website_url) && (strlen($website_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $website_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['website_url'] = $website_url;

        return $this;
    }

    /**
     * Gets display_website_url
     * @return string
     */
    public function getDisplayWebsiteUrl()
    {
        return $this->container['display_website_url'];
    }

    /**
     * Sets display_website_url
     * @param string $display_website_url The URL that is shown on your listings in place of `websiteUrl`. You can use `displayWebsiteUrl` to display a short, memorable web address that redirects consumers to the URL given in `websiteUrl`.  Must be a valid URL and be specified along with `websiteUrl`.
     * @return $this
     */
    public function setDisplayWebsiteUrl($display_website_url)
    {
        if (!is_null($display_website_url) && (strlen($display_website_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $display_website_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['display_website_url'] = $display_website_url;

        return $this;
    }

    /**
     * Gets reservation_url
     * @return string
     */
    public function getReservationUrl()
    {
        return $this->container['reservation_url'];
    }

    /**
     * Sets reservation_url
     * @param string $reservation_url A valid URL used for reservations at this location.
     * @return $this
     */
    public function setReservationUrl($reservation_url)
    {
        if (!is_null($reservation_url) && (strlen($reservation_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $reservation_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['reservation_url'] = $reservation_url;

        return $this;
    }

    /**
     * Gets display_reservation_url
     * @return string
     */
    public function getDisplayReservationUrl()
    {
        return $this->container['display_reservation_url'];
    }

    /**
     * Sets display_reservation_url
     * @param string $display_reservation_url The URL that is shown on your listings in place of `reservationUrl`. You can use `displayReservationUrl` to display a short, memorable web address that redirects consumers to the URL given in `reservationUrl`.  Must be a valid URL and be specified along with `reservationUrl`.
     * @return $this
     */
    public function setDisplayReservationUrl($display_reservation_url)
    {
        if (!is_null($display_reservation_url) && (strlen($display_reservation_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $display_reservation_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['display_reservation_url'] = $display_reservation_url;

        return $this;
    }

    /**
     * Gets menu_url
     * @return string
     */
    public function getMenuUrl()
    {
        return $this->container['menu_url'];
    }

    /**
     * Sets menu_url
     * @param string $menu_url The URL of the location's menu.
     * @return $this
     */
    public function setMenuUrl($menu_url)
    {
        if (!is_null($menu_url) && (strlen($menu_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $menu_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['menu_url'] = $menu_url;

        return $this;
    }

    /**
     * Gets display_menu_url
     * @return string
     */
    public function getDisplayMenuUrl()
    {
        return $this->container['display_menu_url'];
    }

    /**
     * Sets display_menu_url
     * @param string $display_menu_url The URL that is shown on your listings in place of `menuUrl`. You can use `displayMenuUrl` to display a short, memorable web address that redirects consumers to the URL given in `menuUrl`.  Must be a valid URL and be specified along with `menuUrl`.
     * @return $this
     */
    public function setDisplayMenuUrl($display_menu_url)
    {
        if (!is_null($display_menu_url) && (strlen($display_menu_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $display_menu_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['display_menu_url'] = $display_menu_url;

        return $this;
    }

    /**
     * Gets order_url
     * @return string
     */
    public function getOrderUrl()
    {
        return $this->container['order_url'];
    }

    /**
     * Sets order_url
     * @param string $order_url The URL used to place orders that will be fulfilled at the location.
     * @return $this
     */
    public function setOrderUrl($order_url)
    {
        if (!is_null($order_url) && (strlen($order_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $order_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['order_url'] = $order_url;

        return $this;
    }

    /**
     * Gets display_order_url
     * @return string
     */
    public function getDisplayOrderUrl()
    {
        return $this->container['display_order_url'];
    }

    /**
     * Sets display_order_url
     * @param string $display_order_url The URL that is shown on your listings in place of `orderUrl`. You can use `displayOrderUrl` to display a short, memorable web address that redirects consumers to the URL given in `orderUrl`.  Must be a valid URL and be specified along with `orderUrl`.
     * @return $this
     */
    public function setDisplayOrderUrl($display_order_url)
    {
        if (!is_null($display_order_url) && (strlen($display_order_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $display_order_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['display_order_url'] = $display_order_url;

        return $this;
    }

    /**
     * Gets hours
     * @return string
     */
    public function getHours()
    {
        return $this->container['hours'];
    }

    /**
     * Sets hours
     * @param string $hours Hours should be submitted as a comma-separated list of days, where each day's hours are specified as follows:  d:oh:om:ch:cm * d = day of the week –   * 1 – Sunday   * 2 – Monday   * 3 – Tuesday   * 4 – Wednesday   * 5 – Thursday   * 6 – Friday   * 7 – Saturday * oh:om = opening time in 24-hour format * ch:cm = closing time in 24-hour format  Times with single-digit hours (e.g., 9 AM) can be submitted with or without a leading zero (9:00 or 09:00).  **Example:** open 9 AM to 5 PM Monday and Tuesday, open 10 AM to 4 PM on Saturday – 2:9:00:17:00,3:9:00:17:00,7:10:00:16:00  SPECIAL CASES: * To indicate that a location is open 24 hours on a specific day, set 00:00 as both the opening and closing time for that day.   * **Example:** open all day on Saturdays – 7:00:00:00:00 * To indicate that a location is closed on a specific day, omit that day from the list or set it as closed (\"closed\" is not case sensitive).   * **Example:** closed on Sundays – 1:closed   * **NOTE:** If a location is closed seven days a week, set at least one day to closed. Otherwise, **hours** is an empty string, and we assume you are not submitting hours information for that location. * To indicate that a location has split hours on a specific day, submit a set of hours for each block of time the location is open.   * **Example:** open from 9:00 AM to 12:00 PM and again from 1:00 PM to 5:00 PM on Mondays – 2:9:00:12:00,2:13:00:17:00  **NOTE:** To set hours for specific days of the year rather than days of the week, use **holidayHours**.
     * @return $this
     */
    public function setHours($hours)
    {
        if (!is_null($hours) && (strlen($hours) > 255)) {
            throw new \InvalidArgumentException('invalid length for $hours when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['hours'] = $hours;

        return $this;
    }

    /**
     * Gets additional_hours_text
     * @return string
     */
    public function getAdditionalHoursText()
    {
        return $this->container['additional_hours_text'];
    }

    /**
     * Sets additional_hours_text
     * @param string $additional_hours_text Additional information about business hours that does not fit in **hours** (e.g., Closed during the winter)
     * @return $this
     */
    public function setAdditionalHoursText($additional_hours_text)
    {
        if (!is_null($additional_hours_text) && (strlen($additional_hours_text) > 255)) {
            throw new \InvalidArgumentException('invalid length for $additional_hours_text when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['additional_hours_text'] = $additional_hours_text;

        return $this;
    }

    /**
     * Gets holiday_hours
     * @return \Yext\Client\Model\LocationHolidayHours[]
     */
    public function getHolidayHours()
    {
        return $this->container['holiday_hours'];
    }

    /**
     * Sets holiday_hours
     * @param \Yext\Client\Model\LocationHolidayHours[] $holiday_hours Holiday hours for this location.  **NOTE:** hours must be set in order for holidayHours to appear on your listings)
     * @return $this
     */
    public function setHolidayHours($holiday_hours)
    {
        $this->container['holiday_hours'] = $holiday_hours;

        return $this;
    }

    /**
     * Gets description
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        if (!is_null($description) && (strlen($description) > 5000)) {
            throw new \InvalidArgumentException('invalid length for $description when calling Location., must be smaller than or equal to 5000.');
        }

        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets conditions_treated
     * @return string[]
     */
    public function getConditionsTreated()
    {
        return $this->container['conditions_treated'];
    }

    /**
     * Sets conditions_treated
     * @param string[] $conditions_treated A list of the conditions treated by the healthcare provider  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL or HEALTHCARE_FACILITY.
     * @return $this
     */
    public function setConditionsTreated($conditions_treated)
    {
        $this->container['conditions_treated'] = $conditions_treated;

        return $this;
    }

    /**
     * Gets certifications
     * @return string[]
     */
    public function getCertifications()
    {
        return $this->container['certifications'];
    }

    /**
     * Sets certifications
     * @param string[] $certifications A list of the certifications held by the healthcare professional  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setCertifications($certifications)
    {
        $this->container['certifications'] = $certifications;

        return $this;
    }

    /**
     * Gets education_list
     * @return \Yext\Client\Model\LocationEducationList[]
     */
    public function getEducationList()
    {
        return $this->container['education_list'];
    }

    /**
     * Sets education_list
     * @param \Yext\Client\Model\LocationEducationList[] $education_list A list of the types of education and training completed by the healthcare professional  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setEducationList($education_list)
    {
        $this->container['education_list'] = $education_list;

        return $this;
    }

    /**
     * Gets degrees
     * @return string[]
     */
    public function getDegrees()
    {
        return $this->container['degrees'];
    }

    /**
     * Sets degrees
     * @param string[] $degrees A list of the degrees earned by the healthcare professional  **NOTE:**  This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.  Valid values:  * `ANP` (Adult Nurse Practitioner) * `APN` (Advanced Practice Nurse) * `APRN` (Advanced Practice Registered Nurse) * `ARNP` (Advanced Registered Nurse Practitioner) * `CNM` (Certified Nurse Midwife) * `CNP` (Certified Nurse Practitioner) * `CNS` (Clinical Nurse Specialist) * `CPNP` (Certified Pediatric Nurse Practitioner) * `CRNA` (Certified Registered Nurse Anesthetist) * `CRNP` (Certified Registered Nurse Practitioner) * `DC` (Doctor of Chiropractic) * `DDS` (Doctor of Dental Surgery) * `DMD` (Doctor of Dental Medicine) * `DO` (Doctor of Osteopathy) * `DPM` (Doctor of Podiatric Medicine) * `DVM` (Doctor of Veterinary Medicine) * `FNP` (Family Nurse Practitioner) * `GNP` (Geriatric Nurse Practitioner) * `LAC` (Licensed Acupuncturist) * `LPN` (Licensed Practical Nurse) * `MD` (Medical Doctor) * `ND` (Naturopathic Doctor) * `NP` (Nurse Practitioner) * `OD` (Doctor of Optometry) * `PA` (Physician Assistant) * `PAC` (Physician Assistant Certified) * `PHARMD` (Doctor of Pharmacy) * `PHD` (Doctor of Philosophy) * `PNP` (Pediatric Nurse Practitioner) * `VMD` (Veterinary Medical Doctor) * `WHNP` (Womens Health Nurse Practitioner)
     * @return $this
     */
    public function setDegrees($degrees)
    {
        $this->container['degrees'] = $degrees;

        return $this;
    }

    /**
     * Gets admitting_hospitals
     * @return string[]
     */
    public function getAdmittingHospitals()
    {
        return $this->container['admitting_hospitals'];
    }

    /**
     * Sets admitting_hospitals
     * @param string[] $admitting_hospitals A list of hospitals where the healthcare professional admits patients  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setAdmittingHospitals($admitting_hospitals)
    {
        $this->container['admitting_hospitals'] = $admitting_hospitals;

        return $this;
    }

    /**
     * Gets accepting_new_patients
     * @return bool
     */
    public function getAcceptingNewPatients()
    {
        return $this->container['accepting_new_patients'];
    }

    /**
     * Sets accepting_new_patients
     * @param bool $accepting_new_patients Indicates whether the healthcare provider is accepting new patients  Default is true  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL or HEALTHCARE_FACILITY.
     * @return $this
     */
    public function setAcceptingNewPatients($accepting_new_patients)
    {
        $this->container['accepting_new_patients'] = $accepting_new_patients;

        return $this;
    }

    /**
     * Gets closed
     * @return \Yext\Client\Model\LocationClosed
     */
    public function getClosed()
    {
        return $this->container['closed'];
    }

    /**
     * Sets closed
     * @param \Yext\Client\Model\LocationClosed $closed
     * @return $this
     */
    public function setClosed($closed)
    {
        $this->container['closed'] = $closed;

        return $this;
    }

    /**
     * Gets payment_options
     * @return string[]
     */
    public function getPaymentOptions()
    {
        return $this->container['payment_options'];
    }

    /**
     * Sets payment_options
     * @param string[] $payment_options The payment methods accepted at this location  Valid elements depend on the location's country. For US locations, valid elements are: * AMERICANEXPRESS * CASH * CHECK * DINERSCLUB * DISCOVER * FINANCING * INVOICE * MASTERCARD * TRAVELERSCHECK * VISA * ANDROIDPAY * APPLEPAY * SAMSUNGPAY
     * @return $this
     */
    public function setPaymentOptions($payment_options)
    {
        $this->container['payment_options'] = $payment_options;

        return $this;
    }

    /**
     * Gets insurance_accepted
     * @return string[]
     */
    public function getInsuranceAccepted()
    {
        return $this->container['insurance_accepted'];
    }

    /**
     * Sets insurance_accepted
     * @param string[] $insurance_accepted A list of insurance policies accepted by the healthcare provider  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setInsuranceAccepted($insurance_accepted)
    {
        $this->container['insurance_accepted'] = $insurance_accepted;

        return $this;
    }

    /**
     * Gets logo
     * @return \Yext\Client\Model\LocationPhoto
     */
    public function getLogo()
    {
        return $this->container['logo'];
    }

    /**
     * Sets logo
     * @param \Yext\Client\Model\LocationPhoto $logo
     * @return $this
     */
    public function setLogo($logo)
    {
        $this->container['logo'] = $logo;

        return $this;
    }

    /**
     * Gets photos
     * @return \Yext\Client\Model\LocationPhoto[]
     */
    public function getPhotos()
    {
        return $this->container['photos'];
    }

    /**
     * Sets photos
     * @param \Yext\Client\Model\LocationPhoto[] $photos Up to 50 Photos.  **NOTE:** The list of photos that you send us must be comprehensive. For example, if you send us a list of photos that does not include photos that you sent in your last update, Yext considers the missing photos to be deleted, and we remove them from your listings.
     * @return $this
     */
    public function setPhotos($photos)
    {
        $this->container['photos'] = $photos;

        return $this;
    }

    /**
     * Gets headshot
     * @return object
     */
    public function getHeadshot()
    {
        return $this->container['headshot'];
    }

    /**
     * Sets headshot
     * @param object $headshot A portrait of the healthcare professional  **NOTE:** This field is only available to locations whose **locationType** is HEALTHCARE_PROFESSIONAL.
     * @return $this
     */
    public function setHeadshot($headshot)
    {
        $this->container['headshot'] = $headshot;

        return $this;
    }

    /**
     * Gets video_urls
     * @return string[]
     */
    public function getVideoUrls()
    {
        return $this->container['video_urls'];
    }

    /**
     * Sets video_urls
     * @param string[] $video_urls Valid YouTube URLs for embedding a video on some publisher sites.  **NOTE:** Currently, only the first URL in the Array appears in your listings.
     * @return $this
     */
    public function setVideoUrls($video_urls)
    {
        $this->container['video_urls'] = $video_urls;

        return $this;
    }

    /**
     * Gets instagram_handle
     * @return string
     */
    public function getInstagramHandle()
    {
        return $this->container['instagram_handle'];
    }

    /**
     * Sets instagram_handle
     * @param string $instagram_handle Valid Instagram username for the location (e.g., NewCityFiat (without the leading \"@\"))
     * @return $this
     */
    public function setInstagramHandle($instagram_handle)
    {
        $this->container['instagram_handle'] = $instagram_handle;

        return $this;
    }

    /**
     * Gets twitter_handle
     * @return string
     */
    public function getTwitterHandle()
    {
        return $this->container['twitter_handle'];
    }

    /**
     * Sets twitter_handle
     * @param string $twitter_handle Valid Twitter handle for the location (e.g., JohnSmith (without the leading '@')). If you submit an invalid Twitter handle, it will be ignored. The success response will contain a warning message explaining why your Twitter handle wasn't stored in the system.
     * @return $this
     */
    public function setTwitterHandle($twitter_handle)
    {
        if (!is_null($twitter_handle) && (strlen($twitter_handle) > 15)) {
            throw new \InvalidArgumentException('invalid length for $twitter_handle when calling Location., must be smaller than or equal to 15.');
        }

        $this->container['twitter_handle'] = $twitter_handle;

        return $this;
    }

    /**
     * Gets google_website_override
     * @return string
     */
    public function getGoogleWebsiteOverride()
    {
        return $this->container['google_website_override'];
    }

    /**
     * Sets google_website_override
     * @param string $google_website_override The URL you would like to submit to Google My Business in place of the one given in **websiteUrl** (if applicable).  For example, if you want to analyze the traffic driven by your Google listings separately from other traffic, enter the alternate URL that you will use for tracking in this field.
     * @return $this
     */
    public function setGoogleWebsiteOverride($google_website_override)
    {
        if (!is_null($google_website_override) && (strlen($google_website_override) > 255)) {
            throw new \InvalidArgumentException('invalid length for $google_website_override when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['google_website_override'] = $google_website_override;

        return $this;
    }

    /**
     * Gets google_cover_photo
     * @return object
     */
    public function getGoogleCoverPhoto()
    {
        return $this->container['google_cover_photo'];
    }

    /**
     * Sets google_cover_photo
     * @param object $google_cover_photo The cover photo for your business's Google profile  NOTE: Your cover photo must meet all of the following requirements: * have a 16:9 aspect ratio * be at least 480 x 270 pixels * be no more than 2120 x 1192 pixels
     * @return $this
     */
    public function setGoogleCoverPhoto($google_cover_photo)
    {
        $this->container['google_cover_photo'] = $google_cover_photo;

        return $this;
    }

    /**
     * Gets google_profile_photo
     * @return object
     */
    public function getGoogleProfilePhoto()
    {
        return $this->container['google_profile_photo'];
    }

    /**
     * Sets google_profile_photo
     * @param object $google_profile_photo The profile photo for your business's Google profile  **NOTE:** Your profile picture must meet all of the following requirements: * be a square * be at least 200 x 200 pixels * be no more than 500 x 500 pixels
     * @return $this
     */
    public function setGoogleProfilePhoto($google_profile_photo)
    {
        $this->container['google_profile_photo'] = $google_profile_photo;

        return $this;
    }

    /**
     * Gets google_preferred_photo
     * @return string
     */
    public function getGooglePreferredPhoto()
    {
        return $this->container['google_preferred_photo'];
    }

    /**
     * Sets google_preferred_photo
     * @param string $google_preferred_photo The photo Google will consider first when deciding which photo display with the location's business information on Google Maps or Search  One of: * UNSPECIFIED (default) * COVER - the photo in **googleCoverPhoto** * PROFILE - the photo in **googleProfilePhoto**  **NOTE:** If the value of a location's **googlePreferredPhoto** is UNSPECIFIED, **googlePreferredPhoto** will be omitted from the location's data in responses.
     * @return $this
     */
    public function setGooglePreferredPhoto($google_preferred_photo)
    {
        $this->container['google_preferred_photo'] = $google_preferred_photo;

        return $this;
    }

    /**
     * Gets google_attributes
     * @return \Yext\Client\Model\LocationGoogleAttributes[]
     */
    public function getGoogleAttributes()
    {
        return $this->container['google_attributes'];
    }

    /**
     * Sets google_attributes
     * @param \Yext\Client\Model\LocationGoogleAttributes[] $google_attributes The Google My Business attributes for this location.
     * @return $this
     */
    public function setGoogleAttributes($google_attributes)
    {
        $this->container['google_attributes'] = $google_attributes;

        return $this;
    }

    /**
     * Gets facebook_page_url
     * @return string
     */
    public function getFacebookPageUrl()
    {
        return $this->container['facebook_page_url'];
    }

    /**
     * Sets facebook_page_url
     * @param string $facebook_page_url URL for the location's Facebook Page.  Valid formats: * facebook.com/profile.php?id=[numId] * facebook.com/group.php?gid=[numId] * facebook.com/groups/[numId] * facebook.com/[Name] * facebook.com/pages/[Name]/[numId]  where [Name] is a String and [numId] is an Integer  If you submit a URL that is not in one of the valid formats, it will be ignored. The success response will contain a warning message explaining why the URL wasn't stored in the system.  **NOTE:** This value is automatically set to the location's Facebook Page URL. You can only manually set **facebookPageUrl** if the location meets one of the following criteria: * It is not subscribed to a Listings package that contains Facebook. * It is opted out of Facebook.
     * @return $this
     */
    public function setFacebookPageUrl($facebook_page_url)
    {
        if (!is_null($facebook_page_url) && (strlen($facebook_page_url) > 255)) {
            throw new \InvalidArgumentException('invalid length for $facebook_page_url when calling Location., must be smaller than or equal to 255.');
        }

        $this->container['facebook_page_url'] = $facebook_page_url;

        return $this;
    }

    /**
     * Gets facebook_cover_photo
     * @return object
     */
    public function getFacebookCoverPhoto()
    {
        return $this->container['facebook_cover_photo'];
    }

    /**
     * Sets facebook_cover_photo
     * @param object $facebook_cover_photo The cover photo for your business's Facebook profile  Displayed as a 851 x 315 pixel image  You must have a cover photo in order for your listing to appear on Facebook.  **NOTE:** Your cover photo must be at least 400 pixels wide.
     * @return $this
     */
    public function setFacebookCoverPhoto($facebook_cover_photo)
    {
        $this->container['facebook_cover_photo'] = $facebook_cover_photo;

        return $this;
    }

    /**
     * Gets facebook_profile_picture
     * @return object
     */
    public function getFacebookProfilePicture()
    {
        return $this->container['facebook_profile_picture'];
    }

    /**
     * Sets facebook_profile_picture
     * @param object $facebook_profile_picture The profile picture for your business's Facebook profile  You must have a profile picture in order for your listing to appear on Facebook.  **NOTE:** Your profile picture must be larger than 180 x 180 pixels.
     * @return $this
     */
    public function setFacebookProfilePicture($facebook_profile_picture)
    {
        $this->container['facebook_profile_picture'] = $facebook_profile_picture;

        return $this;
    }

    /**
     * Gets uber_link_type
     * @return string
     */
    public function getUberLinkType()
    {
        return $this->container['uber_link_type'];
    }

    /**
     * Sets uber_link_type
     * @param string $uber_link_type Indicates whether the embedded Uber link for this location appears as text or a button  When consumers click on this link on a mobile device, the Uber app (if installed) will open with your location set as the trip destination. If the Uber app is not installed, the consumer will be prompted to download it.
     * @return $this
     */
    public function setUberLinkType($uber_link_type)
    {
        $allowed_values = array('LINK', 'BUTTON');
        if (!is_null($uber_link_type) && (!in_array($uber_link_type, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'uber_link_type', must be one of 'LINK', 'BUTTON'");
        }
        $this->container['uber_link_type'] = $uber_link_type;

        return $this;
    }

    /**
     * Gets uber_link_text
     * @return string
     */
    public function getUberLinkText()
    {
        return $this->container['uber_link_text'];
    }

    /**
     * Sets uber_link_text
     * @param string $uber_link_text The text of the embedded Uber link  Default is \"Ride there with Uber\".  **NOTE:** This field is only available if **uberLinkType** is LINK.
     * @return $this
     */
    public function setUberLinkText($uber_link_text)
    {
        if (!is_null($uber_link_text) && (strlen($uber_link_text) > 100)) {
            throw new \InvalidArgumentException('invalid length for $uber_link_text when calling Location., must be smaller than or equal to 100.');
        }

        $this->container['uber_link_text'] = $uber_link_text;

        return $this;
    }

    /**
     * Gets uber_trip_branding_text
     * @return string
     */
    public function getUberTripBrandingText()
    {
        return $this->container['uber_trip_branding_text'];
    }

    /**
     * Sets uber_trip_branding_text
     * @param string $uber_trip_branding_text The text of the call-to-action that will appear in the Uber app during a trip to your location (e.g., Check out our menu!)  **NOTE:** If a value for **uberTripBrandingText** is provided, values must also be provided for **uberTripBrandingUrl** and **uberTripBrandingDescription**.
     * @return $this
     */
    public function setUberTripBrandingText($uber_trip_branding_text)
    {
        if (!is_null($uber_trip_branding_text) && (strlen($uber_trip_branding_text) > 28)) {
            throw new \InvalidArgumentException('invalid length for $uber_trip_branding_text when calling Location., must be smaller than or equal to 28.');
        }

        $this->container['uber_trip_branding_text'] = $uber_trip_branding_text;

        return $this;
    }

    /**
     * Gets uber_trip_branding_url
     * @return string
     */
    public function getUberTripBrandingUrl()
    {
        return $this->container['uber_trip_branding_url'];
    }

    /**
     * Sets uber_trip_branding_url
     * @param string $uber_trip_branding_url The URL that the consumer will be redirected to when tapping on the call-to-action in the Uber app during a trip to your location.  **NOTE:** If a value for **uberTripBrandingUrl** is provided, values must also be provided for **uberTripBrandingText** and **uberTripBrandingDescription**.
     * @return $this
     */
    public function setUberTripBrandingUrl($uber_trip_branding_url)
    {
        $this->container['uber_trip_branding_url'] = $uber_trip_branding_url;

        return $this;
    }

    /**
     * Gets uber_trip_branding_description
     * @return string
     */
    public function getUberTripBrandingDescription()
    {
        return $this->container['uber_trip_branding_description'];
    }

    /**
     * Sets uber_trip_branding_description
     * @param string $uber_trip_branding_description A longer description that will appear near the call-to-action in the Uber app during a trip to your location.  **NOTE:** If a value for **uberTripBrandingDescription** is provided, values must also be provided for **uberTripBrandingText** and **uberTripBrandingUrl**.
     * @return $this
     */
    public function setUberTripBrandingDescription($uber_trip_branding_description)
    {
        if (!is_null($uber_trip_branding_description) && (strlen($uber_trip_branding_description) > 150)) {
            throw new \InvalidArgumentException('invalid length for $uber_trip_branding_description when calling Location., must be smaller than or equal to 150.');
        }

        $this->container['uber_trip_branding_description'] = $uber_trip_branding_description;

        return $this;
    }

    /**
     * Gets uber_client_id
     * @return string
     */
    public function getUberClientId()
    {
        return $this->container['uber_client_id'];
    }

    /**
     * Sets uber_client_id
     * @param string $uber_client_id The ID that enables **uberTripBrandingText** and **uberTripBrandingUrl**. For more information, contact your Account Manager.
     * @return $this
     */
    public function setUberClientId($uber_client_id)
    {
        $this->container['uber_client_id'] = $uber_client_id;

        return $this;
    }

    /**
     * Gets uber_embed_code
     * @return string
     */
    public function getUberEmbedCode()
    {
        return $this->container['uber_embed_code'];
    }

    /**
     * Sets uber_embed_code
     * @param string $uber_embed_code The Yext-powered code that can be copied and pasted into the markup of emails or web pages where the embedded Uber link should appear
     * @return $this
     */
    public function setUberEmbedCode($uber_embed_code)
    {
        $this->container['uber_embed_code'] = $uber_embed_code;

        return $this;
    }

    /**
     * Gets uber_link
     * @return string
     */
    public function getUberLink()
    {
        return $this->container['uber_link'];
    }

    /**
     * Sets uber_link
     * @param string $uber_link The Yext-powered link that can be copied and pasted into the markup of Yext Pages where the embedded Uber link should appear
     * @return $this
     */
    public function setUberLink($uber_link)
    {
        $this->container['uber_link'] = $uber_link;

        return $this;
    }

    /**
     * Gets year_established
     * @return string
     */
    public function getYearEstablished()
    {
        return $this->container['year_established'];
    }

    /**
     * Sets year_established
     * @param string $year_established The year that this location was opened, not the number of years it was open  Minimum of 1000, maximum of current year + 10.
     * @return $this
     */
    public function setYearEstablished($year_established)
    {
        if (!is_null($year_established) && (strlen($year_established) > 4)) {
            throw new \InvalidArgumentException('invalid length for $year_established when calling Location., must be smaller than or equal to 4.');
        }

        $this->container['year_established'] = $year_established;

        return $this;
    }

    /**
     * Gets display_lat
     * @return double
     */
    public function getDisplayLat()
    {
        return $this->container['display_lat'];
    }

    /**
     * Sets display_lat
     * @param double $display_lat Latitude where the map pin should be displayed, as provided by you  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setDisplayLat($display_lat)
    {
        $this->container['display_lat'] = $display_lat;

        return $this;
    }

    /**
     * Gets display_lng
     * @return double
     */
    public function getDisplayLng()
    {
        return $this->container['display_lng'];
    }

    /**
     * Sets display_lng
     * @param double $display_lng Longitude where the map pin should be displayed, as provided by you  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setDisplayLng($display_lng)
    {
        $this->container['display_lng'] = $display_lng;

        return $this;
    }

    /**
     * Gets routable_lat
     * @return double
     */
    public function getRoutableLat()
    {
        return $this->container['routable_lat'];
    }

    /**
     * Sets routable_lat
     * @param double $routable_lat Latitude to use for driving directions to the location, as provided by you  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setRoutableLat($routable_lat)
    {
        $this->container['routable_lat'] = $routable_lat;

        return $this;
    }

    /**
     * Gets routable_lng
     * @return double
     */
    public function getRoutableLng()
    {
        return $this->container['routable_lng'];
    }

    /**
     * Sets routable_lng
     * @param double $routable_lng Longitude to use for driving directions to the location, as provided by you  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setRoutableLng($routable_lng)
    {
        $this->container['routable_lng'] = $routable_lng;

        return $this;
    }

    /**
     * Gets walkable_lat
     * @return double
     */
    public function getWalkableLat()
    {
        return $this->container['walkable_lat'];
    }

    /**
     * Sets walkable_lat
     * @param double $walkable_lat Latitude to use for walking directions to the location, as provided by you  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setWalkableLat($walkable_lat)
    {
        $this->container['walkable_lat'] = $walkable_lat;

        return $this;
    }

    /**
     * Gets walkable_lng
     * @return double
     */
    public function getWalkableLng()
    {
        return $this->container['walkable_lng'];
    }

    /**
     * Sets walkable_lng
     * @param double $walkable_lng Longitude to use for walking directions to the location, as provided by you  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setWalkableLng($walkable_lng)
    {
        $this->container['walkable_lng'] = $walkable_lng;

        return $this;
    }

    /**
     * Gets pickup_lat
     * @return double
     */
    public function getPickupLat()
    {
        return $this->container['pickup_lat'];
    }

    /**
     * Sets pickup_lat
     * @param double $pickup_lat Latitude to use for pickup spot for the location, as provided by you  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setPickupLat($pickup_lat)
    {
        $this->container['pickup_lat'] = $pickup_lat;

        return $this;
    }

    /**
     * Gets pickup_lng
     * @return double
     */
    public function getPickupLng()
    {
        return $this->container['pickup_lng'];
    }

    /**
     * Sets pickup_lng
     * @param double $pickup_lng Longitude to use for pickup spot for the location, as provided by you  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setPickupLng($pickup_lng)
    {
        $this->container['pickup_lng'] = $pickup_lng;

        return $this;
    }

    /**
     * Gets dropoff_lat
     * @return double
     */
    public function getDropoffLat()
    {
        return $this->container['dropoff_lat'];
    }

    /**
     * Sets dropoff_lat
     * @param double $dropoff_lat Latitude to use for drop off spot for the location, as provided by you  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setDropoffLat($dropoff_lat)
    {
        $this->container['dropoff_lat'] = $dropoff_lat;

        return $this;
    }

    /**
     * Gets dropoff_lng
     * @return double
     */
    public function getDropoffLng()
    {
        return $this->container['dropoff_lng'];
    }

    /**
     * Sets dropoff_lng
     * @param double $dropoff_lng Longitude to use for drop off spot for the location, as provided by you  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setDropoffLng($dropoff_lng)
    {
        $this->container['dropoff_lng'] = $dropoff_lng;

        return $this;
    }

    /**
     * Gets yext_display_lat
     * @return double
     */
    public function getYextDisplayLat()
    {
        return $this->container['yext_display_lat'];
    }

    /**
     * Sets yext_display_lat
     * @param double $yext_display_lat Latitude where the map pin should be displayed, as calculated by Yext  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setYextDisplayLat($yext_display_lat)
    {
        $this->container['yext_display_lat'] = $yext_display_lat;

        return $this;
    }

    /**
     * Gets yext_display_lng
     * @return double
     */
    public function getYextDisplayLng()
    {
        return $this->container['yext_display_lng'];
    }

    /**
     * Sets yext_display_lng
     * @param double $yext_display_lng Longitude where the map pin should be displayed, as calculated by Yext  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setYextDisplayLng($yext_display_lng)
    {
        $this->container['yext_display_lng'] = $yext_display_lng;

        return $this;
    }

    /**
     * Gets yext_routable_lat
     * @return double
     */
    public function getYextRoutableLat()
    {
        return $this->container['yext_routable_lat'];
    }

    /**
     * Sets yext_routable_lat
     * @param double $yext_routable_lat Latitude to use for driving directions to the location, as calculated by Yext  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setYextRoutableLat($yext_routable_lat)
    {
        $this->container['yext_routable_lat'] = $yext_routable_lat;

        return $this;
    }

    /**
     * Gets yext_routable_lng
     * @return double
     */
    public function getYextRoutableLng()
    {
        return $this->container['yext_routable_lng'];
    }

    /**
     * Sets yext_routable_lng
     * @param double $yext_routable_lng Longitude to use for driving directions to the location, as calculated by Yext  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setYextRoutableLng($yext_routable_lng)
    {
        $this->container['yext_routable_lng'] = $yext_routable_lng;

        return $this;
    }

    /**
     * Gets yext_walkable_lat
     * @return double
     */
    public function getYextWalkableLat()
    {
        return $this->container['yext_walkable_lat'];
    }

    /**
     * Sets yext_walkable_lat
     * @param double $yext_walkable_lat Latitude to use for walking directions to the location, as calculated by Yext  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setYextWalkableLat($yext_walkable_lat)
    {
        $this->container['yext_walkable_lat'] = $yext_walkable_lat;

        return $this;
    }

    /**
     * Gets yext_walkable_lng
     * @return double
     */
    public function getYextWalkableLng()
    {
        return $this->container['yext_walkable_lng'];
    }

    /**
     * Sets yext_walkable_lng
     * @param double $yext_walkable_lng Longitude to use for walking directions to the location, as calculated by Yext  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setYextWalkableLng($yext_walkable_lng)
    {
        $this->container['yext_walkable_lng'] = $yext_walkable_lng;

        return $this;
    }

    /**
     * Gets yext_pickup_lat
     * @return double
     */
    public function getYextPickupLat()
    {
        return $this->container['yext_pickup_lat'];
    }

    /**
     * Sets yext_pickup_lat
     * @param double $yext_pickup_lat Latitude to use for pickup spot for the location, as calculated by Yext  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setYextPickupLat($yext_pickup_lat)
    {
        $this->container['yext_pickup_lat'] = $yext_pickup_lat;

        return $this;
    }

    /**
     * Gets yext_pickup_lng
     * @return double
     */
    public function getYextPickupLng()
    {
        return $this->container['yext_pickup_lng'];
    }

    /**
     * Sets yext_pickup_lng
     * @param double $yext_pickup_lng Longitude to use for pickup spot for the location, as calculated by Yext  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setYextPickupLng($yext_pickup_lng)
    {
        $this->container['yext_pickup_lng'] = $yext_pickup_lng;

        return $this;
    }

    /**
     * Gets yext_dropoff_lat
     * @return double
     */
    public function getYextDropoffLat()
    {
        return $this->container['yext_dropoff_lat'];
    }

    /**
     * Sets yext_dropoff_lat
     * @param double $yext_dropoff_lat Latitude to use for drop off spot for the location, as calculated by Yext  Between -90.0 and 90.0, inclusive
     * @return $this
     */
    public function setYextDropoffLat($yext_dropoff_lat)
    {
        $this->container['yext_dropoff_lat'] = $yext_dropoff_lat;

        return $this;
    }

    /**
     * Gets yext_dropoff_lng
     * @return double
     */
    public function getYextDropoffLng()
    {
        return $this->container['yext_dropoff_lng'];
    }

    /**
     * Sets yext_dropoff_lng
     * @param double $yext_dropoff_lng Longitude to use for drop off spot for the location, as calculated by Yext  Between -180.0 and 180.0, inclusive
     * @return $this
     */
    public function setYextDropoffLng($yext_dropoff_lng)
    {
        $this->container['yext_dropoff_lng'] = $yext_dropoff_lng;

        return $this;
    }

    /**
     * Gets emails
     * @return string[]
     */
    public function getEmails()
    {
        return $this->container['emails'];
    }

    /**
     * Sets emails
     * @param string[] $emails Up to five emails addresses for reaching this location  Must be valid email addresses
     * @return $this
     */
    public function setEmails($emails)
    {
        $this->container['emails'] = $emails;

        return $this;
    }

    /**
     * Gets specialties
     * @return string[]
     */
    public function getSpecialties()
    {
        return $this->container['specialties'];
    }

    /**
     * Sets specialties
     * @param string[] $specialties Up to 100 specialties (e.g., for food and dining: Chicago style)  All strings must be non-empty when trimmed of whitespace.
     * @return $this
     */
    public function setSpecialties($specialties)
    {
        $this->container['specialties'] = $specialties;

        return $this;
    }

    /**
     * Gets associations
     * @return string[]
     */
    public function getAssociations()
    {
        return $this->container['associations'];
    }

    /**
     * Sets associations
     * @param string[] $associations Up to 100 association memberships relevant to the location (e.g., New York Doctors Association)  All strings must be non-empty when trimmed of whitespace.
     * @return $this
     */
    public function setAssociations($associations)
    {
        $this->container['associations'] = $associations;

        return $this;
    }

    /**
     * Gets products
     * @return string[]
     */
    public function getProducts()
    {
        return $this->container['products'];
    }

    /**
     * Sets products
     * @param string[] $products Up to 100 products sold at this location  All strings must be non-empty when trimmed of whitespace.
     * @return $this
     */
    public function setProducts($products)
    {
        $this->container['products'] = $products;

        return $this;
    }

    /**
     * Gets services
     * @return string[]
     */
    public function getServices()
    {
        return $this->container['services'];
    }

    /**
     * Sets services
     * @param string[] $services Up to 100 services offered at this location  All strings must be non-empty when trimmed of whitespace.
     * @return $this
     */
    public function setServices($services)
    {
        $this->container['services'] = $services;

        return $this;
    }

    /**
     * Gets brands
     * @return string[]
     */
    public function getBrands()
    {
        return $this->container['brands'];
    }

    /**
     * Sets brands
     * @param string[] $brands Up to 100 brands sold by this location  All strings must be non-empty when trimmed of whitespace.
     * @return $this
     */
    public function setBrands($brands)
    {
        $this->container['brands'] = $brands;

        return $this;
    }

    /**
     * Gets language
     * @return string
     */
    public function getLanguage()
    {
        return $this->container['language'];
    }

    /**
     * Sets language
     * @param string $language Language code of the language in which this location's information is provided. This language is considered the Location's primary language in our system.   If you would like to provide your Location data in more than one language, you can create a Language Profile for each of these additional (alternate) languages.
     * @return $this
     */
    public function setLanguage($language)
    {
        if (!is_null($language) && (strlen($language) > 10)) {
            throw new \InvalidArgumentException('invalid length for $language when calling Location., must be smaller than or equal to 10.');
        }

        $this->container['language'] = $language;

        return $this;
    }

    /**
     * Gets languages
     * @return string[]
     */
    public function getLanguages()
    {
        return $this->container['languages'];
    }

    /**
     * Sets languages
     * @param string[] $languages Up to 100 languages spoken at this location.  All strings must be non-empty when trimmed of whitespace.
     * @return $this
     */
    public function setLanguages($languages)
    {
        $this->container['languages'] = $languages;

        return $this;
    }

    /**
     * Gets keywords
     * @return string[]
     */
    public function getKeywords()
    {
        return $this->container['keywords'];
    }

    /**
     * Sets keywords
     * @param string[] $keywords Up to 100 keywords may be provided  All strings must be non-empty when trimmed of whitespace.
     * @return $this
     */
    public function setKeywords($keywords)
    {
        $this->container['keywords'] = $keywords;

        return $this;
    }

    /**
     * Gets menus_label
     * @return string
     */
    public function getMenusLabel()
    {
        return $this->container['menus_label'];
    }

    /**
     * Sets menus_label
     * @param string $menus_label Label to be used for this location’s Menus. This label will appear on your location's listings.
     * @return $this
     */
    public function setMenusLabel($menus_label)
    {
        $this->container['menus_label'] = $menus_label;

        return $this;
    }

    /**
     * Gets menu_ids
     * @return string[]
     */
    public function getMenuIds()
    {
        return $this->container['menu_ids'];
    }

    /**
     * Sets menu_ids
     * @param string[] $menu_ids IDs of Menus associated with this location.
     * @return $this
     */
    public function setMenuIds($menu_ids)
    {
        $this->container['menu_ids'] = $menu_ids;

        return $this;
    }

    /**
     * Gets bio_lists_label
     * @return string
     */
    public function getBioListsLabel()
    {
        return $this->container['bio_lists_label'];
    }

    /**
     * Sets bio_lists_label
     * @param string $bio_lists_label Label to be used for this location’s Bio lists. This label will appear on your location's listings.
     * @return $this
     */
    public function setBioListsLabel($bio_lists_label)
    {
        $this->container['bio_lists_label'] = $bio_lists_label;

        return $this;
    }

    /**
     * Gets bio_list_ids
     * @return string[]
     */
    public function getBioListIds()
    {
        return $this->container['bio_list_ids'];
    }

    /**
     * Sets bio_list_ids
     * @param string[] $bio_list_ids IDs of Bio lists associated with this location.
     * @return $this
     */
    public function setBioListIds($bio_list_ids)
    {
        $this->container['bio_list_ids'] = $bio_list_ids;

        return $this;
    }

    /**
     * Gets product_lists_label
     * @return string
     */
    public function getProductListsLabel()
    {
        return $this->container['product_lists_label'];
    }

    /**
     * Sets product_lists_label
     * @param string $product_lists_label Services lists. This label will appear on your location's listings.
     * @return $this
     */
    public function setProductListsLabel($product_lists_label)
    {
        $this->container['product_lists_label'] = $product_lists_label;

        return $this;
    }

    /**
     * Gets product_list_ids
     * @return string[]
     */
    public function getProductListIds()
    {
        return $this->container['product_list_ids'];
    }

    /**
     * Sets product_list_ids
     * @param string[] $product_list_ids IDs of Product lists associated with this location.
     * @return $this
     */
    public function setProductListIds($product_list_ids)
    {
        $this->container['product_list_ids'] = $product_list_ids;

        return $this;
    }

    /**
     * Gets event_lists_label
     * @return string
     */
    public function getEventListsLabel()
    {
        return $this->container['event_lists_label'];
    }

    /**
     * Sets event_lists_label
     * @param string $event_lists_label Label to be used for this location’s Event lists. This label will appear on your location's listings.
     * @return $this
     */
    public function setEventListsLabel($event_lists_label)
    {
        $this->container['event_lists_label'] = $event_lists_label;

        return $this;
    }

    /**
     * Gets event_list_ids
     * @return string[]
     */
    public function getEventListIds()
    {
        return $this->container['event_list_ids'];
    }

    /**
     * Sets event_list_ids
     * @param string[] $event_list_ids IDs of Event lists associated with this location.
     * @return $this
     */
    public function setEventListIds($event_list_ids)
    {
        $this->container['event_list_ids'] = $event_list_ids;

        return $this;
    }

    /**
     * Gets folder_id
     * @return string
     */
    public function getFolderId()
    {
        return $this->container['folder_id'];
    }

    /**
     * Sets folder_id
     * @param string $folder_id The folder that this location is in. If the location is in the customer-level (root) folder, its folderId will be 0. Must be a valid, existing Yext Folder ID or 0
     * @return $this
     */
    public function setFolderId($folder_id)
    {
        $this->container['folder_id'] = $folder_id;

        return $this;
    }

    /**
     * Gets label_ids
     * @return string[]
     */
    public function getLabelIds()
    {
        return $this->container['label_ids'];
    }

    /**
     * Sets label_ids
     * @param string[] $label_ids The IDs of the location labels that have been added to this location. Location labels help you identify locations that share a certain characteristic; they do not appear on your location's listings.  **NOTE:** You can only add labels that have already been created via our web interface. Currently, it is not possible to create new labels via the API.
     * @return $this
     */
    public function setLabelIds($label_ids)
    {
        $this->container['label_ids'] = $label_ids;

        return $this;
    }

    /**
     * Gets custom_fields
     * @return map[string,object]
     */
    public function getCustomFields()
    {
        return $this->container['custom_fields'];
    }

    /**
     * Sets custom_fields
     * @param map[string,object] $custom_fields A set of key-value pairs indicating the location's custom fields and their values. The keys are the **`ids`** of the custom fields, and the values are the fields' contents for this location.  To retrieve a list of custom fields for your account, use the Custom Fields: List endpoint.  If a field's **`type`** is `SINGLE_OPTION` or `MULTI_OPTION`, the option or options that apply to this location must be represented by their **`key`**s.  Examples of each type of custom field:  * BOOLEAN:     * `{ \"9662\": \"true\" }` * DAILY_TIMES:     * `{ \"10012\": { \"dailyTimes\": \"2:7:00,3:7:00,4:7:00,5:7:00,6:7:00,7:7:00,1:7:00\" } }` * DATE:     * `{ \"7066\": \"2016-10-12\" }` * GALLERY:     * `{ \"7070\": [ { \"url\": \"http://a.mktgcdn.com/p/ounkg7aq6Oy029-sRf4CIH64/128x128.jpg\" }, { \"url\": \"http://a.mktgcdn.com/p/YkQGqxK8jFBqOlailQ9QIBsgs/1.0000/316x316.png\" } ] }` * HOURS:     * `{ \"10011\": { \"hours\": \"1:7:00:20:00,2:7:00:20:00,3:7:00:20:00,4:7:00:20:00,5:7:00:20:00,6:7:00:20:00,7:7:00:20:00\", \"additionalHoursText\": \"Also by appointment\" }` * MULTILINE_TEXT (up to 4,000 characters):     * `{ \"1592\": \"Take Route 13 south. Pass Riverrun Reservoir. At the traffic light before the post office, turn right off of Route 13. Pass the library and community center on your right and then pass a diner on your left. Cross over the bridge and at the third intersection, turn left onto Jones Street. We are located on the right side in the middle of the block.\" }` * MULTI_OPTION:     * `{ \"7068\": [\"2614\", \"2615\"] }` (`\"2614\"` and `\"2615\"` are the options' **`key`**s) * NUMBER:     * `{ \"7078\": \"123\" }` * PHOTO:     * `{ \"7071\": { \"url\": \"http://a.mktgcdn.com/p/bRtQXQZP2kEzgy2C8/800x800.jpg\", \"description\": \"New storefront\" } }` * SINGLE_OPTION:     * `{ \"7069\": \"2617\" }` (`\"2617\"` is the option's **`key`**) * TEXT (up to 255 characters):     * `{ \"6157\": \"Buy One, Get One 50% Off\" }` * TEXT_LIST:     * `{ \"7072\": [ \"Item 1\", \"Item 2\", \"Item 3\" ] }` * URL:     * `{ \"9381\": \"http://www.location.example.com\" }` * VIDEO:     * `{ \"7077\": { \"url\": \"http://www.youtube.com/watch?v=6KQPho\" } }` * VIDEO_GALLERY:     * `{ \"8452\": [ { \"url\": \"http://www.youtube.com/watch?v=B1EC1U\" }, { \"url\": \"http://www.youtube.com/watch?v=SkEtnN\" } ] }`
     * @return $this
     */
    public function setCustomFields($custom_fields)
    {
        $this->container['custom_fields'] = $custom_fields;

        return $this;
    }

    /**
     * Gets intelligent_search_tracking_enabled
     * @return bool
     */
    public function getIntelligentSearchTrackingEnabled()
    {
        return $this->container['intelligent_search_tracking_enabled'];
    }

    /**
     * Sets intelligent_search_tracking_enabled
     * @param bool $intelligent_search_tracking_enabled Indicates whether Intelligent Search Tracker is enabled.  The Intelligent Search Tracker allows you to understand your performance in local search.
     * @return $this
     */
    public function setIntelligentSearchTrackingEnabled($intelligent_search_tracking_enabled)
    {
        $this->container['intelligent_search_tracking_enabled'] = $intelligent_search_tracking_enabled;

        return $this;
    }

    /**
     * Gets intelligent_search_tracking_frequency
     * @return string
     */
    public function getIntelligentSearchTrackingFrequency()
    {
        return $this->container['intelligent_search_tracking_frequency'];
    }

    /**
     * Sets intelligent_search_tracking_frequency
     * @param string $intelligent_search_tracking_frequency How often we send search queries to track your search performance.
     * @return $this
     */
    public function setIntelligentSearchTrackingFrequency($intelligent_search_tracking_frequency)
    {
        $allowed_values = array('WEEKLY', 'MONTHLY', 'QUARTERLY');
        if (!is_null($intelligent_search_tracking_frequency) && (!in_array($intelligent_search_tracking_frequency, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'intelligent_search_tracking_frequency', must be one of 'WEEKLY', 'MONTHLY', 'QUARTERLY'");
        }
        $this->container['intelligent_search_tracking_frequency'] = $intelligent_search_tracking_frequency;

        return $this;
    }

    /**
     * Gets location_keywords
     * @return string[]
     */
    public function getLocationKeywords()
    {
        return $this->container['location_keywords'];
    }

    /**
     * Sets location_keywords
     * @param string[] $location_keywords Keywords that we will use to track your search performance. These keywords are based on the location information you've stored in our system.
     * @return $this
     */
    public function setLocationKeywords($location_keywords)
    {
        $allowed_values = array('NAME', 'PRIMARY_CATEGORY');
        if (!is_null($location_keywords) && (array_diff($location_keywords, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'location_keywords', must be one of 'NAME', 'PRIMARY_CATEGORY'");
        }
        $this->container['location_keywords'] = $location_keywords;

        return $this;
    }

    /**
     * Gets custom_keywords
     * @return string[]
     */
    public function getCustomKeywords()
    {
        return $this->container['custom_keywords'];
    }

    /**
     * Sets custom_keywords
     * @param string[] $custom_keywords Additional keywords you would like us to use when tracking your search performance
     * @return $this
     */
    public function setCustomKeywords($custom_keywords)
    {
        $this->container['custom_keywords'] = $custom_keywords;

        return $this;
    }

    /**
     * Gets query_templates
     * @return string[]
     */
    public function getQueryTemplates()
    {
        return $this->container['query_templates'];
    }

    /**
     * Sets query_templates
     * @param string[] $query_templates The ways in which your keywords will be arranged in the search queries we use to track your performance
     * @return $this
     */
    public function setQueryTemplates($query_templates)
    {
        $allowed_values = array('KEYWORD', 'KEYWORD_ZIP', 'KEYWORD_CITY', 'KEYWORD_IN_CITY', 'KEYWORD_NEAR_ME', 'KEYWORD_CITY_STATE');
        if (!is_null($query_templates) && (array_diff($query_templates, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'query_templates', must be one of 'KEYWORD', 'KEYWORD_ZIP', 'KEYWORD_CITY', 'KEYWORD_IN_CITY', 'KEYWORD_NEAR_ME', 'KEYWORD_CITY_STATE'");
        }
        $this->container['query_templates'] = $query_templates;

        return $this;
    }

    /**
     * Gets alternate_names
     * @return string[]
     */
    public function getAlternateNames()
    {
        return $this->container['alternate_names'];
    }

    /**
     * Sets alternate_names
     * @param string[] $alternate_names Other names for your business that you would like us to use when tracking your search performance
     * @return $this
     */
    public function setAlternateNames($alternate_names)
    {
        $this->container['alternate_names'] = $alternate_names;

        return $this;
    }

    /**
     * Gets alternate_websites
     * @return string[]
     */
    public function getAlternateWebsites()
    {
        return $this->container['alternate_websites'];
    }

    /**
     * Sets alternate_websites
     * @param string[] $alternate_websites Other websites for your business that we should look for when tracking your search performance
     * @return $this
     */
    public function setAlternateWebsites($alternate_websites)
    {
        $this->container['alternate_websites'] = $alternate_websites;

        return $this;
    }

    /**
     * Gets competitors
     * @return \Yext\Client\Model\LocationCompetitors[]
     */
    public function getCompetitors()
    {
        return $this->container['competitors'];
    }

    /**
     * Sets competitors
     * @param \Yext\Client\Model\LocationCompetitors[] $competitors The names and websites of the competitors whose search performance you would like to compare to your own
     * @return $this
     */
    public function setCompetitors($competitors)
    {
        $this->container['competitors'] = $competitors;

        return $this;
    }

    /**
     * Gets tracking_sites
     * @return string[]
     */
    public function getTrackingSites()
    {
        return $this->container['tracking_sites'];
    }

    /**
     * Sets tracking_sites
     * @param string[] $tracking_sites The search engines that we will use to track your performance
     * @return $this
     */
    public function setTrackingSites($tracking_sites)
    {
        $allowed_values = array('GOOGLE_DESKTOP', 'GOOGLE_MOBILE', 'BING_DESKTOP', 'YAHOO_DESKTOP');
        if (!is_null($tracking_sites) && (array_diff($tracking_sites, $allowed_values))) {
            throw new \InvalidArgumentException("Invalid value for 'tracking_sites', must be one of 'GOOGLE_DESKTOP', 'GOOGLE_MOBILE', 'BING_DESKTOP', 'YAHOO_DESKTOP'");
        }
        $this->container['tracking_sites'] = $tracking_sites;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Yext\Client\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Yext\Client\ObjectSerializer::sanitizeForSerialization($this));
    }
}


