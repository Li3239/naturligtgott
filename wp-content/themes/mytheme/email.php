<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>

<body>
    <style>
        .email-content {
            display: flex;
            flex-direction: column;
            width: 80%;
            max-width: 900px;
            height: 800px;
            margin: auto;
        }

        .email-content .email-header-title {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100px;
            background-color: purple;
            text-align: center;
            /* margin-bottom: 20px; */
            margin: auto;
        }

        .email-content .email-header-title p {
            font-family: Roboto;
            font-size: 48px;
            font-weight: 700;
            line-height: 56px;
            letter-spacing: 0em;
            text-align: left;
            color: #FFFFFF;
        }

        .email-content .email-order-inner {
            margin-bottom: 20px;
        }

        .email-content .email-order-inner .customer-name {
            font-weight: bold;
            display: block;
        }

        .email-content .email-order-inner .order-summary-info,
        .email-content .email-order-inner .order-payment-info {
            display: block;
            margin-bottom: 10px;
        }

        .email-content .email-order-inner #order-title {
            font-size: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .email-content .email-order-detail table {
            width: 100%;
            border-collapse: collapse;
        }

        .email-content .email-order-detail table th,
        .email-content .email-order-detail table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .email-content .email-order-detail table th {
            background-color: #f9f9f9;
        }

        .email-content .email-shipping-billing {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .email-content .email-shipping-billing .email-billing {
            width: 48%;
        }

        .email-content .email-shipping-billing .email-billing h2 {
            margin-bottom: 10px;
        }

        .email-content .email-shipping-billing .email-billing .address p {
            margin: 0 0 10px;
        }

        .related-container {
            display: flex;
            flex-wrap: nowrap;
            justify-content: space-around;
            /* align-items: center; */
        }

        .related-container .related-product {
            flex: 1;
            max-width: 25%;
            margin-right: 10px;
        }

        .related-container .related-product a {
            display: block;
            text-align: center;
        }

        .related-container .related-product a img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <div class="email-content">
        <div class="email-header-image">
        </div>
        <div class="email-header-title">
            <p>Thank you for your order</p>
        </div>
        <div class="email-order-inner">
            <!--  -->
            <span class="customer-name"><?php echo $order->get_billing_first_name(); ?></span>
            <span class="order-summary-info">Just to let you know — we've received your order #<?php echo $order_id; ?>, and it is now being processed:</span>
            <span class="order-payment-info">Pay with <?php echo $order->get_payment_method_title(); ?>.</span>
            <h2 class="order-title">[Order #<?php echo $order_id; ?>] (<?php echo $order->get_date_paid(); ?>)</h2>
        </div>
        <div class="email-order-detail">
            <table>
                <!-- title -->
                <thead>
                    <tr>
                        <th class="column-product">Product</th>
                        <th class="column-quantity">Quantity</th>
                        <th class="column-price">Price</th>
                    </tr>
                </thead>
                <!-- order item detail (Multipule)-->
                <tbody>
                    <tr class="email-order-item">
                        <?php echo $items_list; ?>
                    </tr>
                </tbody>
                <!-- subtotal / shipping / Payment method -->
                <tfoot>
                    <tr>
                        <th class="column-samary-title" scope="row" colspan="2">Subtotal:</th>
                        <td class="column-samary-content" scope="row" colspan="2">
                            <span class="woocommerce-Price-amount amount">
                                <?php echo wc_price($order->get_subtotal()); ?>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th class="column-samary-title" scope="row" colspan="2">Shipping:</th>
                        <td class="column-samary-content">
                            <span class="woocommerce-Price-amount amount">
                                <?php echo wc_price($order->get_shipping_total()); ?>
                            </span>
                            &nbsp;
                            <small class="shipped_via"><?php echo $order->get_shipping_method(); ?></small>
                        </td>
                    </tr>
                    <tr>
                        <th class="column-samary-title" scope="row" colspan="2">Payment method:</th>
                        <td class="column-samary-content"><?php echo $order->get_payment_method(); ?></td>
                    </tr>
                    <tr>
                        <th class="column-samary-title" scope="row" colspan="2">Total:</th>
                        <td class="column-samary-content">
                            <span class="woocommerce-Price-amount amount">
                                <?php echo wc_price($order->get_total()); ?>
                            </span>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="email-shipping-billing">
            <div class="email-billing">
                <h2>Billing address</h2>
                <div class="address">
                    <p class="billing-name"><?php echo $order->get_billing_first_name() . ' ' . $order->get_billing_last_name(); ?></p>
                    <p class="billing-address"><?php echo $order->get_billing_address_1() . ' ' . $order->get_billing_address_2(); ?></p>
                    <p class="billing-post"><?php echo $order->get_billing_postcode(); ?></p>
                    <p class="billing-city"><?php echo $order->get_billing_city(); ?></p>
                </div>
            </div>

            <p style="margin: 0 0 16px;"><?= get_option('email_thanks_info'); ?></p>
        </div>
        <!-- ralated product list -->
        <div class="related-container">
            <?php echo $related_products_html; ?>
        </div>
    </div>
</body>

</html>