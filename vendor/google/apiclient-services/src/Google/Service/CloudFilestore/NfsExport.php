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

class Google_Service_CloudFilestore_NfsExport extends Google_Collection
{
  protected $collection_key = 'protocols';
  public $anonymousGid;
  public $anonymousUid;
  public $protocols;
  public $squash;
  public $unauthenticatedLocksAllowed;
  public $userPortsAllowed;

  public function setAnonymousGid($anonymousGid)
  {
    $this->anonymousGid = $anonymousGid;
  }
  public function getAnonymousGid()
  {
    return $this->anonymousGid;
  }
  public function setAnonymousUid($anonymousUid)
  {
    $this->anonymousUid = $anonymousUid;
  }
  public function getAnonymousUid()
  {
    return $this->anonymousUid;
  }
  public function setProtocols($protocols)
  {
    $this->protocols = $protocols;
  }
  public function getProtocols()
  {
    return $this->protocols;
  }
  public function setSquash($squash)
  {
    $this->squash = $squash;
  }
  public function getSquash()
  {
    return $this->squash;
  }
  public function setUnauthenticatedLocksAllowed($unauthenticatedLocksAllowed)
  {
    $this->unauthenticatedLocksAllowed = $unauthenticatedLocksAllowed;
  }
  public function getUnauthenticatedLocksAllowed()
  {
    return $this->unauthenticatedLocksAllowed;
  }
  public function setUserPortsAllowed($userPortsAllowed)
  {
    $this->userPortsAllowed = $userPortsAllowed;
  }
  public function getUserPortsAllowed()
  {
    return $this->userPortsAllowed;
  }
}
