@extends('admin.layouts.app')

@section('css')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            #section-to-print, #section-to-print * {
                visibility: visible;
            }
            #section-to-print {
                position: absolute;
                left: 0;
                top: 0;
            }
        }
    </style>
@endsection

@section('content')
    <h2 class="content-heading">Заказ № {{ $order->id }}</h2>
    <div class="row">
        <div class="col-12" id="section-to-print">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Информация о заказчике</h3>
                    <div class="block-options">
                        <button class="btn-block-option" type="button" onclick="window.print()"><i class="si si-printer"></i></button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h5 class="font-w600">Заказчик</h5>
                            <p>{{ $order->company_name }}</p>
                            <h5 class="font-w600">Адрес</h5>
                            <p>{{ $order->address }}</p>
                            <h5 class="font-w600">Email</h5>
                            <p>{{ $order->email }}</p>
                            <h5 class="font-w600">Имя заказчика</h5>
                            <p>{{ $order->name }}</p>
                            <h5 class="font-w600">Номер телефона</h5>
                            <p>{{ $order->phone_number }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h5 class="font-w600">Банк</h5>
                            <p>{{ $order->bank }}</p>
                            <h5 class="font-w600">ИНН</h5>
                            <p>{{ $order->tin }}</p>
                            <h5 class="font-w600">ОКЭД</h5>
                            <p>{{ $order->ctea }}</p>
                            <h5 class="font-w600">МФО</h5>
                            <p>{{ $order->mfi }}</p>
                        </div>
                    </div>
                    @if ($order->comment)
                        <div class="row">
                            <div class="col-12">
                                <h5 class="font-w600">Комментарий</h5>
                                <p>{{ $order->comment }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Заказанные товары</h3>
                </div>
                <div class="block-content">
                    <div class="list-group push list-group-flush">
                        @foreach($order->orderItems as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center"><span><img src="{{ $item->getImage() }}" class="img-avatar-rounded img-avatar48 img-avatar" alt=""><span class="ml-20 font-w600 font-size-md">{{ $item->title }}, {{ number_format($item->price, 0, ',', ' ') }} RMB, {{ $item->color_name }}</span></span><span class="badge badge-pill badge-primary" style="background-color: {{ $item->color_hex }}" data-toggle="tooltip" title="Количество">{{ $item->quantity }}</span></li>
                        @endforeach
                    </div>
                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light font-size-md">
                    Итого: {{ number_format($order->getTotalAmount(), 0, ',', ' ')}}, Всего товаров: {{ $order->getTotalProductCount() }}
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Статус заказа</h3>
                </div>
                <div class="block-content pb-30">
                    <h5>Текущий статус: @if ($order->status == 'new')
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABmJLR0QA/wD/AP+gvaeTAAACF0lEQVRIibXVv2sUURAH8I/JwWnAmMbCHwgqptDCMqWVIlqKEhBsrBSrpLJOE4So/4AQRK2FYCGIhcFEK9PYxECKBBtDYowaNXhncbPZd+sdd0kuXxjYmZ35fnfmvbeP9jCMZxhIYgMRG26ToyUuo4Jq2KuwzK9EzpZRwnH04xyWEtJmthS5/VFbakdoqg3iVva2lUgZGx0Q2giuTXQVhPrbbbsFSjjVTKgHtzogkuF2cNbhGhbsfGRFWwhucHQXBFKrhIaupJsKlvFHvqjLSTyzn1jFWkK4ktStR17W1eYSPYjgavg35YcTfhRGPYSragtexSL24F74d9TOUxX3s27gQ4FoHJNRnGI+isdwEXP4gomIT0TeFC7F80xW3BMFaUc3cBpvmnR0V20k8DxIL6ht60V0J+JzoWFUPudM6B1O4npBaEa+RlWcURvTPnxEb/hlfE94R8WIikLv8UI+ukxoXv2OGsJenA3/SoicL+RNwjF8atBRVX4GiqPri/cvwx8J/1H4Y4nIPE5khYcxK9/G2f/ut8bbeyXe/9X4OGT+bHDX4Wmh3U7Yk4w8/dcdLCp3AJucqdCBXRDqyx66k+Dn+IIjdn5V/MJrtW091yypR76LtmMjGlwPzbAfX7ch8k3t0P6H4g2bYQ2PE389hIv4Gu8yjIfYltCLQbVTX8IhTMu/fjpipcgZ1KSb7aCMh2HlFrl1+AevYic8TFoCIAAAAABJRU5ErkJggg=="> Новый заказ
                        @elseif ($order->status == 'viewed')
                        <i class="fa fa-eye text-info"></i> Просмотрено
                        @elseif ($order->status == 'process')
                            <i class="fa fa-arrow-right text-primary"></i> В процессе
                        @elseif ($order->status == 'done')
                            <i class="fa fa-check text-primary"></i> Готов
                        @endif</h5>
                    <div class="d-flex justify-content-around align-items-center">
                        @if ($order->status != 'new')<a href="{{ route('orders.status', [$order->id, 'status' => 'new']) }}" class="btn btn-alt-info"><i class="fa fa-eye"></i> Новый заказ</a> @endif
                        @if ($order->status != 'process')<a href="{{ route('orders.status', [$order->id, 'status' => 'process']) }}" class="btn btn-alt-primary"><i class="fa fa-arrow-right"></i> В процессе</a> @endif
                        @if ($order->status != 'done')<a href="{{ route('orders.status', [$order->id, 'status' => 'done']) }}" class="btn btn-alt-success"><i class="fa fa-check"></i> Готов</a> @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
