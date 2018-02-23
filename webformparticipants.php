<?php

require_once 'webformparticipants.civix.php';
use CRM_Webformparticipants_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function webformparticipants_civicrm_config(&$config) {
  _webformparticipants_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function webformparticipants_civicrm_xmlMenu(&$files) {
  _webformparticipants_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function webformparticipants_civicrm_install() {
  _webformparticipants_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function webformparticipants_civicrm_postInstall() {
  _webformparticipants_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function webformparticipants_civicrm_uninstall() {
  _webformparticipants_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function webformparticipants_civicrm_enable() {
  _webformparticipants_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function webformparticipants_civicrm_disable() {
  _webformparticipants_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function webformparticipants_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _webformparticipants_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function webformparticipants_civicrm_managed(&$entities) {
  _webformparticipants_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function webformparticipants_civicrm_caseTypes(&$caseTypes) {
  _webformparticipants_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function webformparticipants_civicrm_angularModules(&$angularModules) {
  _webformparticipants_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function webformparticipants_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _webformparticipants_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function webformparticipants_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function webformparticipants_civicrm_navigationMenu(&$menu) {
  _webformparticipants_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _webformparticipants_civix_navigationMenu($menu);
} // */

/**
 * Implements hook_civicrm_postProcess();
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 */
function webformparticipants_civicrm_postProcess($formName, &$form) {
  if ($formName == 'CRM_Event_Form_ManageEvent_Registration') {
    if (!empty($form->_id) && !empty($form->_submitValues['is_email_confirm']) && empty($form->_submitValues['is_online_registration'])) {
      civicrm_api3('Event', 'create', array(
        'id' => $form->_id,
        'is_email_confirm' => 1,
      ));
    }
  }
}

function webformparticipants_civicrm_alterMailParams(&$params, $context) {
  $includedParticipantIds = array();
  if (!empty($params['tplParams']) && !empty($params['tplParams']['lineItem'])) {
    if ($params['valueName'] == 'event_online_receipt') {
      foreach ($params['tplParams']['lineItem'] as $key => $val) {
        foreach ($val as $k => $line) {
          $includedParticipantIds[] = $line['entity_id'];
        }
      }
    }
    if ($params['valueName'] == 'contribution_invoice_receipt') {
      foreach ($params['tplParams']['lineItem'] as $key => $val) {
        if (!empty($val['entity_table']) && $val['entity_table'] == 'civicrm_participant') {
          $includedParticipantIds[] = $val['entity_id'];
        }
      }
    }
    foreach ($params['tplParams']['lineItem'] as $k => $lineItems) {
      //Print Line items in contribution invoice template.
      if ($params['valueName'] == 'contribution_invoice_receipt'
        && is_array($lineItems) && !empty($lineItems['entity_id'])
        && !empty($lineItems['entity_table'])
        && ($lineItems['entity_table'] == 'civicrm_participant')) {

        $maxContriID = CRM_Core_DAO::singleValueQuery("SELECT MAX(contribution_id) FROM civicrm_participant_payment WHERE participant_id = {$lineItems['entity_id']}");
        if ($lineItems['contribution_id'] != $maxContriID) {
          unset($params['tplParams']['lineItem'][$k]);
          continue;
        }
        $successUrl = CRM_Core_Session::singleton()->get("ipn_success_url_{$maxContriID}");
        if (!empty($successUrl)) {
          $parts = parse_url($successUrl);
          parse_str($parts['query'], $query);
          module_load_include('inc', 'webform', 'includes/webform.submissions');
          $submissions = webform_get_submissions(array('sid'=> $query['sid']));
          if (!empty($submissions[$query['sid']]->civicrm) && !empty($submissions[$query['sid']]->civicrm['contact'])) {
            $submittedContacts = CRM_Utils_Array::collect('id', $submissions[$query['sid']]->civicrm['contact']);
          }
        }

        $participant = civicrm_api3('Participant', 'getsingle', array('id' => $lineItems['entity_id']));
        $params['tplParams']['part'][$k]['info'] = $participant['display_name'];
        $additionalParticipants = civicrm_api3('Participant', 'get', array(
          'sequential' => 1,
          'registered_by_id' => $lineItems['entity_id'],
        ));
        if (!empty($additionalParticipants['values'])) {
          foreach ($additionalParticipants['values'] as $additionalValues) {
            if (!empty($submittedContacts) && !in_array($additionalValues['contact_id'], $submittedContacts)) {
              continue;
            }
            if (in_array($additionalValues['participant_id'], $includedParticipantIds)) { // $litem['entity_id'] == $participantVal['participant_id']) {
              continue;
            }
            $addiPartLineItem = $lineItems;
            $addiPartLineItem['qty'] = 1;
            $params['tplParams']['lineItem'][$k]['qty'] = 1;
            $params['tplParams']['lineItem'][$k]['line_total'] = $addiPartLineItem['unit_price'];;
            $addiPartLineItem['label'] = CRM_Contact_BAO_Contact::displayName($additionalValues['contact_id']);
            $time = date("F jS, Y, g:i a", strtotime($additionalValues['event_start_date']));
            $addiPartLineItem['label'] .= " - {$additionalValues['event_title']} - {$time}";
            $addiPartLineItem['entity_id'] = $additionalValues['participant_id'];
            $addiPartLineItem['line_total'] = $addiPartLineItem['subTotal'] = $addiPartLineItem['unit_price'];
            $params['tplParams']['lineItem'][] = $addiPartLineItem;
          }
        }
        elseif (empty($additionalParticipants['values'])) {

          $participants = civicrm_api3('ParticipantPayment', 'get', array(
            'return' => array("participant_id"),
            'contribution_id' => $lineItems['contribution_id'],
            'options' => array('limit' => 0),
          ));
          if ($participants['count'] > 1) {
            foreach ($participants['values'] as $key => $participantVal) {
              $participantDetails = civicrm_api3('Participant', 'get', array(
                'sequential' => 1,
                'id' => $participantVal['participant_id'],
              ));
              $participant = $participantDetails['values'][0];
              if ($lineItems['entity_id'] == $participantVal['participant_id']) {
                continue;
              }
              if (in_array($participantVal['participant_id'], $includedParticipantIds)) {
                continue;
              }
              $addiPartLineItem = $lineItems;
              $addiPartLineItem['qty'] = 1;
              $params['tplParams']['lineItem'][$k]['qty'] = 1;
              $params['tplParams']['lineItem'][$k]['line_total'] = $addiPartLineItem['unit_price'];
              $addiPartLineItem['label'] = CRM_Contact_BAO_Contact::displayName($participant['contact_id']);
              $time = date("F jS, Y, g:i a", strtotime($participant['event_start_date']));
              $addiPartLineItem['label'] .= " - {$participant['event_title']} - {$time}";
              $addiPartLineItem['entity_id'] = $participantVal['participant_id'];
              $addiPartLineItem['unit_price'] = $addiPartLineItem['line_total'] = $addiPartLineItem['subTotal'] = $participant['participant_fee_amount'];
              $params['tplParams']['lineItem'][] = $addiPartLineItem;
            }
          }
        }
        usort($params['tplParams']['lineItem'], function($a, $b) {
          return $a['entity_id'] - $b['entity_id'];
        });
      }

      //Print Line items in event online receipt template.
      elseif (is_array($lineItems)) {
        foreach ($lineItems as $key => $litem) {
          if (!empty($litem['entity_id']) && !empty($litem['entity_table']) && ($litem['entity_table'] == 'civicrm_participant')) {
            $maxContriID = CRM_Core_DAO::singleValueQuery("SELECT MAX(contribution_id) FROM civicrm_participant_payment WHERE participant_id = {$litem['entity_id']}");
            if ($litem['contribution_id'] != $maxContriID) {
              unset($params['tplParams']['lineItem'][$k][$key]);
              continue;
            }
            $successUrl = CRM_Core_Session::singleton()->get("ipn_success_url_{$maxContriID}");
            if (!empty($successUrl)) {
              $parts = parse_url($successUrl);
              parse_str($parts['query'], $query);
              module_load_include('inc', 'webform', 'includes/webform.submissions');
              $submissions = webform_get_submissions(array('sid'=> $query['sid']));
              if (!empty($submissions[$query['sid']]->civicrm) && !empty($submissions[$query['sid']]->civicrm['contact'])) {
                $submittedContacts = CRM_Utils_Array::collect('id', $submissions[$query['sid']]->civicrm['contact']);
              }
            }

            $participants = civicrm_api3('ParticipantPayment', 'get', array(
              'return' => array("participant_id"),
              'contribution_id' => $litem['contribution_id'],
              'options' => array('limit' => 0),
            ));
            if ($participants['count'] > 1 && count($params['tplParams']['lineItem']) != $participants['count'] && empty($flag)) {
              foreach ($participants['values'] as $key => $participantVal) {
                if (in_array($participantVal['participant_id'], $includedParticipantIds)) { // $litem['entity_id'] == $participantVal['participant_id']) {
                  continue;
                }
                $participantDetails = civicrm_api3('Participant', 'get', array(
                  'sequential' => 1,
                  'id' => $participantVal['participant_id'],
                ));
                $participant = $participantDetails['values'][0];
                if (!empty($submittedContacts) && !in_array($participant['contact_id'], $submittedContacts)) {
                  continue;
                }
                $addiPartLineItem = $litem;
                $addiPartLineItem['qty'] = 1;
                $addiPartLineItem['label'] = CRM_Contact_BAO_Contact::displayName($participant['contact_id']);
                $time = date("F jS, Y, g:i a", strtotime($participant['event_start_date']));
                $addiPartLineItem['label'] .= " - {$participant['event_title']} - {$time}";
                $addiPartLineItem['entity_id'] = $participantVal['participant_id'];
                $addiPartLineItem['unit_price'] = $addiPartLineItem['line_total'] = $addiPartLineItem['subTotal'] = $participant['participant_fee_amount'];
                $params['tplParams']['lineItem'][] = array($addiPartLineItem);
              }
            }
            else {
              $flag = TRUE;
              $additionalParticipants = civicrm_api3('Participant', 'get', array(
                'sequential' => 1,
                'registered_by_id' => $litem['entity_id'],
              ));
              if (!empty($additionalParticipants['values'])) {
                foreach ($additionalParticipants['values'] as $additionalValues) {
                  if (!empty($submittedContacts) && !in_array($additionalValues['contact_id'], $submittedContacts)) {
                    continue;
                  }
                  if (in_array($additionalValues['participant_id'], $includedParticipantIds)) {
                    continue;
                  }
                  $addiPartLineItem = $lineItems[$key];
                  $addiPartLineItem['qty'] = 1;
                  $params['tplParams']['lineItem'][$k][$key]['qty'] = 1;
                  $params['tplParams']['lineItem'][$k][$key]['line_total'] = $addiPartLineItem['unit_price'];;
                  $addiPartLineItem['label'] = CRM_Contact_BAO_Contact::displayName($additionalValues['contact_id']);
                  $time = date("F jS, Y, g:i a", strtotime($additionalValues['event_start_date']));
                  $addiPartLineItem['label'] .= " - {$additionalValues['event_title']} - {$time}";
                  $addiPartLineItem['entity_id'] = $additionalValues['participant_id'];
                  $addiPartLineItem['line_total'] = $addiPartLineItem['subTotal'] = $addiPartLineItem['unit_price'];
                  $params['tplParams']['lineItem'][] = array($addiPartLineItem);
                }
              }
            }
          }
        }
      }
    }
  }

  if ($context == 'messageTemplate' && $params['valueName'] == 'event_online_receipt' && !empty($params['contributionId'])) {
    usort($params['tplParams']['lineItem'], function($a, $b) {
      return current($a)['entity_id'] - current($b)['entity_id'];
    });
    foreach ($params['tplParams']['lineItem'] as $key => $val) {
      foreach ($val as $k => $lineItem) {
        $participant = civicrm_api3('Participant', 'getsingle', array('id' => $lineItem['entity_id']));
        $params['tplParams']['part'][$key]['info'] = $participant['display_name'];
      }
    }
    //To populate event custom group in mail.
    if (!empty($params['tplParams']['participant']['customGroup'])) {
      $params['tplParams']['customGroup'] += $params['tplParams']['participant']['customGroup'];
      foreach ((array) $params['tplParams']['customGroup'] as $key => $cg) {
        if (is_array($cg)) {
          foreach ($cg as $k => $v) {
            if (empty($v)) {
              unset($params['tplParams']['customGroup'][$key][$k]);
            }
          }
        }
        if (empty($params['tplParams']['customGroup'][$key])) {
          unset($params['tplParams']['customGroup'][$key]);
        }
      }
    }
    //Print Multiple Events and Locations in the receipt template.
    $participants = civicrm_api3('ParticipantPayment', 'get', array(
      'return' => array("participant_id"),
      'contribution_id' => $params['contributionId'],
    ));
    if ($participants['count'] > 1) {
      $eventKey = 1;
      $loopedEvents = array();
      foreach ($participants['values'] as $key => $val) {
        $eventId = civicrm_api3('Participant', 'getvalue', array(
          'return' => "event_id",
          'id' => $val['participant_id'],
        ));
        if (in_array($eventId, $loopedEvents)) {
          continue;
        }
        $loopedEvents[] = $eventId;
        $eventParams = array('id' => $eventId);
        $eventValues = array();
        CRM_Event_BAO_Event::retrieve($eventParams, $eventValues);
        $params['tplParams']['multiple_events'][$eventKey] = $eventValues;

        //get location details
        $locationParams = array(
          'entity_id' => $eventId,
          'entity_table' => 'civicrm_event',
        );
        $params['tplParams']['multiple_locations'][$eventKey] = CRM_Core_BAO_Location::getValues($locationParams);
        $eventKey++;
      }
    }
    if (empty($params['tplParams']['totalAmount'])) {
      $params['tplParams']['totalAmount'] = CRM_Utils_Array::value('amount', $params['tplParams']);
    }
  }
}

