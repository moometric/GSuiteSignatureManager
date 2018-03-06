<?php 
namespace Moometric;

/**
 * GSuite Gmail Signature Manager
 *
 * @author MooMaster
 */

class mooSignature {
	// Required variables
	public $domain;
	public $admin_email;

	// Object variables updated by functions
	public $user_email;
	public $user_alias;
	public $user_info;
	public $user_array;
	public $alias_array;
	public $currentEmailSignature;

	// Google services that need to be instantiated
	public $googleClient;
	public $googleServiceDirectory;
	public $googleServiceGmail;
	public $googleServiceGmailSendAs;

	// Setting variables and arrays
	public $settingRemoveBlanks = True;
	public $settingEmailTemplate;
	public $settingUsersArrayGsuite = True;

	// Filter settings
	public $settingSkipConditions = [];
	public $settingEmailFilter = [];

	// MOTD Settings
	public $settingMOTDHTML;
	public $settingMOTDPosition = "Below";
	public $settingMOTD = True;
	public $settingTestingMode = False;
	public $settingPreviewTemplate = True;

	// Path settings for local variables/templates
	public $settingJSONPath = __DIR__ . '/../local_vars/';
	public $settingSignaturePath =  __DIR__ . '/../signatures/';
	public $settingServiceAccountPath = __DIR__ . '/../local_vars/';

	public function __construct($domain, $admin_email) {
		$this->domain = $domain;
        $this->admin_email = $admin_email;

		if (file_exists($this->settingServiceAccountPath . 'service-account.json')) {
			$this->settingServiceAccountPath = 'GOOGLE_APPLICATION_CREDENTIALS=' . $this->settingServiceAccountPath . 'service-account.json';
			putenv($this->settingServiceAccountPath);
			mooSignature::googleClientConnect();
		}
		if (file_exists($this->settingSignaturePath . 'defaultSig.html')) {
		$this->settingEmailTemplate = file_get_contents($this->settingSignaturePath . 'defaultSig.html');
		}
    }

// Core Google API Client functions

	public function googleClientConnect() {
		if ($this->settingServiceAccountPath) {
			putenv($this->settingServiceAccountPath);
			$this->googleClient = new \Google_Client();
			$this->googleClient->useApplicationDefaultCredentials();
			$this->googleClient->setScopes(array('https://www.googleapis.com/auth/admin.directory.user', 'https://www.googleapis.com/auth/admin.directory.user.alias', 'https://www.googleapis.com/auth/admin.directory.userschema','https://www.googleapis.com/auth/gmail.settings.basic','https://www.googleapis.com/auth/gmail.settings.sharing'));
			$this->googleServiceDirectory = new \Google_Service_Directory($this->googleClient);
	        $this->googleServiceGmail = new \Google_Service_Gmail($this->googleClient);
	        $this->googleServiceGmailSendAs = new \Google_Service_Gmail_SendAs();
		} else {
			echo "Must set the full path to service-account.json file - Cannot find file $this->settingServiceAccountPath";
		}
		return $this;
	}

	public function getUsersList(){
		$this->googleClient->setSubject($this->admin_email);
		$output = $this->googleServiceDirectory->users->listUsers(Array('domain' => "$this->domain", "projection" => "full"));
		$this->user_array = $output;
		
		return $this;
	}

	public function getUser(){
		$this->googleClient->setSubject($this->admin_email);
		$optParms = array("projection" => "full");
		$this->user_array = $this->googleServiceDirectory->users->get("$this->user_email", $optParms);
		
		return $this;
	}

	public function getUserAlias() {
		$this->alias_array = [];
		$this->googleClient->setSubject("$this->user_email");
		$response = $this->googleServiceGmail->users_settings_sendAs->listUsersSettingsSendAs($this->user_email);
			foreach ($response as $key) {
				$this->alias_array[] = $key['sendAsEmail'];
			}
		
		return $this;
	}

	public function getUserSignature() {
		$this->googleClient->setSubject("$this->user_email");
		$this->currentEmailSignature = $this->googleServiceGmail->users_settings_sendAs->get($this->user_email, $this->user_alias)->getSignature();

		return $this;
	}

	public function setUserSignature() {
		if ($this->settingTestingMode == True) {
			echo "<br>Currently in testing mode - no signature will be updated for alias <strong>$this->user_alias</strong><br>";
		} else {
		$this->googleClient->setSubject($this->user_email);
		$this->googleServiceGmailSendAs->setSignature($this->currentEmailSignature);
		$response = $this->googleServiceGmail->users_settings_sendAs->patch($this->user_email, $this->user_alias, $this->googleServiceGmailSendAs);
		}
		if ($this->settingPreviewTemplate == True) {
			echo $this->currentEmailSignature;
		}
	
		return $this;
	}

// Core user based actions

	public function setSignatureMOTD() {

		if ($this->settingUsersArrayGsuite == False) {
			foreach ($this->user_info as $key => $value) {
				if (mooSignature::functionValidateUsers($key) == False) {
				 	continue;
				 } 
				$this->user_email = $this->user_info[$key]['primaryEmail'];
				$this->user_alias = $this->user_info[$key]['alias'];
				mooSignature::functionMOTDupdate();
			}
			
		} else {
		mooSignature::getUsersList();
		foreach ($this->user_array as $key => $value) {
			mooSignature::functionStripUserAttributes($this->user_array[$key]);
			foreach ($this->user_info as $key => $value) {
				if (mooSignature::functionValidateUsers($key) == False) {
				 	continue;
				 }
				$this->user_email = $this->user_info[$key]['primaryEmail'];
				$this->user_alias = $this->user_info[$key]['alias'];
				mooSignature::functionMOTDupdate();
				}
			}	
		}
		return $this;
	}

	public function removeSignatureMOTD() {
		$this->settingMOTDHTML = "";
		mooSignature::setSignatureMOTD();
		return $this;
	}

	public function updateSignatures() {
		if ($this->settingUsersArrayGsuite == False) {
			mooSignature::functionProcessUsers();
		} else {
		mooSignature::getUsersList();
		foreach ($this->user_array as $key => $value) {
			mooSignature::functionStripUserAttributes($this->user_array[$key]);
			mooSignature::functionProcessUsers();
			}
		}

		return $this;
	}

	public function listMergeFields() {

		if ($this->settingUsersArrayGsuite == True) {
			$this->user_email = $this->admin_email;
			mooSignature::getUser();
			mooSignature::functionStripUserAttributes($this->user_array);
			$source = "First user from $this->domain";
		} else {
			$source = "First user from local JSON/Array";
		}
		echo "<p><strong>$source</strong></p>";
		echo "<table><tr><th style=\"border: 1px solid;\">Merge Tag</th><th style=\"border: 1px solid;\">Example</th></tr>";
		foreach ($this->user_info[0] as $key => $value) {
			echo "<tr><td style=\"border: 1px solid;\">{{" . $key . "}}</td><td style=\"border: 1px solid;\">$value</td></tr>";
		}
		echo "</table>";
	}

//Manipulate data functions

	public function functionMOTDupdate() {
		mooSignature::getUserSignature();
		mooSignature::functionRemoveMOTD();
		mooSignature::functionSetUpdateMOTD();
		mooSignature::setUserSignature();
	}

	public function functionSetUpdateMOTD() {
		$motd = '<div style="min-height:1px">' . $this->settingMOTDHTML . '</div>';
			if ($this->settingMOTDPosition == "Above") {
				$updatedSig = "$motd" . "$this->currentEmailSignature";
			} else {
				$updatedSig = "$this->currentEmailSignature" . "$motd";
			}
		$this->currentEmailSignature = $updatedSig;

		return $this;
	}

	public function functionRemoveMOTD() {
		$dom = new \DOMDocument;
		$dom->encoding = 'utf-8';
		if (!$this->currentEmailSignature) {
			return $this;
		}
		$dom->loadHTML(mb_convert_encoding($this->currentEmailSignature, 'HTML-ENTITIES', 'UTF-8'));
		$xPath = new \DOMXPath($dom);
		$nodes = $xPath->query('//*[@style="min-height:1px"]');
				
			if($nodes->item(0)) {
				$nodes->item(0)->parentNode->removeChild($nodes->item(0));
			}

		$this->currentEmailSignature = $dom->saveHTML();

		return $this;
	}

	public function functionStripUserAttributes($user_array) {
		$count = 0;
		$phoneCount = 0;
		$mdSchemas = [];

		if ($user_array['phones']) {
			foreach ($user_array['phones'] as $key) {
				if ($key["value"]) {
					$mdSchemas["phone" . $phoneCount] = $key["value"];
					++$phoneCount;
				}
			}
		}
		if ($user_array['organizations']) {
			foreach ($user_array['organizations'] as $orgs) {
				foreach ($orgs as $orgKey => $orgValue) {
					if ($orgValue) {
						$mdSchemas[$orgKey] = $orgValue;
					}
				}
			}
		}
		if ($user_array['customSchemas']) {
			foreach ($user_array['customSchemas'] as $schemas) {
				foreach ($schemas as $schemaKey => $schemaValue) {
					if ($schemaValue) {
						$mdSchemas[$schemaKey] = $schemaValue;
					}
				}
			}
		}
		$this->user_email = $user_array['primaryEmail'];
		mooSignature::getUserAlias();
			foreach ($this->alias_array as $key => $value) {
				$count;
				$users[] = ["primaryEmail" => $user_array['primaryEmail'],
							"alias" => $value,
							"fullName" => $user_array['name']['fullName'],
							"givenName" => $user_array['name']['givenName'],
							"familyName" => $user_array['name']['familyName'],
							"websites" => $user_array['websites'],
							"thumbnailPhotoUrl" => $user_array["thumbnailPhotoUrl"]
							];
					foreach ($mdSchemas as $key => $value) {
						if ($value) {
							$users[$count] += ["$key" => "$value"];
						}
					}
					++$count;
				}
		
		$this->user_info = $users;
					
		return $this;
	}

	public function functionValidateUsers($key) {
		if (!empty($this->settingSkipConditions)) {
				foreach ($this->settingSkipConditions as $filters) {
					if (!array_key_exists($filters, $this->user_info[$key]) || !isset($this->user_info[$key][$filters])) {
						return False;
					}
				}
			}
			if (!empty($this->settingEmailFilter)) {
				foreach ($this->settingEmailFilter as $emails) {
					if ($this->user_info[$key]['primaryEmail'] == $emails) {
					return True;
					}
				}
				return False;
			}
		return True;
	}

	public function functionProcessUsers() {
		foreach ($this->user_info as $key => $value) {
			if (mooSignature::functionValidateUsers($key) == False) {
				continue;
			}
			mooSignature::generateTemplate($this->user_info[$key]);
			$this->user_email = $this->user_info[$key]['primaryEmail'];
			$this->user_alias = $this->user_info[$key]['alias'];
			mooSignature::setUserSignature();
		}

		return $this;
	}

	public function generateTemplate($user_info) {
		
		// $user_phone_1 = str_replace("-", " ", $user_phone_2);

		$this->currentEmailSignature = $this->settingEmailTemplate;
		foreach ($user_info as $key => $value) {
			$this->currentEmailSignature = str_replace('{{' . $key . '}}', $value, $this->currentEmailSignature);
		}

		if ($this->settingRemoveBlanks == True) {
			$this->currentEmailSignature = preg_replace("/\{\{[^}\}]+\}\}/","", $this->currentEmailSignature);
		}

		if ($this->settingMOTD == True) {
			mooSignature::functionSetUpdateMOTD();
		}

		return $this;
	}

// Settings functions

	public function addSettingStripBlanks($value) {
		// Remove empty fields from template
		$this->settingRemoveBlanks = $value;

		return $this;
	}

	public function addSettingManualUserEmail($user_email, $user_alias = "default@default.com") {
		// Manually set the user the update
		$this->user_email = $user_email;
		$this->user_alias = $user_alias;

		return $this;
	}

	public function addSettingManualSetSignature($value) {
		// Manually set the Signature
		$this->currentEmailSignature = $value;
	}

	public function addSettingSkipConditions($value) {
		// Check if any keys within array are missing - Skip updating these signatures
		$this->settingSkipConditions = $value;

		return $this;
	}

	public function addSettingSetTemplate($value) {
		// Set a new template located in the "signatures" directory
		$this->settingEmailTemplate = file_get_contents( $this->settingSignaturePath . $value);

		return $this;
	}

	public function addSettingUsersFile($value) {
		// Get list of users and details from JSON file rather than GSuite directory
		$json = json_decode(file_get_contents( $this->settingJSONPath . $value), true);
			if (json_last_error() === 0) {
				if (array_key_exists("primaryEmail", $json[0]) && array_key_exists("alias", $json[0])) {
    				$this->settingUsersArrayGsuite = False;
    				$this->user_info = $json;
    			} else {
    				echo "JSON file is value, but missing required keys, \"primaryEmail\" or \"alias\". Both of these keys are needed to update a users signature";
    			}
			} else {
				echo "Problem with JSON users file";
			}
		return $this;
	}

	public function addSettingUserArray($value) {
		// Create your own users array rather than from GSuite directory
		if (array_key_exists("primaryEmail", $value[0]) && array_key_exists("alias", $value[0])) {
			$this->settingUsersArrayGsuite = False;
			$this->user_info = $value;
		} else {
			echo "Missing required keys, \"primaryEmail\" or \"alias\". Both of these keys are needed to update a users signature";
		}	
	}
	
	public function addSettingMOTDPosition($value) {
		// Set the MOTD position - default is below the current signature
		$this->settingMOTDPosition = $value;

		return $this;
	}

	public function addSettingMOTDHTML($value) {
		// Set the HTML for the MOTD - default is none
		$this->settingMOTDHTML = $value;

		return $this;
	}

	public function addSettingMOTD($value) {
		// Set MOTD and signature at the same time - Default True (If MOTD HTML isn't set, nothing will display for the MOTD anyway)
		$this->settingMOTD = $value;

		return $this;	
	}

	public function addSettingRunTestMode($value) {
		// Run in test mode only - will echo output but not update signatures. Default is false
		$this->settingTestingMode = $value;

		return $this;
	}

	public function addSettingPreviewSignature($value) {
		// Preview the email template that has been generated
		$this->settingPreviewTemplate = $value;

		return $this;
	}

	public function addSettingGetUsersFromGsuite($value) {
		// Change setting to update from file/array or GSuite domain
		$this->settingUsersArrayGsuite = $value;

		return $this;
	}

	public function addSettingFilterEmailsToUpdate($value) {
		$this->settingEmailFilter = $value;

		return $this;
	}

	public function addSettingUnsetFilters() {
		unset($this->settingEmailFilter);
		unset($this->settingSkipConditions);
		$this->settingEmailFilter = [];
		$this->settingSkipConditions = [];

		return $this;
	}

	public function addSettingServiceAccountPath($value) {
		if (strpos($value, 'service-account.json') == True) {
		    $this->settingServiceAccountPath = 'GOOGLE_APPLICATION_CREDENTIALS='. $value;
		} else {
			$this->settingServiceAccountPath = 'GOOGLE_APPLICATION_CREDENTIALS='. $value . 'service-account.json';
		}
		mooSignature::googleClientConnect();

		return $this;
	}

	public function addSettingJSONPath($value) {
		$this->settingJSONPath = $value;

		return $this;	
	}

	public function addsettingSignaturePath($value) {
		$this->settingSignaturePath = $value;

		return $this;	
	}

}

class genericActions {

	public function checkFilePermissions() {
		if (!file_exists(__DIR__ . '/../local_vars/service-account.json')) {
	    echo 'Missing file service-account.json - This file is required to do server to server authentication. Make sure you have MOVED or RENAMED this file and have it in the correct location<br>';
		}
	}
}
