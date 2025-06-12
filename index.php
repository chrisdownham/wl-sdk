<?php
require_once __DIR__ . '/WlSdkAutoloader.php';
WlSdkAutoloader::register();

use WellnessLiving\Config\WlRegionSid;
use WellnessLiving\Config\WlConfigDeveloper;
use WellnessLiving\Wl\Passport\Login\Enter\NotepadModel;
use WellnessLiving\Wl\Passport\Login\Enter\EnterModel;
use WellnessLiving\Wl\Report\Data\DataModel;
use WellnessLiving\Wl\Report\Data\WlReportGroupSid;
use WellnessLiving\Wl\Report\Data\WlReportSid;

class ExampleConfig extends WlConfigDeveloper {}

try {
  $o_config = ExampleConfig::create(WlRegionSid::US_EAST_1);

  // Step 1: Get notepad session
  $o_notepad = new NotepadModel($o_config);
  $o_notepad->get();

  // Step 2: Log in using your WL credentials
  $o_enter = new EnterModel($o_config);
  $o_enter->cookieSet($o_notepad->cookieGet());
  $o_enter->s_login = 'ctdownham@googlemail.com';
  $o_enter->s_notepad = $o_notepad->s_notepad;
  $o_enter->s_password = $o_notepad->hash('R1SEYoga7442');
  $o_enter->post();

  // Step 3: Retrieve All Sales Report
  $o_report = new DataModel($o_config);
  $o_report->cookieSet($o_notepad->cookieGet());
  $o_report->id_report_group = WlReportGroupSid::DAY;
  $o_report->id_report = WlReportSid::PURCHASE_ITEM_ACCRUAL_CASH;
  $o_report->k_business = '48278'; // Your business ID
  $o_report->filterSet([
    'dt_date' => date('Y-m-d'), // Today’s date
  ]);
  $o_report->get();

  // Output report
  $i = 0;
  foreach ($o_report->a_data['a_row'] as $a_row) {
    $i++;
    echo $i . '. ' . $a_row['dt_date'] . ' ' . $a_row['f_total']['m_amount'] . ' ' . $a_row['o_user']['text_name'] . ' ' . $a_row['s_item'] . "<br>";
  }

} catch (Exception $e) {
  echo '❌ Error: ' . $e->getMessage() . "<br>";
}
