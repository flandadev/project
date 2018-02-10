'use strict';

let price = $('[name="event-price"]').val() / 100;
let busprice = $('[name="bus"]').val() / 100;

price += busprice;
price = Math.round(price * 100) / 100
$('button[type="submit"]').html(`Pay ${price} €`);

$('[name="ticket"]').on('change', function() {
	let quantity = $(this).val();
    busprice = $('[name="bus"]').val() / 100;

	// GET THE BASE PRICE
  	price = $('[name="event-price"]').val() / 100;
	
	  // MULTIPLY TICKETS
	price = price * quantity;

	// ADD PRICE
	price = price + ( busprice * quantity );
	
	// ROUND
  	price = Math.round(price * 100) / 100;

  $('button[type="submit"]').html(`Pay ${price} €`)
});

$('[name="bus"]').on('change', function() {
    busprice = $('[name="bus"]').val() / 100;
	price = $('[name="event-price"]').val() / 100;

	price = price + busprice;
	price = price * $('[name="ticket"]').val();
	price = Math.round(price * 100) / 100;

	$('button[type="submit"]').html(`Pay ${price} €`)

	console.log($('[name="bus"]').val() * $('[name="ticket"]').val())
})
