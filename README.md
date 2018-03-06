
[![Github All Releases](https://img.shields.io/github/downloads/moometric/GSuiteSignatureManager/total.svg?maxAge=3600)](https://github.com/moometric/GSuiteSignatureManager) [![Version](http://img.shields.io/packagist/v/moometric/GSuite.svg?style=flat&maxAge=3600)](https://packagist.org/packages/moometric/GSuite) [![License](http://img.shields.io/:license-mit-blue.svg)](http://doge.mit-license.org)


# GSuite Signature Manager (PHP)
Ensure that all your users have a standard signature by updating them using the gmail API. Users signatures can be updated direct from the GSuite users directory using standard and custom fields or alternatively from a JSON users file.

![alt text](https://raw.githubusercontent.com/moometric/GSuiteSignatureManager/master/sig.png "GSuite Signature Manager")

- **defaultSig.html** template is included, you can add your own templates to the "signatures" directory.
- **testUsers.json** JSON file is included as an example when fetching users from local source rather than GSuite domain.

## Getting Started

### Prerequisites

- You are a GSuite domain admin with full super admin access
- Make sure your are running at least PHP 5.4+
- Your PHP server can read files from the **local_vars** and **signatures** directory (after installing)

### Installing

#### Step 1: Create your service account
Ensure that you have gone through the steps *[described here](https://moometric.com/integrations/gsuite/use-gmail-api-update-signatures-gsuite-users-php/#Setup_the_gmail_API)* to get your **service-account.json** file. More information can be found on the [Google Admin SDK Guide](https://developers.google.com/admin-sdk/directory/v1/guides/delegation#create_the_service_account_and_its_credentials) to setting up a service account for your GSuite domain.

```
Copy your service-account.json file into the local_vars directory
```

#### Step 2: Grant Domain Wide Delegation
Ensure that you have *[granted domain wide delegation](https://developers.google.com/admin-sdk/directory/v1/guides/delegation#delegate_domain-wide_authority_to_your_service_account)* through the GSuite console for the following scopes of your service account
```
https://www.googleapis.com/auth/admin.directory.user', 'https://www.googleapis.com/auth/admin.directory.user.alias', 'https://www.googleapis.com/auth/admin.directory.userschema','https://www.googleapis.com/auth/gmail.settings.basic','https://www.googleapis.com/auth/gmail.settings.sharing
```

#### Step 3: Install or clone this repo
```
composer require moometric/gsuite
```
OR
```
git clone https://github.com/moometric/GSuiteSignatureManager.git
```

#### Step 4: Update your signature template
By default there is a signature template located in **"signatures/defaultSig.html"**. You can modify this template and include your own MERGE fields.

Merge fields are in the following format **{{mergeFieldOne}}**. If you're not sure what merge fields you can use, use *[listMergeFields()](#user-content-see-a-list-of-available-merge-tags)* function to view a list of available merge tags.

#### Step 5: Instantiate the signature object
If using composer, don't forget to include your autoload file.

```php
require_once '/path/to/your-project/vendor/autoload.php';
```

```php
use Moometric\mooSignature;
$mooSig = new mooSignature("primaryDomain.com", "adminEmail@primaryDomain.com");
```

### Testing

Included is an **index.php** file which contains a few tests to get started.

Once you go live, ensure that you switch off testing mode.

## Usage Examples

### **Message of the day**

#### Set/Update the MOTD for all GSuite users
This will set "Hello World" as the MOTD for all GSuite users

```php
$mooSig->addSettingMOTDHTML("<span style=\"color: red;\">Hello World</span>");
$mooSig->addSettingMOTDPosition("Below");
$mooSig->addSettingMOTD(True);
$mooSig->setSignatureMOTD();
```

#### Removing the MOTD for all GSuite users
If exists, this will remove MOTD for all GSuite users

```php
$mooSig->removeSignatureMOTD();
```

#### Set/Update/Remove MOTD for select GSuite users
If you only want certain GSuite users to have a MOTD, you can filter the users by their primary email.

```php
$mooSig->addSettingMOTDHTML("<span style=\"color: red;\">Marketing Department MOTD</span>");
$mooSig->addSettingFilterEmailsToUpdate(["fakeEmail@moometric.com", "anotherEmail@moometric.com"]);
$mooSig->setSignatureMOTD();
```

Or remove MOTD from those same select users

```php
$mooSig->removeSignatureMOTD();
```

### **Updating the signature**

#### Update signature for all domain users
Update the signature for all domain users from the default template.

```php
$mooSig->addSettingSetTemplate("defaultSig.html");
$mooSig->updateSignatures();
```

#### Update signature for all domain users and set MOTD
Update the signature for all domain users from the default template.

```php
$mooSig->addSettingMOTDHTML("<span style=\"color: red;\">Hello World</span>");
$mooSig->updateSignatures();
```

#### Update signature for only certain users or single user
Update the signature for all domain users from the default template. In the example below only *fakeEmail@moometric.com* and *anotherEmail@moometric.com* will be updated, all other users will be excluded

```php
$mooSig->addSettingFilterEmailsToUpdate(["fakeEmail@moometric.com", "anotherEmail@moometric.com"]);
$mooSig->updateSignatures();
```

#### Exclude users who don't have their profile photo set
Update the signature for all domain users but exclude those who don't have a profile photo or title set.

```php
$mooSig->addSettingSkipConditions(["title", "thumbnailPhotoUrl"]);
$mooSig->updateSignatures();
```

#### Update signature for users in a JSON file
Update the signature for users in the JSON file *testUsers.json*.

```php
$mooSig->addSettingUsersFile("testUsers.json");
$mooSig->updateSignatures();
```

#### Update signature for users in your own array
In this example only users who are in the array below will be updated with a new signature. Two users below will be updated.

```php
$mooSig->addSettingUserArray([
	[
		"primaryEmail" => "fakeEmail@moometric.com", 
		"alias" => "fakeEmail@moometric.com", 
		"fullName" => "MooMaster",
	],
	[
		"primaryEmail" => "anotherEmail@moometric.com", 
		"alias" => "anotherEmail@moometric.com", 
		"fullName" => "MooMinor",
	]
]);
$mooSig->updateSignatures();
```

### **Other examples**

#### See a list of available merge tags
If you want to see what merge fields are available for use in your template, you can run the following function to echo and output to your browser.

```php
$mooSig->listMergeFields();
```

**Output will look something like this**

<table><tbody><tr><th style="border: 1px solid;">Merge Tag</th><th style="border: 1px solid;">Example</th></tr><tr><td style="border: 1px solid;">{{primaryEmail}}</td><td style="border: 1px solid;">fakeEmail@moometric.com</td></tr><tr><td style="border: 1px solid;">{{alias}}</td><td style="border: 1px solid;">fakeEmail@moometric.com</td></tr><tr><td style="border: 1px solid;">{{thumbnailPhotoUrl}}</td><td style="border: 1px solid;">http://i.imgur.com/mmvUt5x.png</td></tr><tr><td style="border: 1px solid;">{{fullName}}</td><td style="border: 1px solid;">MooMaster</td></tr><tr><td style="border: 1px solid;">{{phone0}}</td><td style="border: 1px solid;">555-555-555</td></tr><tr><td style="border: 1px solid;">{{title}}</td><td style="border: 1px solid;">IT Admin / Developer</td></tr></tbody></table>


## Settings

### **Basic Settings**

#### Run test mode *(Default - True)*
During test mode no signatures are updated
```php
$mooSig->addSettingRunTestMode(True);
```

#### Preview the output HTML *(Default - True)*
When testing, echo the signature into your browser
```php
$mooSig->addSettingPreviewSignature(True);
```

#### Get users from GSuite *(Default - True)*
Rather than JSON or other array. Default is True. Will default to False if you use specify a JSON array or another array source after this flag has been set.
```php
$mooSig->addSettingGetUsersFromGsuite(True);
```

#### Set the template *(Default - defaultSig.html)*
you wish to use that is located in the subfolder "/signatures"
```php
mooSig->addSettingSetTemplate("defaultSig.html");
```

#### Strip unused tags *(Default = True)*
that start and end with '{{' '}}' when generating the template. Switch to False when debugging.
```php
$mooSig->addSettingStripBlanks(True);
```

### **User Filters**

#### Skip fields *(Default = [])*
Skip updates if any of the fields are NULL, BLANK or don't exist. Useful when updating users that might have blank values that need to be updated before their signature is created. In the example below, we're skipping the signature update for users that don't have their title or profile picture set.
```php
$mooSig->addSettingSkipConditions(["title", "thumbnailPhotoUrl"]);
```

#### Filter email addresses to update *(Default = [])*
Enter the primaryEmail addresses that you wish you update. Any emails that aren't included here won't be updated.
```php
$mooSig->addSettingFilterEmailsToUpdate(["fakeEmail@moometric.com", "anotherEmail@moometric.com"]);
```

#### Unset all current filters
If filters have been applied, you can unset them all using the following. Useful if you're chaining a whole heap of bulk updates with many different changing filters
```php
$mooSig->addSettingUnsetFilters();
```

### **MOTD Message of the day Settings**

#### Set MOTD position *(Default = "Below")*
Set where the MOTD appears (Above or Below) on the signature.
```php
$mooSig->addSettingMOTDPosition("Below");
```

#### Set HTML for MOTD *(Default = "")*
String value of the HTML that you want to include in the email signature.
```php
$mooSig->addSettingMOTDHTML("<span style=\"color: red;\">Hello World</span>");
```

#### Set MOTD when generating template *(Default = True)*
If you don't set the MOTD HTML, this will have no effect. Otherwise when the template for a user is generated, the MOTD will be included upon generation. 
```php
$mooSig->addSettingMOTD(True);
```

### **Other Settings**

#### Get users from array *(Default = [])*
If you would prefer to get the users details from an array rather than the GSuite directory, you can push your own custom users array along with all the details for the signatures you wish to update. For this option you must include the **primaryEmail** and **alias** in each user array.
```php
$mooSig->addSettingUserArray([
	[
		"primaryEmail" => "fakeEmail@moometric.com", 
		"alias" => "fakeEmail@moometric.com", 
		"thumbnailPhotoUrl" => "http://i.imgur.com/mmvUt5x.png",
		"fullName" => "MooMaster",
		"phone0" => "555-555-555",
		"title" => "IT Admin / Developer"
	],
	[
		"primaryEmail" => "anotherEmail@moometric.com", 
		"alias" => "anotherEmail@moometric.com", 
		"thumbnailPhotoUrl" => "http://i.imgur.com/mmvUt5x.png",
		"fullName" => "MooMinor",
		"phone0" => "444-444-444",
		"title" => "DevOps Admin"
	]
]);
```

#### Get users from JSON file *(Default = "")*
If you would prefer to get the users details from a JSON file rather than the GSuite directory, you can add your JSON file to the */local_vars* folder instead. For this option you must include the **primaryEmail** and **alias** in each JSON object.
```php
$mooSig->addSettingUsersFile("testUsers.json");
```

**Example JSON File**
```json
[
	{
		"primaryEmail": "fakeEmail@moometric.com",
		"alias": "fakeEmail@moometric.com",
		"thumbnailPhotoUrl": "http://i.imgur.com/mmvUt5x.png",
		"fullName": "MooMaster",
		"phone0": "555-555-555",
		"title": "IT Admin / Developer"
	},
	{
		"primaryEmail": "anotherEmail@moometric.com",
		"alias": "anotherEmail@moometric.com",
		"thumbnailPhotoUrl": "http://i.imgur.com/mmvUt5x.png",
		"fullName": "MooMinor",
		"phone0": "444-444-444",
		"title": "DevOps Admin"
	}
]
```

## Authors
- MooMaster - *initial work* - [Moometric.com](https://moometric.com/)

## License

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/moometric/GSuiteSignatureManager/blob/master/LICENSE) file for details
