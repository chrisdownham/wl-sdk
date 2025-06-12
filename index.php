<?php
// ─── Composer Autoloader ───────────────────────────────────────────────────────
require __DIR__ . '/vendor/autoload.php';

use WellnessLiving\Wl\WlRegionSid;
use WellnessLiving\Config\WlConfigDeveloper;
use WellnessLiving\Wl\Passport\Login\Enter\NotepadModel;
use WellnessLiving\Wl\Passport\Login\Enter\EnterModel;
use WellnessLiving\Wl\Report\DataModel;
use WellnessLiving\Wl\Report\WlReportGroupSid;
use WellnessLiving\Wl\Report\WlReportSid;

// ─── Config Subclass ──────────────────────────────────────────────────────────
class ExampleConfig extends WlConfigDeveloper
{
  protected function authorizeId(): string   { return getenv('WL_AUTHORIZE_ID'); }
  protected function authorizeCode(): string { return getenv('WL_AUTHORIZE_CODE'); }
  protected function username(): string      { return getenv('WL_USERNAME'); }
  protected function password(): string      { return getenv('WL_PASSWORD'); }
}

try {
  // 1) Initialize
  $config  = ExampleConfig::create(WlRegionSid::US_EAST_1);
  $notepad = new NotepadModel($config);
  $notepad->get();

  // 2) Authenticate
  $enter = new EnterModel($config);
  $enter->cookieSet($notepad->cookieGet());
  $enter->post();

  // 3) Fetch Sales Report
  $report = new DataModel($config);
  $report->cookieSet($notepad->cookieGet());
  $report->id_report_group = WlReportGroupSid::DAY;
  $report->id_report       = WlReportSid::PURCHASE_ITEM_ACCRUAL_CASH;
  $report->k_business      = getenv('WL_BID');
  $report->filterSet([ 'dt_date' => date('Y-m-d') ]);
  $report->get();

  // 4) Output
  foreach ($report->a_data['a_row'] as $i => $row) {
    echo ($i + 1) . '. '
       . $row['dt_date']
       . ' – $' . $row['f_total']['m_amount']
       . ' – ' . $row['o_user']['text_name']
       . ' – ' . $row['s_item']
       . "<br>\n";
  }

} catch (Exception $e) {
  echo '❌ Error: ' . $e->getMessage() . "<br>\n";
}