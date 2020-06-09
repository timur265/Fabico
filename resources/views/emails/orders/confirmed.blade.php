Заказ подтверждён!

Спасибо за покупку!

Номер заказа: {{ $order->id }}


Заказанные товары:
@foreach($order->orderItems as $orderItem)
    Название товара: {{ $orderItem->title }}
    Количество: {{ $orderItem->quantity }}
    Цена: {{ number_format($orderItem->price, 0, ',', ' ') }} сум
    
@endforeach

Итого: {{ number_format($order->getTotalAmount(), 0, ',', ' ') }} сум
