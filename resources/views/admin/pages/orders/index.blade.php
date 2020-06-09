@extends('admin.layouts.app')

@section('content')
    <h2 class="content-heading">Заказы</h2>
    <div class="block">
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center font-w600">№</th>
                            <th class="text-center font-w600">Заказчик</th>
                            <th class="text-center font-w600">Номер телефона</th>
                            <th class="text-center font-w600">Email</th>
                            <th class="text-center font-w600">Общая сумма</th>
                            <th class="text-center font-w600">Кол-во товаров</th>
                            <th class="text-center font-w600">Статус</th>
                            <th class="text-center font-w600">Дата</th>
                            <th class="text-center font-w600">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td class="text-center">{{ $order->id }}</td>
                                <td class="text-center">{{ $order->company_name }} | {{ $order->name }}</td>
                                <td class="text-center">{{ $order->phone_number }}</td>
                                <td class="text-center">{{ $order->email }}</td>
                                <td class="text-center">{{ number_format($order->getTotalAmount(), 0, ',', ' ') }} RMB</td>
                                <td class="text-center">{{ $order->getTotalProductCount() }}</td>
                                <td class="text-center">
                                    @if ($order->status == 'new')
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABmJLR0QA/wD/AP+gvaeTAAACF0lEQVRIibXVv2sUURAH8I/JwWnAmMbCHwgqptDCMqWVIlqKEhBsrBSrpLJOE4So/4AQRK2FYCGIhcFEK9PYxECKBBtDYowaNXhncbPZd+sdd0kuXxjYmZ35fnfmvbeP9jCMZxhIYgMRG26ToyUuo4Jq2KuwzK9EzpZRwnH04xyWEtJmthS5/VFbakdoqg3iVva2lUgZGx0Q2giuTXQVhPrbbbsFSjjVTKgHtzogkuF2cNbhGhbsfGRFWwhucHQXBFKrhIaupJsKlvFHvqjLSTyzn1jFWkK4ktStR17W1eYSPYjgavg35YcTfhRGPYSragtexSL24F74d9TOUxX3s27gQ4FoHJNRnGI+isdwEXP4gomIT0TeFC7F80xW3BMFaUc3cBpvmnR0V20k8DxIL6ht60V0J+JzoWFUPudM6B1O4npBaEa+RlWcURvTPnxEb/hlfE94R8WIikLv8UI+ukxoXv2OGsJenA3/SoicL+RNwjF8atBRVX4GiqPri/cvwx8J/1H4Y4nIPE5khYcxK9/G2f/ut8bbeyXe/9X4OGT+bHDX4Wmh3U7Yk4w8/dcdLCp3AJucqdCBXRDqyx66k+Dn+IIjdn5V/MJrtW091yypR76LtmMjGlwPzbAfX7ch8k3t0P6H4g2bYQ2PE389hIv4Gu8yjIfYltCLQbVTX8IhTMu/fjpipcgZ1KSb7aCMh2HlFrl1+AevYic8TFoCIAAAAABJRU5ErkJggg==" data-toggle="tooltip" title="Новый заказ">
                                    @elseif ($order->status == 'viewed')
                                        <i class="fa fa-eye text-info" data-toggle="tooltip" title="Просмотрено"></i>
                                    @elseif ($order->status == 'process')
                                        <i class="fa fa-arrow-right text-primary" data-toggle="tooltip" title="В процессе"></i>
                                    @elseif ($order->status == 'done')
                                        <i class="fa fa-check text-primary" data-toggle="tooltip" title="Готов"></i>
                                    @endif
                                </td>
                                <td class="text-center">{{ $order->created_at }}</td>
                                <td class="d-flex justify-content-center align-items-center">
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-alt-primary"><i class="si si-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
