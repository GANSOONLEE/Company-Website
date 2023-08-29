
<!-- form background -->
<div class="form-background show">

    <!-- form -->
    <div class="form">

        <!-- title description -->
        <div class="form-header">
            <p class="form-title">Confirm Order</p>
            <p class="form-description">
                Make sure you check the cart carefully<br>
                If you submit, you can't edit the order.
            </p>
        </div>

        <!-- cart content -->
        <div class="form-body">
            
            <div class="cart-container">

                @foreach($cartData as $cart_content)
                    <div class="cart">
                        <div class="cart-information">
                            <p>Blower Motor</p><br>
                            <p>ABC DEF</p><br>
                            <p>TESTING-AS-002</p><br>
                            <p>16 ptc.</p><br>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>

        <!-- button -->
        <div class="form-footer">

        </div>
    </div>

</div>