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
 * The "services" collection of methods.
 * Typical usage is:
 *  <code>
 *   $serviceusageService = new Google_Service_ServiceUsage(...);
 *   $services = $serviceusageService->services;
 *  </code>
 */
class Google_Service_ServiceUsage_Resource_Services extends Google_Service_Resource
{
  /**
   * Disable a service so it can no longer be used with a project. This prevents
   * unintended usage that may cause unexpected billing charges or security leaks.
   *
   * It is not valid to call the disable method on a service that is not currently
   * enabled. Callers will receive a FAILED_PRECONDITION status if the target
   * service is not currently enabled.
   *
   * Operation (services.disable)
   *
   * @param string $name Name of the consumer and service to disable the service
   * on.
   *
   * The enable and disable methods currently only support projects.
   *
   * An example name would be: projects/123/services/serviceusage.googleapis.com
   * @param Google_Service_ServiceUsage_DisableServiceRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_ServiceUsage_Operation
   */
  public function disable($name, Google_Service_ServiceUsage_DisableServiceRequest $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('disable', array($params), "Google_Service_ServiceUsage_Operation");
  }
  /**
   * Enable a service so it can be used with a project. See [Cloud Auth
   * Guide](https://cloud.google.com/docs/authentication) for more information.
   *
   * Operation (services.enable)
   *
   * @param string $name Name of the consumer and service to enable the service
   * on.
   *
   * The enable and disable methods currently only support projects.
   *
   * Enabling a service requires that the service is public or is shared with the
   * user enabling the service.
   *
   * An example name would be: projects/123/services/serviceusage.googleapis.com
   * @param Google_Service_ServiceUsage_EnableServiceRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_ServiceUsage_Operation
   */
  public function enable($name, Google_Service_ServiceUsage_EnableServiceRequest $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('enable', array($params), "Google_Service_ServiceUsage_Operation");
  }
  /**
   * Returns the service definition and EnabledState for a given service.
   * (services.get)
   *
   * @param string $name Name of the consumer and service to get the ConsumerState
   * for.
   *
   * An example name would be: projects/123/services/serviceusage.googleapis.com
   * @param array $optParams Optional parameters.
   * @return Google_Service_ServiceUsage_ServiceState
   */
  public function get($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_ServiceUsage_ServiceState");
  }
  /**
   * List enabled services. (services.listEnabled)
   *
   * @param string $parent Parent to search for services on.
   *
   * An example name would be: projects/123
   * @param array $optParams Optional parameters.
   *
   * @opt_param int pageSize Requested size of the next page of data.
   * @opt_param string pageToken Token identifying which result to start with;
   * returned by a previous list call.
   * @return Google_Service_ServiceUsage_ListEnabledServicesResponse
   */
  public function listEnabled($parent, $optParams = array())
  {
    $params = array('parent' => $parent);
    $params = array_merge($params, $optParams);
    return $this->call('listEnabled', array($params), "Google_Service_ServiceUsage_ListEnabledServicesResponse");
  }
  /**
   * Search available services.
   *
   * When no filter is specified, returns all accessible services. This includes
   * public services and services for which the calling user has the
   * "servicemanagement.services.bind" permission. (services.search)
   *
   * @param array $optParams Optional parameters.
   *
   * @opt_param string pageToken Token identifying which result to start with;
   * returned by a previous search call.
   * @opt_param int pageSize Requested size of the next page of data.
   * @return Google_Service_ServiceUsage_SearchServicesResponse
   */
  public function search($optParams = array())
  {
    $params = array();
    $params = array_merge($params, $optParams);
    return $this->call('search', array($params), "Google_Service_ServiceUsage_SearchServicesResponse");
  }
}
