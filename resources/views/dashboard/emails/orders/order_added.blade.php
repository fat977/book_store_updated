<x-mail::table>
    Welcome : {{ $name }}

    Your order's price is {{ $order->total_price }} and it will deliver at {{ $order->delivered_at }}
    This mail is sent by super admin .


    | Name              | price | quantity |
    | ------------------|:------| --------:|
    @foreach ($order->books as $book)
        
    {{ $book->name }}   | {{ $book->pivot->price }} |{{ $book->pivot->quantity }}

    @endforeach
Thanks,<br>
{{ config('app.name') }}
</x-mail::table>
