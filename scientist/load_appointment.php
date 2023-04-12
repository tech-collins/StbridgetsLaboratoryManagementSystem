<?php 
include 'fabinde.php';

function showAge($dfb)
{
    $birth_date = strtotime($dfb);
    $now = time();
    $age = $now - $birth_date;
    $new_age = intval($age / 60 / 60 / 24 / 365.25);
    return $new_age;
    //$dd = stripos(".",$a,0 );
    //$new_age = substr($a,$dd);
}

                                    $app_status = "pending";
                                    $appointment = mysqli_query($con,"SELECT * FROM appointments WHERE appointment_status='$app_status' ORDER BY appointment_date ASC");
                                    if($appointment)
                                    {
                                        while($res = mysqli_fetch_assoc($appointment))
                                        { 
                                    ?>
									<tr>
										<td><?php echo $res['appointment_no']; ?></td>
										<td><img width="28" height="28" src="assets/img/user.jpg" class="rounded-circle m-r-5" alt=""> <?php echo $res['patient_name']; ?></td>
										<td><?php echo showAge($res['dob']); ?></td>
										<td><?php echo $res['gender']; ?></td>
                                        <td><?php echo $res['test_category']; ?></td>
										<td><?php echo substr($res['appointment_date'],0,-8); ?></td>
										<td><?php echo substr($res['appointment_date'],12,-3); ?></td>
										<td><span class="custom-badge status-red"><?php echo $res['appointment_status']; ?></span></td>
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="view-appointment.php?ref=<?php echo $res['patient_ref_no'];?>&appN=<?php echo $res['appointment_no']; ?>"><i class="fa fa-pencil m-r-5"></i> View</a>
                                                    <a class="dropdown-item" href="#" onclick="queueStatus('<?php echo $res['id']; ?>','sample collected')"><i class="fa fa-pencil m-r-5"></i> accept</a>
                                                    <!-- <a class="dropdown-item" href="" onclick="queueStatus('<?php //echo $res['id']; ?>','finish')"><i class="fa fa-pencil m-r-5"></i> finish test</a>
													<a class="dropdown-item" href="#" onclick="removeAppointment('<?php //echo $res['id']; ?>')" data-toggle="" data-target=""><i class="fa fa-trash-o m-r-5"></i> Delete</a>  -->
												</div>
											</div>
										</td>
									</tr>
                                    <?php
                                        }
                                    } 
                                    ?>