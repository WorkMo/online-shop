@extends('layouts.app')

@section('content')
<script src="https://js.stripe.com/v3/"></script>
@vite(['resources/js/checkout.js','resources/css/checkout.css'])
<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card">
			<div class="card-header">ご注文手続き</div>
			<div class="card-body p-4 ">






				<!-- Display a payment form -->
				<form id="payment-form">
					<div id="link-authentication-element">
						<!--Stripe.js injects the Link Authentication Element-->
					</div>
					<div id="payment-element">
						<!--Stripe.js injects the Payment Element-->
					</div>
					<button id="submit">
						<div class="spinner hidden" id="spinner"></div>
						<span id="button-text">Pay now</span>
					</button>
					<div id="payment-message" class="hidden"></div>
				</form>

				<form action="{{route('card_pay')}}" method="post">
					<input id="card-holder-name" type="text">

					<!-- ストライプ要素のプレースホルダ -->
					<div id="card-element"></div>

					<button id="card-button">
						Process Payment
					</button>
				</form>





    <form action="" class="card-form" id="form_payment" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">カード番号</label>
            <div id="cardNumber"></div>
        </div>

        <div class="form-group">
            <label for="name">セキュリティコード</label>
            <div id="securityCode"></div>
        </div>

        <div class="form-group">
            <label for="name">有効期限</label>
            <div id="expiration"></div>
        </div>

        <div class="form-group">
            <label for="name">カード名義</label>
            <input type="text" name="cardName" id="cardName" class="form-control" value="" placeholder="カード名義を入力">
        </div>
        <div class="form-group">
            <button type="submit" id="create_token" class="btn btn-primary">カードを登録する</button>
        </div>
    </form>
    <a href="}">クレジットカード情報ページに戻る</a>






			</div>
		</div>
	</div>
</div>
<script src="https://js.stripe.com/v3/"></script>

<script>
	const stripe = Stripe('stripe-public-key');

	const elements = stripe.elements();
	const cardElement = elements.create('card', {
		hidePostalCode: true
	});

	cardElement.mount('#card-element');


	const cardHolderName = document.getElementById('card-holder-name');
	const cardButton = document.getElementById('card-button');

	cardButton.addEventListener('click', async (e) => {
		const {
			paymentMethod,
			error
		} = await stripe.createPaymentMethod(
			'card', cardElement, {
				billing_details: {
					name: cardHolderName.value
				}
			}
		);

		if (error) {
			// "error.message"をユーザーに表示…
		} else {
			// カードは正常に検証された…
		}
	});
</script>

@endsection