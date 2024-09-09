<?php
require_once(__DIR__ . '/deleteDeals.php');
require_once(__DIR__ . '/crest.php');
require_once(__DIR__ . '/checkserver.php');
require_once(__DIR__ . '/settings.php');

function processDeals()
{
    $deals = getDealsInWork();

    foreach ($deals as $deal) {
        $dealId = $deal['ID'];
        $payments = getDealPayments($dealId);

        foreach ($payments as $payment) {
            $paymentId = $payment['id'];
            unpayDeal($paymentId);
            echo "status of paym. $paymentId in deal ID $dealId changed.\n";
        }

        deleteDeal($dealId);
        echo "deal ID $dealId deleted.\n";
    }
}
// Вызываем процесс 10 раз
for ($i = 0; $i < 10; $i++) {
    echo "round $i:\n";
    processDeals();
    echo "endeng round $i.\n";
}