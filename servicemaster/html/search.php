<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<meta http-equiv="cache-control" content="no-cache" />
		<?php echo head(isset($content)?$content:'');?>
		<?php css($array=array('style'));?>
		<?php js($array=array('jquery-1.2.6.min'));?>
	</head>
<?php 
#include the top portion of your website  here.
include_once(DIR_FS_SITE_INCLUDE.'top.php');
include_once(DIR_FS_SITE_INCLUDE.'left.php');
?>
<td valign="top">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
include_once(DIR_FS_SITE_INCLUDE.'banner.php');
?>
	<tr>
        <td colspan="2">
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
			    <!-- main content area -->
                    <td valign="top">
						<table width="494" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="494"><img src="<?php echo DIR_WS_SITE?>graphic/why-lose-top-white.gif" width="494" height="36" /></td>
                          </tr>
                          <tr>
							<td bgcolor="#FFFFFF">
								<table width="100%" border="0" cellspacing="0" cellpadding="2">
									<tr>
										<td align="left" id="breadcrumb">Search Results (<?php echo $keyword?>)</td>
									</tr>
									<tr>
										<td align="right">
											<div class="paging">
											<?php if($status):?>
												<?php echo PageControl_front($query->PageNo, $query->TotalPages, $query->TotalRecords, 'search', $qstring, 2);?>
											<?php endif;?>
											</div>
										</td>
									</tr>
									<tr>
										<td align="left" valign="middle" style="padding-let">
											<?php if(!$status):?>
												Sorry! No results found.
											<?php else:?>
													<table width="100%" cellspacing="5" cellpadding="0" align="center">
														<tr>
															<td width="100%" align="left">
															<?php while($object=$query->GetObjectFromRecord()):?>
																<?php include(DIR_FS_SITE.'template/search.php');?>
															<?php endwhile;?>	
															</td>
														</tr>
													</table>
											<?php endif;?>
										</td>
									</tr>
								</table></td>
							</tr>
                          <tr>
                            <td><img src="<?php echo DIR_WS_SITE?>graphic/why-lose-bottom-white.gif" width="494" height="23" /></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td align="center">
                            <?php include(DIR_FS_SITE.'include/bottom-text.php');?>
                            </td>
                          </tr>
                        </table>
					</td>
						<!-- main content area -->		
<?php
include_once(DIR_FS_SITE_INCLUDE.'right.php');
include_once(DIR_FS_SITE_INCLUDE.'bottom.php');
?>