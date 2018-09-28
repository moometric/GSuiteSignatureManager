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

class Google_Service_CloudFilestore_FileShareConfig extends Google_Collection
{
  protected $collection_key = 'protocols';
  public $capacityGb;
  public $deleted;
  public $enabled;
  protected $exportsType = 'Google_Service_CloudFilestore_Export';
  protected $exportsDataType = 'array';
  public $name;
  public $protocols;

  public function setCapacityGb($capacityGb)
  {
    $this->capacityGb = $capacityGb;
  }
  public function getCapacityGb()
  {
    return $this->capacityGb;
  }
  public function setDeleted($deleted)
  {
    $this->deleted = $deleted;
  }
  public function getDeleted()
  {
    return $this->deleted;
  }
  public function setEnabled($enabled)
  {
    $this->enabled = $enabled;
  }
  public function getEnabled()
  {
    return $this->enabled;
  }
  /**
   * @param Google_Service_CloudFilestore_Export
   */
  public function setExports($exports)
  {
    $this->exports = $exports;
  }
  /**
   * @return Google_Service_CloudFilestore_Export
   */
  public function getExports()
  {
    return $this->exports;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setProtocols($protocols)
  {
    $this->protocols = $protocols;
  }
  public function getProtocols()
  {
    return $this->protocols;
  }
}
