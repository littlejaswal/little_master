<?php
    function display_form_error()
    {
            $login_session =new user_session();
            if($login_session->isset_pass_msg()):
                    $array=$login_session->get_pass_msg();
                    ?>
                     <div style="background-color:#6F0E07;color:#ffffff;padding:3px;font-weight:bold;width:100%;text-align:center;">
                            <span>
                                    <?foreach ($array as $value):
                                      echo '&raquo;&nbsp;'.$value.'';
                                     endforeach;?>
                            </span>
                     </div>
            <?php elseif(isset($_GET['msg'])):?>
                     <div style="background-color:#6F0E07;color:#ffffff;padding:3px;font-weight:bold;margin:5px;width:100%;text-align:center;">
                            <span> <?php echo $_GET['msg'];?> </span>
                    </div>
            <?php endif;
            if(isset($_GET['msg'])):
                    unset($_GET['msg']);
            endif;
            $login_session->isset_pass_msg()?$login_session->unset_pass_msg():'';
    }

    function check_logged_in()
    {
            $login_session =new user_session();
            if($login_session->is_logged_in() && $login_session->is_verified()):
                    return 1;
            elseif($login_session->is_logged_in() && !$login_session->is_verified()):
                    Redirect(make_url('myaccount'));
            else:
                    return 0;
            endif;
    }

    function check_logged_in_for_myaccount()
    {
            $login_session =new user_session();
            if(!$login_session->is_logged_in()):
                    Redirect(make_url('login'));
            endif;
    }

    function check_logged_in_for_wishlist()
    {
            $login_session =new user_session();
            if($login_session->is_logged_in()):
                    Redirect(make_url('wishlist'));
            endif;
    }

    function page_redirect($url)
    {
            $login_session= new user_session();
            $login_session->redirect_url=$url;
            $login_session->set_redirect_url();
    }
?>