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

class Google_Service_Analytics_AccountTreeResponseAccountSettings extends Google_Model
{
  public $admobReporting;
  public $sharingWithGoogleAnySales;
  public $sharingWithGoogleProducts;
  public $sharingWithGoogleSales;
  public $sharingWithGoogleSupport;
  public $sharingWithOthers;

  public function setAdmobReporting($admobReporting)
  {
    $this->admobReporting = $admobReporting;
  }
  public function getAdmobReporting()
  {
    return $this->admobReporting;
  }
  public function setSharingWithGoogleAnySales($sharingWithGoogleAnySales)
  {
    $this->sharingWithGoogleAnySales = $sharingWithGoogleAnySales;
  }
  public function getSharingWithGoogleAnySales()
  {
    return $this->sharingWithGoogleAnySales;
  }
  public function setSharingWithGoogleProducts($sharingWithGoogleProducts)
  {
    $this->sharingWithGoogleProducts = $sharingWithGoogleProducts;
  }
  public function getSharingWithGoogleProducts()
  {
    return $this->sharingWithGoogleProducts;
  }
  public function setSharingWithGoogleSales($sharingWithGoogleSales)
  {
    $this->sharingWithGoogleSales = $sharingWithGoogleSales;
  }
  public function getSharingWithGoogleSales()
  {
    return $this->sharingWithGoogleSales;
  }
  public function setSharingWithGoogleSupport($sharingWithGoogleSupport)
  {
    $this->sharingWithGoogleSupport = $sharingWithGoogleSupport;
  }
  public function getSharingWithGoogleSupport()
  {
    return $this->sharingWithGoogleSupport;
  }
  public function setSharingWithOthers($sharingWithOthers)
  {
    $this->sharingWithOthers = $sharingWithOthers;
  }
  public function getSharingWithOthers()
  {
    return $this->sharingWithOthers;
  }
}
