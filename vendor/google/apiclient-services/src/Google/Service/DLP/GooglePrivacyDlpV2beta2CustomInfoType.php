<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

class Google_Service_DLP_GooglePrivacyDlpV2beta2CustomInfoType extends Google_Collection
{
  protected $collection_key = 'detectionRules';
  protected $detectionRulesType = 'Google_Service_DLP_GooglePrivacyDlpV2beta2DetectionRule';
  protected $detectionRulesDataType = 'array';
  protected $dictionaryType = 'Google_Service_DLP_GooglePrivacyDlpV2beta2Dictionary';
  protected $dictionaryDataType = '';
  protected $infoTypeType = 'Google_Service_DLP_GooglePrivacyDlpV2beta2InfoType';
  protected $infoTypeDataType = '';
  public $likelihood;
  protected $regexType = 'Google_Service_DLP_GooglePrivacyDlpV2beta2Regex';
  protected $regexDataType = '';
  protected $surrogateTypeType = 'Google_Service_DLP_GooglePrivacyDlpV2beta2SurrogateType';
  protected $surrogateTypeDataType = '';

  /**
   * @param Google_Service_DLP_GooglePrivacyDlpV2beta2DetectionRule
   */
  public function setDetectionRules($detectionRules)
  {
    $this->detectionRules = $detectionRules;
  }
  /**
   * @return Google_Service_DLP_GooglePrivacyDlpV2beta2DetectionRule
   */
  public function getDetectionRules()
  {
    return $this->detectionRules;
  }
  /**
   * @param Google_Service_DLP_GooglePrivacyDlpV2beta2Dictionary
   */
  public function setDictionary(Google_Service_DLP_GooglePrivacyDlpV2beta2Dictionary $dictionary)
  {
    $this->dictionary = $dictionary;
  }
  /**
   * @return Google_Service_DLP_GooglePrivacyDlpV2beta2Dictionary
   */
  public function getDictionary()
  {
    return $this->dictionary;
  }
  /**
   * @param Google_Service_DLP_GooglePrivacyDlpV2beta2InfoType
   */
  public function setInfoType(Google_Service_DLP_GooglePrivacyDlpV2beta2InfoType $infoType)
  {
    $this->infoType = $infoType;
  }
  /**
   * @return Google_Service_DLP_GooglePrivacyDlpV2beta2InfoType
   */
  public function getInfoType()
  {
    return $this->infoType;
  }
  public function setLikelihood($likelihood)
  {
    $this->likelihood = $likelihood;
  }
  public function getLikelihood()
  {
    return $this->likelihood;
  }
  /**
   * @param Google_Service_DLP_GooglePrivacyDlpV2beta2Regex
   */
  public function setRegex(Google_Service_DLP_GooglePrivacyDlpV2beta2Regex $regex)
  {
    $this->regex = $regex;
  }
  /**
   * @return Google_Service_DLP_GooglePrivacyDlpV2beta2Regex
   */
  public function getRegex()
  {
    return $this->regex;
  }
  /**
   * @param Google_Service_DLP_GooglePrivacyDlpV2beta2SurrogateType
   */
  public function setSurrogateType(Google_Service_DLP_GooglePrivacyDlpV2beta2SurrogateType $surrogateType)
  {
    $this->surrogateType = $surrogateType;
  }
  /**
   * @return Google_Service_DLP_GooglePrivacyDlpV2beta2SurrogateType
   */
  public function getSurrogateType()
  {
    return $this->surrogateType;
  }
}
