<div class="wrap-header-cart js-panel-cart">
	<div class="s-full js-hide-cart"></div>

	<div class="header-cart flex-col-l p-l-65 p-r-25">
		<div class="header-cart-title flex-w flex-sb-m p-b-8">
			<span class="mtext-103 cl2">
				Your Cart
			</span>

			<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
				<i class="zmdi zmdi-close"></i>
			</div>
		</div>
		
		<div class="header-cart-content flex-w js-pscroll">
			<ul class="header-cart-wrapitem w-full">
				<?php $total_count = 0; ?>
                <?php foreach ($cart as $row):?>
                    <?php $total_count += $row['subtotal']; ?>
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img rmov-cart" id="<?php echo $row['rowid'] ?>" url="<?php echo base_url('cart/del') ?>">        
                                <img src="<?php echo $row['image_link'] ?>" alt="IMG">
                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04" title="<?php echo $row['name']; ?>">
                                    <?php echo count_text($row['name']); ?>
                                </a>

                                <span class="header-cart-item-info">
                                    <?php echo $row['qty']; ?> x <?php echo number_format($row['price']); ?>.vnđ
                                </span>
                            </div>
                        </li>
                <?php endforeach; ?>
			</ul>
			
			<div class="w-full">
				<div class="header-cart-total w-full p-tb-40">
					Total: <span><?php echo number_format($total_count).'.vnđ'; ?></span>
				</div>

				<div class="header-cart-buttons flex-w w-full">
					<a href="<?php echo base_url('cart') ?>" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
						View Cart
					</a>

					<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
						Check Out
					</a>
				</div>
			</div>
		</div>
	</div>
</div>