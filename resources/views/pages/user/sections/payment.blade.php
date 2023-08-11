<div class='error d-none mb-3'>
    <div class='alert alert-danger'>Please correct the errors and try again.</div>
</div>

<div class="alert alert-info">
    DEMO Data:<br/>
    Name: Test<br/>
    Number: 4242 4242 4242 4242<br/>
    CSV: 123<br/>
    Expiration Month: 12<br/>
    Expiration Year: 2028
</div>

<div class="card">
    <form role="form"
          action="{{ route('payment', $user->username) }}"
          method="post"
          class="require-validation"
          data-cc-on-file="false"
          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
          id="payment-form">
        @csrf
        <div class="card-header fw-bold">
            Payment Details
        </div>
        <div class="card-body">
            <div class='form-row row mb-3'>
                <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Name on Card</label>
                    <input class='form-control' size='4' type='text'>
                </div>
            </div>

            <div class='form-row row mb-3'>
                <div class='col-xs-12 form-group required'>
                    <label class='control-label'>Card Number</label>
                    <input autocomplete='off' class='form-control card-number' size='20' type='text'>
                </div>
            </div>

            <div class='form-row row mb-3'>
                <div class='col-xs-12 col-md-4 form-group cvc required'>
                    <label class='control-label'>CVC</label>
                    <input autocomplete='off'
                           class='form-control card-cvc' placeholder='ex. 311' size='4'
                           type="number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==3) return false;">
                </div>
                <div class='col-xs-12 col-md-4 form-group expiration required'>
                    <label class='control-label'>Expiration Month</label>
                    <input class='form-control card-expiry-month' placeholder='MM' size='2'
                           type='text'>
                </div>
                <div class='col-xs-12 col-md-4 form-group expiration required'>
                    <label class='control-label'>Expiration Year</label> <input
                        class='form-control card-expiry-year' placeholder='YYYY' size='4'
                        type='text'>
                </div>
            </div>

        </div>
        <div class="card-footer text-end">
            <button type="submit" class="btn btn-success">Save</button>
        </div>

    </form>
</div>

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">

        $(function() {

            /*------------------------------------------
            --------------------------------------------
            Stripe Payment Code
            --------------------------------------------
            --------------------------------------------*/

            var $form = $(".require-validation");

            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            /*------------------------------------------
            --------------------------------------------
            Stripe Response Handler
            --------------------------------------------
            --------------------------------------------*/
            function stripeResponseHandler(status, response) {
                if (response.error) {
                    console.log(response.error.message);
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    /* token contains id, last4, and card type */
                    var token = response['id'];

                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endpush
