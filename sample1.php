<?php

// 注文処理インターフェース
interface OrderProcessor {
    function processOrder(array $orderData): void;
}

// オンラインストアの注文処理クラス
class OnlineStoreOrderProcessor implements OrderProcessor {

    /**
     * 注文処理
     * @param array $orderData 注文データ
     */
    public function processOrder(array $orderData): void {
        echo "Processing online store order:\n";
        echo "Order ID: {$orderData['id']}\n";
        echo "Total: {$orderData['total']}\n";
        echo "Shipping address: {$orderData['shippingAddress']}\n";

        // オンラインストア独自の注文処理ロジック...
    }
}

// 小売店の注文処理クラス
class RetailStoreOrderProcessor implements OrderProcessor {

    /**
     * 注文処理
     * @param array $orderData 注文データ
     */
    public function processOrder(array $orderData): void {
        echo "Processing retail store order:\n";
        echo "Order ID: {$orderData['id']}\n";
        echo "Total: {$orderData['total']}\n";
        echo "Pick-up location: {$orderData['pickupLocation']}\n";

        // 小売店独自の注文処理ロジック...
    }
}

/**
 * 注文処理
 * @param OrderProcessor $orderProcessor 注文処理
 * @param array $orderData 注文データ
 */
function processOrder(OrderProcessor $orderProcessor, array $orderData): void {
    // 下の処理はOnlineStoreOrderProcessorもRetailStoreOrderProcessorも同じメソッドを持っているからこそ可能なテクニック
    // この$orderProcessorは親のOrderProcessorではなく子のOnlineStoreOrderProcessorやRetailStoreOrderProcessorでも同じことができる
    // これが置換可能という意味
    $orderProcessor->processOrder($orderData);
}

$onlineStoreOrder = [
    'id' => 12345,
    'total' => 99.99,
    'shippingAddress' => '123 Main St, Anytown USA'
];

$retailStoreOrder = [
    'id' => 54321,
    'total' => 49.99,
    'pickupLocation' => 'Downtown Retail Store'
];

$onlineOrderProcessor = new OnlineStoreOrderProcessor();
$retailOrderProcessor = new RetailStoreOrderProcessor();

processOrder($onlineOrderProcessor, $onlineStoreOrder);
processOrder($retailOrderProcessor, $retailStoreOrder);
