<?php
require __DIR__ . '/vendor/autoload.php';

use Moometric\mooSignature;
// Update with your GSuite domain and admin email address
$admin_email = "admin@domain.com";
$domain = "domain.com";
$sigPath ="/your/project/path/signatures/";
$serviceAccountPath = "/your/project/path/local_vars/";

$mooSig = new mooSignature($domain, $admin_email);

// OPTIONAL - Setting the service account path and signature path if not using default location
//$mooSig->addSettingServiceAccountPath($serviceAccountPath);
//$mooSig->addsettingSignaturePath($sigPath);

// Setting test and preview mode so no changes are written
$mooSig->addSettingRunTestMode(True);
$mooSig->addSettingPreviewSignature(True);

// Setting the default signature
$mooSig->addSettingSetTemplate("defaultSig.html");

echo "<h2>Updating a single user from domain</h2>";
// Example 1: setting a single user from domain
$mooSig->addSettingGetUsersFromGsuite(True);
$mooSig->addSettingFilterEmailsToUpdate(["$admin_email"]);
$mooSig->updateSignatures();

// Example 2: Set the MOTD to "Hello World" in red
echo "<h2>Setting MOTD </h2>";
$mooSig->addSettingMOTDHTML("<span style=\"color: red;\">Hello World</span>");
$mooSig->addSettingMOTDPosition("Below");
$mooSig->addSettingMOTD(True);
$mooSig->setSignatureMOTD();

echo "<h2>List of avaliable merge fields</h2>";
// Example 3: For fun, list avaliable merge fields that can be used in your email template
$mooSig->listMergeFields();

echo "<h2>From array of users</h2>";
// Example 4: setting users from array
$mooSig->addSettingUnsetFilters();
$mooSig->addSettingMOTDHTML("<span style=\"color: red;\">MOTD from Array/JSON</span>");
$mooSig->addSettingUserArray([
							[
								"primaryEmail" => "fakeEmail@moometric.com", 
								"alias" => "fakeEmail@moometric.com", 
								"thumbnailPhotoUrl" => "https://i.imgur.com/JRF8XKq.png",
								"fullName" => "MooMaster",
								"phone0" => "555-555-555",
								"title" => "IT Admin / Developer"
							],
							[
								"primaryEmail" => "anotherEmail@moometric.com", 
								"alias" => "anotherEmail@moometric.com", 
								"thumbnailPhotoUrl" => "https://i.imgur.com/JRF8XKq.png",
								"fullName" => "MooMinor",
								"phone0" => "444-444-444",
								"title" => "DevOps Admin"
							]
						]);
$mooSig->updateSignatures();

echo "<h2>From testUsers.JSON file</h2>";
// Example 5: setting users from JSON file
$mooSig->addSettingUsersFile("testUsers.json");
$mooSig->updateSignatures();



