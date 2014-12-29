<?
# Login messages.
define("MSG_LOGIN_INVALID_USERNAME_PASSWORD","Invalid <b>Username</b> or <b>Password</b>.",true);
define("MSG_LOGIN_WELCOME_MSG","Welcome to my account section.",true);
define("MSG_LOGIN_EMAIL_ADDRESS_ALREADY_EXIST","This email address already exists. Please try again.",true);
define("MSG_LOGIN_USERNAME_ALREADY_EXIST","This Username already exists. Please try again.",true);
define("MSG_LOGIN_WRONG_PASSWORD","Password does not match.",true);
define("MSG_LOGIN_EMPTY_PASSWORD","Password cannot be left empty.",true);
define("MSG_LOGIN_ALREADY_LOGGED_IN", "Sorry! you are already logged in.");
define("MSG_LOGIN_EMAIL_FORMATE", "Please use correct Email format <b>like: username@username.com</b>.<br/>You cannot leave <b>password field</b> blank.");
define("MSG_LOGIN_NOT_BLANK", "You cannot leave <b>email field</b> blank.<br/>You cannot leave <b>password field</b> blank.");
define("MSG_LOGIN_ELSE", "You cannot leave <b>email field</b> blank.<br/> Please use correct Email format <b>like: username@username.com</b>.<br/> You cannot leave <b>password field</b> blank.");
define("MSG_SEC_NOT_VALID", "Security code could not be validated. Please try again.");
# my account messages.
define("MSG_REGISTER_PASSWORDS_NOT_SAME","Your passwords do not match.",true);
define("MSG_ACCOUNT_PASSWORD_CHANGE_SUCCESS","Your password has been successfully changed.",true);
define("MSG_ACCOUNT_UPDATE_SUCCESS","Your account information has been updated successfully.",true);
define("MSG_ACCOUNT_UPDATE_FAILED","Your account was not updated. Please try again.",true);
define("MSG_ACCOUNT_ALREADY_ACTIVE", "Your account is already active. Please <a href='".DIR_WS_SITE."?page=login'>click here</a> to login.");
define("MSG_ACCOUNT_MADE_ACTIVE", "Your account has been activated. An email containing your login details has been sent to your email address. Please <a href='".DIR_WS_SITE."?page=login'>click here</a> to login.");
define("MSG_ACCOUNT_NOT_MADE_ACTIVE", "Alas! some techinical malfunction has taken place. Please try again.");
define("MSG_ACCOUNT_WRONG_USER_INFO", "You have used a wrong user information. If you are not a registred user yet. Please <a href='".DIR_WS_SITE."?page=register'>click here</a> to register.");
define("MSG_ACCOUNT_WRONG_URL", "You have used a wrong URL. If you are not a registred user yet. Please <a href='".DIR_WS_SITE."?page=login'>click here</a> to register.");
define("MSG_ACCOUNT_CONFIRM_EMAIL_RESEND_SUCCESS", "Confirmation email has been successfully resent to your registered email address.");
define("MSG_ACCOUNT_CONFIRM_EMAIL_NEW_RESEND_SUCCESS", "Confirmation email has been successfully sent to your new email address.");


#logout messages.
define("MSG_LOGOUT_SUCCESS","You have successfully <b>logged out</b>.",true);


#registrations messages.
define("MSG_REGISTR_FAILED", "Sorry! Registration process failed. Please try again.");
define("MSG_REGISTER_PASSWORDS_NOT_SAME", "Password and confirm password must be same.");
define("MSG_REGISTER_EMAIL_ALREADY_EXIST", "Sorry! this email address already exists. If you have forgotten your login details. Please <a href='".DIR_WS_SITE."?page=login'>click here</a> to know your login details.");
define("MSG_REGISTER_SUCCESS", "You details have been accepted.");


# forgot password messages.
define("MSG_FORGOT_PASSWORD_SUCCESS", "A link has been sent to your email address. Please click that link to set new password.");
define("MSG_FORGOT_PASSWORD_FAIL", "Your email address does not exist in our database.<br />If you are a new user. Please <a href='".DIR_WS_SITE."?page=register'>click here</a> to register.<br /> You can <a href='".DIR_WS_SITE."?page=forgotpassword'>click here</a> to try again.");



# change password messages.
define("MSG_CHANGE_PASSWORD_SUCCESS", "Your password has been changed successfully.<br>Your new login details have been sent to your email address.");
define("MSG_CHANGE_PASSWORD_FAILED", "You have entered a wrong password.");
define("MSG_PASSWORD_RESET", "Your <b>account password</b> has been reset successfully.");
define("MSG_NOT_AUTHORIZED", "You are not <b>authorized</b> to do this.");

#others.
define("MSG_ONLINE_ENQUIRY_SUCCESS", "Your online enquiry has successfully been submitted.");
define("MSG_FREE_SAMPLE_SENT_SUCCESS", "Thank you, Your free sample request has been sent. Our support staff will contact you soon.");
define("MSG_PAYMENT_SUCCESS","Your order has successfully been placed. You can track your order states by logging into your online account.<br/> Your login details 
have been emailed to you (in case you are a new customer). Please <a href='".DIR_WS_SITE."?page=login'><strong><u>click here</u></strong></a> to login.");
define("MSG_CUSTOM_SUCCESS","Thank you for shopping at ".SITE_NAME.".Your order will be processed shortly.");

#cart messages.
define("MSG_CART_OUT_OF_STOCK", 'Sorry! This item is currently out of stock.');
define("MSG_CART_ALREADY_IN_CART", 'This item is already in the cart.');

#shopping messages.
define("MSG_SHOP_CATEGORY_NO_PRODUCT_FOUND","Sorry! There is no product in this category.",true);
define("MSG_SHOP_ORDER_COMPLETE_SUCCESS","You have successfully completed your order.",true);


# website control panel messages.
define("MSG_ADMIN_UPDATE_SUCCESS","Record updated successfully",true);
define("MSG_ADMIN_DELETE_SUCCESS","Record deleted successfully",true);
define("MSG_ADMIN_ADDITION_SUCCESS","Record added successfully",true);
define("MSG_ADMIN_PERMISSION_DENIED","You donot have permission to access the page.",true);


define("MSG_CONTACTUS","Your request have been submitted successfully.");
define("MSG_CONTACTUS_COMPLETE_INFO","Please enter compalete information");

define("MSG_BUSINESS","Your Business has been added successfully. Please wait for the administrator approvel");
define("MSG_INTERACTIVE_MAP","Please select a Business Category.");
?>