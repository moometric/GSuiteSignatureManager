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

/**
 * The "devices" collection of methods.
 * Typical usage is:
 *  <code>
 *   $cloudiotService = new Google_Service_CloudIot(...);
 *   $devices = $cloudiotService->devices;
 *  </code>
 */
class Google_Service_CloudIot_Resource_ProjectsLocationsRegistriesGroupsDevices extends Google_Service_Resource
{
  /**
   * Gets details about a device. (devices.get)
   *
   * @param string $name The name of the device. For example,
   * `projects/p0/locations/us-central1/registries/registry0/devices/device0` or
   * `projects/p0/locations/us-central1/registries/registry0/devices/{num_id}`.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string fieldMask The fields of the `Device` resource to be
   * returned in the response. If the field mask is unset or empty, all fields are
   * returned.
   * @return Google_Service_CloudIot_Device
   */
  public function get($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_CloudIot_Device");
  }
  /**
   * List devices in a device registry.
   * (devices.listProjectsLocationsRegistriesGroupsDevices)
   *
   * @param string $parent The device registry path. Required. For example,
   * `projects/my-project/locations/us-central1/registries/my-registry`.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string pageToken The value returned by the last
   * `ListDevicesResponse`; indicates that this is a continuation of a prior
   * `ListDevices` call and the system should return the next page of data.
   * @opt_param string fieldMask The fields of the `Device` resource to be
   * returned in the response. The fields `id` and `num_id` are always returned,
   * along with any other fields specified.
   * @opt_param int pageSize The maximum number of devices to return in the
   * response. If this value is zero, the service will select a default size. A
   * call may return fewer objects than requested. A non-empty `next_page_token`
   * in the response indicates that more data is available.
   * @opt_param string deviceIds A list of device string IDs. For example,
   * `['device0', 'device12']`. If empty, this field is ignored. Maximum IDs:
   * 10,000
   * @opt_param string deviceNumIds A list of device numeric IDs. If empty, this
   * field is ignored. Maximum IDs: 10,000.
   * @return Google_Service_CloudIot_ListDevicesResponse
   */
  public function listProjectsLocationsRegistriesGroupsDevices($parent, $optParams = array())
  {
    $params = array('parent' => $parent);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_CloudIot_ListDevicesResponse");
  }
  /**
   * Modifies the configuration for the device, which is eventually sent from the
   * Cloud IoT Core servers. Returns the modified configuration version and its
   * metadata. (devices.modifyCloudToDeviceConfig)
   *
   * @param string $name The name of the device. For example,
   * `projects/p0/locations/us-central1/registries/registry0/devices/device0` or
   * `projects/p0/locations/us-central1/registries/registry0/devices/{num_id}`.
   * @param Google_Service_CloudIot_ModifyCloudToDeviceConfigRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_CloudIot_DeviceConfig
   */
  public function modifyCloudToDeviceConfig($name, Google_Service_CloudIot_ModifyCloudToDeviceConfigRequest $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('modifyCloudToDeviceConfig', array($params), "Google_Service_CloudIot_DeviceConfig");
  }
  /**
   * Updates a device. (devices.patch)
   *
   * @param string $name The resource path name. For example,
   * `projects/p1/locations/us-central1/registries/registry0/devices/dev0` or
   * `projects/p1/locations/us-central1/registries/registry0/devices/{num_id}`.
   * When `name` is populated as a response from the service, it always ends in
   * the device numeric ID.
   * @param Google_Service_CloudIot_Device $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string updateMask Only updates the `device` fields indicated by
   * this mask. The field mask must not be empty, and it must not contain fields
   * that are immutable or only set by the server. Mutable top-level fields:
   * `credentials`, `blocked`, and `metadata`
   * @return Google_Service_CloudIot_Device
   */
  public function patch($name, Google_Service_CloudIot_Device $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('patch', array($params), "Google_Service_CloudIot_Device");
  }
}
