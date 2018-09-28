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

class Google_Service_CloudFilestore_Export extends Google_Collection
{
  protected $collection_key = 'networks';
  protected $allowedClientsType = 'Google_Service_CloudFilestore_ClientList';
  protected $allowedClientsDataType = '';
  public $async;
  protected $deniedClientsType = 'Google_Service_CloudFilestore_ClientList';
  protected $deniedClientsDataType = '';
  protected $networksType = 'Google_Service_CloudFilestore_NetworkConfig';
  protected $networksDataType = 'array';
  protected $nfsExportType = 'Google_Service_CloudFilestore_NfsExport';
  protected $nfsExportDataType = '';
  public $path;
  public $readOnly;
  protected $smbExportType = 'Google_Service_CloudFilestore_SmbExport';
  protected $smbExportDataType = '';

  /**
   * @param Google_Service_CloudFilestore_ClientList
   */
  public function setAllowedClients(Google_Service_CloudFilestore_ClientList $allowedClients)
  {
    $this->allowedClients = $allowedClients;
  }
  /**
   * @return Google_Service_CloudFilestore_ClientList
   */
  public function getAllowedClients()
  {
    return $this->allowedClients;
  }
  public function setAsync($async)
  {
    $this->async = $async;
  }
  public function getAsync()
  {
    return $this->async;
  }
  /**
   * @param Google_Service_CloudFilestore_ClientList
   */
  public function setDeniedClients(Google_Service_CloudFilestore_ClientList $deniedClients)
  {
    $this->deniedClients = $deniedClients;
  }
  /**
   * @return Google_Service_CloudFilestore_ClientList
   */
  public function getDeniedClients()
  {
    return $this->deniedClients;
  }
  /**
   * @param Google_Service_CloudFilestore_NetworkConfig
   */
  public function setNetworks($networks)
  {
    $this->networks = $networks;
  }
  /**
   * @return Google_Service_CloudFilestore_NetworkConfig
   */
  public function getNetworks()
  {
    return $this->networks;
  }
  /**
   * @param Google_Service_CloudFilestore_NfsExport
   */
  public function setNfsExport(Google_Service_CloudFilestore_NfsExport $nfsExport)
  {
    $this->nfsExport = $nfsExport;
  }
  /**
   * @return Google_Service_CloudFilestore_NfsExport
   */
  public function getNfsExport()
  {
    return $this->nfsExport;
  }
  public function setPath($path)
  {
    $this->path = $path;
  }
  public function getPath()
  {
    return $this->path;
  }
  public function setReadOnly($readOnly)
  {
    $this->readOnly = $readOnly;
  }
  public function getReadOnly()
  {
    return $this->readOnly;
  }
  /**
   * @param Google_Service_CloudFilestore_SmbExport
   */
  public function setSmbExport(Google_Service_CloudFilestore_SmbExport $smbExport)
  {
    $this->smbExport = $smbExport;
  }
  /**
   * @return Google_Service_CloudFilestore_SmbExport
   */
  public function getSmbExport()
  {
    return $this->smbExport;
  }
}
