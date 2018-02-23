# Webform Multiple Participant Registration.

This extension does better handling of multiple participants registered through webforms for one or more events.

Related SE question - [webform event registration - no receipts from contribution page?](https://civicrm.stackexchange.com/questions/22776/webform-event-registration-no-receipts-from-contribution-page)

## Author

This extension was written by Jitendra Purohit on behalf of [Fuzion](https://www.fuzion.co.nz).

## What it provides

- Able to select "is email confirm" without enabling online registration on Manage Event Page.
- Names and location of all the event that were involved in Webform registration process.
- Lists all the participants with event name and date on the email receipt sent to the contact.
- Include Participant custom field value in the receipt if present.
- If there is a contribution invoice attached to the mail, it will also include all names of the participants with event name and date.

## Configuration

- For the point 2 mentioned above - this extension provides additional tokens `{$multiple_events}` and `{$multiple_locations}` which needs to be used in the default event_online_receipt template to print names and location of all the events that were involved in webform registration process.
- A sample of the message template is included in the file "online_event_message_template.tpl" of the extension. It contains only the part which needs to be replaced with the below lines in the default Event Online message template to get all the event names in the mail.

       <td colspan="2" {$valueStyle}>
         {$event.event_title}<br />
         {$event.event_start_date|date_format:"%A"} {$event.event_start_date|crmDate}{if $event.event_end_date}-{if $event.event_end_date|date_format:"%Y%m%d" == $event.event_start_date|date_format:"%Y%m%d"}{$event.event_end_date|crmDate:0:1}{else}{$event.event_end_date|date_format:"%A"} {$event.event_end_date|crmDate}{/if}{/if}
       </td>

### Contribute

- Issue Tracker: https://github.com/fuzionnz/nz.co.fuzion.webformparticipants/issues
- Source Code: https://github.com/fuzionnz/nz.co.fuzion.webformparticipants

## Support

This extension is contributed by [Fuzion](https://www.fuzion.co.nz).

We welcome contributions and bug reports via the the [nz.co.fuzion.webformparticipants issue queue](https://github.com/fuzionnz/nz.co.fuzion.webformparticipants.issues).

Community support is available via CiviCRM community channels:

* [CiviCRM chat](https://chat.civicrm.org)
* [CiviCRM question & answer forum on StackExchange](https://civicrm.stackexchange.com)

Contact us - info@fuzion.co.nz - for professional support and development requests.
