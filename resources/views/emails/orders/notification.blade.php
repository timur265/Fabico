Новый заказ!

Номер заказа: {{ $order->id }}

Данные о заказчике:
Имя: {{ $order->name }}
Email: {{ $order->email }}
Номер телефона: {{ $order->phone_number }}
Комментарий: {{ $order->comment }}

Компания: {{ $order->company_name }}
Банк: {{ $order->bank }}
Адрес: {{ $order->address }}
ИНН: {{ $order->tin }}
ОКЕД: {{ $order->ctea }}
МФО: {{ $order->mfi }}

Заказанные товары:
@foreach($order->orderItems as $orderItem)
    Название товара: {{ $orderItem->title }}
    Количество: {{ $orderItem->quantity }}
    Цена: {{ number_format($orderItem->price, 0, ',', ' ') }} сум

@endforeach

Итого: {{ number_format($order->getTotalAmount(), 0, ',', ' ') }} сум
