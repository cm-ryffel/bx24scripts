<?php

function getDealPayments($dealId)
{
    $result = CRest::call('crm.item.payment.list', [
        'entityId' => $dealId,
        'entityTypeId' => 2
    ]);

    return $result['result'] ?? [];
}

function unpayDeal($paymentId)
{
    CRest::call('crm.item.payment.unpay', [
        'id' => $paymentId
    ]);
}

function deleteDeal($dealId)
{
    CRest::call('crm.deal.delete', [
        'id' => $dealId
    ]);
}

function getDealsInWork()
{
    $result = CRest::call('crm.deal.list', [
        'filter' => [
            'CATEGORY_ID' => 0, // Основная воронка
            'CLOSED' => 'N' // Только сделки в работе
        ],
        'select' => ['ID']
    ]);

    return $result['result'] ?? [];
}