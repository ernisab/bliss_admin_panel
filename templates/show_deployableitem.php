<?php

/*  author  skynetdev
 *  email   skynetdev3@gmail.com
 *  
 */
?>	
<h1><?php echo $title;?></h1>
	<!-- end page-heading -->

	<table border="0" width="100%" cellpadding="0" cellspacing="0" id="content-table">
	<tr>
		<td id="tbl-border-left"></td>
		<td>
		<!--  start content-table-inner ...................................................................... START -->
		<div id="content-table-inner">
		
			<!--  start table-content  -->
			<div id="table-content">
				<div id="gear_vehicle">
					<div class="gear_info">
						<img class="playermodel" src='images/vehicles/<?php echo $row['class_name']; ?>.jpg'/>
						<div id="gps" style="margin-left:46px;margin-top:54px">
							<div class="gpstext" style="font-size: 22px;width:60px;text-align: left;margin-left:47px;margin-top:13px">
							<?php echo round(($Worldspace[0]/100));?>
							</div>
							<div class="gpstext" style="font-size: 22px;width:60px;text-align: left;margin-left:47px;margin-top:34px">
							<?php echo round(($Worldspace[3]/100));  ?>
							</div>
							<div class="gpstext" style="width:120px;margin-left:13px;margin-top:61px">
							<?php echo world_x($Worldspace[1], getMapName()).world_y($Worldspace[2], getMapName()) ?>
							</div>							
						</div>
						<div class="statstext" style="width: 180px; margin-left: 205px; margin-top: -125px;">
						 Body Owner:&nbsp;<br>	<a target="_blank" href="?page=player&svid=<?php echo $row['svid']?>"> <?php echo $row['pfname'];?></a>
                                                
						</div>
						<div class="statstext" style="width:180px;margin-left:205px;margin-top:-104px">
						Body status:&nbsp; <img style="cursor:help" title="<?php echo $row['is_dead']?'dead':'live';?>" src="images/icons/<?php echo $row['is_dead']?'dead':'live';?>.png">
						</div>
						<div class="statstext" style="width: 180px; margin-left: 205px; margin-top: -58px;">
						 Item last updated:&nbsp;<br>	<?php echo $row['last_updated']?>
						</div> 
						<div class="statstext" style="width: 180px; margin-left: 205px; margin-top: -25px;">
						 Item created:&nbsp;<br>	<?php echo $row['created']?>
						</div>                                                    

					</div>
					<!-- Backpack -->
					<div class="vehicle_gear">	
						<div id="vehicle_inventory">	
						<?php
							
							$maxmagazines = 24;
							$maxweaps = 3;
							$maxbacks = 0;
							$freeslots = 0;
							$freeweaps = 0;
							$freebacks = 0;
							$BackpackName = $row['class_name'];
								$maxmagazines = $row['transport_max_magazines'];
								$maxweaps = $row['transport_max_weapons'];
								$maxbacks = $row['transport_max_backpacks'];
								$BackpackName = $row['name'];
							
							if (count($Backpack) >0){
							$bpweaponscount = count($Backpack[0][0]);
							$bpweapons = array();
							for ($m=0; $m<$bpweaponscount; $m++){
									for ($mi=0; $mi<$Backpack[0][1][$m]; $mi++){
										$bpweapons[] = $Backpack[0][0][$m];
									}
							}							

							
							$bpitemscount = count($Backpack[1][0]);
							$bpitems = array();
							for ($m=0; $m<$bpitemscount; $m++){
								for ($mi=0; $mi<$Backpack[1][1][$m]; $mi++){
									$bpitems[] = $Backpack[1][0][$m];
								}
							}
							
							$bpackscount = count($Backpack[2][0]);
							$bpacks = array();
							for ($m=0; $m<$bpackscount; $m++){
								for ($mi=0; $mi<$Backpack[2][1][$m]; $mi++){
									$bpacks[] = $Backpack[2][0][$m];
								}
							}
							
							$Backpack = (array_merge($bpweapons, $bpacks, $bpitems));
							$freebacks = $maxbacks;
							$backpackslots = 0;
							$backpackitem = array();
							$bpweapons = array();
//                                                        echo "<pre>";
//                                                        print_r($Backpack);
//                                                        exit;
							for ($i=0; $i<count($Backpack); $i++){
								$object_array_for_backpack = getObjectByClassName($Backpack[$i]);
									switch($object_array_for_backpack['type']){
										case 'binocular':
											$backpackitem[] = array('image' => '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $row['slots']);
											break;
										case 'rifle':
											$bpweapons[] = array('image' => '<img style="max-width:84px;max-height:84px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $row['slots']);
											break;
										case 'pistol':
											$bpweapons[] = array('image' => '<img style="max-width:84px;max-height:84px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $row['slots']);
											break;
										case 'backpack':
											$bpweapons[] = array('image' => '<img style="max-width:84px;max-height:84px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $row['slots']);
											$freebacks = $freebacks - 1;
											break;
										case 'heavyammo':
											$backpackitem[] = array('image' => '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $row['slots']);
											break;
										case 'smallammo':
											$backpackitem[] = array('image' => '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $row['slots']);
											break;
										case 'item':
											$backpackitem[] = array('image' => '<img style="max-width:43px;max-height:43px;" src="images/thumbs/'.$Backpack[$i].'.png" title="'.$Backpack[$i].'" alt="'.$Backpack[$i].'"/>', 'slots' => $row['slots']);
											break;
										default:
											$s = '';
									}
								
							}	
							
							$weapons = count($bpweapons);
							$magazines = $maxmagazines;
							$freeslots = $magazines;
							$freeweaps = $maxweaps;
							$jx = 1;
							$jy = 0;
							$jk = 0;
							$jl = 0;
							$numlines = 0;
							for ($j=0; $j< $weapons; $j++){
								if ($jk > 3){ $jk = 0;$jl++;}
								echo '<div class="gear_slot" style="margin-left:'.($jx+(86*$jk)).'px;margin-top:'.($jy+(86*$jl)).'px;width:84px;height:84px;">'.$bpweapons[$j]['image'].'</div>';
								//$magazines = $magazines - $bpweapons[$j]['slots'];	
								$freeweaps = $freeweaps - 1;
								$jk++;
							}
							
							if ($jl > 0){
								$numlines = $jl+1;
							}
							if ($jl == 0){
								if ($weapons > 0){
									$numlines++;
								}
							}
							//if ($weapons == 1){$numlines = 1;}
							$jx = 1;
							$jy = (86*$numlines);
							$jk = 0;
							$jl = 0;

							for ($j=0; $j<$magazines; $j++){
								if ($jk > 6){ $jk = 0;$jl++;}
								if ($j<count($backpackitem)){
									echo '<div class="gear_slot" style="margin-left:'.($jx+(49*$jk)).'px;margin-top:'.($jy+(49*$jl)).'px;width:47px;height:47px;">'.$backpackitem[$j]['image'].'</div>';
									//$jk = $jk - 1 + $backpackitem[$j]['slots'];
									//$backpackslots = $backpackslots + $backpackitem[$j]['slots'];
									$freeslots = $freeslots - 1;
								} else {
									//if($backpackslots==$maxmagazines){
										//break;
									//}
									//$backpackslots++;
									echo '<div class="gear_slot" style="margin-left:'.($jx+(49*$jk)).'px;margin-top:'.($jy+(49*$jl)).'px;width:47px;height:47px;"></div>';
								}								
								$jk++;
							}	
							}
												
						?>
						</div>
						<div class="backpackname">
						<?php
							echo 'Mags:&nbsp;'.$freeslots.'&nbsp;/&nbsp;'.$maxmagazines.'&nbsp;Weaps:&nbsp;'.$freeweaps.'&nbsp;/&nbsp;'.$maxweaps.'&nbsp;Backs:&nbsp;'.$freebacks.'&nbsp;/&nbsp;'.$maxbacks.'&nbsp;';
						?>
						</div>
					</div>
					<!-- Backpack -->

			
				</div>
			</div>
			<!--  end table-content  -->
	
			<div class="clear"></div>
		 
		</div>
		<!--  end content-table-inner ............................................END  -->
		</td>
		<td id="tbl-border-right"></td>
	</tr>
	<tr>
		<th class="sized bottomleft"></th>
		<td id="tbl-border-bottom">&nbsp;</td>
		<th class="sized bottomright"></th>
	</tr>
	</table>
