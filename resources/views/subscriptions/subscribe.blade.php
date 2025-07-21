<div class="row mt-5">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class="mt-2">Subscribe to Our Plan</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('subscription.create') }}" method="POST"
                    id="subscription-form"
                >
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email:</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ auth()->user()->email }}"
                            required>
                    </div>
    
                    <div class="mb-3">
                        <div id="card-element"></div>
                        <input type="hidden" name="payment_method" id="payment-method">
                    </div>
            
                    <div class="my-2">
                        <button id="submit-button" class="btn btn-primary" type="submit">Subscribe</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    const stripe = Stripe('STRIPE PUBLIC KEY HERE');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');

    const form = document.getElementById('subscription-form');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const { setupIntent, error, paymentMethod } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
            billing_details: {
                email: document.getElementById('email').value
            }
        });

        if (error) {
            alert(error.message);
            return;
        }

        document.getElementById('payment-method').value = paymentMethod.id;
        form.submit();
    });
</script>

            