@component('mail::message')
# COMMANDE RECU

Merci de votre Commande sur {{ config('app.name') }}.

**ID DE COMMANDE:** {{ $order->id }}

**EMAIL DE COMMANDE:** {{ $order->billing_email }}

**VOTRE NOM :** {{ $order->billing_name }}

**TOTAL:** **<span style="color: purple">{{ presentPrice($order->billing_total) }} </span>**

<span style="color: orange"> **Produits Commandez** </span>
<hr/>

@foreach ($order->products as $product)
**Nom:** {{ $product->name }} <br>
**Prix:** {{ presentPrice($product->price) }} <br>
**Quantité:** {{ $product->pivot->quantity }} <hr/>

@endforeach

<br>
Vous pouvez voir plus de details en vous connectant à notre site kalisso.

@component('mail::button', ['url' => config('app.url'), 'color' => 'green'])
Allez vers le site
@endcomponent

Merci encore de nous avoir choisis.

Regards,<br>
{{ config('app.name') }}
@endcomponent