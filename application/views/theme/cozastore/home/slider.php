<section class="section-slide">
	<div class="wrap-slick1">
		<div class="slick1">
			<?php  
				$anima = array('fadeInDown','fadeInUp','zoomIn','rollIn','lightSpeedIn','slideInUp','rotateInDownLeft','rotateInUpRight','rotateIn');
			?>
			<?php 
				foreach ($slide as $key) {
			?>
				<div class="item-slick1" style="background-image: url(<?php echo public_url('upload/slide/'.$key->image_link) ?>);">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="<?php echo $anima[rand(0, count($anima) - 1)]; ?>" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									<?php echo $key->name; ?>
								</span>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="<?php echo $anima[rand(0, count($anima) - 1)]; ?>" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									<?php echo $key->info; ?>
								</h2>
							</div>
								
							<div class="layer-slick1 animated visible-false" data-appear="<?php echo $anima[rand(0, count($anima) - 1)]; ?>" data-delay="1600">
								<a href="<?php echo $key->link ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php 
				} 
			?>
		</div>
	</div>
</section>