{if $multiple_events}
  {foreach from=$multiple_events item=event key=eventKey}
    <tr>
      <td colspan="2" {$valueStyle}>
        Event {$eventKey} - {$event.event_title}<br />
        {$event.event_start_date|date_format:"%A"} {$event.event_start_date|crmDate}{if $event.event_end_date}-{if $event.event_end_date|date_format:"%Y%m%d" == $event.event_start_date|date_format:"%Y%m%d"}{$event.event_end_date|crmDate:0:1}{else}{$event.event_end_date|date_format:"%A"} {$event.event_end_date|crmDate}{/if}{/if}
      </td>
    </tr>

    {if $isShowLocation}
      <tr>
       <td colspan="2" {$valueStyle}>
        {$multiple_locations.$eventKey.address.1.display|nl2br}
       </td>
      </tr>
    {/if}

    {if $multiple_locations.$eventKey.phone.1.phone || $multiple_locations.$eventKey.email.1.email}
      <tr>
       <td colspan="2" {$labelStyle}>
        {ts}Event Contacts:{/ts}
       </td>
      </tr>
      {foreach from=$multiple_locations.$eventKey.phone item=phone}
        {if $phone.phone}
        <tr>
         <td {$labelStyle}>
          {if $phone.phone_type}
           {$phone.phone_type_display}
          {else}
           {ts}Phone{/ts}
          {/if}
         </td>
         <td {$valueStyle}>
          {$phone.phone} {if $phone.phone_ext}&nbsp;{ts}ext.{/ts} {$phone.phone_ext}{/if}
         </td>
        </tr>
        {/if}
      {/foreach}
      {foreach from=$multiple_locations.$eventKey.email item=eventEmail}
        {if $eventEmail.email}
        <tr>
         <td {$labelStyle}>
          {ts}Email{/ts}
         </td>
         <td {$valueStyle}>
          {$eventEmail.email}
         </td>
        </tr>
        {/if}
      {/foreach}
    {/if}
  {/foreach}

{else}
    <td colspan="2" {$valueStyle}>
      {$event.event_title}<br />
      {$event.event_start_date|date_format:"%A"} {$event.event_start_date|crmDate}{if $event.event_end_date}-{if $event.event_end_date|date_format:"%Y%m%d" == $event.event_start_date|date_format:"%Y%m%d"}{$event.event_end_date|crmDate:0:1}{else}{$event.event_end_date|date_format:"%A"} {$event.event_end_date|crmDate}{/if}{/if}
    </td>
  </tr>
{/if}