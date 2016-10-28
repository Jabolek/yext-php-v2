<?php
/**
 * LocationTest
 *
 * PHP version 5
 *
 * @category Class
 * @package  Yext\Client
 * @author   http://github.com/swagger-api/swagger-codegen
 * @license  http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Yext API
 *
 * # Policies and Conventions  This section gives you the basic information you need to use our APIs.  ## Authentication All requests must be authenticated using an app’s API key.  <pre>GET https://api.yext.com/v2/accounts/[accountId]/locations?<b>api_key=API_KEY</b>&v=YYYYMMDD</pre>  The API key should be kept secret, as each app has exactly one API key.  ## Versioning All requests must be versioned using the **`v`** parameter.   <pre>GET https://api.yext.com/v2/accounts/[accountId]/locations?api_key=API_KEY&<b>v=YYYYMMDD</b></pre>  The **`v`** parameter (a date in `YYYYMMDD` format) is designed to give you the freedom to adapt to Yext API changes on your own schedule. When you pass this parameter, any changes we made to the API after the specified date will not affect the behavior of the request or the content of the response.  **NOTE:** Yext has the ability to make changes that affect previous versions of the API, if necessary.  ## Serialization API v2 only accepts data in JSON format.  ## Content-Type Headers For all requests that include a request body, the Content-Type header must be included and set to `application/json`.  ## Errors and Warnings There are three kinds of issues that can be reported for a given request:  * **`FATAL_ERROR`**     * An issue caused the entire request to be rejected. * **`NON_FATAL_ERROR`**     * An item is rejected, but other items present in the request are accepted (e.g., one invalid Product List item).      * A field is rejected, but the item otherwise is accepted (e.g., invalid website URL in a Location). * **`WARNING`**     * The request did not adhere to our best practices or recommendations, but the data was accepted anyway (e.g., data was sent that may cause some listings to become unavailable, a deprecated API was used, or we changed the format of a field's content to meet our requirements).  ## Validation Modes *(Available December 2016)*  API v2 will support two request validation modes: *Strict Mode* and *Lenient Mode*.  In Strict Mode, both `FATAL_ERROR`s and `NON_FATAL_ERROR`s are reported simply as `FATAL_ERROR`s, and any error will cause the entire request to fail.  In Lenient Mode, `FATAL_ERROR`s and `NON_FATAL_ERROR`s are reported as such, and only `FATAL_ERROR`s will cause a request to fail.  All requests will be processed in Strict Mode by default.  To activate Lenient Mode, append the parameter `validation=lenient` to your request URLs.  ### Dates and times * We always use milliseconds since epoch (a.k.a. Unix time) for timestamps (e.g., review creation times, webhook update times). * We always use ISO 8601 without timezone for local date times (e.g., Event start time, Event end time). * Dates are transmitted as strings: `“YYYY-MM-DD”`.  ## Account ID In keeping with RESTful design principles, every URL in API v2 has an account ID prefix. This prefix helps to ensure that you have unique URLs for all resources.  In addition to specifying resources by explicit account ID, the following two macros are defined: * **`me`** - refers to the account that owns the API key sent with the request * **`all`** - refers to the account that owns the API key sent with the request, as well as all sub-accounts (recursively)  **IMPORTANT:** The **`me`** macro is supported in all API methods.  The **`all`** macro will only be supported in certain URLs, as noted in the reference documentation.  ### Examples This URL refers to all locations in account 123. <pre>https://api.yext.com/v2/accounts/<b>123</b>/locations?api_key=456&v=20160822</pre>  This URL refers to all locations in the account that owns API key 456. <pre>https://api.yext.com/v2/accounts/<b>me</b>/locations?<b>api_key=456</b>&v=20160822</pre>  This URL refers to all locations in the account that owns API key 456, as well as all locations from any of its child accounts. <pre>https://api.yext.com/v2/accounts/<b>all</b>/locations?<b>api_key=456</b>&v=20160822</pre>  ## Actor Headers *(Available December 2016)*  To attribute changes to a particular user or employee, all requests may be passed with the following headers.  **NOTE:** If you choose to provide actor headers, and we are unable to authenticate the request using the values you provide, the request will result in an error and fail.  * Attribute activity to Admin user via admin login cookie *(for Yext’s use only)*     * Header: `YextEmployee`     * Value: Admin user’s AlphaLogin cookie * Attribute activity to Admin user via email address and password     * Headers: `YextEmployeeEmail`, `YextEmployeePassword`     * Values: Admin user’s email address, Admin user’s Admin password * Attribute activity to customer user via login cookie     * Header: `YextUser`     * Value: Customer user’s YextAppsLogin cookie * Attribute activity to customer user via email address and password     * Headers: `YextUserEmail`, `YextUserPassword`     * Values: Customer user’s email address, Customer user’s password  Changes will be logged as follows:  * App with no designated actor     * History Entry \"Updated By\" Value: `App [App ID] - ‘[App Name]’`     * Example: `App 432 - ‘Hello World App’` * App with customer user actor     * History Entry \"Updated By\" Value: `[user name] ([user email]) (App [App ID] - ‘[App Name]’)`     * Example: `Jordan Smith (jsmith@example.com) (App 432 - ‘Hello World App’)` * App with Yext employee actor   * History Entry \"Updated By\" Value: `[employee username] (App [App ID] - ‘[App Name]’)`   * Example: `hlerman (App 432 - ‘Hello World App’)`  ## Response Format * **`meta`**     * Response metadata  * **`meta.uuid`**     * Unique ID for this request / response * **`meta.errors[]`**     * List of errors and warnings  * **`meta.errors[].code`**     * Code that uniquely identifies the error or warning  * **`meta.errors[].type`**     * One of:         * `FATAL_ERROR`         * `NON_FATAL_ERROR`         * `WARNING`     * See \"Errors and Warnings\" above for details. * **`meta.errors[].message`**     * An explanation of the issue * **`response`**     * The main content (body) of the response  Example: <pre><code> {     \"meta\": {         \"uuid\": \"bb0c7e19-4dc3-4891-bfa5-8593b1f124ad\",         \"errors\": [             {                 \"code\": ...error code...,                 \"type\": ...error, fatal error, non fatal error, or warning...,                 \"message\": ...explanation of the issue...             }         ]     },     \"response\": {         ...results...     } } </code></pre>  ## Status Codes * `200 OK`    * Either there are no errors or warnings, or the only issues are of type `WARNING`. * `207 Multi-Status`     * There are errors of type `itemError` or `fieldError` (but none of type `requestError`). * `400 Bad Request`     * A parameter is invalid, or a required parameter is missing. This includes the case where no API key is provided and the case where a resource ID is specified incorrectly in a path.     * This status is if any of the response errors are of type `requestError`. * `401 Unauthorized`     * The API key provided is invalid.     * `403 Forbidden`     * The requested information cannot be viewed by the acting user.  * `404 Not Found`     * The endpoint does not exist. * `405 Method Not Allowed`     * The request is using a method that is not allowed (e.g., POST with a GET-only endpoint). * `409 Conflict`     * The request could not be completed in its current state.     * Use the information included in the response to modify the request and retry. * `429 Too Many Requests`     * You have exceeded your rate limit / quota. * `500 Internal Server Error`     * Yext’s servers are not operating as expected. The request is likely valid but should be resent later. * `504 Timeout`     * Yext’s servers took too long to handle this request, and it timed out.  ## Quotas and Rate Limits Default quotas and rate limits are as follows.  * **Location Cloud API** *(includes Analytics, PowerListings®, Location Manager, Reviews, Social, and User endpoints)*: 5,000 requests per hour * **Administrative API**: 1 qps * **Live API**: 100,000 requests per hour  **NOTE:** Webhook requests do not count towards an account’s quota.  For the most current and accurate rate-limit usage information for a particular request type, check the **`Rate-Limit-Remaining`** and **`Rate-Limit-Limit`** HTTP headers of your API responses.  If you are currently over your limit, our API will return a `429` error, and the response object returned by our API will be empty. We will also include a **`Rate-Limit-Reset`** header in the response, which indicates when you will have additional quota.  ## Client- vs. Yext-assigned IDs You can set the ID for the following objects when you create them. If you do not provide an ID, Yext will generate one for you.  * Account * User * Location * Bio List * Menu List * Product List * Event List * Bio List Item * Menu List Item * Product List Item * Event List Item  ## Logging All API requests are logged. API logs can be found in your Developer Console and are stored for 90 days.
 *
 * OpenAPI spec version: 0.0.2
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Please update the test case below to test the model.
 */

namespace Yext\Client;

/**
 * LocationTest Class Doc Comment
 *
 * @category    Class */
// * @description Location
/**
 * @package     Yext\Client
 * @author      http://github.com/swagger-api/swagger-codegen
 * @license     http://www.apache.org/licenses/LICENSE-2.0 Apache License v2
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class LocationTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Setup before running any test case
     */
    public static function setUpBeforeClass()
    {

    }

    /**
     * Setup before running each test case
     */
    public function setUp()
    {

    }

    /**
     * Clean up after running each test case
     */
    public function tearDown()
    {

    }

    /**
     * Clean up after running all test cases
     */
    public static function tearDownAfterClass()
    {

    }

    /**
     * Test "Location"
     */
    public function testLocation()
    {

    }

    /**
     * Test attribute "id"
     */
    public function testPropertyId()
    {

    }

    /**
     * Test attribute "account_id"
     */
    public function testPropertyAccountId()
    {

    }

    /**
     * Test attribute "timestamp"
     */
    public function testPropertyTimestamp()
    {

    }

    /**
     * Test attribute "location_type"
     */
    public function testPropertyLocationType()
    {

    }

    /**
     * Test attribute "location_name"
     */
    public function testPropertyLocationName()
    {

    }

    /**
     * Test attribute "first_name"
     */
    public function testPropertyFirstName()
    {

    }

    /**
     * Test attribute "middle_name"
     */
    public function testPropertyMiddleName()
    {

    }

    /**
     * Test attribute "last_name"
     */
    public function testPropertyLastName()
    {

    }

    /**
     * Test attribute "office_name"
     */
    public function testPropertyOfficeName()
    {

    }

    /**
     * Test attribute "gender"
     */
    public function testPropertyGender()
    {

    }

    /**
     * Test attribute "npi"
     */
    public function testPropertyNpi()
    {

    }

    /**
     * Test attribute "address"
     */
    public function testPropertyAddress()
    {

    }

    /**
     * Test attribute "address2"
     */
    public function testPropertyAddress2()
    {

    }

    /**
     * Test attribute "suppress_address"
     */
    public function testPropertySuppressAddress()
    {

    }

    /**
     * Test attribute "display_address"
     */
    public function testPropertyDisplayAddress()
    {

    }

    /**
     * Test attribute "city"
     */
    public function testPropertyCity()
    {

    }

    /**
     * Test attribute "state"
     */
    public function testPropertyState()
    {

    }

    /**
     * Test attribute "zip"
     */
    public function testPropertyZip()
    {

    }

    /**
     * Test attribute "country_code"
     */
    public function testPropertyCountryCode()
    {

    }

    /**
     * Test attribute "service_area"
     */
    public function testPropertyServiceArea()
    {

    }

    /**
     * Test attribute "phone"
     */
    public function testPropertyPhone()
    {

    }

    /**
     * Test attribute "is_phone_tracked"
     */
    public function testPropertyIsPhoneTracked()
    {

    }

    /**
     * Test attribute "local_phone"
     */
    public function testPropertyLocalPhone()
    {

    }

    /**
     * Test attribute "alternate_phone"
     */
    public function testPropertyAlternatePhone()
    {

    }

    /**
     * Test attribute "fax_phone"
     */
    public function testPropertyFaxPhone()
    {

    }

    /**
     * Test attribute "mobile_phone"
     */
    public function testPropertyMobilePhone()
    {

    }

    /**
     * Test attribute "toll_free_phone"
     */
    public function testPropertyTollFreePhone()
    {

    }

    /**
     * Test attribute "tty_phone"
     */
    public function testPropertyTtyPhone()
    {

    }

    /**
     * Test attribute "category_ids"
     */
    public function testPropertyCategoryIds()
    {

    }

    /**
     * Test attribute "featured_message"
     */
    public function testPropertyFeaturedMessage()
    {

    }

    /**
     * Test attribute "featured_message_url"
     */
    public function testPropertyFeaturedMessageUrl()
    {

    }

    /**
     * Test attribute "website_url"
     */
    public function testPropertyWebsiteUrl()
    {

    }

    /**
     * Test attribute "display_website_url"
     */
    public function testPropertyDisplayWebsiteUrl()
    {

    }

    /**
     * Test attribute "reservation_url"
     */
    public function testPropertyReservationUrl()
    {

    }

    /**
     * Test attribute "hours"
     */
    public function testPropertyHours()
    {

    }

    /**
     * Test attribute "additional_hours_text"
     */
    public function testPropertyAdditionalHoursText()
    {

    }

    /**
     * Test attribute "holiday_hours"
     */
    public function testPropertyHolidayHours()
    {

    }

    /**
     * Test attribute "description"
     */
    public function testPropertyDescription()
    {

    }

    /**
     * Test attribute "conditions_treated"
     */
    public function testPropertyConditionsTreated()
    {

    }

    /**
     * Test attribute "certifications"
     */
    public function testPropertyCertifications()
    {

    }

    /**
     * Test attribute "education_list"
     */
    public function testPropertyEducationList()
    {

    }

    /**
     * Test attribute "admitting_hospitals"
     */
    public function testPropertyAdmittingHospitals()
    {

    }

    /**
     * Test attribute "accepting_new_patients"
     */
    public function testPropertyAcceptingNewPatients()
    {

    }

    /**
     * Test attribute "closed"
     */
    public function testPropertyClosed()
    {

    }

    /**
     * Test attribute "payment_options"
     */
    public function testPropertyPaymentOptions()
    {

    }

    /**
     * Test attribute "insurance_accepted"
     */
    public function testPropertyInsuranceAccepted()
    {

    }

    /**
     * Test attribute "logo"
     */
    public function testPropertyLogo()
    {

    }

    /**
     * Test attribute "photos"
     */
    public function testPropertyPhotos()
    {

    }

    /**
     * Test attribute "headshot"
     */
    public function testPropertyHeadshot()
    {

    }

    /**
     * Test attribute "video_urls"
     */
    public function testPropertyVideoUrls()
    {

    }

    /**
     * Test attribute "instagram_handle"
     */
    public function testPropertyInstagramHandle()
    {

    }

    /**
     * Test attribute "twitter_handle"
     */
    public function testPropertyTwitterHandle()
    {

    }

    /**
     * Test attribute "google_website_override"
     */
    public function testPropertyGoogleWebsiteOverride()
    {

    }

    /**
     * Test attribute "google_cover_photo"
     */
    public function testPropertyGoogleCoverPhoto()
    {

    }

    /**
     * Test attribute "google_profile_photo"
     */
    public function testPropertyGoogleProfilePhoto()
    {

    }

    /**
     * Test attribute "google_preferred_photo"
     */
    public function testPropertyGooglePreferredPhoto()
    {

    }

    /**
     * Test attribute "google_attributes"
     */
    public function testPropertyGoogleAttributes()
    {

    }

    /**
     * Test attribute "facebook_page_url"
     */
    public function testPropertyFacebookPageUrl()
    {

    }

    /**
     * Test attribute "facebook_cover_photo"
     */
    public function testPropertyFacebookCoverPhoto()
    {

    }

    /**
     * Test attribute "facebook_profile_picture"
     */
    public function testPropertyFacebookProfilePicture()
    {

    }

    /**
     * Test attribute "uber_link_type"
     */
    public function testPropertyUberLinkType()
    {

    }

    /**
     * Test attribute "uber_link_text"
     */
    public function testPropertyUberLinkText()
    {

    }

    /**
     * Test attribute "uber_trip_branding_text"
     */
    public function testPropertyUberTripBrandingText()
    {

    }

    /**
     * Test attribute "uber_trip_branding_url"
     */
    public function testPropertyUberTripBrandingUrl()
    {

    }

    /**
     * Test attribute "uber_client_id"
     */
    public function testPropertyUberClientId()
    {

    }

    /**
     * Test attribute "uber_embed_code"
     */
    public function testPropertyUberEmbedCode()
    {

    }

    /**
     * Test attribute "uber_link"
     */
    public function testPropertyUberLink()
    {

    }

    /**
     * Test attribute "year_established"
     */
    public function testPropertyYearEstablished()
    {

    }

    /**
     * Test attribute "display_lat"
     */
    public function testPropertyDisplayLat()
    {

    }

    /**
     * Test attribute "routable_lat"
     */
    public function testPropertyRoutableLat()
    {

    }

    /**
     * Test attribute "yext_display_lat"
     */
    public function testPropertyYextDisplayLat()
    {

    }

    /**
     * Test attribute "yext_routable_lat"
     */
    public function testPropertyYextRoutableLat()
    {

    }

    /**
     * Test attribute "emails"
     */
    public function testPropertyEmails()
    {

    }

    /**
     * Test attribute "specialties"
     */
    public function testPropertySpecialties()
    {

    }

    /**
     * Test attribute "associations"
     */
    public function testPropertyAssociations()
    {

    }

    /**
     * Test attribute "products"
     */
    public function testPropertyProducts()
    {

    }

    /**
     * Test attribute "services"
     */
    public function testPropertyServices()
    {

    }

    /**
     * Test attribute "brands"
     */
    public function testPropertyBrands()
    {

    }

    /**
     * Test attribute "languages"
     */
    public function testPropertyLanguages()
    {

    }

    /**
     * Test attribute "keywords"
     */
    public function testPropertyKeywords()
    {

    }

    /**
     * Test attribute "menus_label"
     */
    public function testPropertyMenusLabel()
    {

    }

    /**
     * Test attribute "menu_ids"
     */
    public function testPropertyMenuIds()
    {

    }

    /**
     * Test attribute "bio_lists_label"
     */
    public function testPropertyBioListsLabel()
    {

    }

    /**
     * Test attribute "bio_list_ids"
     */
    public function testPropertyBioListIds()
    {

    }

    /**
     * Test attribute "product_lists_label"
     */
    public function testPropertyProductListsLabel()
    {

    }

    /**
     * Test attribute "product_list_ids"
     */
    public function testPropertyProductListIds()
    {

    }

    /**
     * Test attribute "event_lists_label"
     */
    public function testPropertyEventListsLabel()
    {

    }

    /**
     * Test attribute "event_list_ids"
     */
    public function testPropertyEventListIds()
    {

    }

    /**
     * Test attribute "folder_id"
     */
    public function testPropertyFolderId()
    {

    }

    /**
     * Test attribute "label_ids"
     */
    public function testPropertyLabelIds()
    {

    }

    /**
     * Test attribute "custom_fields"
     */
    public function testPropertyCustomFields()
    {

    }

}
