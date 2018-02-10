<template>
    <div class="section center-container">
        <form action="/buy" method="POST">
            <div class="row">
                <div class="form-group col-md">
                    <label for="first_name">First Name: </label>
                    <input type="text" name="first_name" placeholder="First Name" class="form-control" required>
                </div>
                <div class="form-group col-md">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" placeholder="Last Name" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email: </label>
                <input type="email" name="email" placeholder="Email" class="form-control" required>
            </div>
             <div class="row">
                <div class="form-group col-md-7">
                    <label for="address">Address: </label>
                    <input type="text" name="address" placeholder="Address" class="form-control" required>
                </div>
                <div class="form-group col-md-5">
                    <label for="zipcode"> &nbsp; </label>
                    <input type="text" name="zipcode" placeholder="zipcode" class="form-control" required>
                </div>
            </div>


            <input type="hidden" name="stripeToken" v-model="stripeToken">
            <input type="hidden" name="stripeEmail" v-model="stripeEmail">
            <input type="hidden" name="_token" value="">

            <div class="form-group">
                <input @click.prevent="buy" id="submit-checkout" type="submit" class="btn btn-primary" name="sub" value="Checkout">
            </div>
        </form>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                stripeEmail: '',
                stripeToken: '',
                _token: '',
                email: '',
                first_name: '',
                last_name: '',
                address: '',
                zipcode: ''
            };
        },

        created() {
            this.stripe = StripeCheckout.configure({
                key: defaults.stripeKey,
                locale: 'auto',
                token: (token) => {
                    this.stripeToken = token.id;
                    this.stripeEmail = token.email;
                    this._token = document.querySelector('meta[name="csrf-token"]').content;
                    this.email  = document.querySelector('input[name="email"]').value;
                    this.first_name  = document.querySelector('input[name="first_name"]').value;
                    this.last_name  = document.querySelector('input[name="last_name"]').value;
                    this.zip  = document.querySelector('input[name="zipcode"]').value;
                    this.address  = document.querySelector('input[name="address"]').value;

                    let formData = this.$data;

                    console.log(formData);

                    axios.post('/buy-ticket', formData)
                        .then(response => {
                            alert('Complete! Thanks for your payment!')
                        })
                        .catch(e =>
                            {console.warn(e)
                        });
                }
             });
        },

        methods: {
            buy() {
                this.stripe.open({
                    name: 'Ticket',
                    description: 'Ticket for the event.',
                    amount: 2500,
                    zipCode: true
                });
            }
        }
    }
</script>
