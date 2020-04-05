<!-- breadcrumb -->
<div class="container">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			Shoping Cart
		</span>
	</div>
</div>
		

<!-- Shoping Cart -->
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-xl-12 m-lr-auto m-b-25">
			<div class="m-lr-0-xl">
				<form class="bg0 p-t-75 p-b-30" action="<?php echo base_url('cart/update') ?>" method="post">
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
					<?php $total_count = 0; $i = 0;
			    		foreach ($cart as $row):
			    			$total_count += $row['subtotal'];
							$where = array('id_product' => $row['id']);
	        				$attr = $this->atribute_model->get_info_rule($where);
					?>
							<tr class="table_row">
								<td>
									<div class="how-itemcart2 m-auto">
										<img src="<?php echo $row['image_link'] ?>" alt="IMG-PRODUCT">
									</div>
								</td>
								<td><?php echo $row['name']; ?></td>
								<td><?php echo number_format($row['price']).'.vnđ'; ?></td>
								<td class="p-lr-10">
									<div class="">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 clr change-size" attr-id="<?php echo $attr->id ?>" url="<?php echo base_url('cart/change_size') ?>" name="color_<?php echo $row['id'] ?>">
												<?php
													$color = $row['options']['color'][0];
													foreach (explode('|', $attr->name) as $key => $value) {
												?>
													<option <?php  echo ($color == $value) ? 'selected' : '' ?>>
														<?php echo trim($value); ?>
													</option>
												<?php 
													}
												?>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
								</td>
								<td>
									<div class="">
										<div class="rs1-select2 bor8 bg0">
											<select class="js-select2 siz recipients" name="size_<?php echo $row['id'] ?>">
												<?php 
								                	$posi = $row['options']['posi'][0];
								                	$size = $row['options']['size'][0];
								                	$size_arr = explode('|', $attr->size);
								                	$size_arr = explode(',', $size_arr[$posi]);
								                	foreach ($size_arr as $key => $value) { 
								                ?>
								                	<option <?php echo ($size == 'Size '.$value) ? 'selected' : '' ?>>
								              		<?php echo 'Size '.trim($value); ?>
								              		</option>
								                <?php 
								            		}	 
								                ?>
											</select>
											<div class="dropDownSelect2"></div>
										</div>
									</div>
									<input type="hidden" class="posi" name="posi_<?php echo $row['id'] ?>" value="<?php echo $posi ?>">
								</td>
								<td>
									<div class="wrap-num-product flex-w m-auto">
										<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-minus"></i>
										</div>

										<input class="mtext-104 cl3 txt-center num-product" type="number" name="qty_<?php echo $row['id'] ?>" value="<?php echo $row['qty']; ?>">

										<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
											<i class="fs-16 zmdi zmdi-plus"></i>
										</div>
									</div>
								</td>
								<td><?php echo number_format($row['subtotal']).'.vnđ'; ?></td>
							</tr>
					<?php $i++; endforeach; ?>
						</table>
					</div>
					<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
						<div class="flex-w flex-m m-r-20 m-tb-5">
							<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
								
							<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
								Apply coupon
							</div>
						</div>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
						<button type="submit">
							<div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
								Update Cart
							</div>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<form class="row" action="<?php echo base_url('cart') ?>" method="post">
		<div class="col-lg-6 col-xl-6 m-b-50">
			<div class="bor10 p-lr-40 p-t-30 p-b-40">
				<h4 class="mtext-109 cl2 p-b-30">
					Customer information
				</h4>
				<div class="bor8 bg0 m-b-22">
					<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" value="<?php echo isset($user['name']) ? $user['name'] : '' ?>" placeholder="Your Name">
				</div>
				<div class="bor8 bg0 m-b-22">
					<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email" value="<?php echo isset($user['email']) ? $user['email'] : '' ?>" placeholder="Your mail">
				</div>
				<div class="bor8 bg0 m-b-22">
					<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="address" value="<?php echo isset($user['address']) ? $user['address'] : '' ?>" placeholder="Your Address">
				</div>
				<div class="bor8 bg0 m-b-22">
					<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="number" name="phone" value="<?php echo isset($user['phone']) ? $user['phone'] : '' ?>" placeholder="Your Phone">
				</div>
				<span class="stext-112 cl8">
					Note (*)
				</span>
				<div class="bor8 bg0 m-b-22">
					<textarea class="stext-111 cl8 plh3 size-111 p-lr-15" name="note"></textarea>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-xl-6 m-b-50">
			<div class="bor10 p-lr-40 p-t-30 p-b-40">
				<h4 class="mtext-109 cl2 p-b-30">
					Cart Totals
				</h4>

				<div class="flex-w flex-t bor12 p-b-13">
					<div class="size-208">
						<span class="stext-110 cl2">
							Subtotal:
						</span>
					</div>

					<div class="size-209">
						<span class="mtext-110 cl2 sub-total" subtt="<?php echo $total_count ?>">
							<?php echo number_format($total_count); ?>.vnđ
						</span>
						<br><small>(Excluding shipping charges)</small>
					</div>
				</div>

				<div class="flex-w flex-t bor12 p-t-15 p-b-30">
					<div class="size-208 w-full-ssm">
						<span class="stext-110 cl2">
							Shipping:
						</span>
					</div>

					<div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
						<p class="stext-111 cl6 p-t-2 notif">
							There are no shipping methods available. Please double check your address, or contact us if you need any help.
						</p>
						
						<div class="p-t-15">
							<span class="stext-112 cl8">
								Calculate Shipping
							</span>

							<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
								<select class="js-select2 get_citi" name="citi">
									<option value="0">City</option>
									<?php foreach ($citi as $key) {?>
										<option value="<?php echo $key->fee; ?>"><?php echo $key->citi; ?></option>
									<?php }?>
								</select>
								<div class="dropDownSelect2"></div>
							</div>

							<div class="bor8 bg0 m-b-22">
								<input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" value="<?php echo isset($user['postcode']) ? $user['postcode'] : '' ?>" name="postcode" placeholder="Postcode / Zip">
							</div>
							<span class="stext-112 cl8">
								Payment
							</span>
							<div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
								<select class="js-select2" name="payment">
									<option value="0">Thanh Toán Khi Nhận Hàng</option>
									<?php foreach ($payment as $key) { ?>
									<option value="<?php echo $key->id ?>"><?php echo $key->name; ?></option>
									<?php } ?>
								</select>
								<div class="dropDownSelect2"></div>
							</div>
						</div>
					</div>
				</div>

				<div class="flex-w flex-t flex-m p-t-27 p-b-33">
					<div class="size-208">
						<input type="hidden" name="totalmount" class="ttmount">
						<span class="mtext-101 cl2 amount">
							Total: <?php echo number_format($total_count); ?>.vnđ
						</span>
					</div>
			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
					<div class="size-209 p-t-1">
						<button disabled type="submit" class="sub-order flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Checkout
						</button>
					</div>
				</div>

			</div>
		</div>
	</form>
</div>
<style type="text/css">
.table_head th{
	text-align: center;
}
.table_row td{
	text-align: center;
}
</style>