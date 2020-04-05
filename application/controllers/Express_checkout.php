<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Express_checkout extends MY_Controller
{
	function __construct()
	{
		parent::__construct();

		// Load PayPal library config
		$this->config->load('paypal');
		$config = array(
			'Sandbox' => $this->config->item('Sandbox'),            // Sandbox / testing mode option.
			'APIUsername' => $this->config->item('APIUsername'),    // PayPal API username of the API caller
			'APIPassword' => $this->config->item('APIPassword'),    // PayPal API password of the API caller
			'APISignature' => $this->config->item('APISignature'),    // PayPal API signature of the API caller
			'APISubject' => '',                                    // PayPal API subject (email address of 3rd party user that has granted API permission for your app)
			'APIVersion' => $this->config->item('APIVersion'),        // API version you'd like to use for your call.  You can set a default version in the class and leave this blank if you want.
			'DeviceID' => $this->config->item('DeviceID'),
			'ApplicationID' => $this->config->item('ApplicationID'),
			'DeveloperEmailAccount' => $this->config->item('DeveloperEmailAccount')
		);
		// Show Errors
		if ($config['Sandbox']) {
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
		}

		// Load PayPal library
		$this->load->library('paypal/paypal_pro', $config);
	}

	/**
	 * Cart Review page
	 */
	public function index()
	{
		// Clear PayPalResult from session userdata
		//$this->session->unset_userdata('PayPalResult');

		// Clear cart from session userdata
		//$this->session->unset_userdata('shopping_cart');
		$cart = $this->cart->contents();
		if (empty($cart)) {
			redirect(base_url());
		}
		include APPPATH . 'third_party/simple_html_dom.php';
		
		// For demo purpose, we create example shopping cart data for display on sample cart review pages

		// Example Data - cart item
		$i = 0;
		foreach ($cart as $row) {
			$url = "https://vi.coinmill.com/USD_VND.html?VND=".$row['price']."#VND";
	        $html = file_get_html($url);
	        $price = $html->find("#currencyBox1 .currencyField")[0]->value;
			$cart['items'][$i] = array(
				'id' => $row['id'],
				'name' => $row['name'],
				'size' => $row['options']['size'][0],
				'color' => $row['options']['color'][0],
				'image_link' => $row['image_link'],
				'qty' => $row['qty'],
				'price' => $price,
				'total' => $price*$row['qty']
			);
		$i++;
		}
		$amount_link = "https://vi.coinmill.com/USD_VND.html?VND=".$this->cart->total()."#VND";
        $get_file = file_get_html($amount_link);
        $amount = $get_file->find("#currencyBox1 .currencyField")[0]->value;
		// Example Data - cart variable with items included
		$cart_paypal['shopping_cart'] = array(
			'items' => $cart['items'],
			'subtotal' => $amount,
			'shipping' => 0,
			'handling' => 0,
			'tax' => 0,
		);

		// Example Data - grand total
		$cart_paypal['shopping_cart']['grand_total'] = $cart_paypal['shopping_cart']['subtotal'] + $cart_paypal['shopping_cart']['shipping'] + $cart_paypal['shopping_cart']['handling'] + $cart_paypal['shopping_cart']['tax'];

		// Example - Load Review Page
		$this->session->set_userdata('shopping_cart',$cart_paypal);
		$this->data['cart_paypal'] = $cart_paypal;
		$this->data['page_title'] = 'Paypal - Checkout'.' | '.site_name();
       	$this->data['template'] = 'theme/'.$this->site.'/paypal/index';
       	$this->load->view('theme/'.$this->site.'/layout',$this->data);
	}

	/**
	 * SetExpressCheckout
	 */
	public function SetExpressCheckout()
	{	
		// Clear PayPalResult from session userdata
		$this->session->unset_userdata('PayPalResult');
		// Get cart data from session userdata
		$cart = $this->session->userdata('shopping_cart');
		if (empty($cart)) {
			redirect(base_url());
		}
		/**
		 * Here we are setting up the parameters for a basic Express Checkout flow.
		 *
		 * The template provided at /vendor/angelleye/paypal-php-library/templates/SetExpressCheckout.php
		 * contains a lot more parameters that we aren't using here, so I've removed them to keep this clean.
		 *
		 * $domain used here is set in the config file.
		 */
		$SECFields = array(
			'maxamt' => round($cart['shopping_cart']['grand_total'] * 2,2), 					// The expected maximum total amount the order will be, including S&H and sales tax.
			'returnurl' => base_url('express_checkout/GetExpressCheckoutDetails'), 							    // Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
			'cancelurl' => base_url('express_checkout/OrderCancelled'), 							    // Required.  URL to which the customer will be returned if they cancel payment on PayPal's site.
			'hdrimg' => 'https://www.angelleye.com/images/angelleye-paypal-header-750x90.jpg', 			// URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server or you'll get a warning message in the browser.
			'logoimg' => 'https://www.angelleye.com/images/angelleye-logo-190x60.jpg', 					// A URL to your logo image.  Formats:  .gif, .jpg, .png.  190x60.  PayPal places your logo image at the top of the cart review area.  This logo needs to be stored on a https:// server.
			'brandname' => 'Angell EYE', 							                                // A label that overrides the business name in the PayPal account on the PayPal hosted checkout pages.  127 char max.
			'customerservicenumber' => '816-555-5555', 				                                // Merchant Customer Service number displayed on the PayPal Review page. 16 char max.
		);

		/**
		 * Now we begin setting up our payment(s).
		 *
		 * Express Checkout includes the ability to setup parallel payments,
		 * so we have to populate our $Payments array here accordingly.
		 *
		 * For this sample (and in most use cases) we only need a single payment,
		 * but we still have to populate $Payments with a single $Payment array.
		 *
		 * Once again, the template file includes a lot more available parameters,
		 * but for this basic sample we've removed everything that we're not using,
		 * so all we have is an amount.
		 */
		$Payments = array();
		$Payment = array(
			'amt' => $cart['shopping_cart']['grand_total'], 	// Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
		);

		/**
		 * Here we push our single $Payment into our $Payments array.
		 */
		array_push($Payments, $Payment);

		/**
		 * Now we gather all of the arrays above into a single array.
		 */
		$PayPalRequestData = array(
			'SECFields' => $SECFields,
			'Payments' => $Payments,
		);

		/**
		 * Here we are making the call to the SetExpressCheckout function in the library,
		 * and we're passing in our $PayPalRequestData that we just set above.
		 */
		$PayPalResult = $this->paypal_pro->SetExpressCheckout($PayPalRequestData);

		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If all goes well, we save our token in a session variable so that it's
		 * readily available for us later, and then redirect the user to PayPal
		 * using the REDIRECTURL returned by the SetExpressCheckout() function.
		 */
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			// Load errors to variable
			$this->load->vars('errors', $errors);

			$this->data['page_title'] = 'Paypal - Checkout'.' | '.site_name();
	       	$this->data['template'] = 'theme/'.$this->site.'/paypal/paypal_error';
	       	$this->load->view('theme/'.$this->site.'/layout',$this->data);
		}
		else
		{
			// Successful call.

			// Set PayPalResult into session userdata (so we can grab data from it later on a 'payment complete' page)
			$this->session->set_userdata('PayPalResult', $PayPalResult);

			// In most cases you would automatically redirect to the returned 'RedirectURL' by using: redirect($PayPalResult['REDIRECTURL'],'Location');
			// Move to PayPal checkout
			redirect($PayPalResult['REDIRECTURL'], 'Location');
		}
	}

	/**
	 * GetExpressCheckoutDetails
	 */
	public function GetExpressCheckoutDetails()
	{
		// Get cart data from session userdata
		$cart = $this->session->userdata('shopping_cart');
		if (empty($cart)) {
			redirect(base_url());
		}
		// Get PayPal data from session userdata
		$SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
		$PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

		/**
		 * Now we pass the PayPal token that we saved to a session variable
		 * in the SetExpressCheckout.php file into the GetExpressCheckoutDetails
		 * request.
		 */
		$PayPalResult = $this->paypal_pro->GetExpressCheckoutDetails($PayPal_Token);

		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If the call is successful, we'll save some data we might want to use
		 * later into session variables.
		 */
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			// Load errors to variable
			$this->load->vars('errors', $errors);

			$this->load->view('express_checkout/paypal_error');
		}
		else
		{
			// Successful call.

			/**
			 * Here we'll pull out data from the PayPal response.
			 * Refer to the PayPal API Reference for all of the variables available
			 * in $PayPalResult['variablename']
			 *
			 * https://developer.paypal.com/docs/classic/api/merchant/GetExpressCheckoutDetails_API_Operation_NVP/
			 *
			 * Again, Express Checkout allows for parallel payments, so what we're doing here
			 * is usually the library to parse out the individual payments using the GetPayments()
			 * method so that we can easily access the data.
			 *
			 * We only have a single payment here, which will be the case with most checkouts,
			 * but we will still loop through the $Payments array returned by the library
			 * to grab our data accordingly.
			 */
			$cart['paypal_payer_id'] = isset($PayPalResult['PAYERID']) ? $PayPalResult['PAYERID'] : '';
			$cart['phone_number'] = isset($PayPalResult['PHONENUM']) ? $PayPalResult['PHONENUM'] : '';
			$cart['email'] = isset($PayPalResult['EMAIL']) ? $PayPalResult['EMAIL'] : '';
			$cart['first_name'] = isset($PayPalResult['FIRSTNAME']) ? $PayPalResult['FIRSTNAME'] : '';
			$cart['last_name'] = isset($PayPalResult['LASTNAME']) ? $PayPalResult['LASTNAME'] : '';

			foreach($PayPalResult['PAYMENTS'] as $payment) {
				$cart['shipping_name'] = isset($payment['SHIPTONAME']) ? $payment['SHIPTONAME'] : '';
				$cart['shipping_street'] = isset($payment['SHIPTOSTREET']) ? $payment['SHIPTOSTREET'] : '';
				$cart['shipping_city'] = isset($payment['SHIPTOCITY']) ? $payment['SHIPTOCITY'] : '';
				$cart['shipping_state'] = isset($payment['SHIPTOSTATE']) ? $payment['SHIPTOSTATE'] : '';
				$cart['shipping_zip'] = isset($payment['SHIPTOZIP']) ? $payment['SHIPTOZIP'] : '';
				$cart['shipping_country_code'] = isset($payment['SHIPTOCOUNTRYCODE']) ? $payment['SHIPTOCOUNTRYCODE'] : '';
				$cart['shipping_country_name'] = isset($payment['SHIPTOCOUNTRYNAME']) ? $payment['SHIPTOCOUNTRYNAME'] : '';
			}

			
			// Set example cart data into session
			$this->session->set_userdata('shopping_cart', $cart);

			// Load example cart data to variable
			$this->load->vars('cart', $cart);
			// Example - Load Review Page
			$this->data['cart_paypal'] = $cart;
			$this->data['page_title'] = 'Paypal - Checkout'.' | '.site_name();
	       	$this->data['template'] = 'theme/'.$this->site.'/paypal/index';
	       	$this->load->view('theme/'.$this->site.'/layout',$this->data);
		}
	}

	/**
	 * DoExpressCheckoutPayment
	 */
	public function DoExpressCheckoutPayment()
	{
		/**
		 * Now we'll setup the request params for the final call in the Express Checkout flow.
		 * This is very similar to SetExpressCheckout except that now we can include values
		 * for the shipping, handling, and tax amounts, as well as the buyer's name and
		 * shipping address that we obtained in the GetExpressCheckoutDetails step.
		 *
		 * If this information is not included in this final call, it will not be
		 * available in PayPal's transaction details data.
		 *
		 * Once again, the template for DoExpressCheckoutPayment provides
		 * many more params that are available, but we've stripped everything
		 * we are not using in this basic demo out.
		 */

		// Get cart data from session userdata
		$cart = $this->session->userdata('shopping_cart');
		if (empty($cart)) {
			redirect(base_url());
		}
		// Get cart data from session userdata
		$SetExpressCheckoutPayPalResult = $this->session->userdata('PayPalResult');
		$PayPal_Token = $SetExpressCheckoutPayPalResult['TOKEN'];

		$DECPFields = array(
			'token' => $PayPal_Token, 								// Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
			'payerid' => $cart['paypal_payer_id'], 							// Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
		);

		/**
		 * Just like with SetExpressCheckout, we need to gather our $Payment
		 * data to pass into our $Payments array.  This time we can include
		 * the shipping, handling, tax, and shipping address details that we
		 * now have.
		 */
		$Payments = array();
		$Payment = array(
			'amt' => number_format($cart['shopping_cart']['grand_total']), 	    // Required.  The total cost of the transaction to the customer.  If shipping cost and tax charges are known, include them in this value.  If not, this value should be the current sub-total of the order.
			'itemamt' => number_format($cart['shopping_cart']['subtotal']),       // Subtotal of items only.
			'currencycode' => 'USD', 					                                // A three-character currency code.  Default is USD.
			'shippingamt' => number_format($cart['shopping_cart']['shipping']), 	// Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
			'handlingamt' => number_format($cart['shopping_cart']['handling']), 	// Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
			'taxamt' => number_format($cart['shopping_cart']['tax']), 			// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order.
			'shiptoname' => $cart['shipping_name'], 					            // Required if shipping is included.  Person's name associated with this address.  32 char max.
			'shiptostreet' => $cart['shipping_street'], 					        // Required if shipping is included.  First street address.  100 char max.
			'shiptocity' => $cart['shipping_city'], 					            // Required if shipping is included.  Name of city.  40 char max.
			'shiptostate' => $cart['shipping_state'], 					            // Required if shipping is included.  Name of state or province.  40 char max.
			'shiptozip' => $cart['shipping_zip'], 						            // Required if shipping is included.  Postal code of shipping address.  20 char max.
			'shiptocountrycode' => $cart['shipping_country_code'], 				    // Required if shipping is included.  Country code of shipping address.  2 char max.
			'shiptophonenum' => $cart['phone_number'],  				            // Phone number for shipping address.  20 char max.
			'paymentaction' => 'Sale', 					                                // How you want to obtain the payment.  When implementing parallel payments, this field is required and must be set to Order.
		);

		/**
		 * Here we push our single $Payment into our $Payments array.
		 */
		array_push($Payments, $Payment);

		/**
		 * Now we gather all of the arrays above into a single array.
		 */
		$PayPalRequestData = array(
			'DECPFields' => $DECPFields,
			'Payments' => $Payments,
		);

		/**
		 * Here we are making the call to the DoExpressCheckoutPayment function in the library,
		 * and we're passing in our $PayPalRequestData that we just set above.
		 */
		$PayPalResult = $this->paypal_pro->DoExpressCheckoutPayment($PayPalRequestData);

		/**
		 * Now we'll check for any errors returned by PayPal, and if we get an error,
		 * we'll save the error details to a session and redirect the user to an
		 * error page to display it accordingly.
		 *
		 * If the call is successful, we'll save some data we might want to use
		 * later into session variables, and then redirect to our final
		 * thank you / receipt page.
		 */
		if(!$this->paypal_pro->APICallSuccessful($PayPalResult['ACK']))
		{
			$errors = array('Errors'=>$PayPalResult['ERRORS']);

			// Load errors to variable
			$this->load->vars('errors', $errors);

			$this->load->view('site/paypal/paypal_error');
		}
		else
		{
			// Successful call.
			/**
			 * Once again, since Express Checkout allows for multiple payments in a single transaction,
			 * the DoExpressCheckoutPayment response is setup to provide data for each potential payment.
			 * As such, we need to loop through all the payment info in the response.
			 *
			 * The library helps us do this using the GetExpressCheckoutPaymentInfo() method.  We'll
			 * load our $payments_info using that method, and then loop through the results to pull
			 * out our details for the transaction.
			 *
			 * Again, in this case we are you only working with a single payment, but we'll still
			 * loop through the results accordingly.
			 *
			 * Here, we're only pulling out the PayPal transaction ID and fee amount, but you may
			 * refer to the API reference for all the additional parameters you have available at
			 * this point.
			 *
			 * https://developer.paypal.com/docs/classic/api/merchant/DoExpressCheckoutPayment_API_Operation_NVP/
			 */
			foreach($PayPalResult['PAYMENTS'] as $payment)
			{
				$cart['paypal_transaction_id'] = isset($payment['TRANSACTIONID']) ? $payment['TRANSACTIONID'] : '';
				$cart['paypal_fee'] = isset($payment['FEEAMT']) ? $payment['FEEAMT'] : '';
			}

			// Set example cart data into session
			$this->session->set_userdata('shopping_cart', $cart);

			// Successful Order
			redirect(base_url('express_checkout/OrderComplete'));
		}
	}

	/**
	 * Order Complete - Pay Return Url
	 */
	public function OrderComplete()
	{
		// Get cart from session userdata
		$shopping_cart = $this->session->userdata('shopping_cart');
		$cart = $this->cart->contents();
		if(empty($shopping_cart)) redirect('paypal/express_checkout');

		$transaction = $this->session->userdata('transaction');
		$transaction['paypal_fee'] = $shopping_cart['paypal_fee'];
		$transaction['usd'] = $shopping_cart['shopping_cart']['grand_total'];
		$this->session->set_userdata('transaction', $transaction);
		$this->load->model('transaction_model');
		$this->load->model('order_model');
		$this->transaction_model->create($transaction);

		$transaction_id = $this->db->insert_id();
		foreach ($cart as $row) {
			$json = json_encode($row['options']);
			$data = array(
			'transaction_id' => $transaction_id,
			'product_id'	 => $row['id'],
			'qty'			 => $row['qty'],
			'amount'		 => $row['subtotal'],
			'data'			 => $json,
			'status'		 => '0',
			);
			$this->order_model->create($data);
		}
		//real time cart to trans
		/*$this->load->view('vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '101d71ba1f48fc65f0f8',
            '8113aca0a3241eecbdaa',
            '814743',
            $options
        );
        $where['where'] = array('status'=> '0');
        $count_items = $this->transaction_model->get_total($where);
        $data_tran 		 = array(
        	'count'		=> $count_items,
        	'id' 		=> $transaction_id,
			'status'	 => '<strong class="text-green">Đã Thanh Toán</strong>',
			'user_email' => $transaction['user_email'],
			'user_name'	 => $transaction['user_name'],
			'user_phone' => $transaction['user_phone'],
			'user_address'=> $transaction['citi'].'/'.$transaction['user_address'],
			'amount'	 => number_format($shopping_cart['shopping_cart']['grand_total']).'$',// tong don hang
			'fee'	 => $fee.'.$',// tong don hang
			'ptt'	 	=> 'Paypal',// con  thanh toan
			'created'	 => get_date(now()),
			'get_order'  => '<button type="button" data-id="'.$transaction_id.'" class="get_order btn btn-default" data-toggle="modal" data-target="#modal-default" data-url="'.base_url('admin/transaction/get_order').'"><i class="fa fa-eye"></i></button>',
			'update_tran' => '<a class="btn btn-warning"> Chưa Ship</a>',
			'destroy_tran' => ''
		);
        $pusher->trigger('send_cart', 'my-event', $data_tran);*/
		// xoa all cart
		$this->cart->destroy();
		$this->session->unset_userdata('shopping_cart');
		$this->session->unset_userdata('PayPalResult');
		$this->session->unset_userdata('data_payment');
		$this->session->set_flashdata('notify_success',$this->lang->line('pay-success'));
		redirect(base_url());
	}

	/**
	 * Order Cancelled - Pay Cancel Url
	 */
	public function OrderCancelled()
	{
		// Clear PayPalResult from session userdata
		$this->session->unset_userdata('PayPalResult');

		// Clear cart from session userdata
		$this->session->unset_userdata('shopping_cart');

		// Successful call.  Load view or whatever you need to do here.
		$this->session->set_flashdata('notify_success',$this->lang->line('pay-error'));
		redirect(base_url());
	}

}