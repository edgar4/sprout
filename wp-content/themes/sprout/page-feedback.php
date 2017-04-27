<?php
/**
 * Created by PhpStorm.
 * User: edgarchris
 * Date: 4/21/17
 * Time: 16:09
 */

get_header(); $user = wp_get_current_user();

echo phpinfo();

if($user->roles[0] =='parent'){
    $price = 300;
}else{
    $price = 1500;
}
?>


    <div class="container-fluid">
        <div class="widget-box">
            <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
                <div class="item item-text-wrap">
                    <input type="hidden" name="action" value="prefix_send_email_to_admin">
                    <p><strong>How to pay</strong></p>
                    <ul>
                        <li>Go to the M-PESA menu on your phone</li>
                        <li>Select Pay Bill option</li>
                        <li>Enter the following business number: <strong>759696</strong></li>
                        <li>Enter <strong>SPT-<?php echo $user->ID?></strong> as the Account Number</li>
                        <li id="cart_total">Enter the total amount <strong> <?php echo $price?></strong></li>
                        <li>Enter your PIN and then send the money</li>
                        <li>You will receive a transaction confirmation SMS from M-PESA</li>
                        <li> Enter the Transaction Code recieved from Mpesa below and click make payment</li>
                        <li>Once payment is received your account will be automatically updated.
                        </li>
                    </ul>
                    <div class="list">
                        <label class="item item-input item-floating-label">
                            <span class="input-label">M-PESA Transaction Code</span>
                            <input type="text" name="transactionCode" class="form-control" placeholder=Transaction Code" required>
                        </label>

                    </div>
                    <button class=" btn  btn-info btn-large"
                            data-ink-color="#031a49" data-ink-opacity="0.5">Make Payment
                    </button>

                </div>
            </form>
        </div>
    </div>
    </div>
<?php get_footer(); ?>