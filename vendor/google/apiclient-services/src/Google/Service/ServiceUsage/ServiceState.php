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

class Google_Service_ServiceUsage_ServiceState extends Google_Model
{
  protected $enabledType = 'Google_Service_ServiceUsage_EnabledState';
  protected $enabledDataType = '';
  public $name;
  protected $serviceType = 'Google_Service_ServiceUsage_PublishedService';
  protected $serviceDataType = '';

  /**
   * @param Google_Service_ServiceUsage_EnabledState
   */
  public function setEnabled(Google_Service_ServiceUsage_EnabledState $enabled)
  {
    $this->enabled = $enabled;
  }
  /**
   * @return Google_Service_ServiceUsage_EnabledState
   */
  public function getEnabled()
  {
    return $this->enabled;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  /**
   * @param Google_Service_ServiceUsage_PublishedService
   */
  public function setService(Google_Service_ServiceUsage_PublishedService $service)
  {
    $this->service = $service;
  }
  /**
   * @return Google_Service_ServiceUsage_PublishedService
   */
  public function getService()
  {
    return $this->service;
  }
}
