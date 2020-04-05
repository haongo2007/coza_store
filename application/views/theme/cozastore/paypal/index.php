<!-- breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
            Paypal CheckOut
        </span>
    </div>
</div>
        

<!-- Shoping Cart -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-xl-12 m-lr-auto m-b-25">
            <div class="m-lr-0-xl bg0 p-t-75 p-b-30">
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart">
                        <tr class="table_head">
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        <?php foreach ($cart_paypal['shopping_cart']['items'] as $row):?>
                            <tr class="table_row">
                                <td class="p-lr-10">
                                    <div class="how-itemcart2 m-auto">
                                        <img src="<?php echo $row['image_link'] ?>" alt="IMG-PRODUCT">
                                    </div>
                                </td>
                                <td class="column-2"><span><?php echo $row['name']; ?></span></td>
                                <td class="column-2">
                                    <span><?php echo $row['color']; ?></span>
                                </td>
                                <td class="column-2">
                                    <span><?php echo $row['size']; ?></span>
                                </td>
                                <td class="column-2">
                                    <span><?php echo $row['price'].'.$'; ?></span>
                                </td>
                                <td class="column-2">
                                    <span><?php echo $row['qty']; ?></span>
                                </td>
                                <td class="column-2"><?php echo $row['total'].'.$'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-6 m-b-50">
            <div class="bor10 p-lr-40 p-t-30 p-b-40">
                <h4 class="mtext-109 cl2 p-b-30">
                    Customer information
                </h4>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Subtotal:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            $.<?php echo $cart_paypal['shopping_cart']['subtotal']; ?>
                        </span>
                    </div>
                </div>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Shipping:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            $.<?php echo $cart_paypal['shopping_cart']['shipping']; ?>
                        </span>
                    </div>
                </div>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Handling:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            $.<?php echo $cart_paypal['shopping_cart']['handling']; ?>
                        </span>
                    </div>
                </div>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Tax:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            $.<?php echo $cart_paypal['shopping_cart']['tax']; ?>
                        </span>
                    </div>
                </div>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Grand Total:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            $.<?php echo $cart_paypal['shopping_cart']['grand_total']; ?>
                        </span>
                    </div>
                </div>
                <?php 
                    $link_out = isset($cart_paypal['paypal_payer_id']) ? base_url('express_checkout/DoExpressCheckoutPayment') : base_url('express_checkout/SetExpressCheckout');
                    $button = isset($cart_paypal['paypal_payer_id']) ? 'Finish' : 'Continue';
                ?>
                <div class="flex-w flex-t flex-m p-t-27 p-b-33">
                    <div class="size-209 p-t-1">
                        <a href="<?php echo $link_out; ?>">
                            <button class="sub-order flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                <?php echo $button; ?>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($cart_paypal['paypal_payer_id'])) { ?>
        <div class="col-lg-6 col-xl-6 m-b-50">
            <div class="bor10 p-lr-40 p-t-30 p-b-40">
                <h4 class="mtext-109 cl2 p-b-30">
                    Billing Information
                </h4>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Name:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            <?php echo $cart_paypal['first_name'] . ' ' . $cart_paypal['last_name']; ?>
                        </span>
                    </div>
                </div>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Send To:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            <?php echo $cart_paypal['shipping_name'] ?>
                        </span>
                    </div>
                </div>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                            Email:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            <?php echo $cart_paypal['email']; ?>
                        </span>
                    </div>
                </div>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                           Address:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            <?php echo $cart_paypal['shipping_street'].', '.$cart_paypal['shipping_city'] . ', ' . $cart_paypal['shipping_state'] . '  ' . $cart_paypal['shipping_zip'] . '<br />' .$cart_paypal['shipping_country_name'] ?>
                        </span>
                    </div>
                </div>
                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                    <div class="size-208">
                        <span class="stext-110 cl2">
                           Phone Number:
                        </span>
                    </div>

                    <div class="size-209">
                        <span class="mtext-110 cl2">
                            <?php echo $cart_paypal['phone_number']; ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<style type="text/css">
.table_head th{
    text-align: center;
}
.table_row td{
    text-align: center;
}
</style>