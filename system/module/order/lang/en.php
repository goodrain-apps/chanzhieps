<?php if(!defined("RUN_MODE")) die();?>
<?php
$lang->order->common  = 'Order';

$lang->order->id             = 'ID';
$lang->order->productInfo    = 'Products';
$lang->order->account        = 'Account';
$lang->order->address        = 'Address';
$lang->order->price          = 'Price';
$lang->order->count          = 'count';
$lang->order->amount         = 'Amount';
$lang->order->sn             = 'Payment Number';
$lang->order->payStatus      = 'Pay Status';
$lang->order->paidDate       = 'Paid Time';
$lang->order->deliveryStatus = 'Delivery Status';
$lang->order->deliveriedDate = 'Deliveried Time';
$lang->order->confirmedDate  = 'Time of receipt';
$lang->order->payment        = 'Transaction Mode';
$lang->order->createdDate    = 'Order time';
$lang->order->express        = 'Courier company';
$lang->order->waybill        = 'Waybill number';
$lang->order->expressInfo    = 'Express Information';
$lang->order->receiver       = 'Receiver';
$lang->order->noRecord       = 'No record';
$lang->order->status         = 'Status';
$lang->order->note           = 'Message to seller';
$lang->order->basic          = 'Basic Info';
$lang->order->info           = 'Detailed Info';

$lang->order->admin          = 'Admin Orders';
$lang->order->view           = 'Order Info';
$lang->order->setting        = 'Settings';
$lang->order->browse         = 'My Orders';
$lang->order->bought         = 'Browse bought producs';
$lang->order->createdSuccess = 'Order created successfully！';
$lang->order->paidSuccess    = 'Order paid successfully!';
$lang->order->submit         = 'Submit order';
$lang->order->cancel         = 'Cancel';
$lang->order->pay            = 'Pay';
$lang->order->goToPay        = 'Please complete the payment.';
$lang->order->return         = 'Receive payment';
$lang->order->delivery       = 'Delivery';
$lang->order->finish         = 'Finish';
$lang->order->confirm        = 'Confirm order';
$lang->order->selectProducts = "<strong class='text-danger'>%s</strong> products selected, ";
$lang->order->totalToPay     = "cost：<strong id='amount' class='text-danger'>%s</strong>";
$lang->order->payInfo        = "Order from %s for %s";
$lang->order->goToBank       = "Please pay your order online.";
$lang->order->track          = 'Logistics Tracking';
$lang->order->life           = 'Order Life';
$lang->order->days           = 'Days';
$lang->order->deliveryInfo   = 'Delivery Information';
$lang->order->backToCart     = 'Back to Cart for Changing';
$lang->order->paid           = 'I have paid';
$lang->order->products       = 'Products';
$lang->order->selectPayment  = 'Select payment';
$lang->order->settlement     = 'To the settlement.';

$lang->order->confirmLimit         = 'Confirm Delivery in';
$lang->order->confirmReceived      = 'Confirm Received';
$lang->order->deliveryConfirmed    = 'Your order delivery is received';
$lang->order->confirmWarning       = "Make sure you have received good.";
$lang->order->cancelWarning        = "Confirm to cancel this order?";
$lang->order->cancelSuccess        = "order successsfully canceled";
$lang->order->paymentRequired      = 'At least one mode required';
$lang->order->confirmLimitRequired = 'You should set a  expiry dates of delivery receiving';
$lang->order->finishWarning        = "Make sure to finish this order?";
$lang->order->noProducts           = "No products in order";
$lang->order->lowStocks            = "<strong>%s</strong>Inventory shortage ";

$lang->order->alipayPid   = 'Partner ID';
$lang->order->alipayKey   = 'Partner KEY';
$lang->order->alipayEmail = 'Alipay Email';
$lang->order->score       = 'Score Recharge';

$lang->order->placeholder = new stdclass();
$lang->order->placeholder->pid = 'Corporate identity to ID, 16 pure number begin with 2088.';
$lang->order->placeholder->key = 'Security checking code, 32 characters to numbers and letters.';
$lang->order->placeholder->email = 'Alipay Email';

$lang->order->paymentList = array();
$lang->order->paymentList['alipay']        = 'Alipay Payment';
$lang->order->paymentList['alipaySecured'] = 'Alipay Secured';
$lang->order->paymentList['COD']           = 'Cash on Delivery';

$lang->order->statusList = array();
$lang->order->statusList['not_paid']  = 'Not Paid';
$lang->order->statusList['paid']      = 'Paid';
$lang->order->statusList['not_send']  = 'Not Send';
$lang->order->statusList['send']      = 'Send';
$lang->order->statusList['confirmed'] = 'Received';
$lang->order->statusList['normal']    = 'Going';
$lang->order->statusList['finished']  = 'Finished';
$lang->order->statusList['canceled']  = 'Canceled';
